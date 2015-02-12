<?php
include ("connection.php");

class prescription{
	
	function save_prescription($varsubstitution, $vardate, $varfinishdate, $varx, $visit_charge_id, $duration, $consumption, $quantity,$service_charge_id){
			$sql = "INSERT INTO pres(prescription_substitution, prescription_startdate, prescription_finishdate, drug_times_id, visit_charge_id, drug_duration_id, drug_consumption_id, prescription_quantity,service_charge_id) 
			VALUES('$varsubstitution', '$vardate', '$varfinishdate', (SELECT drug_times_id FROM drug_times WHERE drug_times_name = '$varx'), $visit_charge_id, (SELECT drug_duration_id FROM drug_duration WHERE drug_duration_name = '$duration'), (SELECT drug_consumption_id FROM drug_consumption WHERE drug_consumption_name = '$consumption'), '$quantity','$service_charge_id')";
		//	echo $sql;
			$prescription = new Database();
			$prescription->insert($sql);
	}
	
	function get_visit_charge_id($visit_id, $date, $time){
		
		$sql = "SELECT visit_charge_id FROM visit_charge WHERE visit_id = $visit_id AND date = '$date' AND time = '$time'";
		
		$get = new Database();
		$rs = $get->select($sql);
			
		return mysql_result($rs, 0, "visit_charge_id");
	}
	function get_visit_charge_id1($id){
		
		$sql = "SELECT visit_charge_id FROM pres WHERE prescription_id= $id";
		//echo $sql;
		$get = new Database();
		$rs = $get->select($sql);
			
		return mysql_result($rs, 0, "visit_charge_id");
	}
function check_deleted_visitcharge($id){
		
		$sql = "SELECT * FROM visit_charge WHERE visit_charge_id= $id";
		//echo $sql;
		$get = new Database();
		$rs = $get->select($sql);
		return $rs;
			
}
	
	function save_visit_charge($varpassed_value, $visit_id, $date, $time, $quantity,$visit_t){
		if(($visit_t=1)||($visit_t=2)){	
		$visit_t=0;
			$sql = "INSERT INTO visit_charge(service_charge_id, visit_id, visit_charge_amount, date, time, visit_charge_units) 
			VALUES((SELECT service_charge_id FROM service_charge WHERE service_charge_name = '$varpassed_value' and visit_type_id=$visit_t), '$visit_id', (SELECT service_charge_amount FROM service_charge WHERE service_charge_name = '$varpassed_value'  and visit_type_id=$visit_t), '$date', '$time', '$quantity')";
}{
	
$sql = "INSERT INTO visit_charge(service_charge_id, visit_id, visit_charge_amount, date, time, visit_charge_units) 
			VALUES((SELECT service_charge_id FROM service_charge WHERE service_charge_name = '$varpassed_value' and visit_type_id=$visit_t), '$visit_id', (SELECT service_charge_amount FROM service_charge WHERE service_charge_name = '$varpassed_value'  and visit_type_id=$visit_t), '$date', '$time', '$quantity')";
	
	}
			
		//echo $sql;
			$prescription = new Database();
			$prescription->insert($sql);
	}
function update_visit_charge($visit_charge_id,$quantity){
			$sql = "UPDATE visit_charge SET visit_charge_units=$quantity where visit_charge_id= '$visit_charge_id'";
			//echo $sql;
			$prescription = new Database();
			$prescription->insert($sql);
	}
		
	function select_prescription($visit_id){
if(($visit_t=1)||($visit_t=2)){	
$visit_t=0;
			$sql = "SELECT service_charge.service_charge_name AS drugs_name,service_charge.service_charge_amount  AS drugs_charge , drug_duration.drug_duration_name, pres.prescription_substitution, pres.prescription_id, pres.units_given,pres.visit_charge_id,pres.prescription_startdate, pres.prescription_finishdate, drug_times.drug_times_name, pres.prescription_startdate, pres.prescription_finishdate, pres.service_charge_id AS drugs_id, pres.prescription_substitution, drug_duration.drug_duration_name, pres.prescription_quantity, drug_consumption.drug_consumption_name
			
			FROM pres, drugs, drug_times, drug_duration, drug_consumption, service_charge
			
			WHERE pres.visit_charge_id = $visit_id
			AND service_charge.service_charge_id=pres.service_charge_id 
			AND service_charge.drug_id = drugs.drugs_id
			AND pres.drug_times_id = drug_times.drug_times_id 
			AND pres.drug_duration_id = drug_duration.drug_duration_id
			AND pres.drug_consumption_id = drug_consumption.drug_consumption_id";
}
else {
				$sql = "SELECT service_charge.service_charge_name AS drugs_name,service_charge.service_charge_amount  AS drugs_charge , drug_duration.drug_duration_name, pres.prescription_substitution, pres.prescription_id,pres.units_given, pres.visit_charge_id,pres.prescription_startdate, pres.prescription_finishdate, drug_times.drug_times_name, pres.prescription_startdate, pres.prescription_finishdate, pres.service_charge_id AS drugs_id, pres.prescription_substitution, drug_duration.drug_duration_name, pres.prescription_quantity, drug_consumption.drug_consumption_name
			
			FROM pres, drugs, drug_times, drug_duration, drug_consumption, visit_charge, service_charge
			
			WHERE pres.visit_charge_id = $visit_id
			AND service_charge.service_charge_id=pres.service_charge_id 
			AND service_charge.drug_id = drugs.drugs_id
			AND pres.drug_times_id = drug_times.drug_times_id 
			AND pres.drug_duration_id = drug_duration.drug_duration_id
			AND pres.drug_consumption_id = drug_consumption.drug_consumption_id";
}
			
			$get = new Database();
			$rs = $get->select($sql);
			
			return $rs;
	}
	
