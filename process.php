<?php
// This is an eloqua parsing script developed by Puru Shetty 
// This file was last modified on 25/09/2013

// Maximum script execution time - set for 300 secs(5 mins)
ini_set('max_execution_time', 300);

//ini_set('display_errors','Off'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Eloqua HTML Parser</title>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" href="css/main.css" type="text/css"/>        
        <script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
        <script src="js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script>
            jQuery(document).ready(function(){
                jQuery("#form_elq").validationEngine();
            });
			
			function hide_form() {
				jQuery("#form_eloqua").hide();
			};
        </script>
    </head>
    <body>

<div class="box">
<img src="images/headerLogo.jpg" alt="McAfee Logo" />
<fieldset style="padding:10px 40px 0 20px">

<?php
include_once('simplehtmldom_1_5/simple_html_dom.php');

// Autoload method for including library routines
/*function __autoload($class_name) {
    include_once($class_name.".php");
}
*/

include_once('validate.php');
include_once('replace_url.php');
include_once('db_connect.php');
include_once('strings.php');

// Database class - invoke new object
$db = new db_connect;	

// Validation class for validating input - invoke new object			
$lid_check = new validate;

// Instantiate object for url replacement 
$final_doc = new replace_url;

// Making sure that no unauthorised user comes across this script. If he has, redirect him to the input page!
if((isset($_POST['elq1']) && $_POST['elq1'] == 'elq1') || (isset($_POST['elq2']) && $_POST['elq2'] == 'elq2') || (isset($_POST['elq3']) && $_POST['elq3'] == 'elq3') || (isset($_POST['check1']) && $_POST['check1'] === 'check1'))			
{
	// Ensure if the lid urls have been entered. If not that means, we are getting the html input from the first page!
	if((isset($_POST['check1'])) && ($_POST['check1'] === 'check1'))
	{
		$get_html = trim($_POST['body']);
		// Lid urls have been submitted.
		echo '<script type="text/javascript">hide_form();</script>';
		$url_status = array();
		$url_fill = array();
		$fin_array = array();			// define array for final url replacement	
			
		// Check for blank url entries
		$url_status = $lid_check->get_lid_urls($_POST['count_lids']);	
					
		// Check whether url or lids already exist in the database.
		// If the url(s) is(are) already present in the database, the array will have the text 'full' stored as the array value.
		if (!array_search("empty", $url_status))
		{ 			
			// If not, fetch the urls that have been entered in the second page.
			// Also check if the url has 'http://' appended and if not, prepend them!

			$url_fill = $lid_check->fetch_lid_urls($_POST['count_lids'], $_SESSION['LIDS']);	
			
			echo '<fieldset class="fld"><legend>Record Status</legend>';							
			foreach($url_fill as $key=>$val)
			{
				$url = trim($val);
				$key = trim($key);				
				
				// Does the lid or url already exist in the database?			
				$no = $db->db_lid_check($key);	

				if(!$no)
				{
					// It doesn't! Insert the new lid and the url into the database!
					// Insert a new record
					$res = $db->db_insert_lid($key, $url);
					$fin_array[$key] = $url;
	
					if(!$res)
					{
						//echo "<b><font color='green'>New record for $key inserted!</font></b><br><br>";	
						echo "<div class='red'>Error! No new record inserted into the database.</div>";	
					}
					else
					{
						echo '<div class="blue">*** New record added for lid# <span class="bold">'.$key.'</span> in the database! ***</div>';
					}
					
					// Call the url replacing method and store result in an array
					if($_SESSION['data'] === 'file')
					{
						$file_write_contents = $final_doc->parse_replace_url($_SESSION['target_route'], $fin_array);
			
					// And finally, store the result in a .html file!
					// $final_doc->file_write($file_write_contents, 'eloqua-out.html');			
					}
					else
					{
						$file_write_string = $final_doc->parse_replace_url($get_html, $fin_array);	
		
						// And finally, store the result in a .html file!
						// $final_doc->file_write_string($file_write_string, 'eloqua-out.html');			
					} 
		
					$file_write_string2 = $file_write_string;

					echo '<fieldset class="fld"><legend>Output</legend>';
					echo '<p class="in-desc">If you want to generate another file, click on "Make another" button below.<br><br>The html code with the cleaned up eloqua lids is pasted below.<br />If you want to create another html code, click on the button below.</p>';		

					//echo '<p style="font-weight:bold"><a href="eloqua-out.html" target="_blank">Download file</a></p>';		

					echo "<textarea name='html_out' id='html_out' rows='15' cols='60'>$file_write_string</textarea>"; 		
	
					echo '<p><form action="index.php" method="post" name="upload" id="upload">';
		
					echo '<input type="submit" value="Make another" name="clickme" id="clickme">&nbsp;&nbsp;';
					echo '<input type="reset" value="No thanks!" name="nothanks" id="nothanks" onClick="location.href=\'http://www.mcafeepartner.com\'">';
		
					echo '</form></fieldset></p>';
					exit;					
				}
				else
				{					
					// Yes it does! Now has the user entered a new url to replace the existing one in the database?
					// Read the url stored in the database for this particular lid
					$flg = $db->db_get_url($key);						
					
					// Now compare it with the user entered url
					if($flg !== $url)
					{             
						$res = $db->db_update_lid($key, $url);
						
						if(!$res)
						{
							echo "<div class='red'>There has been an ERROR! No records updated in the database.</div>";	
							//echo "<b><font color='green'>Record for $key updated!</font></b><br><br>";	
						}			
						else
						{
							echo "<div class='blue'>*** Record updated in database for lid#<span class='bold'>$key</span> ***</div>";
						}
						
						$fin_array[$key] = $url;
					}
					else
					{
						$fin_array[$key] = $flg;

						// Record already exists. No new entries made
						echo "<div class='red'> *** Record already exists for lid#<b>$key</b>. Database NOT updated! *** </div>";
					}
				}
			}
			echo '</fieldset>';				
		}		
		
		// Call the url replacing method and store result in an array
		if($_SESSION['data'] === 'file')
		{
			$file_write_contents = $final_doc->parse_replace_url($_SESSION['target_route'], $fin_array);
			
			// And finally, store the result in a .html file!
//			$final_doc->file_write($file_write_contents, 'eloqua-out.html');			
		}
		else
		{
			$file_write_string = $final_doc->parse_replace_url($get_html, $fin_array);	
		
			// And finally, store the result in a .html file!
//			$final_doc->file_write_string($file_write_string, 'eloqua-out.html');			
		} 		
		
		$file_write_string2 = $file_write_string;
		
		echo '<fieldset class="fld"><legend>Output</legend>';
		echo '<p class="in-desc">If you want to generate another file, click on "Make another" button below.<br><br>The html code with the cleaned up eloqua lids is pasted below.<br />If you want to create another html code, click on the button below.</p>';		

		//echo '<p style="font-weight:bold"><a href="eloqua-out.html" target="_blank">Download file</a></p>';		

		echo "<textarea name='html_out' id='html_out' rows='15' cols='60'>$file_write_string</textarea>"; 		
	
		echo '<p><form action="index.php" method="post" name="upload" id="upload">';
		
		echo '<input type="submit" value="Make another" name="clickme" id="clickme">&nbsp;&nbsp;';
		echo '<input type="reset" value="No thanks!" name="nothanks" id="nothanks" onClick="location.href=\'http://www.mcafeepartner.com\'">';
		
		echo '</form></fieldset></p>';		
		//session_destroy();		
		exit;
	}
	else if(isset($_POST['elq1']) && !empty($_POST['elq1']))
	{
		$body = str_get_html(trim($_POST['html']));
	}
	else if(isset($_POST['elq2']) && !empty($_POST['elq2']))
	{
		// Has there been an error during the file upload?
		if ($_FILES["file"]["error"] > 0)
	  	{
		  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  		}
		
		// Store session info to identify file upload input
		$_SESSION['data'] = 'file';
		
		// define target path and save it 
		$target_path = $target_path . basename( $_FILES["file"]["name"]);		
		$_SESSION['target_route'] = $target_path;						
		   
		// Now move the temp file into a permanent location   
		if(!move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)) 
		{
	   		echo "There was an error uploading the file, please try again!";
		}		
		
		//$body = trim(file_get_contents($target_path));		
		$body = file_get_html($target_path);
	}
	else if(isset($_POST['elq3']) && !empty($_POST['elq3']))
	{
		$body = file_get_html(trim($_POST['url']));				
		//$body = $lid_check->get_html($_POST);
	}
		
