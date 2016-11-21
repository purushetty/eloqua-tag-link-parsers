<?php
class replace_url {

	public $regexp2 = "<a\s[^>]*href=(\"??)([^\"]*?)\\1[^>]*>(.*)<\/a>";
	public $regexp20 = '<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1';
	public $regexp3 = "lid\s*=(\d+).*";	
	public $store = array();
	public $filter = array();
	public $matches = array();
	public $matches2 = array();
	public $matches3 = array();
	public $mod_html = array();
	public $read_file = array();
	public $findme = 'lid=';
	public $findme_mod = '?';
	public $findme_mod2 = 'href=(.*)';
	public $findme_mod3 = "\<elqdomain.*?\/\>";	
	
	function parse_file_mod($name) {
			
		if(preg_match_all("/$this->regexp2/isUm", $name, $this->matches, PREG_SET_ORDER)) 
		{		
		   	foreach($this->matches as $match) 
		  	{
			  if(strpos($match[0], $this->findme) !== false)										//preg_match_all('/.*\&lid=.*/i', $match[2], $lid))
			  {
			  	$lid1 = stristr($match[0], 'lid=');
				preg_match_all("/$this->regexp3/im", $lid1, $this->matches2, PREG_SET_ORDER);
				
			  	foreach($this->matches2 as $match)
				{
					$this->store[] = trim($match[1]);
				}
			  } 
/*			  elseif(strpos($match[0], $this->findme_mod) !== false)
			  {
				$lid1 = mb_strstr($match[0], $this->findme_mod, true);	
				preg_match_all("/$this->findme_mod2/im", $lid1, $this->matches3, PREG_SET_ORDER);
				
				foreach($this->matches3 as $match)
				{
					//echo $match[1].'<br>';
					$lid1 = substr($match[1], 1);
					$this->filter[] = $lid1; 
				}
				$this->store[] = trim($lid1);	  
			  }
*/			}
						 
			// Remove any duplicate entries					  
			$this->store = array_values(array_unique($this->store));	
		}	// close if loop

		return $this->store;
	}

	function parse_file($name) {
		
		if(preg_match_all("/$this->regexp2/isUm", $name, $this->matches, PREG_SET_ORDER)) 
		{					
		   	foreach($this->matches as $match) 
		  	{
			  if(strpos($match[0], $this->findme) !== false)										//preg_match_all('/.*\&lid=.*/i', $match[2], $lid))
			  {			
			  	$lid1 = mb_strstr($match[0], 'lid=');
			  	$lid1 = mb_strstr($lid1, 'elq=', true);			 
				$lid1 = trim($lid1);			
				$lid1 = mb_strstr($lid1, '=');		
				$lid1 = substr($lid1, 1, strpos($lid1, '&') - 1);
				$this->store[] = $lid1;
			  }						
			}
						 
			// Remove any duplicate entries					  
			$this->store = array_values(array_unique($this->store));	
		}	// close if loop

		return $this->store;
	}

	function parse_replace_url($name, $farray) {
		
		if($_SESSION['data'] === 'file')
		{
			$this->read_file = file($name);

			foreach($this->read_file as $link)
			{
				if(preg_match_all("/$this->regexp2/iUm", $link, $matches, PREG_SET_ORDER)) 
				{			
			   		foreach($matches as $match) 
			  		{	
		  				if(strpos($match[2], $this->findme) !== false)					
						{
						  	$lid1 = mb_strstr($match[2], 'lid=');
						  	$lid1 = mb_strstr($lid1, 'elq=', true);			 
							$lid1 = trim($lid1);			
							$lid1 = mb_strstr($lid1, '=');		
							$lid1 = substr($lid1, 1, strpos($lid1, '&') - 1);

							$file_write_string = preg_replace('/\?elq\_mid.*/i', '', $file_write_string);										
						
							if(array_key_exists($lid1, $farray))
							{
								$store[] = str_replace($match[2], $farray[$lid1], $link);
							}
							else
							{
								$store[] = $link;
							}
						}// close if loop										
					}	// close foreach loop
				}
				else
				{
					$store[] = $link;
				}			
				// close if loop
			}	// close foreeach loop
			
			return $store;
		}
		else
		{
				$store_me = $name;
				if(preg_match_all("/$this->regexp2/iUm", $store_me, $matches, PREG_SET_ORDER)) 
				{						
			   		foreach($matches as $match) 
			  		{	
		  				if(preg_match("/$this->findme/im", $match[2]))			//strpos($match[2], $this->findme		
						{
						  	$lid1 = stristr($match[2], 'lid=');
						  	$lid1 = stristr($lid1, 'elq=', true);			 
							$lid1 = trim($lid1);			
							$lid1 = stristr($lid1, '=');		
							$lid1 = substr($lid1, 1, strpos($lid1, '&') - 1);
						
							if(array_key_exists($lid1, $farray))
							{
								$store_me = str_replace($match[2], $farray[$lid1], $store_me);
							}
	  					}
						elseif(preg_match("/$this->findme_mod2/im", $match[2]))				//strpos($match[2], $this->findme_mod)
						{
							$lid1 = stristr($match[2], $this->findme_mod, true);
							echo $lid1.'<br>';	
							$store_me = str_replace($match[2], $lid1, $store_me);
						}
							// close if loop										
					}	// close foreach loop					
				}
			
				//$store_me = stristr($store_me, '</body>', true);
				return stripslashes($store_me);
			}		
	}
	
	function file_write($content, $filename) {
		
		// Check if the file already exists and delete any old ones!
		if(file_exists($filename))
		{
			unlink($filename);	
		}

		foreach($content as $line) {
		
		    // Open file in append mode.
    		// The file pointer is at the bottom of the file
	    	if (!$handle = fopen($filename, 'a')) {
    	    	 echo "Cannot open file ($filename)";
	        	 exit;
		    }

	    	// Write content to our opened file.
		    if (fwrite($handle, $line) === FALSE) {
    		    echo "Cannot write to file ($filename)";
        		exit;
	    	}
		}
			// Close file handle
	   		fclose($handle);	
	}	

	function file_write_string($content, $filename) {
		
		// Check if the file already exists and delete any old ones!
		if(file_exists($filename))
		{
			unlink($filename);	
		}
		
		    // Open file in write mode.
    		// The file pointer is at the bottom of the file
	    	if (!$handle = fopen($filename, 'w')) {
    	    	 echo "Cannot open file ($filename)";
	        	 exit;
		    }

	    	// Write content to our opened file.
		    if (fwrite($handle, $content) === FALSE) {
    		    echo "Cannot write to file ($filename)";
        		exit;
	    	}

			// Close file handle
	   		fclose($handle);	
	}	

}

?>