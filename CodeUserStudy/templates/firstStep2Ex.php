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
		<h1 align="center">TUTORIAL - Aufgabe Nr. 2</h1>

		<div class="alert alert-primary" role="alert">	
			Bitte geben Sie den Streckenverlauf wieder!  </br> </br>	
			
			<div class="input-group col-md-6">
			  <div class="input-group-prepend">
			    <span class="input-group-text" id="defStreet" name="defStreet">Streckenverlauf</span>
			  </div>
			  <input type="text" class="form-control" id="numStreetEntry" aria-describedby="defStreet" maxlength="70" placeholder="Bitte wählen Sie einen Button aus..." readonly>
			</div>		
			</br>
			<div class="input-group col-md-10">
				<button type="button" class="btn btn-info" onClick="addDirection(1)">Linkskurve hinzufügen</button>
				<button type="button" class="btn btn-info" onClick="addDirection(2)">Rechtskurve hinzufügen</button>
				<button type="button" class="btn btn-danger" onClick="deleteEntry()">Letzten Eintrag entfernen</button>
			</div>			
		</div>
		
		<div class='col-sm-2'></div>
    <div class="error"></div>
    <div class="answer"></div>
    <div class='col-sm-2'></div> 
		
		<button type="button" class="btn btn-primary" name="register" id ="register" onClick="checkStreetFormTut(-3)">Aufgabe abschließen</button>
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
