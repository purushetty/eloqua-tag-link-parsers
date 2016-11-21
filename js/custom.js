            jQuery(document).ready(function(){

                //jQuery("#eloqua_url").validationEngine();
			
				$('#confirm').hide();
				$('#success-message').hide();
				$('#error-message').hide();
				//$('#err-msg').hide();	
				$('#bsrcfn').hide();
				$('#src').hide();
				$('#badfn').hide();	
				
				$("#eloqua_url").submit(function(event) {
					event.preventDefault();						
					validate_input();
				});
				
				$('<div></div>')
					.attr('id', 'spinner')
					.hide()
					.appendTo(gallery.container)
					.fadeTo('slow', 0.6);								
            });
						
			// Form input validation routine
			function validate_input() {
					$.ajax({
				  		type : "POST",
						url	: "ajax_routines.php",
						data : $("#eloqua_url").serialize(), 
					    datatype : 'html', 					 
					 success: function(data) {

						 if(data == 'mv')
						 {
							 $( "#src" ).dialog({
									    width: 500,
    		        					height:200,										
										modal: true,
										buttons: {
											Ok: function() {
											$( this ).dialog( "close" );
											}
										}
							}).show();
							
							//jQuery('#url').validationEngine('showPrompt', 'Please fill in a value!', 'fail', 'topRight');
							//$('#err-msg').html('<p>*** Please provide either source code url or paste in the html code in the text area! ***</p>').show();
						 }						 
						 else if(data == 'mvbf')
						 {		
							$( "#bsrcfn" ).dialog({
							    width: 500,
    		        			height:200,										
								modal: true,
								buttons: {
									Ok: function() {
									$( this ).dialog( "close" );
									}
								}
							}).show();	
							
							//jQuery('#url').validationEngine('showPrompt', 'Please fill in a value!', 'fail', 'topRight');
							//jQuery('#htmlO').validationEngine('showPrompt', 'Invalid filename!', 'fail', 'topRight');										
							//$('#err-msg').html('<p>*** Please provide either the source url or html code! ***</p> <p>*** Invalid Filename ***</p> ').show();
						 }
						 else if(data == 'bf')
						 {
							$( "#badfn" ).dialog({
							    width: 500,
    		        			height:200,										
								modal: true,
								buttons: {
									Ok: function() {
									$( this ).dialog( "close" );
									}
								}
							}).show();							 
							
							//jQuery('#htmlO').validationEngine('showPrompt', 'Invalid filename!', 'fail', 'topRight');			
							//$('#err-msg').html('<p>Invalid Filename</p>').show();
						 }
						 else if(data == 'fok')
						 {
							 $( "#src" ).dialog({
									    width: 500,
    		        					height:200,										
										modal: true,
										buttons: {
											Ok: function() {
											$( this ).dialog( "close" );
											}
										}
							}).show();
							
							//jQuery('#htmlO').validationEngine('showPrompt', 'Invalid filename!', 'fail', 'topRight');			
							//$('#err-msg').html('<p>Invalid Filename</p>').show();
						 }					 
						 else if(data == 'ok')
						 {
							//jQuery('#htmlO').validationEngine('showPrompt', 'Perfect!', 'pass', 'topRight');			
							$('#eloqua_url').unbind('submit').submit()
						 }						 
  					 }
				});
			}

			// Server output file delete $.post ajax call
			function del_copy() {			
			    $( "#confirm" ).dialog({
      				resizable: false,
				    width: 500,
    		        height:200,
				    modal: true,
				    buttons: {
				        "Yes": function() {
  				            $( this ).dialog( "close" );
							
							$.post('ajax_routines.php', { 'delete': 'delete' }, function(data) {
								if(data)
								{
									$( "#success-message" ).dialog({
									    width: 500,
    		        					height:200,										
										modal: true,
										buttons: {
											Ok: function() {
											$( this ).dialog( "close" );
											}
										}
									});
									$('#out-file').hide();
								}
								else
								{
									$( "#error-message" ).dialog({
										width: 500,
    		        					height:200,
										modal: true,
										buttons: {
											Ok: function() {
											$( this ).dialog( "close" );
											}
										}
									});									
								}
							});						
				        },
 				        Cancel: function() {
    				      $( this ).dialog( "close" );
        				}
      				}
    			});								
			}
			
			$('#spinner').fadeOut('slow', function() {
				$(this).remove();
			});			