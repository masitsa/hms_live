<?php

class Strathmore_population extends CI_Model 
{
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/

	public function get_ams_student($student_id = NULL){

        $conn = oci_connect($db['students']['username'],$db['students']['password'],
        		('//' . $db['students']['hostname'] . ':' . $db['students']['port'] . '/' . $db['students']['database']) );
				
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		
		}else{
			if($student_id == NULL)
			{
				$sql = "SELECT * FROM GAOWNER.VIEW_STUDENT_DETAILS";
			}
			
			else
			{
				$sql = "SELECT * FROM GAOWNER.VIEW_STUDENT_DETAILS WHERE STUDENT_NO='$student_id'";
			}
		
			$rs4 = oci_parse($conn, $sql);
	   		oci_execute($rs4);
			$rows = oci_num_rows($rs4);	
		
			$t=0;
			
			while (OCIFetch($rs4)) {
				$t++;
				$name1=ociresult($rs4, "SURNAME");
				$dob=ociresult($rs4, "DOB");
				$gender=ociresult($rs4, "GENDER");		
				$oname1=ociresult($rs4, "OTHER_NAMES");
				$STUDENT_NO=ociresult($rs4, "STUDENT_NO");
				$COURSES=ociresult($rs4, "COURSES");
				$GUARDIAN_NAME1=ociresult($rs4, "GUARDIAN_NAME");
				$MOBILE_NO=ociresult($rs4, "MOBILE_NO");
				$EMAIL=ociresult($rs4, "EMAIL");
				$FACULTIES=ociresult($rs4, "FACULTIES");

				//  details to be saved 

				$name=str_replace("'", "", "$name1");
				$oname=str_replace("'", "", "$oname1");
				$GUARDIAN_NAME=str_replace("'", "", "$GUARDIAN_NAME1");

				if(!empty($STUDENT_NO))
				{
					$exists = $this->student_exists($STUDENT_NO);
					
					$data = array('title'=>'','Surname'=>$name,'Other_names'=>$oname,'DOB'=>$dob,'contact'=>$MOBILE_NO,'gender'=>$gender,'student_Number'=>$STUDENT_NO,'courses'=>$FACULTIES,'GUARDIAN_NAME'=>$GUARDIAN_NAME,'faculty'=>$FACULTIES);
					
					if(!$exists)
					{
						$this->db->insert('student', $data);
					}
					
					else
					{
						$this->db->where('student_Number', $STUDENT_NO);
						$this->db->update('student', $data);
					}
				
					$date = date("Y-m-d H:i:s");

					//  data for patients patient date, visit type, strath number created by and modified by fields
					
					if($student_id != NULL)
					{
						$patient_data = array('patient_number'=>$this->create_patient_number(),'patient_date'=>$date,'visit_type_id'=>1,'strath_no'=>$STUDENT_NO,'created_by'=>$this->session->userdata('personnel_id'),'modified_by'=>$this->session->userdata('personnel_id'));

						$this->db->insert('patients', $patient_data);
						return $this->db->insert_id();
					}
				}
				else{
					$this->session->set_userdata("error_message","Student could not be found");
					return FALSE;
				}
			}
				
			if($student_id != NULL)
			{
				return TRUE;
			}
		}
	}
	// public function get_hr_staff($staff_number = NULL)
	// {	
	// 	//connect to database
 //        $connect = mysql_connect("192.168.170.16", "medical", "Med_centre890")
 //                    or die("Unable to connect to MySQL".mysql_error());
 //        //selecting a database
 //        mysql_select_db("hr", $connect)
 //                    or die("Could not select database".mysql_error());
		
	// 	if($staff_number != NULL)
	// 	{
	// 		$sql1 = "select `employee`.`Employee_ID` AS `E_ID`, `employee`.`Employee_Code` AS `Employee_Code`,`employee`.`ID_No` AS `ID_No`,`employee`.`Title` AS `Title`,`employee`.`Surname` AS `Surname`,`employee`.`Other_Name` AS `Other_Name`,`employee`.`Gender` AS `Gender`,`employee`.`DOB` AS `DOB`,`employee`.`Nationality` AS `Nationality`,`employee`.`Marital_Status` AS `Marital_Status`,`dept`.`Dept` AS `Dept`,`emp_post`.`Post` AS `Post`,`contact`.`Tel_1` AS `Tel_1`,`contact`.`Address_2` AS `Address_2`,`contact`.`Postal_Code` AS `Postal_Code`,`contact`.`Email` AS `Email`,`contact`.`City` AS `City` from (((`employee` join `emp_post` on((`employee`.`Employee_ID` = `emp_post`.`Employee_ID`))) join `contact` on((`employee`.`Contact_ID` = `contact`.`Contact_ID`))) join `dept` on((`employee`.`Dept_ID` = `dept`.`Dept_ID`))) where `employee`.`Employee_Code`='$staff_number'";
	// 	}
		
	// 	else
	// 	{
	// 		$sql1 = "select `employee`.`Employee_ID` AS `E_ID`, `employee`.`Employee_Code` AS `Employee_Code`,`employee`.`ID_No` AS `ID_No`,`employee`.`Title` AS `Title`,`employee`.`Surname` AS `Surname`,`employee`.`Other_Name` AS `Other_Name`,`employee`.`Gender` AS `Gender`,`employee`.`DOB` AS `DOB`,`employee`.`Nationality` AS `Nationality`,`employee`.`Marital_Status` AS `Marital_Status`,`dept`.`Dept` AS `Dept`,`emp_post`.`Post` AS `Post`,`contact`.`Tel_1` AS `Tel_1`,`contact`.`Address_2` AS `Address_2`,`contact`.`Postal_Code` AS `Postal_Code`,`contact`.`Email` AS `Email`,`contact`.`City` AS `City` from (((`employee` join `emp_post` on((`employee`.`Employee_ID` = `emp_post`.`Employee_ID`))) join `contact` on((`employee`.`Contact_ID` = `contact`.`Contact_ID`))) join `dept` on((`employee`.`Dept_ID` = `dept`.`Dept_ID`)))";
	// 	}
				
 //        $rs1 = mysql_query($sql1)
 //        	or die ("unable to Select ".mysql_error());
	// 	$rows2 = mysql_num_rows($rs1);
	// 	if($rows2 > 0){
	// 		for($a=0; $a< $rows2; $a++){
	// 		    $E_ID=mysql_result($rs1, $a,'E_ID');
	// 			$Employee_Code=mysql_result($rs1, $a,'Employee_Code');
	// 			$ID_No=mysql_result($rs1, $a,'ID_No');
	// 			$DOB=mysql_result($rs1, $a,'DOB');
	// 			$Surname1=mysql_result($rs1, $a,'Surname');
	// 			$Other_Name1=mysql_result($rs1, $a,'Other_Name');
	// 			$Nationality=mysql_result($rs1, $a,'Nationality');
	// 			$Marital_Status=mysql_result($rs1, $a,'Marital_Status');
	// 			$Email=mysql_result($rs1, $a,'Email');
	// 			$Gender=mysql_result($rs1, $a,'Gender');	
	// 			$Title=mysql_result($rs1, $a,'Title');	
	// 			$Tel_1=mysql_result($rs1, $a,'Tel_1');
	// 			$Dept=mysql_result($rs1, $a,'Dept');
				
	// 			$exists = $this->staff_exists($Employee_Code);
				
	// 			//  insert data into the staff table
	// 			$data = array('title'=>$Title,'Surname'=>$Surname1,'Other_names'=>$Other_Name1,'DOB'=>$DOB,'contact'=>$Tel_1,'gender'=>$Gender,'Staff_Number'=>$Employee_Code,'staff_system_id'=>$E_ID,'department'=>$Dept);
	// 			if(!$exists)
	// 			{
	// 				//echo 'title='.$Title.'<br/>Surname='.$Surname1.'<br/>Other_names='.$Other_Name1.'<br/>DOB='.$DOB.'<br/>contact='.$Tel_1.'<br/>gender='.$Gender.'<br/>Staff_Number='.$Employee_Code.'<br/>staff_system_id='.$E_ID;
	// 				$this->db->insert('staff', $data);
	// 			}
				
	// 			else
	// 			{
	// 				$this->db->where('Staff_Number', $Employee_Code);
	// 				$this->db->update('staff', $data);
	// 			}
	// 		}
	// 		return TRUE;
	// 	}
		
	// 	else
	// 	{
	// 		$this->session->set_userdata("error_message","Staff could not be found");
	// 		return FALSE;
	// 	}
	// }

	public function get_hr_staff($staff_number = NULL)
	{
		include_once(__DIR__.'/../../../config/database.php');
		global $db_hr;
		
		//connect to database
        $connect_hr = mysqli_connect($db_hr['hostname'], $db_hr['username'], $db_hr['password'])
                    or die("Unable to connect to MySQL".mysql_error());

        //selecting a database
        mysqli_select_db($connect_hr, $db_hr['database'])
                    or die("Could not select database".mysql_error());
		
		if($staff_number != NULL)
		{
			
			 $sql1 = "select 
						`emp_no` AS `staff_system_id`,
						`employee_id` AS `staff_no`,
						`emp_lastname` AS `emp_lastname`,
						`emp_firstname` AS `emp_firstname`,
						`emp_middle_name` AS `emp_middle_name`,
						`emp_birthday` AS `emp_birthday`,
						`emp_gender` AS `emp_gender`,
						`emp_marital_status` AS `marital_status`,
						`emp_mobile` AS `emp_mobile`,
						`dept`	 AS `department`,
						`emp_nationality` AS `nationality`,
						`emp_work_email` AS `emp_work_email`
					from  vw_payroll_details
					where employee_id = '$staff_number' 
					ORDER BY emp_no ASC";
		}
		
		else
		{
			$sql1 = "select 
						`emp_no` AS `staff_system_id`,
						`employee_id` AS `staff_no`,
						`emp_lastname` AS `emp_lastname`,
						`emp_firstname` AS `emp_firstname`,
						`emp_middle_name` AS `emp_middle_name`,
						`emp_birthday` AS `emp_birthday`,
						`emp_gender` AS `emp_gender`,
						`emp_marital_status` AS `marital_status`,
						`emp_mobile` AS `emp_mobile`,
						`dept` AS `department`,
						`emp_nationality` AS `nationality`,
						`emp_work_email` AS `emp_work_email`
					from  vw_payroll_details
					where 1=1  
					ORDER BY emp_no ASC";
		}
		
        $rs1 = mysqli_query($connect_hr, $sql1);        	
		$rows2 = mysqli_num_rows($rs1);		
		
		if($rows2 > 0){
			while ($row = mysqli_fetch_assoc($rs1)) {	 
	       		$staff_system_id = $row['staff_system_id'];
				$staff_no = $row['staff_no'];
				$emp_lastname = $row['emp_lastname'];
				$emp_firstname = $row['emp_firstname'];
				$emp_middle_name = $row['emp_middle_name'];
				$emp_birthday = $row['emp_birthday'];
				$emp_gender = $row['emp_gender'];
				$marital_status = $row['marital_status'];
				$emp_mobile = $row['emp_mobile'];
				$department = $row['department'];
				$nationality = $row['nationality'];	
				$emp_work_email = $row['emp_work_email'];

				$other_name = $emp_firstname." ".$emp_middle_name;
				
				if($emp_gender == 1)
				{
					$gender = 'M';
				}
				else if($emp_gender == 2)
				{
					$gender = 'F';
				}
				else
				{
					$gender = '';
				}
				$exists = $this->staff_exists($staff_no);
				
				//  insert data into the staff table
				$data = array('Surname'=>$emp_lastname,'Other_names'=>$other_name,'DOB'=>$emp_birthday,'contact'=>$emp_mobile,'gender'=>$gender,'Staff_Number'=>$staff_no,'staff_system_id'=>$staff_system_id,'department'=>$department);
				if($exists == FALSE)
				{
					//echo 'title='.$Title.'<br/>Surname='.$Surname1.'<br/>Other_names='.$Other_Name1.'<br/>DOB='.$DOB.'<br/>contact='.$Tel_1.'<br/>gender='.$Gender.'<br/>Staff_Number='.$Employee_Code.'<br/>staff_system_id='.$E_ID;
					$this->db->insert('staff', $data);
				}				
				else
				{
					$this->db->where('Staff_Number', $staff_no);
					$this->db->update('staff', $data);
					//$this->session->set_userdata("error_message","Staff seems to exist");
				}
			}
			return TRUE;
		}		
		else
		{
			$this->session->set_userdata("error_message","Staff could not be found");
			return FALSE;
		}
	}
	
	public function staff_exists($Employee_Code)
	{
		$this->db->where('Staff_Number', $Employee_Code);
		$query = $this->db->get('staff');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function student_exists($student_number)
	{
		$this->db->where('student_Number', $student_number);
		$query = $this->db->get('student');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	public function create_patient_number()
	{
		//select product code
		$this->db->from('patients');
		$this->db->select('MAX(patient_number) AS number');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$number++;//go to the next number

			if($number == 1){
				$number = "SUMC/000001";
			}

			
			if($number == 1)
			{
				$number = "SUMC/000001";
			}
			
		}
		else{//start generating receipt numbers
			$number = "SUMC/000001";
		}

		return $number;
	}
	
	public function update_patient_numbers()
	{
		/*$data['patient_number'] = '';
		$this->db->update('patients', $data);*/
			
		$query = $this->db->get('patients');
		
		$result = $query->result();
		
		foreach($result as $res)
		{
			$patient_id = $res->patient_id;
			
			$data['patient_number'] = $this->create_patient_number();


			$this->db->where('patient_id', $patient_id);
			$this->db->update('patients', $data);
		}
		
		return TRUE;
	}
}

?>
