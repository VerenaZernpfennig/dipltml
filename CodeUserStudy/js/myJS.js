function createCurrentUrl(){
	var url= window.location.href;
	var pos=url.search("index");
	var current=url.substring(0,pos);
	return current;
}

function registerError(){
	$(document).ready(function() {
		$(".error").append('<div class="alert alert-danger" role="alert">Es ist ein Fehler bei der Registrierung entstanden.</div>');
	});
}

/**
*	first page: Radiobuttons of 'Alter'
*/
function getAgeNr(name){
	var agenr = 0;
	switch(name){
		case '19':
			agenr=1;
			break;
		case '20':
			agenr = 2;
			break;
		case '21':
			agenr = 3;
			break;
		case '22':
			agenr = 4;
			break;
	}
	return agenr;
}

/**
*	first page: save personaldata
*/
function registerUser(){
	var validation = checkValidation();
	if(validation){
		var age = '';
		var gender = '';
		var videofreq = '';
		var naviusage = '';
		var navifreq = '';
		var navitype = '';

		var inputElems = document.getElementsByTagName("input");
		for(var i = 0; i<inputElems.length;i++){
			if (inputElems[i].type == "radio" && inputElems[i].checked == true){
				switch (inputElems[i].name){
					case 'rdbAge':
						age = inputElems[i].value;
						break;
					case 'rdbSex':
						gender = inputElems[i].value;
						break;
					case 'rdbIntervalVideo':
						videofreq = inputElems[i].value;
						break;
					case 'rdbUsedNavi':
						naviusage = inputElems[i].value;
						break;
					case 'rdbIntervalNavi':
						navifreq = inputElems[i].value;
						break;
					case 'rdbWhichNavi':
						navitype = inputElems[i].value;
						break;
				}
			}

		}
		var content = {"Age":age,"Gender":gender,"Videofreq":videofreq,"Naviusage":naviusage,"Navifreq":navifreq,"Navitype":navitype};
		var json_content = JSON.stringify(content);
		$.post("./templates/doRegister.php",{Content:json_content}).done(function(data){
			if(data.indexOf('Message') >= 0){
				$(document).ready(function() {
					$(".error").empty();
					$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
				});
			}
			else{
				//in neue Form wechseln - Tutorials
				window.location = window.location.pathname+"?section=form0&taskid=-1";
			}
		});
	}
}

//prüfen ob min 3 Antworten markiert wurden
function checkNumberThree(nr){
	var taskid = nr;
	var inputElems = document.getElementsByTagName("input"), count = 0, def = '', newdef = '';

	for(var i = 0; i<inputElems.length;i++){
		if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
			def+= inputElems[i].value  + ',';
			count++;
		}
	}
	//letzten Beistrich löschen
	newdef = def.substring(0,def.length-1);

	//wenn mehr als 3 Einträge ausgewählt wurden
	if (count > 3){ 
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Es wurden mehr als drei Einträge ausgewählt!</div>');
		});
	}
	else{
		//wenn alles ok in DB speichern
		switch(taskid){
			//Task 1 - 6
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
				var res = newdef.split(",");

				//wenn res kleiner 3 (weniger Einträge wurden ausgwählt)
				if (res.length != 3){
					switch(res.length){
						//wenn ein Eintrag fehlt
						case 2: res[2] = 'Corr0';
								break;

						case 1: res[2] = 'Corr0';
								res[1] = 'Corr0';
								break;
						case 0: res[2] = 'Corr0';
								res[1] = 'Corr0';
								res[0] = 'Corr0';
								break;
					}
				}
		
				var content = {"TaskNr":taskid,"Corr1":res[0],"Corr2":res[1],"Corr3":res[2],"TaskType":'1'};
				var json_content = JSON.stringify(content);
				$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
					if(data.indexOf('Message') >= 0){
						$(document).ready(function() {
							$(".error").empty();
							$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
						});
					}
					else{

						//in neue Form wechseln
						//nächste Task-Nr. generieren
						var nextNr = taskid + 1;
						//wenn Task-ID > 6 in form2 wechseln
						if (nextNr > 6) {
							//Pause
							window.location = window.location.pathname+"?section=form5&taskid=" + taskid;
						}
						else{
							window.location = window.location.pathname+"?section=form1&taskid=" + nextNr;
						}
					}
				});
				break;


		}
		$(document).ready(function() {
			$(".error").empty();
		});
		
	}
}

