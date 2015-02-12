<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/auth/controllers/auth.php";

class Laboratory extends auth
{	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('lab_model');
		$this->load->model('reception/reception_model');
		$this->load->model('database');
		$this->load->model('reception/reception_model');
		$this->load->model('accounts/accounts_model');
		$this->load->model('nurse/nurse_model');
	}
	
	public function index()
	{
		$this->session->unset_userdata('visit_search');
		$this->session->unset_userdata('patient_search');
		
		$where = 'visit_department.visit_id = visit.visit_id AND visit_department.department_id = 4 AND visit_department.visit_department_status = 1 AND visit.patient_id = patients.patient_id AND visit.close_card = 0 AND visit.visit_date = \''.date('Y-m-d').'\'';
		
		$table = 'visit_department, visit, patients';
		$query = $this->reception_model->get_all_ongoing_visits($table, $where, 6, 0);
		$v_data['query'] = $query;
		$v_data['page'] = 0;
		$v_data['visit'] = 4;
		$v_data['department'] = 4;
		
		$v_data['type'] = $this->reception_model->get_types();
		$v_data['doctors'] = $this->reception_model->get_doctor();
		
		$data['content'] = $this->load->view('dashboard', $v_data, TRUE);
		
		$data['title'] = 'Dashboard';
		$data['sidebar'] = 'lab_sidebar';
		$this->load->view('auth/template_sidebar', $data);
	}
	public function lab_queue($page_name = 12)
	{
		// this is it
		$where = 'visit_department.visit_id = visit.visit_id AND visit_department.department_id = 4 AND visit_department.visit_department_status = 1 AND visit.patient_id = patients.patient_id AND visit.close_card = 0 AND visit.visit_date = \''.date('Y-m-d').'\'';
		$table = 'visit_department, visit, patients';
		$visit_search = $this->session->userdata('patient_visit_search');
		
		if(!empty($visit_search))
		{
			$where .= $visit_search;
		}
		$segment = 4;
		
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/laboratory/lab_queue/'.$page_name;
		$config['total_rows'] = $this->reception_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->reception_model->get_all_ongoing_visits($table, $where, $config["per_page"], $page, 'ASC');
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		
		$data['title'] = 'Lab Queue';
		$v_data['title'] = 'Lab Queue';
		$v_data['module'] = 0;
		
		$v_data['type'] = $this->reception_model->get_types();
		$v_data['doctors'] = $this->reception_model->get_doctor();
		
		$data['content'] = $this->load->view('lab_queue', $v_data, true);
		
		
		$data['sidebar'] = 'lab_sidebar';
		
		
		$this->load->view('auth/template_sidebar', $data);
		// end of it
	}
	public function queue_cheker($page_name = NULL)
	{
		$where = 'visit_department.visit_id = visit.visit_id AND visit_department.department_id = 4 AND visit_department.visit_department_status = 1 AND visit.patient_id = patients.patient_id AND visit.close_card = 0 AND visit.visit_date = \''.date('Y-m-d').'\'';
		$table = 'visit_department, visit, patients';
		$items = "*";
		$order = "visit.visit_id";

		$result = $this->database->select_entries_where($table, $where, $items, $order);
		
		if(count($result) > 0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

	}
	public function test($visit_id){
		$patient = $this->reception_model->patient_names2(NULL, $visit_id);
		$visit_type = $patient['visit_type'];
		$patient_type = $patient['patient_type'];
		$patient_othernames = $patient['patient_othernames'];
		$patient_surname = $patient['patient_surname'];
		$patient_date_of_birth = $patient['patient_date_of_birth'];
		$age = $this->reception_model->calculate_age($patient_date_of_birth);
		$gender = $patient['gender'];
		
		$patient = 'Surname: <span style="font-weight: normal;">'.$patient_surname.'</span> Othernames: <span style="font-weight: normal;">'.$patient_othernames.'</span> Age: <span style="font-weight: normal;">'.$age.'</span> Gender: <span style="font-weight: normal;">'.$gender.'</span> Patient Type: <span style="font-weight: normal;">'.$visit_type.'</span>';
		
		$v_data = array('visit_id'=>$visit_id,'visit'=>1,'patient'=>$patient);
		$data['content'] = $this->load->view('tests/test', $v_data, true);
		$data['sidebar'] = 'lab_sidebar';
		$data['title'] = 'Laboratory Test List';
		$this->load->view('auth/template_sidebar', $data);
	}
	public function search_laboratory_tests($visit_id)
	{
		$this->form_validation->set_rules('search_item', 'Search', 'trim|required|xss_clean');
		
		//if form conatins invalid data
		if ($this->form_validation->run())
		{
			$search = ' AND lab_test_name LIKE \'%'.$this->input->post('search_item').'%\'';
			$this->session->set_userdata('lab_test_search', $search);
		}
		
		$this->laboratory_list(0,$visit_id);
	}
	
	public function close_lab_test_search($visit_id)
	{
		$this->session->unset_userdata('lab_test_search');
		$this->laboratory_list(0,$visit_id);
	}
	public function test1($visit_id)
	{
		$data = array('visit_id'=>$visit_id);
		$this->load->view('tests/test1',$data);
	}
	public function test2($visit_id)
	{
		$data = array('visit_id'=>$visit_id);
		$this->load->view('tests/test2',$data);
	}
	public function laboratory_list($lab,$visit_id){

		//check patient visit type
		$rs = $this->nurse_model->check_visit_type($visit_id);
		if(count($rs)>0){
		  foreach ($rs as $rs1) {
			# code...
			  $visit_t = $rs1->visit_type;
		  }
		}

		if ($lab ==2){
			$this->session->set_userdata('nurse_lab',$lab);
		}
		else {
			$this->session->set_userdata('nurse_lab',NULL);
		}

		
		$order = 'service_charge_name';
		
		$where = 'service_charge.service_charge_name = lab_test.lab_test_name
		AND lab_test_class.lab_test_class_id = lab_test.lab_test_class_id  AND service_charge.service_id = 5  AND  service_charge.visit_type_id = '.$visit_t;
		$test_search = $this->session->userdata('lab_test_search');
		
		if(!empty($test_search))
		{
			$where .= $test_search;
		}
		
		$table = '`service_charge`, lab_test_class, lab_test';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/laboratory/laboratory_list/'.$lab.'/'.$visit_id;
		$config['total_rows'] = $this->reception_model->count_items($table, $where);
		$config['uri_segment'] = 5;
		$config['per_page'] = 15;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->lab_model->get_lab_tests($table, $where, $config["per_page"], $page, $order);
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		
		$data['title'] = 'Laboratory Test List';
		$v_data['title'] = 'Laboratory Test List';
		
		$v_data['visit_id'] = $visit_id;
		$data['content'] = $this->load->view('laboratory_list', $v_data, true);
		
		$data['title'] = 'Laboratory Test List';
		$this->load->view('auth/template_no_sidebar', $data);	

	}

	public function delete_cost($visit_charge_id, $visit_id)
	{
		$this->lab_model->delete_cost($visit_charge_id);
		
		//$this->laboratory_list(0, $visit_id);
		$this->test_lab($visit_id);
	}

	public function test_lab($visit_id, $service_charge_id=NULL){
		$data = array('service_charge_id' => $service_charge_id, 'visit_id' => $visit_id);
		$this->load->view('test_lab', $data);
	}

	public function save_result($id,$result,$visit_id)
	{
		$result = str_replace('%20', ' ',$result);
		$data = array('id'=>$id,'result'=>$result,'visit_id'=>$visit_id);
		$this->load->view('save_result',$data);

	}
	public function finish_lab_test($visit_id){
		redirect('laboratory/lab_queue');
	}

	public function save_comment($comment,$id){
		$comment = str_replace('%20', ' ',$comment);
		$this->lab_model->save_comment($comment, $id);
	}

	public function send_to_doctor($visit_id)
	{
		if($this->reception_model->set_visit_department($visit_id, 2))
		{
			redirect('laboratory/lab_queue');
		}
		else
		{
			FALSE;
		}
	}
	public function send_to_accounts($visit_id,$module= NULL)
	{
		redirect("nurse/send_to_accounts/".$visit_id."/2");
	}
	public function test_history($visit_id,$page_name = NULL)
	{
		// this is it
		$where = 'visit.patient_id = patients.patient_id AND visit.patient_id = (SELECT patient_id FROM visit WHERE visit.visit_id = visit_department.visit_id ) AND visit_department.department_id = 4 AND visit_department.visit_id != '.$visit_id.'  AND visit.visit_id = '.$visit_id.' ';
		$visit_search = $this->session->userdata('visit_search');
		
		if(!empty($visit_search))
		{
			$where .= $visit_search;
		}
		
		if($page_name == NULL)
		{
			$segment = 3;
		}
		
		else
		{
			$segment = 4;
		}
		$table = 'visit_department,visit, patients';
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/laboratory/test_history/'.$page_name;
		$config['total_rows'] = $this->reception_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->lab_model->get_all_ongoing_visits($table, $where, $config["per_page"], $page, 'ASC');
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		
		$data['title'] = 'Test History';
		$v_data['title'] = 'Test History';
		$v_data['module'] = 0;
		
		$v_data['type'] = $this->reception_model->get_types();
		$v_data['doctors'] = $this->reception_model->get_doctor();
		
		$data['content'] = $this->load->view('test_history', $v_data, true);
		
		
		$data['sidebar'] = 'lab_sidebar';
		
		
		$this->load->view('auth/template_sidebar', $data);
		// end of it

	}

	function print_test($visit_id, $patient_id)
	{
		$this->load->library('fpdf');
		$this->fpdf->AliasNbPages();
		$this->fpdf->AddPage();
		$this->fpdf->setFont('Times', '', 10);
		$this->fpdf->SetFillColor(190, 186, 211);
		
		$lab_rs = $this->lab_model->get_lab_visit($visit_id);
		$num_lab_visit = count($lab_rs);

		$rs2 = $this->lab_model->get_comment($visit_id);
		$num_rows2 = count($rs2);

		if($num_rows2 > 0){
			foreach ($rs2 as $key2):
				$comment = $key2->lab_visit_comment;
				$visit_date = $key2->visit_date;
				$this->session->set_userdata('visit_date',$visit_date);
			endforeach;
			
		}

		$s = 0;
		
		$patient = $this->reception_model->patient_names2(NULL, $visit_id);
		$visit_type = $patient['visit_type'];
		$patient_type = $patient['patient_type'];
		$patient_othernames = $patient['patient_othernames'];
		$patient_surname = $patient['patient_surname'];
		$patient_date_of_birth = $patient['patient_date_of_birth'];
		$patient_number = $patient['patient_number'];
		$age = $this->reception_model->calculate_age($patient_date_of_birth);
		$gender = $patient['gender'];
		
		$lineBreak = 10;
		
		//Colors of frames, background and Text
		$this->fpdf->SetDrawColor(41, 22, 111);
		$this->fpdf->SetFillColor(190, 186, 211);
		$this->fpdf->SetTextColor(41, 22, 111);

		//thickness of frame (mm)
		//$this->fpdf->SetLineWidth(1);
		//Logo
		$this->fpdf->Image(base_url().'img/createslogo.jpg',20,0,140);
		//font
		$this->fpdf->SetFont('Arial', 'B', 12);
		//title

		$this->fpdf->Ln(25);
		$this->fpdf->Cell(0,5, 'DIAGNOSTIC LABORATORY SERVICES', 0, 1, 'C');
		$this->fpdf->Cell(0, 5, 'Laboratory Report Form', 0, 1, 'C');
		$this->fpdf->Cell(0, 5, 'Date: '.$visit_date, '0', 1, 'C');

		$this->fpdf->Cell(100,5,'Name:	'.$patient_surname." ".$patient_othernames, 0, 0, 'L');
		$this->fpdf->Cell(50,5,'Age:'.$age, 0, 0, 'L');
		
		$this->session->set_userdata('patient_sex',$gender);
		$this->fpdf->Cell(50,5,'Sex:'.$gender, 0, 1, 'L');
		//$this->fpdf->Cell(-30);//move left
		$this->fpdf->Cell(0,7,'Clinic Number:'.$patient_number, 'B', 1, 'L');
		//line break
		$pageH = 7;
		$this->fpdf->SetTextColor(0, 0, 0);
		$this->fpdf->SetDrawColor(0, 0, 0);
		$this->fpdf->SetFont('Times','B',10);
			
		$this->fpdf->SetDrawColor(41, 22, 111);
		$personnel_id = $this->session->userdata('personnel_id');
	
		$rs2 = $this->lab_model->get_lab_personnel($personnel_id);
		$num_rows = count($rs2);

		if($num_rows > 0){
			foreach($rs2 as $key):
				$personnel = $key->personnel_surname;
				$personnel = $personnel." ".$key->personnel_fname;
			endforeach;
			
		}
		
		else{
			$personnel = "";
		}

		//HEADER
		$billTotal = 0;
		$linespacing = 2;
		$majorSpacing = 7;
		$pageH = 5;
		$counter = 0;
		 $next_name ="";  $test_format=""; $lab_test_name=""; $fill="";
		if($num_lab_visit > 0){
			foreach ($lab_rs as $key_lab){
				$visit_charge_id = $key_lab->visit_charge_id;
				
				$rsy2 = $this->lab_model->get_test_comment($visit_charge_id);
				$num_rowsy2 = count($rsy2);
				
				if($num_rowsy2 >0){
					$comment4= $rsy2[0]->lab_visit_format_comments;
				}
				else {
				
					$comment4="";	
				}
				$format_rs = $this->lab_model->get_lab_visit_result($visit_charge_id);
				$num_format = count($format_rs);
				
				if($num_format > 0){
					$rs = $this->lab_model->get_test($visit_charge_id);
					$num_lab = count($rs);
				}
				
				else{
					$rs = $this->lab_model->get_m_test($visit_charge_id);
					$num_lab = count($rs);
				}
				
				if($num_lab > 0){
					$counts =0;
					foreach ($rs as $key_what){
						$counts++;
						$lab_test_name = $key_what->lab_test_name;
						$lab_test_class_name = $key_what->lab_test_class_name;
						$lab_test_units = $key_what->lab_test_units;
						$lab_test_lower_limit = $key_what->lab_test_malelowerlimit;
						$lab_test_upper_limit = $key_what->lab_test_malelupperlimit;
						$lab_test_lower_limit1 = $key_what->lab_test_femalelowerlimit;
						$lab_test_upper_limit1 = $key_what->lab_test_femaleupperlimit;
						$visit_charge_id = $key_what->lab_visit_id;
						$lab_results = $key_what->lab_visit_result;
						
						//results for formats
						if($this->session->userdata('test') ==0){
						
							$test_format = $key_what->lab_test_formatname;
							$lab_test_format_id = $key_what->lab_test_format_id;
							$lab_results = $key_what->lab_visit_results_result;
							$lab_test_units = $key_what->lab_test_format_units;
							$lab_test_lower_limit = $key_what->lab_test_format_malelowerlimit;
							$lab_test_upper_limit = $key_what->lab_test_format_maleupperlimit;
							$lab_test_lower_limit1 = $key_what->lab_test_format_femalelowerlimit;
							$lab_test_upper_limit1 = $key_what->lab_test_format_femaleupperlimit;
						}
						
						//if there are no formats
						else{
							$test_format ="-";
						}
						
						if(($counter % 2) == 0){
							$fill = TRUE;
						}
						
						else{
							$fill = FALSE;
						}
						
						if ($counts < ($num_lab-1)){
							$next_name = $rs[$counts]->lab_test_name;
						}
						
						if(($lab_test_name <> $next_name) || ($counts == 1))
						{
							$this->fpdf->Ln(5);
							
							$this->fpdf->SetFont('Times', 'B', 10);
							$this->fpdf->Cell(50,$pageH,"TEST: ".$lab_test_name, 'B',1,'L', FALSE);
							$this->fpdf->Cell(50,$pageH,"CLASS: ".$lab_test_class_name, 'B',1,'L', FALSE);
							
							$this->fpdf->Ln(2);
							
							$this->fpdf->Cell(50,$pageH,"Sub Test", 1,0,'L', FALSE);
							$this->fpdf->Cell(50,$pageH,"Results",1,0,'L', FALSE);
							$this->fpdf->Cell(50,$pageH,"Units",1,0,'L', FALSE);
							$this->fpdf->Cell(30,$pageH,"Normal Limits",1,1,'L', FALSE);
							$this->fpdf->SetFont('Times', '', 10);
						}
						
						$this->fpdf->Cell(50,$pageH,$test_format, 1,0,'L', $fill);
						$this->fpdf->Cell(50,$pageH,$lab_results,1,0,'L', $fill);
						$this->fpdf->Cell(50,$pageH,$lab_test_units,1,0,'L', $fill);
						
						if($this->session->userdata('patient_sex') == "Male"){
							$this->fpdf->Cell(30,$pageH,$lab_test_lower_limit." - ".$lab_test_upper_limit,1,1,'L', $fill);
						}
						
						else{
							$this->fpdf->Cell(30,$pageH,$lab_test_lower_limit1." - ".$lab_test_upper_limit1,1,1,'L', $fill);
						}
						$counter++;
					}
			
				if($test_format !="-"){ 
					$this->fpdf->Ln(3);
					$this->fpdf->SetFont('Times', 'B', 10);
					$this->fpdf->Cell(0,10,"".$lab_test_name ."  Comment ",'B',1,'L', $fill);
					$this->fpdf->SetFont('Times', '', 10);
					$this->fpdf->Cell(0,10,$comment4,0,1,'L', $fill=true);
				
				}	
			}}
				
				if(($counter % 2) == 0){
					$fill = TRUE;
				}
				
				else{
					$fill = FALSE;
				}
				
				$this->fpdf->Ln(5);
				$this->fpdf->SetFont('Times', 'B', 10);
				$this->fpdf->Cell(0,10,"Comments ",'B',1,'L', $fill);
				$this->fpdf->SetFont('Times', '', 10);
				$this->fpdf->Cell(0,10,$comment,0,1,'L', $fill);
		}
		$this->fpdf->Output();

	}
	
	public function save_result_lab()
	{
		$visit_id = $this->input->post('visit_id');
		$this->lab_model->save_tests_format2($visit_id);
	}
	
	public function save_lab_comment()
	{
		$visit_charge_id = $this->input->post('visit_charge_id');
		$query = $this->lab_model->get_lab_comments($visit_charge_id);
		$num_rows = $query->num_rows();
		
		
		if ($num_rows == 0)
		{
			$this->lab_model->save_new_lab_comment();
		}
			
		else
		{
			$this->lab_model->update_existing_lab_comment($visit_charge_id);
		} 
	}
	public function search_visit_patients($module = NULL)
	{
		$visit_type_id = $this->input->post('visit_type_id');
		$strath_no = $this->input->post('strath_no');
		
		if(!empty($visit_type_id))
		{
			$visit_type_id = ' AND patients.visit_type_id = '.$visit_type_id.' ';
		}
		
		if(!empty($strath_no))
		{
			$strath_no = ' AND patients.strath_no LIKE '.$strath_no.' ';
		}
		
		//search surname
		if(!empty($_POST['surname']))
		{
			$surnames = explode(" ",$_POST['surname']);
			$total = count($surnames);
			
			$count = 1;
			$surname = ' AND (';
			for($r = 0; $r < $total; $r++)
			{
				if($count == $total)
				{
					$surname .= ' patients.patient_surname LIKE \'%'.mysql_real_escape_string($surnames[$r]).'%\'';
				}
				
				else
				{
					$surname .= ' patients.patient_surname LIKE \'%'.mysql_real_escape_string($surnames[$r]).'%\' AND ';
				}
				$count++;
			}
			$surname .= ') ';
		}
		
		else
		{
			$surname = '';
		}
		
		//search other_names
		if(!empty($_POST['othernames']))
		{
			$other_names = explode(" ",$_POST['othernames']);
			$total = count($other_names);
			
			$count = 1;
			$other_name = ' AND (';
			for($r = 0; $r < $total; $r++)
			{
				if($count == $total)
				{
					$other_name .= ' patients.patient_othernames LIKE \'%'.mysql_real_escape_string($other_names[$r]).'%\'';
				}
				
				else
				{
					$other_name .= ' patients.patient_othernames LIKE \'%'.mysql_real_escape_string($other_names[$r]).'%\' AND ';
				}
				$count++;
			}
			$other_name .= ') ';
		}
		
		else
		{
			$other_name = '';
		}
		
		$search = $visit_type_id.$strath_no.$surname.$other_name;
		$this->session->set_userdata('patient_visit_search', $search);
		
		$this->lab_queue();
		
		
	}
	public function close_queue_search()
	{
		$this->session->unset_userdata('patient_visit_search');
		$this->lab_queue();
	}
}
?>