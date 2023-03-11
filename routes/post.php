<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (! isset($_POST['action']) || $_POST['action'] == "") {
		die('Action is not set');
	}

	return match ($_POST['action']) {
		'getUpdates' => api('getUpdates'),
		'sendMessageToAll' => api('sendMessageToAll'),
		default => api('404')
	};
}
