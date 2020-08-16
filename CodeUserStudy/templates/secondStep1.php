<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Nutzerstudie TML</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/mycss.css"/>
  <script type="text/javascript" src="js/myJS.js"></script>
</head>

<body>		
  <!-- start with personal infos -->
  <div class="container center_div">
	<form id="second-page" method="post" action="<?php echo 'index.php?section=form1Ex&taskid='.$taskid?>">
		<h1 align="center">Aufgabe Nr. <?php echo $taskid ?></h1>
		<div class="alert alert-success" role="alert">
			Verfolgen Sie den roten Kreis auf der Strecke und versuchen Sie sich so viele Namen wie möglich zu merken. "Namen" sind dabei die Bezeichnungen, die sich auf beiden Seiten ca. 1 cm von der Strecke (strichlierte Linie) befinden. </br></br>
			Ablauf: </br>
			1. Es wird Ihnen ein Video gezeigt.</br>
			2. Nach Ablauf des Videos wird ein Button "Zur Aufgabe" eingeblendet. Bei Klick auf diesen Button, wechselt die Ansicht.</br>
			3. Es werden 3 richtige und 3 falsche Antwortmöglichkeiten angezeigt.</br>			
		</div>

		<div class="container">
	      <div class="row">        
	        <div class="col-sm-9">
	          <div align="center" >
	            <video onclick="this.play()" class="embed-responsive-item" id="videoPlayer" style="max-width:100%; height:600px" onended="videoEnded()">
	            	<?php
				    	switch($taskid){
				    		//AM3_1_Index0		    		
				    		case 1: echo "<source src='./video/Session_Sur_AM3_1_In50_Zoom_Route45.mp4' type='video/mp4'>";
				    				break;
				    		case 2: echo "<source src='./video/Session_Sur_AM4_2_In250_Zoom_Route45.mp4' type='video/mp4'>";
				    				break;
				    		case 3: echo "<source src='./video/Session_Sur_AM4_3_In1000_Zoom_Route45.mp4' type='video/mp4'>";
				    				break;
				    		case 4: echo "<source src='./video/Session_Sur_AM3_1_In0_NoZoom_Route45.mp4' type='video/mp4'>";
				    				break;		    		 
				    		case 5: echo "<source src='./video/Session_Sur_AM4_2_In500_NoZoom_Route45.mp4' type='video/mp4'>";
				    				break;
				    		case 6: echo "<source src='./video/Session_Sur_AM4_3_In1250_NoZoom_Route45.mp4' type='video/mp4'>";
				    				break;
				   		}
				   	?>		                                
	            </video>
	          </div>
	        </div>
	        <div class="col-sm-3 mb-0">
	          <button type="button" id="button_play" name="button_play" class="btn" onclick= 'buttonPlayPress()'><i class="fa fa-play"></i> Video starten </button>
	          <div class="button_next"></div>
	        </div>
	      </div>
	    </div>		
		<div class="extra_space"></div>		
	</form>
  </div>

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
