<?php
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

    <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</head>

<body>	
  <!-- start with personal infos -->
  <div class="container center_div">
	<form id="first-page" name="first-page" method='post'>
		<h1 align="center">Machen Sie eine kurze Pause!</h1>
		<div class="alert alert-success" role="alert">		
      </br>	
			<h3>Wenn Sie wieder bereit sind, klicken Sie auf den Button "Nutzerstudie fortfahren". </h3></br>
		</div>		
	

		<div class='col-sm-2'></div>
        <div class="error"></div>
        <div class='col-sm-2'></div> 
		<button type="button" class="btn btn-primary" name="register" id ="register" onClick="continueApp(<?php echo $s++?>)">Nutzerstudie fortfahren</button>
	</form>
  </div>
</body>

</html>
