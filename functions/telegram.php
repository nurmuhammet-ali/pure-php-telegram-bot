<?php 

function getUpdates()
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


function sendMessage(int $chat_id, string $message)
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

function sendMessageToAll(string $message)
{
	$chats = getUpdates();

	$chat_ids = [];
	foreach ($chats->result as $chat) {
		if (! in_array($chat->message->chat->id, $chat_ids)) {
			$chat_ids[] = $chat->message->chat->id;

			sendMessage(
				chat_id: $chat->message->chat->id,
				message: $message
			);
		}
	}
}
