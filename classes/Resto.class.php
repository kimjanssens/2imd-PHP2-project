<?php  
	include_once("classes/Db.class.php");
	class Resto{
		private $m_sName;
		private $m_sStreet;
		private $m_sCity;
		private $m_iNumber;

		public function __set($p_sProperty, $p_vValue){
			switch ($p_sProperty) {
				case "Name":
					if (empty($p_vValue)) {
						throw new Exception("Restaurant naam veld is leeg.");
					}
					$this->m_sName = $p_vValue;
					break;
				case "Street":
					if (empty($p_vValue)) {
						throw new Exception("Straat veld is leeg.");
					}
					$this->m_sStreet = $p_vValue;
					break;
				case "Number":
					if (empty($p_vValue)) {
						throw new Exception("Huisnummer veld is leeg.");
					}
					$this->m_iNumber = $p_vValue;
					break;
				case "City":
					if (empty($p_vValue)) {
						throw new Exception("Stad veld is leeg.");
					}
					$this->m_sCity = $p_vValue;
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
					return $this->m_iNumber;
					break;
				case "Phone":
					return $this->m_sCity;
					break;
			}
		}
		public function Save(){
			$db = new Db();
			$sql = "INSERT INTO tbl_restaurants (user_id, name, street, city, number) VALUES (
				'".$db->conn->real_escape_string($_SESSION['eigenId'])."',
				'".$db->conn->real_escape_string($this->m_sName)."',
				'".$db->conn->real_escape_string($this->m_sStreet)."',
				'".$db->conn->real_escape_string($this->m_sCity)."',
				'".$db->conn->real_escape_string($this->m_iNumber)."'
				)";
			$db->conn->query($sql);
		}
		
		public function GetRestaurants()
        {
            $db = new Db();
            $sql = "SELECT * from tbl_restaurants WHERE user_id = '".$db->conn->real_escape_string($_SESSION['eigenId'])."';";
			$result = $db->conn->query($sql);
            
            echo "<ul>";
            echo "<h2>Huidige restauranten</h2>";
            foreach($result as $restaurant)
            {
                echo "<li>";
                    echo "<a href='restaurantdetails.php?id=".$restaurant['id']."&userid=".$restaurant['user_id']."'>".$restaurant['name']."</a>";
                echo "</li>";
            }
            echo "</ul>";
        }
        
        public function GetRestaurantDetails($id)
        {
            $db = new Db();
            $sql = "SELECT * FROM tbl_restaurants WHERE id = '".$db->conn->real_escape_string($id)."';";
			$result = $db->conn->query($sql);
            
            $restaurantArray = $result->fetch_assoc();
            
            return $restaurantArray;
        }
	}
?>