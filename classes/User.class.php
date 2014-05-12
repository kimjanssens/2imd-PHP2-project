<?php  
	include_once("Db.class.php");
	class User{
		private $m_sName;
		private $m_sStreet;
		private $m_sCity;
		private $m_sPhone;
		private $m_sPassword;

		public function __set($p_sProperty, $p_vValue){
			switch ($p_sProperty) {
				case "Name":
					if (empty($p_vValue)) {
						throw new Exception("Name field is empty");
					}
					$this->m_sName = $p_vValue;
					break;
				case "Street":
					if (empty($p_vValue)) {
						throw new Exception("Street field is empty");
					}
					$this->m_sStreet = $p_vValue;
					break;
				case "City":
					if (empty($p_vValue)) {
						throw new Exception("City field is empty");
					}
					$this->m_sCity = $p_vValue;
					break;
				case "Phone":
					if (empty($p_vValue)) {
						throw new Exception("Phone field is empty");
					}
					$this->m_sPhone = $p_vValue;
					break;
				case "Password":
					if(empty($p_vValue)){
						throw new Exception("Password field is empty");
					}
					if(strlen($p_vValue)<5){
						throw new Exception("Password not long enough");
					}
					$salt = "#WeAreIMD!001";
					$this->m_sPassword = md5($p_vValue.$salt);
					break;
			}
		}
		public function __get($p_sProperty){
			switch ($p_sProperty) {
				case "Name":
					return $this->m_sName;
					break;
				case "Street":
					return $this->m_sStreet;
					break;
				case "City":
					return $this->m_sCity;
					break;
				case "Phone":
					return $this->m_sPhone;
					break;
				case "Password":
					return $this->m_sPassword;
					break;
			}
		}
		public function Save(){
			$db = new Db();
			$sql = "INSERT INTO tbl_users (name, street, city, phone, password) VALUES (
				'".$db->conn->real_escape_string($this->m_sName)."',
				'".$db->conn->real_escape_string($this->m_sStreet)."',
				'".$db->conn->real_escape_string($this->m_sCity)."',
				'".$db->conn->real_escape_string($this->m_sPhone)."',
				'".$db->conn->real_escape_string($this->m_sPassword)."'
				)";
			$db->conn->query($sql);
		}
		
		public function Login()
		{
			$db = new Db();
			$sql = "SELECT * from tbl_users WHERE name = '".$db->conn->real_escape_string($this->m_sName)."' AND password = '".$db->conn->real_escape_string($this->m_sPassword)."';";
			
			$result = $db->conn->query($sql);
			
			if($result->num_rows ==1)
			{
				session_start();
				$_SESSION['username'] = $this->Name;
				$_SESSION['loggedinPassword'] = $this->Password;
				$_SESSION['loggedin'] = true;
				$_SESSION['type']='admin';
				foreach ($result as $id)
                {
                    $_SESSION['eigenId'] = $id['id'];
                }
				header('Location: admin.php');
			}
			else
			{
				throw new Exception("Username and/or password are invalid.");	
			}	
		}
	}
?>