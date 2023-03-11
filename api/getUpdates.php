<?php 

$updates = getUpdates();

if (! $updates) {
	return response()->json([
		'message' => 'Connection problem to Telegram API'
	]);
}

syncUpdatesWithDB($updates);

return response()->json([
	'message' => 'Successefully updated'
]);
