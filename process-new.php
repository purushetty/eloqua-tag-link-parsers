<?php
ob_start();
session_start();
// This is an eloqua parsing script developed by Puru Shetty 
// This file was last modified on 23/10/2013

// Maximum script execution time - set for 300 secs(5 mins)
ini_set('max_execution_time', 300);
ini_set('display_errors', 1); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Eloqua HTML Parser</title>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" href="css/main.css" type="text/css"/>        
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        
<!--        <script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>-->
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="js/custom.js" type="text/javascript"></script>
    </head>
<body>

<div class="box">

<div class="head-logo"><img src="images/headerLogo.jpg" alt="McAfee Logo" width="180" height="49" /></div>

<div id="confirm" title="File Delete">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This will cause the html output file to be deleted from the server. Do you want to proceed?</p>
</div>

<div id="success-message" title="Operation Success">
	<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
		File was successfully deleted!
	</p>
</div>

<div id="error-message" title="Operation Fail">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>
		There seems to be a problem. Please try again later!
	</p>
</div>

<fieldset style="padding:10px 40px 0 20px">

<?php
include_once('simplehtmldom_1_5/simple_html_dom.php');

// Autoload method for including library routines
function __autoload($class_name) {
    include_once($class_name.".php");
}

// Validation class for validating input - invoke new object			
$puru = new validate;

// HTML Tidy Library for cleaning up html code
//$tidy = new tidy;

// Make sure that no unauthorised user comes across this page. In that case, redirect to the input page!
if((isset($_POST['elq1']) && $_POST['elq1'] == 'elq1'))			
{	
	// STRING INPUT - Get html string from input page
	if(isset($_POST['html']) && !empty($_POST['html']))
	{
		// Make sure that line breaks and carriage returns are not taken off the original source code!
		$puru->body = str_get_html(trim($_POST['html']), $lowercase=true, $forceTagsClosed=true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN=false, $defaultBRText=DEFAULT_BR_TEXT, $defaultSpanText=DEFAULT_SPAN_TEXT);
	}
	// URL INPUT - Fetch url link from input page
	else if(isset($_POST['url']) && !empty($_POST['url']))
	{
		//$puru->body = file_get_html(trim($_POST['url']));				
		$puru->body = file_get_html(trim($_POST['url']), $use_include_path = false, $context=null, $offset = -1, $maxLen=-1, $lowercase = true, $forceTagsClosed=true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN=false, $defaultBRText=DEFAULT_BR_TEXT);
	}
		
	// HTML Output filename - If not specified, a default name is assumed!
	if(isset($_POST['htmlO']) && !empty($_POST['htmlO']))
	{
		$puru->filename = 'output/'.$puru->check_file_ext(filter_var($_POST['htmlO'], FILTER_SANITIZE_STRING));		
	}
	else
	{
		$puru->filename = 'output/'.'test '.date('Y-m-d').' '.date('H:i:s', time()).'.html';
	}

// Save filename in a session variable in case if user decides to DELETE it off the server
$_SESSION['filename'] = $puru->filename;

// Get the eloqua html string to be worked upon
$puru->html = $puru->body;

echo '<fieldset class="fld"><legend>NOTES FOR DEVELOPER(IGNORE THIS SPACE)</legend>';

// Replace eloqua tracking image urls (as per the HTML document) that are usually found at the bottom of the code !!
foreach($puru->html->find('img') as $element)
{
	if(((preg_match($puru->footer, $element->src))) || (preg_match('/(.*?s927\.t\.en25\.com\/e\/FooterImages\/.*)/i', $element->src)) || (preg_match($puru->footer2, $element->src)) || (preg_match($puru->footer3, $element->src, $match)) || (preg_match($puru->footer4, $element->src, $match)) || (preg_match($puru->footer5, $element->src,  $match)) || (preg_match($puru->footer6, $element->src,  $match)))
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
			$rel_count++;
		}
	}
}

