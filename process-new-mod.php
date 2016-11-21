<?php
ob_start();
// This is an eloqua parsing script developed by Puru Shetty 
// This file was last modified on 24/10/2013

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
				
				$('#fin-out').hide();
				
				$('<div></div>')
					.attr('id', 'spinner')
					.hide()
					.appendTo(gallery.container)
					.fadeTo('slow', 0.6);

                jQuery("#form_elq").validationEngine();
            });
			
			$('#spinner').fadeOut('slow', function() {
				$(this).remove();
			});
			
			
			function hide_form() {
				jQuery("#form_eloqua").hide();			
			};
			
			function parse_me() {
			
				$.ajax ({
					url: 'parser.php',
					data: 'body=' +,
					dataType: 'json',
					success: function(data) {
						;	
					}
				});
			};
			
        </script>
    </head>
    <body>

<div class="box">
<img src="images/headerLogo.jpg" alt="McAfee Logo" />
<fieldset style="padding:10px 40px 0 20px">

<?php
// Making sure that no unauthorised user comes across this page. If he has, redirect him to the input page!
if((isset($_POST['elq1']) && $_POST['elq1'] == 'elq1') || (isset($_POST['elq2']) && $_POST['elq2'] == 'elq2') || (isset($_POST['elq3']) && $_POST['elq3'] == 'elq3'))			
{	
	// Get html string from input page
	if(isset($_POST['elq1']) && !empty($_POST['elq1']))
	{
		$puru->body = str_get_html(trim($_POST['html']));
	}
	// Get uploaded file from input page, carry out validation and store it locally!
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
		$target_path = $folder . basename( $_FILES["file"]["name"]);		
		$_SESSION['target_route'] = $target_path;						
		   
		// Now move the temp file into a permanent location   
		if(!move_uploaded_file($_FILES["file"]["tmp_name"], $target_path)) 
		{
	   		echo "There was an error uploading the file, please try again!";
		}		
		
		//$puru->body = trim(file_get_contents($target_path));		
		$puru->body = file_get_html($target_path);
	}
	// Get url link from input page
	else if(isset($_POST['elq3']) && !empty($_POST['elq3']))
	{
		$puru->body = file_get_html(trim($_POST['url']));				
	}
		
// Present a summary of the parsed code ?>
<div id="fin-out">
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

</fieldset>

	<fieldset class="fld"><legend>Download HTML File</legend>
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
			echo '<p class="in-desc">You can download the eloqua-free-html file <a href="'.$puru->filename.'" target="_blank">here</a><br>
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
/*		$puru->body = str_replace('\"', '"', $puru->body, $count); 				
		$puru->body = str_replace("\'", "'", $puru->body, $count); 		
*/
		echo '<p class="in-desc">You can also copy and paste the same code from the textarea box shown below</p>
		<p class="in-desc">If you want to parse another file, click on "Make another" button below</p>
		<textarea name="html_out" id="html_out" rows="15" cols="60" class="text-out">'.trim($puru->body).'</textarea>'; 
		
		echo '<form action="index-new.php" method="post" name="upload" id="upload" class="form-out">';
		
		echo '<input type="submit" value="Make another" name="clickme" id="clickme">&nbsp;&nbsp;';
		echo '<input type="reset" value="No thanks!" name="nothanks" id="nothanks" onClick="location.href=\'http://www.mcafeepartner.com\'">';
		
		echo '</form>';		
		//session_destroy();				

		ob_end_flush();		
	
		?>
	</fieldset>
	</div>
    
<?php } else {

	ob_end_clean();
	header("Location:index-new.php");
}
?>

</fieldset>
</div>
</body>
</html>