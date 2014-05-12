<?php
	if (isset($_POST["restaurant"])) {
		try {
			include_once('../classes/Resto.class.php');
			$r = new Resto();
			$check = $r->GetRestaurantDetails($_POST["restaurant"]);

			$teller = 0;
			foreach($check as $field)
            {
                $response["restaurant_name"][$teller] = $field['name'];
                $teller++;
            }
		} catch (Exception $e) {
			$response["restaurant_name"] = $e->getMessage();
		}
			
			
			

		echo json_encode($response);
	}
?>