//prüfen ob min 3 Antworten markiert wurden
function checkNumberThreeTut(nr){
	var tempnr = nr
	var taskid = tempnr + 1;
	var inputElems = document.getElementsByTagName("input"), count = 0, def = '', newdef = '';

	for(var i = 0; i<inputElems.length;i++){
		if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
			def+= inputElems[i].value  + ',';
			count++;
		}
	}
	//letzten Beistrich löschen
	newdef = def.substring(0,def.length-1);

	//wenn mehr als 3 Einträge ausgewählt wurden
	if (count > 3){ 
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Es wurden mehr als drei Einträge ausgewählt!</div>');
		});
	}
	//wenn weniger als 3 Einträge ausgewählt wurden
	else{
		//wenn alles ok in DB speichern
		var res = newdef.split(",");

		//wenn res kleiner 3 (weniger Einträge wurden ausgwählt)
		if (res.length != 3){
			switch(res.length){
				//wenn ein Eintrag fehlt
				case 2: res[2] = 'Corr0';
						break;

				case 1: res[2] = 'Corr0';
						res[1] = 'Corr0';
						break;
				case 0: res[2] = 'Corr0';
						res[1] = 'Corr0';
						res[0] = 'Corr0';
						break;
			}
		}

		var content = {"TaskNr":taskid,"Corr1":res[0],"Corr2":res[1],"Corr3":res[2],"TaskType":'1'};		
		var json_content = JSON.stringify(content);
		$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
			if(data.indexOf('Message') >= 0){
				$(document).ready(function() {
					$(".error").empty();
					$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
				});
			}
			else{
				var correctNr = data;
				//Antwort war richtig
				if (correctNr > 0){
					$(document).ready(function() {
						var elem = document.getElementById('register');
						elem.parentNode.removeChild(elem);
						$(".error").empty();
						$(".answer").empty();
						$(".answer").append('<div class="alert alert-success" role="alert"><p><b>Die Antworten waren richtig.</b></br></br> ' +
							'Bitte mit den Button "Weiter" zur nächsten Aufgabe wechseln.</p></br><button type="button" class="btn btn-primary" ' +
							'name="register" id ="register" onClick="changeToNewTask('+nr+')">Weiter</button></div>');
					});
				}
				//Antwort war falsch
				else{
					var elem = document.getElementById('register');
					elem.parentNode.removeChild(elem);
					$(document).ready(function() {
						$(".error").empty();
						$(".answer").empty();
						$(".answer").append('<div class="alert alert-danger" role="alert"><p><b>Die Antworten waren falsch.</b> </br></br>Mit Klick auf den Button ' +
											'"Erneut durchführen" können Sie die Aufgabe wiederholen. </br>Mit den Button "Weiter" können Sie zur nächsten ' +
											'Aufgabe wechseln.</p></br><button type="button" class="btn btn-primary" name="register" ' +
											'id ="register" onClick="changeToTask('+taskid+')">Erneut durchführen</button><button type="button" class="btn btn-primary" name="register" ' +
											'id ="register" onClick="changeToNewTask('+nr+')">Weiter</button> </div>');
					});
				}					
			}
		});
			
	
		$(document).ready(function() {
			$(".error").empty();
		});		
	}
}

//Tutorial Taskwechsel (erneut ausführen)
function changeToTask(nr){
	switch(nr){
		case 1:
			window.location = window.location.pathname+"?section=form1&taskid=" + nr;
			break;
		case -1: 
			window.location = window.location.pathname+"?section=form0&taskid=" + nr;
			break;
		case -2: 
			window.location = window.location.pathname+"?section=form00&taskid=" + nr;
			break;
		case -3: 
			window.location = window.location.pathname+"?section=form000&taskid=" + nr;
			break;
	}
}

