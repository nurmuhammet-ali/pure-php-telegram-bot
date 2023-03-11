<?php

function home_dir(string $path = '')
{
	return strlen($path) == 0 
		? __DIR__ . '/../'
		: __DIR__ . '/../' . $path;
}

function pages(string|int $name)
{
	require home_dir('pages/' . $name .'.php');
}

function api(string|int $name)
{
	require home_dir('api/' . $name .'.php');
}

function keyValueExistsInArray(array $datas, string|int $key, string|int $value)
{
	foreach ($datas as $data) {
		if (isset($data[$key]) && $data[$key] == $value) {
			return true;
		}
    }

    return false;
}

function changeEnv(string $name, mixed $value): bool
{
	$values = [$name => $value];

    $envFile = home_dir('.env');
    $str = file_get_contents($envFile);

    if (\count($values) > 0) {
        $str .= "\n"; // In case the searched variable is in the last line without \n
        foreach ($values as $envKey => $envValue) {
            if ($envValue === true) {
                $value = 'true';
            } elseif ($envValue === false) {
                $value = 'false';
            } else {
                $value = $envValue;
            }

            $envKey = mb_strtoupper($envKey);
            $keyPosition = mb_strpos($str, "{$envKey}=");
            $endOfLinePosition = mb_strpos($str, "\n", $keyPosition);
            $oldLine = mb_substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
            $space = mb_strpos($value, ' ');
            $envValue = $space === false ? $value : '"' . $value . '"';

            // If key does not exist, add it
            if (! $keyPosition || ! $endOfLinePosition || ! $oldLine) {
                $str .= "{$envKey}={$envValue}\n";
            } else {
                $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
            }
        }
    }

    $str = mb_substr($str, 0, -1);

    if (! file_put_contents($envFile, $str)) {
        return false;
    }

    return true;
}

function response()
{
	require_once 'response.php';

	return new Response();
}