// Remove header - 'View as a webpage' at the top of the page
foreach($puru->html->find('table[width=550] tbody tr td') as $element)
{		
	if((preg_match($puru->header_rep, $element->innertext)) || (preg_match($puru->header_rep2, $element->innertext)))
	{
		$puru->body = str_ireplace($element, '', $puru->body);
	}
}

// Modify salutation text based on user input
if(isset($_POST['sal']) && !empty($_POST['sal'])) 
{
	foreach($puru->html->find('table tbody tr td') as $element)
	{
		if((preg_match($puru->sal_text, $element->innertext, $match)))
		{
			//echo $match[1].'<br>';
			switch($_POST['sal'])
			{
				case 'none':
				$puru->body = str_ireplace($match[1], '', $puru->body);							
				break;
				
				default:
				$val = $_POST['sal'].',';
				$puru->body = str_ireplace($match[0], $val, $puru->body);							
				break;
			}
		}
	}
}

// Find footer code and replace it with user selected footer code
foreach($puru->html->find('div') as $element)
{		
	if((preg_match($puru->footer_rep4, $element)))
	{
		switch($_POST['footer'])
		{			
			case 'india':
				$puru->body = str_ireplace($element, $puru->india_footer, $puru->body);
//				echo 'India Footer added to final html output!<br>';
				break;	
			
			case 'anz':
				$puru->body = str_ireplace($element, $puru->anz_footer, $puru->body);
//				echo 'ANZ Footer added to final html output!<br>';				
				break;	
			
			case 'sea':
				$puru->body = str_ireplace($element, $puru->sea_footer, $puru->body);
//				echo 'SEA Footer added to final html output!<br>';
				break;			
				
			default:
				echo 'Footer unchanged!<br>';			
				break;			
		}
	}
}

// Now parse anchor - '<a>' - tags. This block of code replaces all
// eloqua redirected urls with the original ones
foreach($puru->html->find('a') as $element)
{		
	$puru->url_count++;			// Increment url counter
	
	// Check for empty '#' links
	if(preg_match('/^\#$/', $element->href, $match))
	{
		$puru->blank_urls++;		// Increment blank url counter					
		if(preg_match('/.*?\<a.*?\>(.*?)\<\/a\>/i', $element, $match))
		{
			$puru->body = str_replace($element, $match[1], $puru->body);								
		}
	}
	// Look for links with 'lids'
	elseif(preg_match($puru->findlid, $element->href, $match))
	{			
		$puru->lid_count++;					// Increment redirect url counter			

		// Now replace all eloqua encoded redirected urls with the actual urls 
		// by calling the method below
		$puru->body = str_replace($match[0], $puru->get_web_page($match[0]), $puru->body);					
	}		

// The following block of code converts long google map urls, if any,
// to short ones using the Google URL shortener API
	if(preg_match('/maps\.google\.com.*/', $element->href, $match))
	{
		$puru->surl = $puru->short_url($element->href);
		$puru->body = str_replace($element->href, $puru->surl, $puru->body);
	}
	else if(!preg_match('/^http.*/im', $element->href) && !preg_match('/^mailto:.*/im', $element->href))
	{
		$puru->rel_count++;
	}
	
	// Dead Links check
	if($puru->check_url($element->href) === '404')
	{
		echo $element->href.'<br>';
		$puru->brlink_count++;
	}

	// Check for eloqua campaign ids and remove them
	if(preg_match($puru->elq_string, $element->href, $match))
	{
		echo $element->href.'<br>';
		$puru->body = str_ireplace($element->href, $match[1], $puru->body);
	}
	else
	{
		$puru->elm1 = preg_replace('/(.*?)\?\s*$/', '$1', $element->href);	
		$puru->body = str_replace($element->href, $puru->elm1, $puru->body);
	}	
} 

// The following lines of code removes all eloqua tags from the urls in the code. 
// Gotta group it together!
$puru->body = preg_replace('/\?elq.*?\"/', '"', $puru->body);	
$puru->body = preg_replace("/\?elq.*?\'/", "'", $puru->body);	

// Remove any trailing '?' characters at the end of a url
$puru->html =  str_get_html($puru->body);

echo '</fieldset>';

