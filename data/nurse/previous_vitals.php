<?php
$visit_id = $_GET['visit_id'];

include("../../classes/class_nurse.php");

$get = new nurse;
$rs = $get->get_previous_vitals($visit_id);
$num_rows = mysql_num_rows($rs);

if($num_rows > 0){
	echo '
		<div class="navbar-inner"><p style="text-align:center; color:#0e0efe;">Previous Vitals</p></div>

		<table class="table table-striped table-hover table-condensed">
			<tr>
				<th></th>
				<th>Systolic</th>
				<th>Diastolic</th>
				<th>Weight</th>
				<th>Height</th>
				<th>BMI</th>
				<th>Hip</th>
				<th>Waist</th>
				<th>H / W</th>
				<th>Temperature</th>
				<th>Pulse</th>
				<th>Respiration</th>
				<th>Oxygen Saturation</th>
				<th>Pain</th>
			</tr>
	';
	
	for($r = 0; $r < $num_rows; $r++){
		
		$vital_id = mysql_result($rs, $r, "vital_id");
		$visit_date = mysql_result($rs, $r, "visit_date");
		
		if($vital_id == 1){
			$temperature = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 2){
			$respiration = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 3){
			$waist = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 4){
			$hip = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 5){
			$systolic = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 6){
			$diastolic = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 7){
			$pulse = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 8){
			$weight = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 9){
			$height = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 10){
			$pain = mysql_result($rs, $r, "visit_vital_value");
		}
		
		else if($vital_id == 11){
			$oxygen = mysql_result($rs, $r, "visit_vital_value");
		}
		$bmi = $weight / ($height * $height);
		$hwr = $hip / $waist;
		
		echo '
			<tr>
				<td>'.$visit_date.'</td>
				<td>'.$systolic.'</td>
				<td>'.$diastolic.'</td>
				<td>'.$weight.'</td>
				<td>'.$height.'</td>
				<td>'.$bmi.'</td>
				<td>'.$hip.'</td>
				<td>'.$waist.'</td>
				<td>'.$hwr.'</td>
				<td>'.$temperature.'</td>
				<td>'.$pulse.'</td>
				<td>'.$respiration.'</td>
				<td>'.$oxygen.'</td>
				<td>'.$pain.'</td>
			</tr>

		';
	}
	
	echo "</table>";
}
?>