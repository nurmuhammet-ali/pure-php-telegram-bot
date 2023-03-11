<?php 

function getUpdates(): ?object
{
	$curl = curl_init();
	curl_setopt_array($curl, [
	  CURLOPT_URL => 'https://api.telegram.org/bot'. TELEGRAM_TOKEN .'/getupdates',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	]);

	$response = curl_exec($curl);
	curl_close($curl);

	return json_decode($response);
}


function sendMessage(int $chat_id, string $message): void
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://api.telegram.org/bot'. TELEGRAM_TOKEN .'/sendMessage?chat_id='. $chat_id .'&text='. urlencode(mb_convert_encoding($message, 'UTF-8')),
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$response = curl_exec($curl);

	curl_close($curl);
}

function syncUpdatesWithDB(?object $updates): bool
{
	if (is_null($updates)) {
		return false;
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

	return true;
}

function sendMessageToAll(string $message): void
{
	syncUpdatesWithDB(getUpdates());

	$users = DB::query('SELECT * FROM users');

	foreach ($users as $user) {
		sendMessage(
			chat_id: $user['telegram_chat_id'],
			message: $message
		);
	}
}

function sendMessageToUsername(string $username, string|int $message)
{
	syncUpdatesWithDB(getUpdates());

	$data = DB::queryFirstRow('SELECT * FROM users WHERE telegram_username = %s', $username);

	if ($data) {
		sendMessage(
			chat_id: $data['telegram_chat_id'], 
			message: $message
		);
	}
}
