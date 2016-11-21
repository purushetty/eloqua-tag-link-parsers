<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eloqua HTML Parser</title>
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" href="css/main.css" type="text/css"/>
        <script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
        <script src="js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script>
            jQuery(document).ready(function(){
                jQuery("#eloqua_html2").validationEngine();
            });
		</script>
</head>

<body>
<div class="box">

<img src="images/headerLogo.jpg" alt="McAfee Logo" />
<fieldset class="outer">

<p class="intro-text">Please upload the content to be parsed using one of the following options below. The script will parse the eloqua-tags-populated html  and provide a clean html output code as a result. The script also converts encrypted elqoua urls and replaces them with the final url redirects.<br /><br />
<!-- The output is made available in the following formats:

<ul type="disc" class="intro-bull">
<li>An html file for direct download <span class="bold">OR</span></li>
<li>As a block of code to be copied and pasted</li>
</ul>

</p>

 <fieldset class="fld"><legend>File Upload</legend>
<form action="process.php" method="post" name="eloqua_file" enctype="multipart/form-data">

<label for="file" class="title">
UPLOAD FILE:
</label>
<input type="file" name="file" id="file" />

<input type="hidden" name="elq2" value="elq2" />
<input type="submit" value="Upload File" />
</form> 
</fieldset>

<p class="bold">OR</p>

<fieldset class="fld"><legend>Link Upload</legend>
<form action="process.php" method="post" name="eloqua_url" enctype="multipart/form-data">

<label for="file" class="title">
URL:
</label>
<input type="text" name="url" id="url" size="40" />

<input type="hidden" name="elq3" value="elq3" />
<input type="submit" value="Submit" />
</form> 
</fieldset>

<p class="bold">OR</p> -->

<fieldset class="fld"><legend>String Upload</legend>
<form action="process.php" method="post" name="eloqua_html2" id="eloqua_html2">
<label for="html" class="title">
Paste the html below<br />
</label>
<textarea name="html" id="html" rows="10" cols="50" class="validate[required]"></textarea>

<input type="hidden" name="elq1" value="elq1" />
<p><input type="submit" value="Upload Code" /></p>

</form>
</fieldset>

</fieldset>
</div>

</body>
</html>