//Tutorial Taskwechsel (weiter)
function changeToNewTask(nr){
	switch(nr){
		case 1:
			window.location = window.location.pathname+"?section=form1&taskid=" + nr;
			break;
		case -1: 
			window.location = window.location.pathname+"?section=form0&taskid=" + nr;
			break;			
		case -2: 
			window.location = window.location.pathname+"?section=form00&taskid=" + nr;
			break;
		case -3: 
			window.location = window.location.pathname+"?section=form000&taskid=" + nr;
			break;
	}
}

//prüfen ob Werte für Links und Rechtskurve eingegeben wurden
function checkStreetForm(nr){	
	var taskid = nr;
	var newdef = '';
	//prüfen ob beide Eingabefelder befüllt
	if ($('#numStreetEntry').val() == ''){
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert"><p>Bitte setzen Sie durch die beiden Button "Linkskurve hinzufügen" und ' +
				'"Rechtskurve hinzufügen" den Streckenverlauf!</p></div>');
		});
	}

	else {
		//wenn alles ok in DB speichern
		switch(nr){
			//Task 7 - 12
			case 7:
			case 8:
			case 9:
			case 10:
			case 11:
			case 12:
				var def = $('#numStreetEntry').val();
				//letztes Komma rausparsen
				newdef = def.substring(0,def.length-1);
				var content = {"TaskNr":taskid,"DefStreet":newdef,"TaskType":'2'};
				var json_content = JSON.stringify(content);
				$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
					if(data.indexOf('Message') >= 0){
						$(document).ready(function() {
							$(".error").empty();
							$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
						});
					}
					else{
						//in neue Form wechseln
						//nächste Task-Nr. generieren
						var nextNr = taskid + 1;
						if (nextNr > 12){
							//Pause
							window.location = window.location.pathname+"?section=form5&taskid=" + taskid;
						}
						else{
							window.location = window.location.pathname+"?section=form2&taskid=" + nextNr;
						}

					}
				});
				break;
		}		
	}
}

//TUTORIAL - prüfen ob Werte für Links und Rechtskurve eingegeben wurden
function checkStreetFormTut(nr){
	var tempnr = nr;	
	var taskid = tempnr + 1;
	var newdef = '';
	//prüfen ob beide Eingabefelder befüllt
	if ($('#numStreetEntry').val() == ''){
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert"><p>Bitte setzen Sie durch die beiden Button "Linkskurve hinzufügen" und ' +
				'"Rechtskurve hinzufügen" den Streckenverlauf!</p></div>');
		});
	}

	else {		
		var def = $('#numStreetEntry').val();
		//letztes Komma rausparsen
		newdef = def.substring(0,def.length-1);
		var content = {"TaskNr":taskid,"DefStreet":newdef,"TaskType":'2'};
		var json_content = JSON.stringify(content);
		$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
			if(data.indexOf('Message') >= 0){
				$(document).ready(function() {
					$(".error").empty();
					$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
				});
			}
			else{
				var correctNr = data;
				//Antwort war richtig
				if (correctNr > 0){
					$(document).ready(function() {
						var elem = document.getElementById('register');
						elem.parentNode.removeChild(elem);
						$(".error").empty();
						$(".answer").empty();
						$(".answer").append('<div class="alert alert-success" role="alert"><p><b>Die Antworten waren richtig.</b></br></br> ' +
							'Bitte mit den Button "Weiter" zur nächsten Aufgabe wechseln.</p></br><button type="button" class="btn btn-primary" ' +
							'name="register" id ="register" onClick="changeToNewTask('+nr+')">Weiter</button></div>');
					});
				}
				//Antwort war falsch
				else{
					var elem = document.getElementById('register');
					elem.parentNode.removeChild(elem);
					$(document).ready(function() {
						$(".error").empty();
						$(".answer").empty();
						$(".answer").append('<div class="alert alert-danger" role="alert"><p><b>Die Antworten waren falsch.</b> </br></br>Mit Klick auf den Button ' +
											'"Erneut durchführen" können Sie die Aufgabe wiederholen. </br>Mit den Button "Weiter" können Sie zur nächsten ' +
											'Aufgabe wechseln.</p></br><button type="button" class="btn btn-primary" name="register" ' +
											'id ="register" onClick="changeToTask('+taskid+')">Erneut durchführen</button><button type="button" class="btn btn-primary" name="register" ' +
											'id ="register" onClick="changeToNewTask('+nr+')">Weiter</button> </div>');
					});
				}
			}
		});				
	}
}

