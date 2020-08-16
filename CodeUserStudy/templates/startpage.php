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
		<h1 align="center">Herzlich willkommen!</h1>
		<div class="alert alert-success" role="alert">
			Bei dieser Nutzerstudie wird eine Evaluierung der Nutzer-Aufmerksamkeit für dynamische Kartenbeschriftung näher betrachtet. </br></br>
			
			Zu beachten:</br>
			1. Bitte füllen Sie die Angaben zu Ihrer Person wahrheitsgetreu aus.</br>
			2. Lesen Sie die Aufgabenbeschreibungen mit Sorgfalt durch und bearbeiten Sie die einzelnen Aufgaben gewissenhaft.</br>
			3. Am Ende wartet ein Feedback-Bogen auf Sie. Bitte geben Sie hier Ihre tatsächlichen Eindrücke und konstruktive Kritik an.</br>	</br>
			
			<b>Sämtliche Angaben zu Ihrer Person und die erfassten Daten während der Nutzerstudie werden streng anonym behandelt und dienen ausschließlich für statistische Auswertungen.</b> </br>
			
		</div>

		<div class="alert alert-danger" role="alert">
			Bei einem sehr kleinen Prozentsatz von Menschen können Anfälle auftreten, wenn sie bestimmten visuellen Reizen ausgesetzt sind z. B. aufblitzende Lichter oder Muster.
			Menschen, die keine Vorgeschichte von Anfällen oder Epilepsie haben, können ein nicht diagnostiziertes Leiden haben, das beim Anschauen von Videos zu diesen "photosensitiven 
			epileptischen Anfällen" führt.</br>			
			Mögliche Symptome: Schwindelgefühl, veränderte Wahrnehmung, Augen- oder Muskelzucken uvm.</br></br>			
			<b>Stellen Sie eines dieser Symptome oder generelles Unwohlsein bei Ihnen fest, beenden Sie bitte sofort die Nutzerstudie!</b>
		</div>

		
		<div class="form-group">
			<span style="display:inline-block; width: 50px;">Alter</span>
			<!-- Radiobutton < 19-->
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" class="custom-control-input" id="defaultInline1" name="rdbAge" value="19" checked> 
			  	<label class="custom-control-label" for="defaultInline1">< 19</label>
			  <!--<label class="custom-control-label" for="defaultInline1">< 19</label> -->
			</div>

			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline2" name="rdbAge" value="20">
			  <label class="custom-control-label" for="defaultInline2">20 - 25</label>
			</div>

			<!-- Radiobutton 26 - 30-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline3" name="rdbAge" value="21">
			  <label class="custom-control-label" for="defaultInline3">26 - 30</label>
			</div>
			
			<!-- Radiobutton 30+-->
			<div class="custom-control custom-radio custom-control-inline">
				<input type="radio" class="custom-control-input" id="defaultInline4" name="rdbAge" value="22">
				<label class="custom-control-label" for="defaultInline4"> > 30 </label>
			</div>
		</div>
		
		<div class="form-group">
			<span style="display:inline-block; width: 100px;">Geschlecht</span>
			<!-- weiblich -->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline5" name="rdbSex" value="1" checked>
			  <label class="custom-control-label" for="defaultInline5">weiblich</label>
			</div>
			
			<!-- männlich -->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline6" name="rdbSex" value = "2">
			  <label class="custom-control-label" for="defaultInline6">männlich</label>
			</div>

			<!-- divers -->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline61" name="rdbSex" value = "3">
			  <label class="custom-control-label" for="defaultInline61">divers</label>
			</div>
		</div>
		<div class="form-group">
			<span style="display:inline-block; width: 260px;">Wie oft spielen Sie Videospiele?</span>
			<!-- Radiobutton < 19-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline7" name="rdbIntervalVideo" value = "1" checked>
			  <label class="custom-control-label" for="defaultInline7">täglich</label>
			</div>

			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline8" name="rdbIntervalVideo" value = "2">
			  <label class="custom-control-label" for="defaultInline8">mehrmals in der Woche</label>
			</div>

			<!-- Radiobutton 26 - 30-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline9" name="rdbIntervalVideo" value = "3">
			  <label class="custom-control-label" for="defaultInline9">1-2 mal im Monat</label>
			</div>
			
			<!-- Radiobutton 30+-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline10" name="rdbIntervalVideo" value = "4">
			  <label class="custom-control-label" for="defaultInline10">nie</label>
			</div>
		</div>
		<div class="form-group">
			<span style="display:inline-block; width: 260px;">Haben Sie bereits ein Navigationssystem verwendet?</span>
			<!-- Radiobutton < 19-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline11" name="rdbUsedNavi" value = "1" checked>
			  <label class="custom-control-label" for="defaultInline11">ja</label>
			</div>

			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline12" name="rdbUsedNavi" value = "2">
			  <label class="custom-control-label" for="defaultInline12">nein</label>
			</div>
		</div>
		<div class="form-group">
			<span style="display:inline-block; width: 260px;">Wie oft verwenden Sie ein Navigationssystem?</span>
			<!-- Radiobutton < 19-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline13" name="rdbIntervalNavi" value = "1" checked>
			  <label class="custom-control-label" for="defaultInline13">täglich</label>
			</div>

			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline14" name="rdbIntervalNavi" value= "2">
			  <label class="custom-control-label" for="defaultInline14">mehrmals in der Woche</label>
			</div>
			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline15" name="rdbIntervalNavi" value = "3">
			  <label class="custom-control-label" for="defaultInline15">selten</label>
			</div>
			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline16" name="rdbIntervalNavi" value = "4">
			  <label class="custom-control-label" for="defaultInline16">nie</label>
			</div>
		</div>
		<div class="form-group">
			<span style="display:inline-block; width: 260px;">Welches Navigationssytem verwenden Sie am meisten?</span>
			<!-- Radiobutton < 19-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline17" name="rdbWhichNavi" value = "1"checked>
			  <label class="custom-control-label" for="defaultInline17">Handy</label>
			</div>

			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline18" name="rdbWhichNavi" value = "2">
			  <label class="custom-control-label" for="defaultInline18">eingebautes Autonavi</label>
			</div>
			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline19" name="rdbWhichNavi" value = "3">
			  <label class="custom-control-label" for="defaultInline19">variables Autonavi</label>
			</div>
			<!-- Radiobutton 20 - 25-->
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" class="custom-control-input" id="defaultInline20" name="rdbWhichNavi" value = "4">
			  <label class="custom-control-label" for="defaultInline20">keines</label>
			</div>
		</div>
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" id="chkAgreement" name="chkAgreement" value="chkAgreement" onClick="checkValidation()">
			<label class="custom-control-label" for="chkAgreement">Sie haben den Ablauf sowie die Risiken verstanden und die Angaben zu Ihrer Person wurden wahrheitsgetreu ausgefüllt.</label>
		</div>

		<div class='col-sm-2'></div>
        <div class="error"></div>
        <div class='col-sm-2'></div> 
		<button type="button" class="btn btn-primary" name="register" id ="register" onClick="registerUser()">Weiter</button>
	</form>
  </div>
</body>

</html>
