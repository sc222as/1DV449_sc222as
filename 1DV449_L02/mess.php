<?php
	require_once("get.php");
	require_once("sec.php");
	checkUser();
    
ob_start("ob_gzhandler");

?>
<?php
 Header("Cache-Control: max-age=3600");

?>

<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Karla:400,700">
	<link href='http://fonts.googleapis.com/css?family=Wellfleet' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/screen.css" media="screen"/>
    <link rel="stylesheet" href="css/lightbox.css" media="screen"/>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/grid1.css"/>
    <link rel="stylesheet" href="css/grid2.css"/>
    <script type="text/javascript" src="js/app-min.js"> </script>
    <!-- <script async type="text/javascript" src="js/ajax.js"> </script> -->
    
    <style type="text/css">
	
	.message_container {
		border: 1px solid black;
		padding: 8px;
		background-color: #DDD;
	}
	</style>
    <style type="text/css">
			#mess_p_mess {
				width: 100%; height: 250px; overflow-y: scroll !important; border: solid 3px black; padding: 5px;
			}
			
			#mess_p_headline {
				font-family: 'Wellfleet', cursive;
			}
			
		</style>
    
    
	<!-- <script type="text/javascript" src="js/longpoll.js"></script> -->
    
	<title>Messy Labbage</title>

	<script>
		$( document ).ready( 
			function() {
				$("#logout").bind( "click", function() {
  				  	window.location = "index.php";
			 	});
			}
		)
		
		$( document ).ready( 
					
			function() {
				
				$('#mess_container').hide();
				
				$("#add_btn").bind( "click", function() {
  				  	
					var name_val = $('#name_txt').val();
					var message_val = $('#message_ta').val();
					var pid =  $('#mess_inputs').val();
					// make ajax call to logout
					$.ajax({
						type: "GET",
					  	url: "functions.php",
					  	data: {function: "add", name: name_val, message: message_val, pid: pid}
					}).done(function(data) {                    
					  var data2 = data.split("@@@@@@"); //Eftersom jag får en array tillbaka med meddelande och namn så splittar jag den här och lägger den i två egna variabler. Använder 6x@ för att bryta för vem skriver det?
                      var message = data2[0]; //innehåller meddelandet
                      var name = data2[1];      // innehåller namnet                
                    $( "#mess_p_mess" ).prepend( "<p class='message_container'>" + message +"<br />Skrivet av: " + name +"</p>"); //skriver ut allt i en message_container i div-taggen mess_p_mess
                                });
				  
			  });
			}
		)
	</script>


	<!-- Bootstrap core CSS -->
	    

	    <!-- Custom styles for this template -->

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->
	  </head>

	  <body>

	    <div class="container">
			<div class="header">
			        <ul class="nav nav-pills pull-right">
			             <li><button class="btn" id="logout">Logga ut</button></li>
			        </ul>
			        <h3 class="text-muted">Messy Labbage</h3>
			      </div>

			<!-- page header -->
			<div class="jumbotron">
	      	  
	        	  <h1>Messy Labbage</h1>
	        	  <p class="lead">Software developed by the MakeMyPageBetterPlease Company</p>
				  
	      	 </div>
		  
			<div class="image-row">
			
			<!-- This script is running to get the data for the producers -->
			<script>
				// Called when we click on a producer link - gets the id for the producer 
				function changeProducer(pid) {
				
				//console.log("pid --> " +pid);
								
				// Clear and update the hidden stuff
				$( "#mess_inputs").val(pid);
				$( "#mess_p_mess").text("");
				
				// get all the stuff for the producers
				// make ajax call to functions.php with teh data
				$.ajax({
					type: "GET",
				  	url: "functions.php",
				  	data: {function: "producers", pid: pid}
				}).done(function(data) { // called when the AJAX call is ready
					console.log(data);
					var j = JSON.parse(data);
					
					$("#mess_p_headline").text("Meddelande till " +j.name +", " +j.city);
					
					
					if(j.url !== "") {
						
						$("#mess_p_kontakt").text("Länk till deras hemsida " +j.url);
					}
					else {
						$("#mess_p_kontakt").text("Producenten har ingen webbsida");
					}
					
					if(j.imageURL !== "") {
						$("#p_img_link").attr("href", j.imageURL); 
						$("#p_img").attr("src", j.imageURL); 
					}
					else {
						$("#p_img_link").attr("href", "#"); 
						$("#p_img").attr("src", "img/noimg.jpg"); 
					}
				});
				
				// Get all the messages for the producers through functions.php
				$.ajax({
					type: "GET",
				  	url: "functions.php",
				  	data: {function: "getIdsOfMessages", pid: pid}
					
				}).done(function(data) {
					
					// all the id:s for the messages for this producer
					var ids = JSON.parse(data);
					//console.log(ids);
					
					// Loop through all the ids and make calls for the messages
					if(ids !== false){
					 ids.forEach(function(entry) {
						// problems with the messages not coming in the right order :/ (Not anymore ;))
						$.ajax({
							type: "GET",
						  	url: "functions.php",
						  	data: {function: "getMessage", serial: entry.serial},
							timeout: 2000
						}).done(function(data) {
							var j = JSON.parse(data);
						//	console.log(j);
							$( "#mess_p_mess" ).prepend( "<p class='message_container'>" +j.message +"<br />Skrivet av: " +j.name +"</p>"); //byter ut att append mot prepend
					
						});
					});
					}
					
				});
				
				// show the div if its unvisible
				$("#mess_container").show("slow");
				
			}
			</script>

			
            
            
            
			<!-- This holds all the links -->
			<div class="row">
			<div class="col-md-6">
			<?php
			/* Produces all the links to the producers */
				require_once("get.php");
				$ps = getProducers();
				
				foreach($ps as $p) {
					
					echo('<a onclick="changeProducer(' .$p["producerID"] .');" href="#mess_anchor">' .$p["name"] .'</a><br />');	
				}
			?>
			</div>
			<div class="col-md-6">
				<img src="pics/food.jpg" height="220px"/>
			</div>
			</div>
			<div style="clear: both;"></div>

			<!-- This is the part that will be populated with data from AJAX -->	
			<div id="mess_anchor"></div>	
			<div id="mess_container">
				<div class="row">
					<!-- Headline will be updated here -->
		  	     	<div class="col-md-6" height="250px">
						<h1 id="mess_p_headline"></h1>
		  	     		<p id="mess_p_kontakt"></p>
		  	  			<a id="p_img_link" class="example-image-link" href="" data-lightbox="example-set" title="">
		  					<img id="p_img"  class="example-image" src="" alt="" width="100" height="100"/>
		  				</a>
		  	     	</div>
				  		  	
	        		<div class="col-md-6">
				<p>Skriv ditt meddelande så dyker det upp i listan</p>
				<input id="mess_inputs" type="hidden" value="" />
				Namn: <br /><input id="name_txt" type="text" name="name" value="<?php echo $_SESSION['user']; ?>" /><br />
				Meddelande: <br /><textarea id="message_ta" cols="50" rows="5" name="message"></textarea><br /><br />
				<button id="add_btn" class="btn btn-primary">Skicka ditt meddelande</button>                
				</div>
				<div class="col-md-6">
				<strong>Meddelanden:</strong><br />
				<div id="mess_p_mess">                
					<!-- Här populeras meddelandena -->
				</div>
			</div>
			
	  	</div><!-- mess_container -->

	    </div> <!-- /container -->
		
		<!-- <script type="text/javascript" src="js/ajax_minified.js"></script> -->

	  </body>
	</html>