<?php 

if (! isset($_POST['message']) || $_POST['message'] == "" || ! isset($_POST['username']) || $_POST['username'] == "") {
	return response()->json([
		'message' => 'No (message || username) ?'
	]);
}

sendMessageToUsername($_POST['username'], $_POST['message']);

return response()->json([
	'message' => 'sucess'
]);
