<?php


if (! isset($_POST['message']) || $_POST['message'] == "") {
	return response()->json([
		'message' => 'No message?'
	]);
}

sendMessageToAll($_POST['message']);

return response()->json([
	'message' => 'Successefully sent'
]);
