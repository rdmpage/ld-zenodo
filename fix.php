<?php

// Check source file makes sense


error_reporting(E_ALL);

require_once('core.php');

$fix = array();


$files1 = scandir($config['cache']);

//$files1 = array('225'); // debugging


foreach ($files1 as $directory)
{
	if (preg_match('/^\d+$/', $directory))
	{	
		$files2 = scandir($config['cache'] . '/' . $directory);
				
		foreach ($files2 as $filename)
		{
			if (preg_match('/\.json$/', $filename))
			{
				// how big is the file?
				
				$json_filename = $config['cache'] . '/' . $directory . '/' . $filename;
				
				$size = filesize($json_filename);
				
				//echo $size . "\n";
				
				if ($size < 200)
				{
					echo $size . "\n";
					$fix[] = 'oai:zenodo.org:' . str_replace('.json', '', $filename);
				}
			}
		}
	}
}


echo join("\n", $fix);

?>