// Present a summary of the parsed code ?>
<fieldset class="fld"><legend>Parsing Summary</legend>

<p class="in-desc">Total Count of Links: <span class="rednbold"><?php echo $puru->url_count == '' ? 0 : $puru->url_count; ?></span></p> 	    
<p class="in-desc">Total Count of Redirected Links: <span class="rednbold"><?php echo $puru->lid_count == '' ? 0 : $puru->lid_count; ?></span></p> 	

<?php if($puru->rel_count > 0) { ?>    
<p class="red-warn">Total Count of relative URLS: <span class="rednbold"><?php echo $puru->rel_count == '' ? 0 : $puru->rel_count; ?></span></p>
<?php } else { ?>
<p class="in-desc">Total Count of relative URLS: <span class="rednbold"><?php echo $puru->rel_count == '' ? 0 : $puru->rel_count; ?></span></p>
<?php } ?>		

<?php if($puru->brlink_count > 0) { ?>
<p class="red-warn">Total Count of broken URLS: <span class="rednbold"><?php echo $puru->brlink_count == '' ? 0 : $puru->brlink_count; ?></span></p>
<?php } else { ?>
<p class="in-desc">Total Count of broken URLS: <span class="rednbold"><?php echo $puru->brlink_count == '' ? 0 : $puru->brlink_count; ?></span></p>
<?php } ?>		

<?php if($puru->blank_urls > 0) { ?>
<p class="red-warn">Total Count of blank URLS: <span class="rednbold"><?php echo $puru->blank_urls == '' ? 0 : $puru->blank_urls; ?></span></p>
<?php } else { ?>
<p class="in-desc">Total Count of blank URLS: <span class="rednbold"><?php echo $puru->blank_urls == '' ? 0 : $puru->blank_urls; ?></span></p>
<?php } ?>		

</fieldset>

	<fieldset class="fld" id="out-file"><legend>Download HTML File</legend>
    <?php 
	
	$puru->mess = $puru->file_html($puru->body);
	
	switch($puru->mess)
	{
		case 'fof':
			echo '<span class="rednbold">File open fail!</span>';
			break;	
		
		case 'fwf':
			echo '<span class="rednbold">File write fail!</span>';
			break;	
	
		case 'nw':
			echo '<span class="rednbold">File not writeable!</span>';
			break;	

		case 'fws':
			echo '<p class="in-desc">You can download the eloqua-tag-free-html file <a href="'.$puru->filename.'" target="_blank">here</a><br>
			<span class="small">(Right click on the link and choose <span class="bold">\'Save Link As\'</span> to store it on your computer!)</span>
			<p><span class="deleteF"><a href="#" onclick="javascript:del_copy();">Delete </a>file copy on server. Please make sure that you have first saved a copy locally on your machine!</span></p></p>';     			
			break;
		
		default:
			echo '<span class="rednbold">Something went wrong! Please try again later.</span>';
			break;
	}
	
	?>

    </fieldset>
	
	<fieldset class="fld"><legend>Copy &amp; Paste Code Output</legend>    
<?php
		echo '<p class="in-desc">You can also copy and paste the same code from the textarea box shown below</p>
		<p class="in-desc">If you want to parse another file, click on "Make another" button below</p>
		<textarea name="html_out" id="html_out" rows="15" cols="60" class="text-out">'.$puru->body.'</textarea>'; 
		
		echo '<form action="index-new.php" method="post" name="upload" id="upload" class="form-out">';
		
		echo '<input type="submit" value="Make another" name="clickme" id="clickme" class="btn">&nbsp;&nbsp;';
		echo '<input type="reset" value="No thanks!" name="nothanks" id="nothanks" class="btn" onClick="location.href=\'http://www.intelsecurityapac.com\'">';
		
		echo '</form>';		
		//session_destroy();				

//		ob_end_flush();		
		// To prevent resubmission of form data
		$_POST = array();	
	
		?>
	</fieldset>
	
<?php } else {

	ob_end_clean();
	header("Location:index-new.php");
}
?>

</fieldset>
</div>
</body>
</html>