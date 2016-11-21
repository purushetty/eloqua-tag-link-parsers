<?php
// This routine has been developed by Puru Shetty and was last modified on 28th August, 2011
// This is a database class and contains methods related to database connectivity, 
// inserts, deletes and updates. There is a local database and a server database config
// parameters in the __construct() method of the class. 

class db_connect {

	public function __construct() {

		if($_SERVER['SERVER_NAME'] != 'localhost')
		{
			// Server database parameters - uncomment the following block of code while working on the server!
		    $server = "wic002my.server-sql.com";
			$user = "vs215131_5_dbo";	
			$password = "kRKNOxK8eZ";	
			$database = "vs215131_5"; 
		}
		else
		{
			// Local database parameters - uncomment the following block of code while working locally!
			$server = "localhost";
			$user = "vs215131_3_dbo";	
			$password = "FoiHhkK7wS";	
			$database = "vs215131_3"; 
		}
		
		mysql_connect($server,$user,$password) or die("Could not connect: " . mysql_error());	
		mysql_query("USE $database");
	}

	// Public method that returns the total no of rows/records in the database	
	public function db_no_rows() {	
		$result = mysql_query("SELECT * FROM eloqua_test");
		$numrows = mysql_num_rows($result);
		return $numrows;
	}
	
	// Public method that checks if the passed 'lid' already exists in the database
	public function db_lid_check($id) {	

		$result = mysql_query("SELECT * FROM eloqua_test WHERE LID = $id");
		
		if($result)
		{			
			$numrows = mysql_num_rows($result);
			return $numrows;
		}
		else
		{
			return 0;
		}
	}	

	// Public method for extracting links based on the lid that is passed
	public function db_get_url($id) {	
		//echo "SELECT * FROM eloqua_test WHERE LID = $id<br>";
		$result = mysql_query("SELECT * FROM eloqua_test WHERE LID = $id");		
		
		$table_result=array();
	    $r=0;
	
		while($row = mysql_fetch_assoc($result)){
        $arr_row=array();
        $c=0;
		
        while ($c < mysql_num_fields($result)) {        
            $col = mysql_fetch_field($result, $c);    
            $arr_row[$col -> name] = $row[$col -> name];            
            $c++;
        }    
	    }    
    	
		//return $table_result;		
		return $arr_row['LINKS'];
	}	
	
	// Public method for inserting a new lid
	public function db_insert_lid($val1, $url1) {		
		//echo "INSERT INTO eloqua_test (LID, LINKS) VALUES('$val1', '$url1')<br>";
		$result = mysql_query("INSERT INTO eloqua_test (LID, LINKS) VALUES('$val1', '$url1')") or die(mysql_error());  			
	
		if($result)
		{			
			$numrows = mysql_affected_rows();
			return $numrows;
		}		
	}

	// Public method for updating existing lid record
	public function db_update_lid($val1, $url1) {		
		//echo "UPDATE eloqua_test SET LID='$val1', LINKS='$url1' WHERE LID='$val1'<br>";
		$result = mysql_query("UPDATE eloqua_test SET LID='$val1', LINKS='$url1' WHERE LID='$val1'") or die(mysql_error());  			
	
		if($result)
		{			
			$numrows = mysql_affected_rows();
			return $numrows;
		}		
	}
	
	// Public method for reading all the rows in a table
	public function db_read_all_records() {	
		$totrows = array();
		$result = mysql_query("SELECT * FROM eloqua_test");
		
		$table_result=array();
		
	    $r=0;
	
 		while($row = mysql_fetch_assoc($result)){
        $arr_row=array();
        $c=0;
		
        while ($c < mysql_num_fields($result)) {        
            $col = mysql_fetch_field($result, $c);    
            $arr_row[$col -> name] = $row[$col -> name];            
            $c++;
        }    	
		
        $table_result[$r] = $arr_row;
        $r++;
	    }    
    	
		return $table_result;				
 	}

	// Public method for fetching records of those LIDS passed in the passed-in input array parameter
	public function db_read_lid_records($lid) {	
		$totrows = array();
		$table_result=array();
	    $r=0;				
		
		for($i=0; $i<count($lid);$i++)
		{
			$result = mysql_query('SELECT * FROM eloqua_test WHERE LID='.$lid[$i]);				
	
 			while($row = mysql_fetch_assoc($result)){
        	$arr_row=array();
	        $c=0;
		
    	    while ($c < mysql_num_fields($result)) {        
        	    $col = mysql_fetch_field($result, $c);    
            	$arr_row[$col -> name] = $row[$col -> name];            
	            $c++;
    	    }    	
		
	        $table_result[$r] = $arr_row;
    	    $r++;
	    	}       	
		}
		
		return $table_result;	
 	}

}
?>