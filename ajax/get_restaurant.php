<?php
	if (isset($_POST["restaurant"])) {
		try {
			session_start();
			include_once('../classes/Resto.class.php');
			$r = new Resto();
			$check = $r->GetRestaurantDetails($_POST["restaurant"]);
			
			$_SESSION['currentRestaurantId'] = $_POST["restaurant"];

			foreach($check as $field)
            {
                $response["restaurant_name"] = $field['name'];
            }
		} catch (Exception $e) {
			$response["restaurant_name"] = $e->getMessage();
		}
			
			
			

		echo json_encode($response);
	}
?>