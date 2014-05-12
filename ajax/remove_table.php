<?php
	if (isset($_POST["tableId"])) {
		try {
			include_once('../classes/Resto.class.php');
			$r = new Resto();
			$r->RemoveTable($_POST["tableId"]);

            $response["feedback"] = "Tafel verwijderd";
		} catch (Exception $e) {
			$response["feedback"] = $e->getMessage();
		}
			

		echo json_encode($response);
	}
?>