//prüfen ob eine Variante ausgewählt wurde 
function chooseVariante(nr){	
	var taskid = nr;
	var inputElems = document.getElementsByTagName("input"), count = 0, def = '', newdef = '', taskid = nr;

	for(var i = 0; i<inputElems.length;i++){
		if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
			def+= inputElems[i].value  + ',';
			count++;
		}
	}
	//letzten Beistrich löschen
	newdef = def.substring(0,def.length-1);
	
	//wenn mehr als 1 Eintrag ausgewählt wurde
	if (count > 1){ 
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Bitte wählen Sie nur <b>eine</b> Variante aus!</div>');
		});
	}
	else if (count == 0){
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Bitte wählen Sie <b>eine</b> Variante aus!</div>');
		});
	}

	else {
		//wenn alles ok in DB speichern
		switch(taskid){
			//Task 13 - 18
			case 13:
			case 14:
			case 15:
			case 16:
			case 17:
			case 18:
				var var1 = 0;
				var var2 = 0;
				var var3 = 0;
				var var4 = 0;

				switch(newdef){
					case 'Var1': 
						var1 = 1;
						break;
					case 'Var2':
						var2 = 1;
						break;
					case 'Var3':
						var3 = 1;
						break;
					case 'Var4':
						var4 = 1;
						break;
				}

				var content = {"TaskNr":taskid,"Var1":var1,"Var2":var2,"Var3":var3,"Var4":var4, "TaskType":'3'};
				var json_content = JSON.stringify(content);
				$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
					if(data.indexOf('Message') >= 0){
						$(document).ready(function() {
							$(".error").empty();
							$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
						});
					}
					else{
						//in neue Form wechseln
						//nächste Task-Nr generieren
						var nextNr = taskid + 1;
						if (nextNr > 18){
							window.location = window.location.pathname+"?section=form4&taskid=" + nextNr;
						}
						else{
							window.location = window.location.pathname+"?section=form3&taskid=" + nextNr;
						}
					}
				});
				break;
		}		
	}
}

//TUTORIAL - prüfen ob eine Variante ausgewählt wurde 
function chooseVarianteTut(nr){	
	taskid = -3;
	var inputElems = document.getElementsByTagName("input"), count = 0, def = '', newdef = '', taskid = nr;

	for(var i = 0; i<inputElems.length;i++){
		if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
			def+= inputElems[i].value  + ',';
			count++;
		}
	}
	//letzten Beistrich löschen
	newdef = def.substring(0,def.length-1);
	
	//wenn mehr als 1 Eintrag ausgewählt wurde
	if (count > 1){ 
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Bitte wählen Sie nur <b>eine</b> Variante aus!</div>');
		});
	}
	else if (count == 0){
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Bitte wählen Sie <b>eine</b> Variante aus!</div>');
		});
	}

	else {
		//wenn alles ok in DB speichern		
		var var1 = 0;
		var var2 = 0;
		var var3 = 0;
		var var4 = 0;

		switch(newdef){
			case 'Var1': 
				var1 = 1;
				break;
			case 'Var2':
				var2 = 1;
				break;
			case 'Var3':
				var3 = 1;
				break;
			case 'Var4':
				var4 = 1;
				break;
		}

		var content = {"TaskNr":taskid,"Var1":var1,"Var2":var2,"Var3":var3,"Var4":var4, "TaskType":'3'};
		var json_content = JSON.stringify(content);
		$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
			if(data.indexOf('Message') >= 0){
				$(document).ready(function() {
					$(".error").empty();
					$(".error").append('<div class="alert alert-danger" role="alert"><p>Ein Fehler ist aufgetreten. '+data+'</p></div>');
				});
			}
			else{
				var correctNr = data;
				//Antwort war richtig
				if (correctNr > 0){
					$(document).ready(function() {
						var elem = document.getElementById('register');
						elem.parentNode.removeChild(elem);
						$(".error").empty();
						$(".answer").empty();
						$(".answer").append('<div class="alert alert-success" role="alert"><p><b>Die Antwort war richtig.</b></br></br> ' +
							'Der Tutorial Part ist damit abgeschlossen. </br> Wenn Sie bereit sind, starten Sie bitte mit den Button "Weiter" die Nutzerstudie.</p></br><button type="button" class="btn btn-primary" ' +
							'name="register" id ="register" onClick="changeToNewTask(1)">Weiter</button></div>');
					});
				}
				//Antwort war falsch
				else{
					var elem = document.getElementById('register');
					elem.parentNode.removeChild(elem);
					$(document).ready(function() {
						$(".error").empty();
						$(".answer").empty();
						$(".answer").append('<div class="alert alert-danger" role="alert"><p><b>Die Antwort war falsch.</b> </br></br>Mit Klick auf den Button ' +
											'"Erneut durchführen" können Sie die Aufgabe wiederholen. </br>Mit den Button "Weiter" können Sie zur nächsten ' +
											'Aufgabe wechseln.</p></br><button type="button" class="btn btn-primary" name="register" ' +
											'id ="register" onClick="changeToTask(-3)">Erneut durchführen</button><button type="button" class="btn btn-primary" name="register" ' +
											'id ="register" onClick="changeToNewTask(1)">Weiter</button> </div>');
					});
				}
			}
		});
					
	}
}