	function update_drug_list($start_date, $finish_date, $frequncy, $id, $sub, $duration, $consumption, $quantity){
				
			$sql = "UPDATE pres 
			
			SET prescription_startdate = '$start_date', 
			prescription_finishdate = '$finish_date', 
			drug_times_id = (SELECT drug_times_id FROM drug_times WHERE drug_times_name = '$frequncy'), 
			prescription_substitution = '$sub', 
			drug_duration_id = (SELECT drug_duration_id FROM drug_duration WHERE drug_duration_name = '$duration'), 
			drug_consumption_id = (SELECT drug_consumption_id FROM drug_consumption WHERE drug_consumption_name = '$consumption'),
			prescription_quantity = '$quantity'
			
			WHERE prescription_id = $id";//echo $sql;
		
			$get = new Database();
			$get->insert($sql);
	}
	
	function get_drugs_name($id){
		
		$sql = "SELECT drugs_name FROM drugs WHERE drugs_id = $id";

		$get = new Database();
		$rs = $get->select($sql);
		
		return mysql_result($rs, 0, "drugs_name");
	}
	
	function delete_visit_charge($visit_charge_id){
		
		$sql = "DELETE FROM visit_charge WHERE visit_charge_id = $visit_charge_id";
//echo $sql;		$get = new Database();
			$get = new Database();
			$get->insert($sql);
	}
	
	function delete_prescription($id){
		
		$sql = "DELETE FROM pres WHERE prescription_id = $id";
		//echo $sql;
			$get = new Database();
			$get->insert($sql);;
	}
	
	function delete_item2($id){
		
		$sql = "DELETE FROM visit_charge WHERE visit_charge_id = $id";
		
		$get = new Database();
		$get->insert($sql);
	}
	
	function get_drug_forms(){
		
		$sql = "SELECT * FROM drug_type ORDER BY drug_type_name";
		
		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_admin_route(){
		
		$sql = "SELECT * FROM drug_administration_route ORDER BY drug_administration_route_name";
		
		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_dose_unit(){
		
		$sql = "SELECT * FROM drug_dose_unit ORDER BY drug_dose_unit_name";
		
		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function save_drug_form($form, $varpassed_value, $varadminroute, $vardose, $vardoseunit){
		
		$sql = "UPDATE drugs 
		
		SET drug_type_id = (SELECT drug_type_id FROM drug_type WHERE drug_type_name = '$form'),
		drug_administration_route_id = (SELECT drug_administration_route_id FROM drug_administration_route WHERE drug_administration_route_name = '$varadminroute'),
		drug_dose_unit_id = (SELECT drug_dose_unit_id FROM drug_dose_unit WHERE drug_dose_unit_name = '$vardoseunit'),
		drugs_dose = $vardose
		
		WHERE drugs_id = (SELECT drugs_id FROM drugs WHERE drugs_name = '$varpassed_value')";//echo $sql;
		
		$update = new Database;
		$update->insert($sql);
	}
	
	function get_drug_times(){
		
		$sql = "SELECT * FROM drug_times ORDER BY drug_times_name";

		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	function get_drug_time($time){
		
		$sql = "SELECT * FROM drug_times where drug_times_name='$time' ORDER BY drug_times_name";
//echo $sql;
		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_drug_duration(){
		
		$sql = "SELECT * FROM drug_duration ORDER BY drug_duration_name";

		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_instructions(){
		
		$sql = "SELECT * FROM instructions ORDER BY instructions_name";

		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_warnings(){
		
		$sql = "SELECT * FROM warnings ORDER BY warnings_name";

		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_consumption(){
		
		$sql = "SELECT * FROM drug_consumption ORDER BY drug_consumption_name";

		$get = new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function send_to_pharmacy($visit_id, $page){
		
		$sql="Update visit set doc_visit='1', pharmarcy = $page WHERE visit_id ='$visit_id'";
		$save = new Database();
		$save->insert($sql);
	}
	
	function get_drug($service_charge_id){
		
		$sql = "SELECT drugs.drug_type_id, drugs.drug_size,drugs.drug_size_type,drugs.drug_administration_route_id, drugs.drugs_dose, drugs.drug_dose_unit_id FROM drugs, service_charge WHERE service_charge.service_charge_id = $service_charge_id AND service_charge.drug_id = drugs.drugs_id";
	//	echo $sql;
		$get =new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_drug_type_name($id){
		
		$sql = "SELECT drug_type_name FROM drug_type WHERE drug_type_id = $id";
		//echo $sql;
		
		$get =new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_admin_route2($id){
		
		$sql = "SELECT drug_administration_route_name FROM drug_administration_route WHERE drug_administration_route_id = $id";
		
		$get =new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
	
	function get_dose_unit2($id){
		
		$sql = "SELECT drug_dose_unit_name FROM drug_dose_unit WHERE drug_dose_unit_id = $id";
		
		$get =new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
		function select_invoice_drugs($visit_id,$service_charge_id){
		
		$sql = "SELECT sum(visit_charge_units) FROM `visit_charge` WHERE visit_id ='$visit_id' AND service_charge_id ='$service_charge_id'";
		
		$get =new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
			function select_invoice_drugs1($visit_id,$service_charge_id){
		
		$sql = "SELECT * FROM `visit_charge` WHERE visit_id ='$visit_id' AND service_charge_id ='$service_charge_id'";
		
		$get =new Database();
		$rs = $get->select($sql);
		
		return $rs;
	}
}


?>