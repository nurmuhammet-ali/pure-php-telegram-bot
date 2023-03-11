<?php


if (! isset($_POST['message']) || $_POST['message'] == "") {
	return response()->json([
		'message' => 'No message?'
	]);
}

sendMessageToAll($_POST['message']);

$response = [
	'ok' => true,
	'message' => 'Successefully sent'
];

header("Content-Type: application/json");
echo json_encode($response);
return;
