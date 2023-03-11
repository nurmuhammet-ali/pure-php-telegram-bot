<?php

function home_dir()
{
	return __DIR__ . '/../';
}

function pages($name)
{
	require home_dir().'pages/' . $name .'.php';
}

function api($name)
{
	require home_dir().'api/' . $name .'.php';
}