//	$_SESSION['data'] = 'html';				
//	$_SESSION['t_html'] = $body;

	 //$header 	= $_POST['emailheader'];
	 //$body 		= trim($_POST['emailbody']);
	 //$footer 	= $_POST['emailfooter']; 	  

// Array for storing the lids extracted from the links
$store = array();
$store_lid = array();
$redirect_url = array();
$tmp = array();
$dead_url = array();

//$body = htmlspecialchars_decode($body);

// Get the eloqua html string to be worked upon
$html = $body;

// Following line of code replaces the eloqua footer
foreach($html->find('p') as $element)
{
	   if((preg_match('/.*?Privacy\s*Policy.*/i', $element->plaintext)) || (preg_match($footer_rep1, $element->plaintext)) || (preg_match($footer_rep2, $element->plaintext)) || (preg_match($footer_rep3, $element->innertext)) || (preg_match($footer_rep4, $element->innertext)))
	   {	
		   $body = str_ireplace($element->innertext, '', $body);					
	   }
}

// Replace eloqua image urls as per the HTML document
foreach($html->find('img') as $element)
{
	if(((preg_match($footer, $element->src))) || (preg_match('/(.*?s927\.t\.en25\.com\/e\/FooterImages\/.*)/i', $element->src)) || (preg_match($footer2, $element->src)))
	{		
		$body = str_ireplace($element, '', $body);					
	}
	else if(preg_match('/(\&lt\;elqdomain\s+type\=\d+\/\&gt\;)\/.*/i', $element->src, $match))
	{
		//echo $element->src.'<br>';
		$body = str_ireplace($match[1], 'img.en25.com', $body);			
	}
}

