<?php

// fetch data using a list of ids and store in cache

require_once(dirname(__FILE__) . '/core.php');

$filename = "ids.txt";
$filename = "extra.txt";

$force = false; // true if always grab new copy
//$force = true;
$fresh = false; // true if refresh older copies

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	$id = trim(fgets($file_handle));
	
	$id = str_replace('oai:zenodo.org:', '', $id);
	
	if ($id != '')
	{
	
		$data = get_one($id, $force, $fresh);
	
		if ($data)
		{
			echo $data;
		}
	}	
}	

?>
