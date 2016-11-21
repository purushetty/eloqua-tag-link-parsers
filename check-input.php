<?php

if((empty($_POST['url'])) && (empty($_POST['html'])))
{
	$results = 'mv';	
}

if(!empty($_POST['htmlO'])) 
{
	if(preg_match('/[^\/?*:;{}#\\]+/i', trim($_POST['htmlO'])))  	//(preg_match('/[^/?*:;{}#\]+\\.[^/?*:;{}#\]+/i', trim($_POST['htmlO'])))
	{
		$results = 'bf';
	}
	else
	{
		$results = 'ok';
	}
}
else
{
	if(!isset($results) && empty($results))
	{
		$results = 'ok';
	}
}

	// Splorp out all the anti-caching stuff
	header("Expires: 0");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	// Add some IE-specific options
	header("Cache-Control: post-check=0, pre-check=0", false);
	// For HTTP/1.0
	header("Pragma: no-cache");

	header('Content-Type: application/json'); 

	echo json_encode($results);

?>
