<?php  
	include_once("Db.class.php");
	class Resto{
		private $m_sName;
		private $m_sStreet;
		private $m_sCity;
		private $m_iNumber;
		private $m_iAmount;
		private $m_iSeats;
		private $m_iRestoId;
		private $m_iTablenumber;

		

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
				case "Amount":
					if (empty($p_vValue)) {
						throw new Exception("Aantal tafels veld is leeg.");
					}
					$this->m_iAmount = $p_vValue;
					break;
				case "Seats":
					if (empty($p_vValue)) {
						throw new Exception("Aantal zitplaatsen veld is leeg.");
					}
					$this->m_iSeats = $p_vValue;
					break;
				case "RestoId":
					$this->m_iRestoId = $p_vValue;
					break;
				case "Tablenumber":
					if (empty($p_vValue)) {
						throw new Exception("Tafel nummer veld is leeg.");
					}
					$this->m_iTablenumber = $p_vValue;
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
				case "Number":
					return $this->m_iNumber;
					break;
				case "Amount":
					return $this->m_iAmount;
					break;
				case "Seats":
					return $this->m_iSeats;
					break;
				case "RestoId":
					return $this->m_iRestoId;
					break;
				case "Tablenumber":
					return $this->m_iTablenumber;
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
		
		public function GetAll(){
			$db = new Db();
            $sql = "SELECT * from tbl_restaurants;";
			$results = $db->conn->query($sql);

			foreach($results as $result){
				echo "<li><a href='restaurant-tables.php?id=".$result['id']."'>";
				echo "<h3>".$result['name']."</h3>";
				echo "<p>".$result['street'].", <strong>".$result['city']."</strong></p>";
				echo "</a></li>";
			}
		}

		public function GetAllTables(){
			$db = new Db();
            
            if(isset($_SESSION['currentRestaurantId']))
            {
                $sql = "SELECT * from tbl_tables WHERE restaurant_id = '".$db->conn->real_escape_string($_SESSION['currentRestaurantId'])."';";
            }
            else
            {
                $sql = "SELECT * from tbl_tables WHERE restaurant_id = '".$db->conn->real_escape_string($this->m_iRestoId)."';";
            }
			$results = $db->conn->query($sql);
            echo "<ul id='tables'>";
			foreach ($results as $result) {
				echo "<li><a href='restaurant-tables.php?id='".$result['id']."'";
				    echo "<span class='tableId' style='display: none;'>".$result['id']."</span>";
				    echo "<span>Tafel nummer: ".$result['table_nr']."</span>";
				    echo "<span>Zitplaatsen: ".$result['seats']."</span>";
				    if($result['status'] == 0)
                    {
                        echo "<span>Vrij</span>";
                    }
                    else
                    {
                        echo "<span>Geboekt</span>";
                    }
				    echo "<span><input type='button' class='btnRemoveTable' value='Verwijder tafel'></span>";
				echo "</a></li>";
			}
			echo "</ul>";
		}

		public function GetRestaurants()
        {
            $db = new Db();
            
            $sql = "SELECT * from tbl_restaurants WHERE user_id = '".$db->conn->real_escape_string($_SESSION['eigenId'])."';";
			$result = $db->conn->query($sql);
            
            echo "<select id='restaurants'>";
            foreach($result as $restaurant)
            {
                    if($restaurant['id'] == $_SESSION['currentRestaurantId'])
                    {
                        echo "<option selected value='".$restaurant['id']."'>".$restaurant['name']."</option>";
                    }
                    else
                    {
                        echo "<option value='".$restaurant['id']."'>".$restaurant['name']."</option>";
                    }
            }
            echo "</select>";
        }
        
        public function GetRestaurantDetails($id)
        {
            $db = new Db();
            
            $_SESSION['currentRestaurantId'] = $id;
            
            $sql = "SELECT * FROM tbl_restaurants WHERE id = '".$db->conn->real_escape_string($id)."';";

            $result = $db->conn->query($sql);
            $result_array=array();
            

            // LOOP OVER ALL RECORDS AND PUT THEM IN AN ARRAY
            while($row = $result->fetch_array())
            {
                $result_array[] = $row;
            }

            // RETURN RESULTS AS AN ARRAY
            return($result_array);
        }
        
        public function SaveTables(){
			$db = new Db();
			for ($i = 0; $i < $this->m_iAmount; $i++)
            {
                $sql = "INSERT INTO tbl_tables (restaurant_id, seats, table_nr, status) VALUES (
				'".$db->conn->real_escape_string($this->m_iRestoId)."',
				'".$db->conn->real_escape_string($this->m_iSeats)."',
				'".$db->conn->real_escape_string($this->m_iTablenumber+$i)."',
				'".$db->conn->real_escape_string(0)."'
				)";
			    $db->conn->query($sql);
            }
		}
	}
?>