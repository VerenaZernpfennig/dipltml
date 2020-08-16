<?php 
	$db = new Database();

	$task1 = $db->getTask1($_GET['taskid']);
	$s = $taskid;
?>
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
</head>

<body>	
  <div class="container center_div">
	<form id="second-page" method="post">
		<h1 align="center">Tutorial - Aufgabe Nr. 1</h1>
		<!--<input type="hidden" name="taskid" id = "taskid" value="1"/>-->
		<div class="alert alert-primary" role="alert">	
			Bitte wählen Sie drei Namen aus, die Sie in der Karte gesehen haben! </br> </br>	
			<div class="container">
				<div class="row">
			    	<div class="col-sm">
			    		<div class="custom-control custom-checkbox add-space">
						    <input type="checkbox" class="custom-control-input" id="names1" name="names1" value = "Corr1">
						    <label class="custom-control-label" for="names1"><?php echo $task1->getTask1Data("val1") ?></label>
						</div>	
						<div class="custom-control custom-checkbox add-space">
						    <input type="checkbox" class="custom-control-input" id="names2" name="names2" value = "Corr2">
						    <label class="custom-control-label" for="names2"><?php echo $task1->getTask1Data("val2") ?></label>
						</div>	
						<div class="custom-control custom-checkbox add-space">
						    <input type="checkbox" class="custom-control-input" id="names3" name="names3" value = "Corr3">
						    <label class="custom-control-label" for="names3"><?php echo $task1->getTask1Data("val3") ?></label>
						</div>		
			    	</div>
			    	<div class="col-sm">
			    		<div class="custom-control custom-checkbox add-space">
						    <input type="checkbox" class="custom-control-input" id="names4" name="names4" value = "Corr4">
						    <label class="custom-control-label" for="names4"><?php echo $task1->getTask1Data("val4") ?></label>
						</div>	
						<div class="custom-control custom-checkbox add-space">
						    <input type="checkbox" class="custom-control-input" id="names5" name="names5" value = "Corr5">
						    <label class="custom-control-label" for="names5"><?php echo $task1->getTask1Data("val5") ?></label>
						</div>	
						<div class="custom-control custom-checkbox add-space">
						    <input type="checkbox" class="custom-control-input" id="names6" name="names6" value = "Corr6">
						    <label class="custom-control-label" for="names6"><?php echo $task1->getTask1Data("val6") ?></label>
						</div>		
					</div>
				</div>
			</div>				
		</div>
		<div class='col-sm-2'></div>
        <div class="error"></div>
        <div class="answer"></div>
        <div class='col-sm-2'></div> 
		
		<button type="button" class="btn btn-primary" name="register" id ="register" onClick="checkNumberThreeTut(-2)">Aufgabe abschließen</button>
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
