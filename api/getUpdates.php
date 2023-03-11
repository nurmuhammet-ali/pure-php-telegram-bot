<?php 

$updates = getUpdates();

if (! $updates) {
	return response()->json([
		'message' => 'Connection problem to Telegram API'
	]);
}

if (empty($updates->result)) {
	return response()->json([
		'message' => 'no-updates'
	]);
}

$registeredUsers = DB::query('select * from users');
$users = [];
foreach($updates->result as $update) {
	$chat = $update->message->chat;

	// If username is in db or already inn users array, skip
	if (keyValueExistsInArray($registeredUsers, 'telegram_username', $chat->username) || keyValueExistsInArray($users, 'username', $chat->username)) {
		continue;
	}

	$users[] = [
		'chat_id' => $chat->id,
		'first_name' => $chat->first_name,
		'username' => $chat->username
	];
}

foreach ($users as $user) {
	DB::insert('users', [
	  'telegram_username' => $user['username'],
	  'telegram_first_name' => $user['first_name'],
	  'telegram_chat_id' => $user['chat_id']
	]);
}
