<?php
session_start();
if(isset($_POST['delete']) && !empty($_POST['delete']))
{	
	$results = unlink($_SESSION['filename']);
}
else
{
	if((empty($_POST['url'])) && (empty($_POST['html'])))
	{
		$results = 'mv';	
	}

	if(!empty($_POST['htmlO'])) 
	{
		if(preg_match('/[?\/*:;{}\\#]/', $_POST['htmlO']))  	//(preg_match('/[^/?*:;{}#\]+\\.[^/?*:;{}#\]+/i', trim($_POST['htmlO'])))
		{
			if(!isset($results) && empty($results))
			{
				$results = 'bf';
			}
			else
			{
				$results = 'mvbf';
			}
		}
		else
		{
			if(!isset($results) && empty($results))
			{
				$results = 'ok';
			}
			else
			{
				$results = 'fok';	
			}
		}
	}
	else
	{
		if(!isset($results) && empty($results))
		{
			$results = 'ok';
		}	
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
	
	unset($_SESSION['filename']);
	echo json_encode($results);

?>
