<?php

// Remove JSON files and associted triples file if JSON has "message"
// which indicates there was a problem downlaoding

error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/core.php');

$files1 = scandir($config['cache']);

$count = 1;

foreach ($files1 as $directory)
{
	if (preg_match('/^\d+$/', $directory))
	{	
		$files2 = scandir($config['cache'] . '/' . $directory);
		
		foreach ($files2 as $filename)
		{
			if (preg_match('/\.json$/', $filename))
			{	
				$jsonfile = $config['cache'] . '/' . $directory . '/' . $filename;
			
				$id = str_replace('.nt', '', $filename);
				$ntfile = $config['cache'] . '/' . $directory . '/' . $filename;
				
				$json = file_get_contents($jsonfile);
				
				$obj = json_decode($json);
				
				if (isset($obj->message))
				{
					echo $json . "\n";
					
					unlink($jsonfile);
					
					if (file_exists($ntfile))
					{
						unlink($ntfile);					
					}
				}
			}
		}
	}
}

?>
