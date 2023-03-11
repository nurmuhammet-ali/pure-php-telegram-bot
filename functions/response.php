<?php 

class Response
{
	public function __construct() {}

	public function json(array $data = [])
	{
		header("Content-Type: application/json");

		echo json_encode($data);
	}
}
