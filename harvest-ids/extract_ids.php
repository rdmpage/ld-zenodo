<?php

$ids = array();

$basedir ='cache/zenodo.org/userbiosyslit';

$files = scandir($basedir);

foreach ($files as $filename)
{
	if (preg_match('/\.xml$/', $filename))
	{	
		// do stuff on $basedir . '/' . $filename
		
		$xml = file_get_contents($basedir . '/' . $filename);
		
		if ($xml != '')
		{
		
			$xml = str_replace("\n", '', $xml);
			$xml = preg_replace('/<OAI-PMH(.*)>/Uu', '<OAI-PMH>', $xml);
				
			$dom = new DOMDocument;
			$dom->loadXML($xml);
			$xpath = new DOMXPath($dom);
		
			$xpath->registerNamespace("dc", "http://purl.org/dc/elements/1.1/");	
			$xpath->registerNamespace("oaidc", "http://www.openarchives.org/OAI/2.0/oai_dc/");	
			$xpath->registerNamespace("xsi", "http://www.w3.org/2001/XMLSchema-instance");	
		
			$identifiers = $xpath->query ('//ListIdentifiers/header/identifier');
			foreach($identifiers as $identifier)
			{
				$oai_id = $identifier->firstChild->nodeValue;
				
				$ids[] = $oai_id ;
			
				//echo $oai_id . "\n";
			}
		}		
	}
}

$ids = array_unique($ids);

echo join("\n", $ids);

?>
