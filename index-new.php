<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eloqua HTML Parser</title>
        
        <!-- CSS Definitions - starts here -->
        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" href="css/main.css" type="text/css"/>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!-- CSS Definitions - ends here -->
                
        <!-- Javascript library includes - starts here -->        
        <!-- <script src="js/jquery-1.5.1.min.js" type="text/javascript"></script> -->
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>        
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>        
        <script src="js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <!-- Javascript library includes - ends here -->
                
</head>

<body>
<div class="box">

<div class="head-logo"><img src="images/headerLogo.jpg" alt="McAfee Logo" width="180" height="49" /></div>

<div id="src" title="Input Error"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please provide either the source url or html code!</p></div>
 
<div id="badfn" title="Filename Error"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Invalid Filename</p></div>
 
 <div id="bsrcfn" title="Input Error"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please provide either source code url or paste in the html code in the text area!</p></div>
 
<form action="process-new.php" method="post" name="eloqua_url" id="eloqua_url" enctype="multipart/form-data">
<fieldset class="outer">

<p class="intro-text">Please upload the content to be parsed using one of the following options below. The script will parse the eloqua-tags-populated html  and provide a clean html output code as a result. The script also converts encrypted elqoua urls and replaces them with the final url redirects.<br /><br />

<fieldset class="fld"><legend>Link Upload</legend>

<label for="file" class="title">
URL:
</label>
<input type="text" name="url" id="url" size="40" data-prompt-position='topRight' class="" />

</fieldset> 

<p class="bold">OR</p>

<fieldset class="fld"><legend>String Upload</legend>

<label for="html" class="title">
Paste the html below<br /><br />
</label>
<textarea name="html" id="html" rows="10" cols="50" data-prompt-position='topRight'></textarea>

</fieldset>

<fieldset class="fld"><legend>Salutation</legend>

<div class="outfile">
Select the salutation text from the list below
</div>
<select name="sal" class="select-geo">
<option value="">Select</option>
<option value="none">No Salutation</option>
<option value="Dear Colleague">Dear Colleague</option>
<option value="Dear Partner">Dear Partner</option>
</select>
</fieldset>

<fieldset class="fld"><legend>Footer Selection</legend>

<div class="outfile">
Select the custom footer to go with the final html output file!
</div>
<select name="footer" class="select-geo">
<option value="none">Select</option>
<option value="india">India</option>
<option value="sea">SEA</option>
<option value="anz">ANZ</option>
</select>
</fieldset>

<fieldset class="fld"><legend>Output File</legend>

<div class="outfile">
Assign a desired name, with a .html extension, to the final html output file. In case if no name is specified, a default name would be assigned!
</div>
<input type="text" name="htmlO" id="htmlO" size="40" data-prompt-position='topRight' />

</fieldset>

<div class="submit">
<input type="submit" value="Process Input" name="sub" id="sub" class="btn" />
<input type="hidden" name="elq1" value="elq1" />
</div>

</fieldset>

</div>

</body>
</html>