// The following line of code parses all the urls in the uploaded html and 
// and extracts the lids, if any, found within it
	$url_count = 0;
	$lid_count = 0;
	foreach($html->find('a') as $element)
	{
		$url_count++;
		// Look for lids
		if(preg_match($findlid, $element->href, $match))
		{
			$lid_count++;
			$store_lid[] = $match[0];
			$body = str_replace($match[0], $lid_check->get_web_page($match[0]), $body);			
			// Store the captured lids in an array
			$store[] = $match[1];
		}
		// Remove header - 'View as a webpage'
		else if(preg_match($header_rep, $element->innertext))
		{
			$body = str_ireplace($element, '', $body);
		}
	}

	// Bunch of code that removes all eloqua tags from the urls in the code. Gotta group it together!
	$body = preg_replace('/\?elq\_mid\=\d+/', '?', $body);	
	$body = preg_replace('/\&elq\_mid\=\d+/', '', $body);	
				
	$body = preg_replace('/\?elq\_cid\=\d+/', '?', $body);
	$body = preg_replace('/\&elq\_cid\=\d+/', '', $body);
				
	$body = preg_replace('/\?elq\=\w+/', '?', $body);
	$body = preg_replace('/\&elq\=\w+/', '', $body);		
		
	$body = preg_replace('/\?\&/', '?', $body);		

	// Remove any trailing '?' characters at the end of a url
	$html =  str_get_html($body);
	foreach($html->find('a') as $element)
	{
		$elm1 = preg_replace('/(.*?)\?\s*$/', '$1', $element->href);	
		$body = str_replace($element->href, $elm1, $body);
	}
	
	//Remove duplicate entries, if any, of all urls with 'lid' tags
	$store_lid = array_unique($store_lid);

	// Present a summary of the parsed code ?>
	<fieldset class="fld"><legend>Parsing Summary</legend>
 	<p class="in-desc">Total Count of Links: <span class="rednbold"><?php echo $url_count == '' ? 0 : $url_count; ?></span></p> 	    
 	<p class="in-desc">Total Count of Redirected Links: <span class="rednbold"><?php echo $lid_count == '' ? 0 : $lid_count; ?></span></p> 	
	</fieldset>

	
	<fieldset class="fld"><legend>Download HTML File</legend>
    <?php 
	
	$mess = $lid_check->file_html($body);
	
	switch($mess)
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
			echo '<p class="in-desc">You can download the eloqua-free-html file <a href="html-out.html" target="_blank">here</a><br>
			<span class="small">(Right click on the link and choose <span class="bold">\'Save Link As\'</span> to store it on your computer!)</span></p>';     
			break;
		
		default:
			echo '<span class="rednbold">Something went wrong! Please try again later.</span>';
			break;		
	
	}
	
	?>

    </fieldset>
	
	<fieldset class="fld"><legend>Copy &amp; Paste Code Output</legend>    
<?php
/*		$body = str_replace('\"', '"', $body, $count); 				
		$body = str_replace("\'", "'", $body, $count); 		
*/
		echo '<p class="in-desc">You can also copy and paste the same code from the textarea box shown below</p>
		<p class="in-desc">If you want to parse another file, click on "Make another" button below</p>
		<textarea name="html_out" id="html_out" rows="15" cols="60" class="text-out">'.trim($body).'</textarea>'; 
		
		echo '<form action="index.php" method="post" name="upload" id="upload" class="form-out">';
		
		echo '<input type="submit" value="Make another" name="clickme" id="clickme">&nbsp;&nbsp;';
		echo '<input type="reset" value="No thanks!" name="nothanks" id="nothanks" onClick="location.href=\'http://www.mcafeepartner.com\'">';
		
		echo '</form>';		
		//session_destroy();				
		exit;    	?>
	</fieldset>

<?php } else {
	
	header("Location:index.php");
}
?>

</fieldset>
</div>
</body>
</html>