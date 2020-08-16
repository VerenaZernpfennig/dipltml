<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link type="text/css" rel="stylesheet" href="css/mycss.css"/>
</head>
<body>
	<div class="main-body">
		<div class="flex-top flex-column">
			<!-- Horizontal Steppers -->
			<div class="row">
			  <div class="col-md-12">
			  	<!-- Stepers Wrapper -->
				<ul class="stepper stepper-horizontal stepper-set">					
					<?php
						//First Step
						switch($taskid){
							case '-1': 
							case '-2':
							case '-3': echo "<li class='active'><a href='#!'><span class='circle'>1</span><span class='label'>Tutorial</span>
										</a></li>";
									break;
							case '0': echo "<li class='active'><a href='#!'><span class='circle'>1</span><span class='label'>Persönliches</span>
										</a></li>";
									break;	
							default: echo "<li><a href='#!'><span class='circle'>1</span><span class='label'>Persönliches</span>
										</a></li>";
									break;
						}
						
						//Second Step
						switch($taskid){
							case '-1': 
							case '-2':
							case '-3':  echo "<li><a href='#!'><span class='circle'>2</span></a></li>";
									break; 
							case '0': echo "<li><a href='#!'><span class='circle'>2</span></a></li>";
									break; 
							case '1': echo "<li class='active'><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 1/6</span></a></li>";
								break;
							case '2': echo "<li class='active'><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 2/6</span></a></li>";
								break;
							case '3': echo "<li class='active'><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 3/6</span></a></li>";
								break;
							case '4': echo "<li class='active'><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 4/6</span></a></li>";
								break;
							case '5': echo "<li class='active'><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 5/6</span></a></li>";
								break;
							case '6': echo "<li class='active'><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 6/6</span></a></li>";
								break;
							default:
								echo "<li><a href='#!'><span class='circle'>2</span><span class='label'>Namen auf Strecke erkennen 6/6</span></a></li>";
								break;
						}
						//Third Step
						switch($taskid){
							case '-1': 
							case '-2':
							case '-3': 
							case '0':
							case '1':
							case '2':
							case '3':
							case '4':
							case '5':
							case '6': echo "<li><a href='#!'><span class='circle'>3</span></a></li>";
									break; 
							case '7': echo "<li class='active'><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 1/6 </span></a></li>";
								break;
							case '8': echo "<li class='active'><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 2/6 </span></a></li>";
								break;
							case '9': echo "<li class='active'><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 3/6 </span></a></li>";
								break;
							case '10': echo "<li class='active'><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 4/6 </span></a></li>";
								break;
							case '11': echo "<li class='active'><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 5/6 </span></a></li>";
								break;
							case '12': echo "<li class='active'><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 6/6 </span></a></li>";
								break;
							default:
								echo "<li><a href='#!'><span class='circle'>3</span><span class='label'>Strecke merken 6/6</span></a></li>";
								break; 
						}

				

						//Fourth Step
						switch($taskid){
							case '-1': 
							case '-2':
							case '-3': 
							case '0':
							case '1':
							case '2':
							case '3':
							case '4':
							case '5':
							case '6': 
							case '7':
							case '8':
							case '9':
							case '10':
							case '11':
							case '12': echo "<li><a href='#!'><span class='circle'>4</span></a></li>";
									break; 
							case '13': echo "<li class='active'><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 1/6</span></a></li>";
								break;
							case '14': echo "<li class='active'><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 2/6</span></a></li>";
								break;
							case '15': echo "<li class='active'><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 3/6</span></a></li>";
								break;
							case '16': echo "<li class='active'><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 4/6</span></a></li>";
								break;
							case '17': echo "<li class='active'><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 5/6</span></a></li>";
								break;
							case '18': echo "<li class='active'><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 6/6</span></a></li>";
								break;
							default:
								echo "<li><a href='#!'><span class='circle'>4</span><span class='label'>Reihenfolge merken 6/6</span></a></li>";
								break; 
						}

		
						//Fifth Step
						switch($taskid){
							case '19': echo "<li class='active'><a href='#!'><span class='circle'>5</span><span class='label'>Auswertung</span></a></li>";
							break;
							default: echo "<li><a href='#!'><span class='circle'>5</span></a></li>";
									break;
						}
					?>	
				</ul>		
				<!-- Steppers Ende -->
			</div>
		<!-- /.Horizontal Steppers --> 		
    </div>
  </div>
</body>
</html>