/**
* Task2 Streckenverlauf angeben
*/
function addDirection(nr){
	if (nr == 1){
		document.getElementById('numStreetEntry').value = document.getElementById('numStreetEntry').value + 'L,';	
	}
	else{
		document.getElementById('numStreetEntry').value = document.getElementById('numStreetEntry').value + 'R,'
	}	
}

/**
* Task2 Eintrag aus Streckenverlauf löschen
*/
function deleteEntry(){
	var text = document.getElementById('numStreetEntry').value;
	document.getElementById('numStreetEntry').value = text.substring(0,text.length-2);
}

/**
*	first page: Checkbox with agreement has to be checked
*/
function checkValidation(){
	var result = true;
	if($("input:checkbox[name ='chkAgreement']").prop('checked') == false){
		$(document).ready(function() {
			$(".error").empty();
			$(".error").append('<div class="alert alert-danger" role="alert">Bitte setzen Sie ein Häkchen in der Box.</div>');
		});
		result = false;
	}
	else{
		$(".error").empty();
	}
	return result;
}

function redirectToStep(nr){
	var formNr = nr;
	window.location = window.location.pathname+"?section=form"+formNr;
}

function doRegister(){
	window.location = window.location.pathname+"?action=register";
}

function buttonPlayPress(){
	var v = document.getElementById("videoPlayer");
	v.focus();
	v.play();
}


/**
* Nach Pauseseite richtige Seite aufrufen
*/
function continueApp(nr){
	var taskid = nr+1;
	//Wechsel zu Task2
	if (taskid > 6 && taskid < 13){
		window.location = window.location.pathname+"?section=form2&taskid=" + taskid;
	}
	else{
		window.location = window.location.pathname+"?section=form3&taskid=" + taskid;
	}
}

/**
* Auswertung speichern
* Session beenden
*/
function closeApp(){
	if (!($('#feedbackText').val() == '')){
		var feedText = $('#feedbackText').val();
		var content = {"Feedback":feedText, "TaskType":'4'};
		var json_content = JSON.stringify(content);
		$.post("./templates/saveTask.php",{Content:json_content}).done(function(data){
			//Nothing to do
		});
	}
	
	window.location = window.location.pathname+"?action=logout";
}

function videoEnded(){	
	$(document).ready(function() {
			$(".button_next").empty();
			$(".button_next").append('<button type="submit" class="btn btn-primary" name="register" id ="register">Zur Aufgabe</button>');
			document.getElementById("register").focus();

	});	
}



