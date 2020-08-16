<?php 
	$db = new Database();

	$task3 = $db->getTask3($_GET['taskid']);
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
  <!-- start with personal infos -->
  <div class="container center_div">
	<form id="second-page" method="post">
		<h1 align="center">TUTORIAL - Aufgabe Nr. 3</h1>
		<input type="hidden" name="taskid" id = "taskid" value="13"/>
		<div class="alert alert-primary" role="alert">	
			Bitte wählen Sie eine Variante aus! </br> </br>
			<div class="container">
			  <div class="row">
			    <div class="col-sm">
			      	<div class="custom-control custom-checkbox add-space">
					    <input type="checkbox" class="custom-control-input" id="names1" name="names1" value = "Var1">
					    <label class="custom-control-label" for="names1">Variante 1</label>					    
					</div>	
					<ul class="list-group list-group-flush">
						<li class="list-group-item">1. <?php echo $task3[0]->getTask3Data("val1") ?></li>
					    <li class="list-group-item">2. <?php echo $task3[0]->getTask3Data("val2") ?></li>
					    <li class="list-group-item">3. <?php echo $task3[0]->getTask3Data("val3") ?></li>
					</ul>
			    </div>
			    <div class="col-sm">
			    	<div class="custom-control custom-checkbox add-space">
					    <input type="checkbox" class="custom-control-input" id="names2" name="names2" value = "Var2">
					    <label class="custom-control-label" for="names2">Variante 2</label>
					</div>	
					<ul class="list-group list-group-flush">
						<li class="list-group-item">1. <?php echo $task3[1]->getTask3Data("val1") ?></li>
					    <li class="list-group-item">2. <?php echo $task3[1]->getTask3Data("val2") ?></li>
					    <li class="list-group-item">3. <?php echo $task3[1]->getTask3Data("val3") ?></li>
					</ul>
			    </div>
			    <div class="col-sm">
			    	<div class="custom-control custom-checkbox add-space">
					    <input type="checkbox" class="custom-control-input" id="names3" name="names3" value = "Var3">
					    <label class="custom-control-label" for="names3">Variante 3</label>
					</div>	
					<ul class="list-group list-group-flush">
						<li class="list-group-item">1. <?php echo $task3[2]->getTask3Data("val1") ?></li>
					    <li class="list-group-item">2. <?php echo $task3[2]->getTask3Data("val2") ?></li>
					    <li class="list-group-item">3. <?php echo $task3[2]->getTask3Data("val3") ?></li>
					</ul>
			    </div>
			    <div class="col-sm">
			    	<div class="custom-control custom-checkbox add-space">
					    <input type="checkbox" class="custom-control-input" id="names4" name="names4" value = "Var4">
					    <label class="custom-control-label" for="names4">Variante 4</label>
					</div>	
					<ul class="list-group list-group-flush">
						<li class="list-group-item">1. <?php echo $task3[3]->getTask3Data("val1") ?></li>
					    <li class="list-group-item">2. <?php echo $task3[3]->getTask3Data("val2") ?></li>
					    <li class="list-group-item">3. <?php echo $task3[3]->getTask3Data("val3") ?></li>
					</ul>
			    </div>
			  </div>
			</div>			
		</div>


		<div class='col-sm-2'></div>
        <div class="error"></div>
        <div class="answer"></div>
        <div class='col-sm-2'></div> 
		
		<button type="button" class="btn btn-primary" name="register" id ="register" onClick="chooseVarianteTut(-3)">Aufgabe abschließen</button>
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
