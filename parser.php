<?php
include_once('simplehtmldom_1_5/simple_html_dom.php');

// Autoload method for including library routines
function __autoload($class_name) {
    include_once($class_name.".php");
}

// Validation class for validating input - invoke new object			
$puru = new validate;

// Get the eloqua html string to be worked upon
$puru->html = $_POST['body'];

// Following line of code replaces the eloqua footer
foreach($puru->html->find('p') as $element)
{
	   if((preg_match('/.*?Privacy\s*Policy.*/i', $element->plaintext)) || (preg_match($puru->footer_rep1, $element->plaintext)) || (preg_match($puru->footer_rep2, $element->plaintext)) || (preg_match($puru->footer_rep3, $element->innertext)) || (preg_match($puru->footer_rep4, $element->innertext)))
	   {	
		   $puru->body = str_ireplace($element->innertext, '', $puru->body);					
	   }
}

// Replace eloqua tracking image urls (as per the HTML document)
foreach($puru->html->find('img') as $element)
{
	if(((preg_match($puru->footer, $element->src))) || (preg_match('/(.*?s927\.t\.en25\.com\/e\/FooterImages\/.*)/i', $element->src)) || (preg_match($puru->footer2, $element->src)))
	{		
		$puru->body = str_ireplace($element, '', $puru->body);					
	}
	else if(preg_match('/(\&lt\;elqdomain\s+type\=\d+\/\&gt\;)\/.*/i', $element->src, $match))
	{
		$puru->body = str_ireplace($match[1], 'img.en25.com', $puru->body);			
	}
	else 
	{
		if(!preg_match('/^http.*/im', $element->src, $match))
		{
			echo $element->src.'<br>';
			$puru->rel_count++;
		}
	}
}

foreach($puru->html->find('a') as $element)
{		
	$puru->url_count++;			// Increment url counter
	// Now look for lids
	if(preg_match($puru->findlid, $element->href, $match))
	{			
		$puru->lid_count++;					// Increment redirect url counter			
			
		// Now replace all eloqua encoded redirected urls with the actual urls 
		// by calling the method below
		$puru->body = str_replace($match[0], $puru->get_web_page($match[0]), $puru->body);					
	}		
	// Remove header - 'View as a webpage'
	else if(preg_match($puru->header_rep, $element->innertext))
	{
		$puru->body = str_ireplace($element, '', $puru->body);
	}
}

// The following lines of code removes all eloqua tags from the urls in the code. 
// Gotta group it together!
$puru->body = preg_replace('/\?elq\_mid\=\d+/', '?', $puru->body);	
$puru->body = preg_replace('/\&elq\_mid\=\d+/', '', $puru->body);	
				
$puru->body = preg_replace('/\?elq\_cid\=\d+/', '?', $puru->body);
$puru->body = preg_replace('/\&elq\_cid\=\d+/', '', $puru->body);
				
$puru->body = preg_replace('/\?elq\=\w+/', '?', $puru->body);
$puru->body = preg_replace('/\&elq\=\w+/', '', $puru->body);		
		
$puru->body = preg_replace('/\?\&/', '?', $puru->body);		

// Remove any trailing '?' characters at the end of a url
$puru->html =  str_get_html($puru->body);
foreach($puru->html->find('a') as $element)
{
	$puru->elm1 = preg_replace('/(.*?)\?\s*$/', '$1', $element->href);	
	$puru->body = str_replace($element->href, $puru->elm1, $puru->body);
}
	
// The following block of code converts long google map urls, if any,
// to short ones using the Google URL shortener API
foreach($puru->html->find('a') as $element)
{
	if(preg_match('/maps\.google\.com.*/', $element->href, $match))
	{
		$puru->surl = $puru->short_url($element->href);
		$puru->body = str_replace($element->href, $puru->surl, $puru->body);
	}
	else if(!preg_match('/^http.*/im', $element->href) && !preg_match('/^mailto:.*/im', $element->href))
	{
		echo $element->href.'<br>';
		$puru->rel_count++;
	}
}

// Now check for broken/dead urls, if any!!
foreach($puru->html->find('a') as $element)
{
	if($puru->check_url($element->href) === '404')
	{
		echo $element->href.'<br>';
		$puru->brlink_count++;
	}
}

$puru->p_url['TOT_LINKS'] = $puru->url_count;
$puru->p_url['REL_LINKS'] = $puru->rel_count;
$puru->p_url['RD_LINKS'] = $puru->lid_count;
$puru->p_url['BR_LINKS'] = $puru->brlink_count;
$puru->p_url['BODY'] = $puru->body;

echo json_encode($puru->p_url);

?>