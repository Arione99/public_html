<?php
class SQL {
	protected $db;
	public function __construct(){
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}

    public function grade(){
        
        $array = array();
        
		$query = "SELECT * FROM `grade`";
		$result = $this->db->query($query) or die($this->db->error);
		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;
	}
	
	
	public function insertSubject($post){
        
        extract($post);
        
		$query = "INSERT INTO `subject`(`gradeID`, `subject`, `status`) VALUES ('$gradeID', '$subject', '0')";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function getSubject($grade){
        
        $array = array();
        
		$query = "SELECT * FROM `subject` WHERE `gradeID` = '$grade' AND `status` = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end 
	
	public function deleteSubject($id){
	
		$query = "UPDATE `subject` SET `status` = '1' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function insertUser($post){
        
        extract($post);
        $password = md5('123456');
        if($position == 'Student'){
         $query = "INSERT INTO `useraccount`(`email`, `password`, `image`, `fname`, `mname`, `lname`, `bday`, `gender`, `address`, `section`,  `position`, `status`) VALUES ('$email', '$password', 'images/profile/profile.png', '$fname', '$mname', '$lname', '$bday', '$gender', '$address', '$section', '$position', '0')";
		 $result = $this->db->query($query) or die($this->db->error);
		 
         $last_id = $this->db->insert_id;
		 $query = "INSERT INTO `studentrecordhistory`(`sectionID`, `studentID`, `status`) VALUES ('$section', '$last_id', '0')";
		 $result = $this->db->query($query) or die($this->db->error);
        } else {
		 $query = "INSERT INTO `useraccount`(`email`, `password`, `image`, `fname`, `mname`, `lname`, `bday`, `gender`, `address`, `position`, `status`) VALUES ('$email', '$password', 'images/profile/profile.png', '$fname', '$mname', '$lname', '$bday', '$gender', '$address', '$position', '0')";
		 
		 $result = $this->db->query($query) or die($this->db->error);
        }

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function getUser($position){
        
        $array = array();
        
		$query = "SELECT useraccount.*, section.sectionName, section.gradeID FROM `useraccount` LEFT JOIN section ON section.id = useraccount.section WHERE `position` LIKE '$position' AND useraccount.`status` = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end 
	
	public function defaultUser($id){
		$password = md5('123456');
		
		$query = "UPDATE `useraccount` SET `password` = '$password' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function updatePassword($password){
		
		$query = "UPDATE `useraccount` SET `password` = '$password' WHERE `id` = '$_SESSION[id]'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function updateUser($post){
		
        extract($post);
        
		$query = "UPDATE `useraccount` SET `email`='$email',`image`='$image',`fname`='$fname',`mname`='$mname',`lname`='$lname',`bday`='$bday',`gender`='$gender',`address`='$address' WHERE `id`='$_SESSION[id]'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function deleteUser($id){
	
		$query = "UPDATE `useraccount` SET `status` = '1' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function insertSection($post){
        
        extract($post);
        
		$query = "INSERT INTO `section`(`gradeID`, `section`, `sectionName`, `advicer`, `schoolYear`, `status`) VALUES ('$gradeID', '$section', '$sectionName', '$advicer', '$schoolYear', '0')";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function sectionInfo($section){
        
		$query = "SELECT * FROM `section` WHERE `id` = $section";
		$result = $this->db->query($query) or die($this->db->error);

		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		return $row;

	}	//end
	
	public function getSection($gradeID, $schoolyear){
        
        $array = array();
        
		$query = "SELECT section.*, useraccount.fname, useraccount.lname FROM `section` LEFT JOIN useraccount on useraccount.id=section.advicer WHERE `gradeID` = '$gradeID' AND `schoolYear` LIKE '$schoolyear' AND section.`status` = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end 
	
	public function updateSection($post){
	
        extract($post);
        
		$query = "UPDATE `section` SET `sectionName`='$sectionName',`advicer`='$advicer',`section`='$section' WHERE `id`='$update'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function deleteSection($id){
	
		$query = "UPDATE `section` SET `status` = '1' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function insertDocuments($post){
        
        extract($post);
        
		$query = "INSERT INTO `documents`(`documents`, `status`) VALUES ('$documents', '0')";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function getDocuments(){
        
        $array = array();
        
		$query = "SELECT * FROM `documents` WHERE status = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	public function deleteDocuments($id){
	
		$query = "UPDATE `documents` SET `status` = '1' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function getAdvisory(){
        
        $array = array();
        
		$query = "SELECT * FROM `section` WHERE `advicer` = '$_SESSION[id]' AND `status` = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	public function studentInSection($section){
        
        $array = array();
        
		$query = "SELECT useraccount.*, useraccount.id as studentID, useraccount.section as presentSection, section.*, studentrecordhistory.id as mainID, nextSectionName.sectionName as movingUP, nextSection.id as movingUPID FROM `studentrecordhistory` 
		LEFT JOIN useraccount ON useraccount.id=studentrecordhistory.studentID 
		LEFT JOIN section ON section.id=studentrecordhistory.sectionID 
		
		LEFT JOIN studentrecordhistory as nextSection ON nextSection.id=studentrecordhistory.nextSectionID 
		LEFT JOIN section as nextSectionName ON nextSectionName.id=nextSection.sectionID 
		
		WHERE studentrecordhistory.`sectionID` = '$section' AND studentrecordhistory.`status` = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	public function studentgradeS($studentRecordID, $subjectID){
        
		$query = "SELECT * FROM `studentgrade` WHERE `studentRecordID` = '$studentRecordID' AND `subjectID` = '$subjectID'";
		$result = $this->db->query($query) or die($this->db->error);

		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		return $row;

	}	//end
	
	public function insertGrade($post){
        
        extract($post);
        foreach($id as $no => $mailID){
            $studentRecordID = $updateGrade;
            $subjectID = $subjectID_[$no];
            $quarter1 = $quarter1_[$no];
            $quarter2 = $quarter2_[$no];
            $quarter3 = $quarter3_[$no];
            $quarter4 = $quarter4_[$no];
            $final = $final_[$no];
            $remarks = $remarks_[$no];
            
		    if ($mailID != "") {
		        
		        $query = "UPDATE `studentgrade` SET `quarter1`='$quarter1', `quarter2`='$quarter2',`quarter3`='$quarter3',`quarter4`='$quarter4',`final`='$final',`remarks`='$remarks' WHERE `id`='$mailID'";
		    } else {
		        
		        $query = "INSERT INTO `studentgrade`(`studentRecordID`, `subjectID`, `quarter1`, `quarter2`, `quarter3`, `quarter4`, `final`, `remarks`) VALUES ('$studentRecordID', '$subjectID', '$quarter1', '$quarter2', '$quarter3', '$quarter4', '$final', '$remarks')";
		    }
		    
		    $result = $this->db->query($query) or die($this->db->error);
        }

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function insertRequest($post){
        
        extract($post);
        
		$query = "INSERT INTO `requestfile`(`requestor`, `sectionID`, `file`, `reason`, `dateRequest`, `status`) VALUES ('$_SESSION[id]','$_SESSION[section]','$file','$reason','$dateRequest','Pending')";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function getAllRequest($status){
        
        $array = array();
        
		$query = "SELECT requestfile.*, useraccount.fname, useraccount.mname, useraccount.lname, section.gradeID, section.sectionName FROM `requestfile` 
		LEFT JOIN useraccount ON useraccount.id=requestfile.requestor 
		LEFT JOIN section ON section.id = requestfile.sectionID WHERE requestfile.`status` = '$status'";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	public function getAllRequestByMyStudent(){
        
        $array = array();
        
		$query = "SELECT requestfile.*, useraccount.fname, useraccount.mname, useraccount.lname, section.gradeID, section.sectionName FROM `requestfile` 
		LEFT JOIN useraccount ON useraccount.id=requestfile.requestor 
		LEFT JOIN section ON section.id = requestfile.sectionID WHERE section.`advicer` = '$_SESSION[id]'";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	public function getRequest(){
        
        $array = array();
        
		$query = "SELECT * FROM `requestfile` WHERE `requestor` = $_SESSION[id]";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end 
	
	public function readytoPickup(){
        
        $array = array();
        
		$query = "SELECT * FROM `requestfile` WHERE `requestor` = $_SESSION[id] AND dateRelease >= '".date('Y-m-d')."'";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end 
	
	public function cancelRequest($id, $status){
	
		$query = "UPDATE `requestfile` SET `status` = '$status' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function finishRequest($post){
	
        extract($post);
		
		$query = "UPDATE `requestfile` SET `status` = 'Finish', dateRelease='$dateRelease', `uploadfiles`='$uploadfiles' WHERE `id` = '$finish'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end 
	
	public function nextSection($grade, $year){
	
        $array = array();
        
		$query = "SELECT * FROM `section` WHERE `gradeID` = '$grade' AND `schoolYear` LIKE '$year'";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	public function movingGrade($post){
		
        extract($post);
		
		$query = "INSERT INTO `studentrecordhistory`(`sectionID`, `studentID`, `status`) VALUES ('$nextSectionID', '$studentID', '0')";
		$result = $this->db->query($query) or die($this->db->error);
		$last_id = $this->db->insert_id;
		 
		$query = "UPDATE `studentrecordhistory` SET `nextSectionID` = '$last_id' WHERE `id` = '$upgrade'";
		$result = $this->db->query($query) or die($this->db->error);
		
		$query = "UPDATE `useraccount` SET `section` = '$last_id' WHERE `id` = '$studentID'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function deleteUserInsection($id){
	
		$query = "UPDATE `studentrecordhistory` SET `status` = '1' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);
		
		$query = "UPDATE `studentrecordhistory` SET `nextSectionID` = NULL WHERE `nextSectionID` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function updateNewSection($post){
		
        extract($post);
		
		$query = "UPDATE `studentrecordhistory` SET `sectionID` = '$sectionID' WHERE `id` = '$updateSection'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function studentrecordhistory(){
		
        $array = array();
        
		$query = "SELECT studentrecordhistory.*, section.gradeID, section.sectionName, section.schoolYear, useraccount.fname, useraccount.lname FROM `studentrecordhistory`
		LEFT JOIN section ON section.id=studentrecordhistory.sectionID
		LEFT JOIN useraccount ON useraccount.id=section.advicer
		WHERE `studentID` = '$_SESSION[id]' AND studentrecordhistory.`status` = 0";
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;
	}	//end

	public function insertAnnouncement($post){
		
        extract($post);
		
		$query = "INSERT INTO `announcement`(`announcementTo`, `subject`, `message`, `dateTime`, `status`) VALUES ('$announcementTo','$subject','$message',NOW(), '0')";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
	
	public function getAnnouncement(){
		
        $array = array();
        if($_SESSION['position'] == 'Admin'){
			$query = "SELECT * FROM `announcement` WHERE `status` = 0 ORDER BY `announcement`.`id` DESC";
		} else if($_SESSION['position'] == 'Teacher'){
			$query = "SELECT * FROM `announcement` WHERE `announcementTo` IN (1,2) AND `status` = 0 ORDER BY `announcement`.`id` DESC";	
		} else {
			$query = "SELECT * FROM `announcement` WHERE `announcementTo` IN (1,3) AND `status` = 0 ORDER BY `announcement`.`id` DESC";	
			
		}
		$result = $this->db->query($query) or die($this->db->error);

		while($row = $result->fetch_array(MYSQLI_ASSOC))
    	{
    		$array[] = $row;
	    }
		
		return $array;

	}	//end
	
	
	public function deleteAnnouncement($id){
	
		$query = "UPDATE `announcement` SET `status` = '1' WHERE `id` = '$id'";
		$result = $this->db->query($query) or die($this->db->error);

		if ($result) {
			return true;
		}
		else{return false;}

	}	//end
}
?>
