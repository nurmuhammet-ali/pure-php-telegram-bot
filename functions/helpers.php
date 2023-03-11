<?php

function home_dir()
{
	return __DIR__ . '/../';
}

function pages($name)
{
	require home_dir().'pages/' . $name .'.php';
}
