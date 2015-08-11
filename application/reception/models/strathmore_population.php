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
			
		include_once(__DIR__.'/../../../config/database.php');
		global $db_students;

        $conn = oci_connect($db_students['username'],$db_students['password'],
        		('//' . $db_students['hostname'] . ':' . $db_students['port'] . '/' . $db_students['database']) );		
				
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
				$sql = "SELECT * FROM GAOWNER.VIEW_STUDENT_DETAILS WHERE TO_NUMBER(STUDENT_NO) = TO_NUMBER('$student_id')";
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
				
				$date = date("Y-m-d H:i:s");
				
				if(($gender == 'Male') || ($gender == 'M') || ($gender == 'MALE') || ($gender == 'male'))
				{
					$gender_id = 1;
				}
				else if(($gender == 'Female') || ($gender == 'F') || ($gender == 'FEMALE') || ($gender == 'female'))
				{
					$gender_id = 2;
				}
				else
				{
					$gender_id = 2;
				}
				
				if(!empty($STUDENT_NO))
				{
					$exists = $this->student_exists($STUDENT_NO);
					
					$data = array('patient_number'=>$this->create_patient_number(),'created_by'=>$this->session->userdata('personnel_id'),'modified_by'=>$this->session->userdata('personnel_id'),'patient_date'=>$date,'visit_type_id'=>1,'strath_no'=>$STUDENT_NO, 'title_id'=>'','patient_surname'=>$name,'patient_othernames'=>$oname,'patient_date_of_birth'=>$dob,'patient_phone1'=>$MOBILE_NO,'gender_id'=>$gender_id,'strath_no'=>$STUDENT_NO,'faculty'=>$FACULTIES,'patient_kin_sname'=>$GUARDIAN_NAME,'department'=>$COURSES);
					
					if(!$exists)
					{
						$this->db->insert('patients', $data);
						$rows_inserted = $this->db->affected_rows();				
					}					
					else
					{
						$this->db->where('strath_no', $STUDENT_NO);
						$this->db->update('patients', $data);
					}

					//  data for patients patient date, visit type, strath number created by and modified by fields
					/*if($student_id != NULL)
					{
						$data = array('patient_number'=>$this->create_patient_number(),'created_by'=>$this->session->userdata('personnel_id'),'modified_by'=>$this->session->userdata('personnel_id'),'patient_date'=>$date,'visit_type_id'=>1,'strath_no'=>$STUDENT_NO, 'title_id'=>'','patient_surname'=>$name,'patient_othernames'=>$oname,'patient_date_of_birth'=>$dob,'patient_phone1'=>$MOBILE_NO,'gender_id'=>$gender,'strath_no'=>$STUDENT_NO,'faculty'=>$FACULTIES,'patient_kin_sname'=>$GUARDIAN_NAME,'faculty'=>$FACULTIES);

						$this->db->insert('patients', $data);
						return $this->db->insert_id();
					}*/
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
	
	public function get_students_from_ams($student_id = NULL)
	{
		include_once(__DIR__.'/../../../config/database.php');
		global $db_students;

        $conn = oci_connect($db_students['username'],$db_students['password'],
        		('//' . $db_students['hostname'] . ':' . $db_students['port'] . '/' . $db_students['database']) );		
				
		if (!$conn) {
			$e = oci_error();
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			
			$data = $e['message'];
		
		}else{
			if($student_id == NULL)
			{
				$sql = "SELECT * FROM GAOWNER.VIEW_STUDENT_DETAILS";
			}
			
			else
			{
				$sql = "SELECT * FROM GAOWNER.VIEW_STUDENT_DETAILS WHERE TO_NUMBER(STUDENT_NO) = TO_NUMBER('$student_id')";
			}
		    
			$rs4 = oci_parse($conn, $sql);
	   		oci_execute($rs4);
			$rows = oci_num_rows($rs4);	
			
			$t=0;
			$data = '
				<table>
					<tr>
						<th>#</th>
						<th>Surname</th>
						<th>Other names</th>
						<th>Gender</th>
						<th>Faculty</th>
						<th>Course</th>
						<th>Phone</th>
						<th>Number</th>
						<th>DOB</th>
						<th>Guardian</th>
						<th>Email</th>
					</tr>
			';
			
			while (OCIFetch($rs4)) 
			{ 
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
				
				$data .= '
					<table>
						<tr>
							<td>'.$t.'</td>
							<td>'.$name.'</td>
							<td>'.$oname.'</td>
							<td>'.$gender.'</td>
							<td>'.$FACULTIES.'</td>
							<td>'.$COURSES.'</td>
							<td>'.$MOBILE_NO.'</td>
							<td>'.$STUDENT_NO.'</td>
							<td>'.$DOB.'</td>
							<td>'.$GUARDIAN_NAME.'</td>
							<td>'.$EMAIL.'</td>
						</tr>
				';
			}
			
			$data .= '</table>';
		}
		
		return $data;
	}

	public function get_staff_from_hr($staff_number = NULL)
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
		
		$t = 0;
		
        $rs1 = mysqli_query($connect_hr, $sql1);        	
		$rows2 = mysqli_num_rows($rs1);		
		
		if($rows2 > 0){
		
			$data = $db_hr['hostname'].' - '.$db_hr['username'].' - '.$db_hr['password'].'
				<table>
					<tr>
						<th>#</th>
						<th>Surname</th>
						<th>Other names</th>
						<th>Gender</th>
						<th>Faculty</th>
						<th>Course</th>
						<th>Phone</th>
						<th>Number</th>
						<th>DOB</th>
						<th>Guardian</th>
						<th>Email</th>
					</tr>
			';
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
				$t++;

				$other_name = $emp_firstname." ".$emp_middle_name;
				
				$data .= '
					<table>
						<tr>
							<td>'.$t.'</td>
							<td>'.$emp_lastname.'</td>
							<td>'.$other_name.'</td>
							<td>'.$emp_gender.'</td>
							<td>'.$department.'</td>
							<td>'.$emp_mobile.'</td>
							<td>'.$staff_no.'</td>
							<td>'.$emp_birthday.'</td>
							<td>'.$emp_work_email.'</td>
						</tr>
				';
			}
			$data .= '</table>';
		}		
		else
		{
			$data = $db_hr['hostname'].' - '.$db_hr['username'].' - '.$db_hr['password']." Staff could not be found";
		}
		
		return $data;
	}

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
				$date = date("Y-m-d H:i:s");
				//  insert data into the staff table
				$data = array(
					'patient_number'=>$this->create_patient_number(),
					'created_by'=>$this->session->userdata('personnel_id'),
					'modified_by'=>$this->session->userdata('personnel_id'),
					'patient_date'=>$date,'patient_surname'=>$emp_lastname,
					'patient_othernames'=>$other_name,
					'patient_date_of_birth'=>$emp_birthday,
					'patient_phone1'=>$emp_mobile,
					'gender_id'=>$emp_gender,
					'strath_no'=>$staff_no,
					'visit_type_id'=>2,
					'department'=>$department
				);
				if($exists == FALSE)
				{
					//echo 'title='.$Title.'<br/>Surname='.$Surname1.'<br/>Other_names='.$Other_Name1.'<br/>DOB='.$DOB.'<br/>contact='.$Tel_1.'<br/>gender='.$Gender.'<br/>Staff_Number='.$Employee_Code.'<br/>staff_system_id='.$E_ID;
					$this->db->insert('patients', $data);
					$patient_id = $this->db->insert_id();
					
					return $patient_id;
				}				
				else
				{
					/*$this->db->where('strath_no', $staff_no);
					$this->db->update('patients', $data);*/
					$this->session->set_userdata("error_message","Staff seems to exist");
					return FALSE;
				}
			}
		}		
		else
		{
			$this->session->set_userdata("error_message","Staff could not be found");
			return FALSE;
		}
	}
	
	public function staff_exists($Employee_Code)
	{
		$this->db->where('strath_no', $Employee_Code);
		$query = $this->db->get('patients');
		
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
		$this->db->where('strath_no', $student_number);
		$query = $this->db->get('patients');
		
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