<?php
	include_once("Db.class.php");
	class Reservation{
		private $m_iTable;
		private $m_iHours;
		private $m_iPeople;
		private $m_sUser;

		public function __set($p_sProperty, $p_vValue){
			switch ($p_sProperty) {
				case "Table":
					$this->m_iTable = $p_vValue;
					break;
				case "Hours":
					$this->m_iHours = $p_vValue;
					break;
				case "People":
					$this->m_iPeople = $p_vValue;
					break;
				case "User":
					$this->m_sUser = $p_vValue;
					break;
			}
		}
		public function __get($p_sProperty){
			switch ($p_sProperty) {
				case "Table":
					return $this->m_iTable;
					break;
				case "Hours":
					return $this->m_iHours;
					break;
				case "People":
					return $this->m_iPeople;
					break;
				case "User":
					return $this->m_sUser;
					break;
			}
		}
		public function Save(){
			$db = new Db();
			$sql = "SELECT * FROM tbl_reservations WHERE hour = '".$db->conn->real_escape_string($this->m_iHours)."'";
			$result = mysqli_query($db->conn, $sql);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows < 1) {
				$sql2 = "INSERT INTO tbl_reservations (tbl_tables_id, hour, user, amount, time) VALUES (
			'".$db->conn->real_escape_string($this->m_iTable)."',
			'".$db->conn->real_escape_string($this->m_iHours)."',
			'".$db->conn->real_escape_string($this->m_sUser)."',
			'".$db->conn->real_escape_string($this->m_iPeople)."',
			now());";
			$db->conn->query($sql2);
			}else{
				throw new Exception("This hour has already been booked");
			}
		}
		public function GetAll(){
			$db = new Db();
			$sql = "SELECT * FROM tbl_reservations WHERE tbl_tables_id = '".$db->conn->real_escape_string($this->m_iTable)."'";
			$results = $db->conn->query($sql);
			foreach ($results as $result) {
				echo "<li>";
				echo "Reservation at ".$result['hour']."u for ".$result['amount']." by ".$result['user'];
				echo "</li>";
			}
		}
		public function Remove(){
			$db = new Db();
			$sql = "DELETE FROM tbl_reservations WHERE time < getdate()";
			$db->conn->query($sql);
		}
	}
?>