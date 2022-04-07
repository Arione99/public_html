<?php
class User {
	protected $db;
	public function __construct(){
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}

	/*** Login Process ***/
	public function checkLogin($Email, $Password){
		$password = md5($Password);

		$query = "SELECT * from useraccount WHERE email='$Email' and password='$password' and status=0";	
		
		$result = $this->db->query($query) or die($this->db->error);

		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
		    
			$_SESSION['login'] = true; // this login var will use for the session thing
			$_SESSION['id'] = $user_data['id'];
			$_SESSION['fullname'] = $user_data['fname'].' '.$user_data['lname'];
			$_SESSION['position'] = $user_data['position'];
			$_SESSION['image'] = $user_data['image'];
			$_SESSION['section'] = $user_data['section'];
			
			return true;
		}
		else{return false;}

	}	//end

	/*** User Information ***/
	public function getData($users_id){

		$query = "SELECT * FROM useraccount WHERE id = $users_id";
		$result = $this->db->query($query) or die($this->db->error);

		$row = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
			return $row;
		}
		else{return false;}
	} //end

	/*** Check Session ***/
	public function getSession(){

		if(isset($_SESSION['login'])) {
			return true;
		}
		else { return false; }
	}	//end

	/*** LogOut Session ***/
	public function userLogout() {
        
		$_SESSION['login'] = FALSE;
		unset($_SESSION);
		session_destroy();
	}
}
?>
