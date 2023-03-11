<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (! isset($_POST['action']) || $_POST['action'] == "") {
		die('Action is not set');
	}

	if ($_POST['action'] == 'sendMessageToAll') {
		if (! isset($_POST['message']) || $_POST['message'] == "") {
			die('no message?');
		}

		sendMessageToAll($_POST['message']);

		$response = [
			'ok' => true,
			'message' => 'Successefully sent'
		];

		header("Content-Type: application/json");
		echo json_encode($response);
		return;
	}

	die("You're at wrong place boddy :}");
}
