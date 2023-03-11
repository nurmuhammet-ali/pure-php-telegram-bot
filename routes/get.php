<?php 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if ($_SERVER['REQUEST_URI'] == '/') {
		return pages('home');
	}
}
