<!-- search -->
<?php echo $this->load->view('patients/search/staff_search', '', TRUE);?>
<!-- end search -->

<div class="row">
    <div class="col-md-12">

      <!-- Widget -->
      <div class="widget boxed">
        <!-- Widget head -->
        <div class="widget-head">
          <h4 class="pull-left"><i class="icon-reorder"></i><?php echo $title;?></h4>
          <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="icon-remove"></i></a>
          </div>
          <div class="clearfix"></div>
        </div>             

        <!-- Widget content -->
        <div class="widget-content">
          <div class="padd">
<?php
		$error = $this->session->userdata('error_message');
		$success = $this->session->userdata('success_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger">'.$error.'</div>';
			$this->session->unset_userdata('error_message');
		}
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success">'.$success.'</div>';
			$this->session->unset_userdata('success_message');
		}
				
		$search = $this->session->userdata('patient_staff_search');
		
		if(!empty($search))
		{
			echo '<a href="'.site_url().'/reception/close_patient_search/2" class="btn btn-warning">Close Search</a>';
		}
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
				<table class="table table-hover table-bordered ">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Staff Number</th>
					  <th>Surname</th>
					  <th>Other Names</th>
					  <th>Phone number</th>
					 <!-- <th>Date Created</th> -->
					  <th>Last Visit</th>
					  <th>Balance</th>
					  <th colspan="5">Actions</th>
					</tr>
				  </thead>
				  <tbody>';
			
			$personnel_query = $this->personnel_model->get_all_personnel();
			
			foreach ($query->result() as $row)
			{
				$patient_id = $row->patient_id;
				$strath_no = $row->strath_no;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$deleted_by = $row->deleted_by;
				$visit_type_id = $row->visit_type_id;
				$created = $row->patient_date;
				$last_modified = $row->last_modified;
				$last_visit = $row->last_visit;
				$patient_phone1 = $row->patient_phone1;
				$patient_othernames = $row->patient_othernames;
				$patient_surname = $row->patient_surname;
				$patient_type_id = $row->visit_type_id;

				$account_balance = $this->administration_model->patient_account_balance($patient_id);
				
				if($last_visit != NULL)
				{
					$last_visit = date('jS M Y',strtotime($last_visit));
				}
				
				else
				{
					$last_visit = '';
				}
				
				//creators and editors
				if($personnel_query->num_rows() > 0)
				{
					$personnel_result = $personnel_query->result();
					
					foreach($personnel_result as $adm)
					{
						$personnel_id = $adm->personnel_id;
						
						if($personnel_id == $created_by)
						{
							$created_by = $adm->personnel_fname;
						}
						
						if($personnel_id == $modified_by)
						{
							$modified_by = $adm->personnel_fname;
						}
						
						if($personnel_id == $modified_by)
						{
							$modified_by = $adm->personnel_fname;
						}
						
						if($personnel_id == $deleted_by)
						{
							$deleted_by = $adm->personnel_fname;
						}
					}
				}
				
				else
				{
					$created_by = '-';
					$modified_by = '-';
					$deleted_by = '-';
				}
				$dependats = $this->reception_model->get_dependant_patient($strath_no);
				$count++;
				
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$strath_no.'</td>
						<td>'.$patient_surname.'</td>
						<td>'.$patient_othernames.'</td>
						<td>'.$patient_phone1.'</td>
						<!--<td>'.date('jS M Y H:i a',strtotime($created)).'</td>-->
						<td>'.$last_visit.'</td>
						<td>  '.number_format($account_balance,0).'</td>
						<td><a href="'.site_url().'/reception/set_visit/'.$patient_id.'" class="btn btn-sm btn-success">Visit</a></td>
						<td><a href="'.site_url().'/reception/edit_staff/'.$patient_id.'" class="btn btn-sm btn-warning">Edit </a></td>
						<td>
							<a id="open_visit'.$patient_id.'" class="btn btn-sm btn-default" onclick="get_visit_trail('.$patient_id.');">Dependants</a>
							<a  class="btn btn-sm btn-danger" id="close_visit'.$patient_id.'" style="display:none;" onclick="close_visit_trail('.$patient_id.');">Close Dependants</a>
						</td>
						
						<td><a href="'.site_url().'/administration/individual_statement/'.$patient_id.'/2" class="btn btn-sm btn-danger" target="_blank"> Statement</a></td>
						<td><a href="'.site_url().'/reception/to-others/'.$patient_id.'/2" class="btn btn-sm btn-primary">Change patient type</a></td>
					</tr> 
				';
				$result .=
						'<tr id="visit_trail'.$patient_id.'" style="display:none;">
							<td colspan="12">';
								$result .= 
								'
								<table class="table table-hover table-bordered ">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Staff Number</th>
									  <th>Surname</th>
									  <th>Other Names</th>
									  <th>Last Visit</th>
									  <th>Balance</th>
									  <th colspan="5">Actions</th>
									</tr>
								  </thead>
								  <tbody>';
								if($dependats->num_rows() > 0){
									$counter = 0;
									foreach ($dependats->result() as $row2)
									{
										$patient_id2 = $row2->patient_id;
										$dependant_id2 = $row2->dependant_id;
										$strath_no2 = $row2->strath_no;
										$created_by2 = $row2->created_by;
										$modified_by2 = $row2->modified_by;
										$deleted_by2 = $row2->deleted_by;
										$visit_type_id2 = $row2->visit_type_id;
										$created2 = $row2->patient_date;
										$last_modified2 = $row2->last_modified;
										$last_visit2 = $row2->last_visit;
										$staff_system_id2 = $row2->staff_system_id;
										$dependant_id2 = $row2->dependant_id;


										$patient2 = $this->reception_model->patient_names2($patient_id2);
										$patient_type2 = $patient2['patient_type'];
										$patient_othernames2 = $patient2['patient_othernames'];
										$patient_surname2 = $patient2['patient_surname'];
										$patient_type_id2 = $patient2['visit_type_id'];
										$account_balance2 = $patient2['account_balance'];
										$counter++;
				
										$result .= 
										'
											<tr>
												<td>'.$counter.'</td>
												<td>'.$dependant_id2.'</td>
												<td>'.$patient_surname2.'</td>
												<td>'.$patient_othernames2.'</td>
												<td>'.$last_visit2.'</td>
												<td>  '.number_format($account_balance2,0).'</td>
												<td><a href="'.site_url().'/reception/set_visit/'.$patient_id2.'" class="btn btn-sm btn-success">Visit</a></td>
												<td><a href="'.site_url().'/reception/edit_staff_dependant_patient/'.$patient_id2.'" class="btn btn-sm btn-warning">Edit </a></td>
												<td><a href="'.site_url().'/administration/individual_statement/'.$patient_id2.'/2" class="btn btn-sm btn-danger" target="_blank">Patient Statement</a></td>
												<!--<td><a href="'.site_url().'/reception/dependants/'.$patient_id.'" class="btn btn-sm btn-primary">Dependants</a></td>-->
												<!--<td><a href="'.site_url().'/reception/delete_patient/'.$patient_id.'/3" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete ?\');">Delete</a></td>-->
											</tr> 
										';
															}
								}
								else
								{

								}
								$result .= 
								'
								  </tbody>
								</table>
								';

							$result .='</td>
						</tr>';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no patients";
		}
		
		echo $result;
?>
          </div>
          
          <div class="widget-foot">
                                
				<?php if(isset($links)){echo $links;}?>
            
                <div class="clearfix"></div> 
            
            </div>
        </div>
        <!-- Widget ends -->

      </div>
    </div>
  </div>

   <script type="text/javascript">

	function get_visit_trail(patient_id){

		var myTarget2 = document.getElementById("visit_trail"+patient_id);
		var button = document.getElementById("open_visit"+patient_id);
		var button2 = document.getElementById("close_visit"+patient_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		button2.style.display = '';
	}
	function close_visit_trail(patient_id){

		var myTarget2 = document.getElementById("visit_trail"+patient_id);
		var button = document.getElementById("open_visit"+patient_id);
		var button2 = document.getElementById("close_visit"+patient_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
	}
  </script>