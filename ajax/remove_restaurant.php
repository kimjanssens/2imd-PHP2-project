<?php
	if (isset($_POST["restoId"])) {
		try {
			include_once('../classes/Resto.class.php');
			$r = new Resto();
			$r->RemoveRestaurant($_POST["restoId"]);

            $response["feedback"] = "Restaurant verwijderd.";
		} catch (Exception $e) {
			$response["feedback"] = $e->getMessage();
		}
			

		echo json_encode($response);
	}
?>