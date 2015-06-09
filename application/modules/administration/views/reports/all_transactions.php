<!-- search -->
<?php echo $this->load->view('search/transactions', '', TRUE);?>
<!-- end search -->
<?php //echo $this->load->view('transaction_statistics', '', TRUE);?>

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
          <h5 class="center-align"><?php echo $this->session->userdata('search_title');?></h5>
<?php
		$result = '<a href="'.site_url().'/administration/reports/export_transactions" class="btn btn-success pull-right">Export</a>';
		if(!empty($search))
		{
			echo '<a href="'.site_url().'/administration/reports/close_search/'.$module.'" class="btn btn-warning">Close Search</a>';
		}
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
				'
					<table class="table table-hover table-bordered table-striped table-responsive col-md-12">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Visit date</th>
						  <th>Patient</th>
						  <th>Category</th>
						  <th>Doctor</th>
						  <th>Staff/ Student/ID No.</th>
						  <th>Invoice total</th>
						  <th>Payments total</th>
						  <th>Balance</th>
						  <th colspan="2">Actions</th>
						</tr>
					  </thead>
					  <tbody>
						  
				';
			
			foreach ($query->result() as $row)
			{
				$count++;
				$total_invoiced = 0;
				$visit_date = date('jS M Y',strtotime($row->visit_date));
				$visit_time = date('H:i a',strtotime($row->visit_time));
				if($row->visit_time_out != '0000-00-00 00:00:00')
				{
					$visit_time_out = date('H:i a',strtotime($row->visit_time_out));
				}
				else
				{
					$visit_time_out = '-';
				}
				$visit_id = $row->visit_id;
				$strath_no = $row->strath_no;
				$patient_othernames = $row->patient_othernames;
				$patient_surname = $row->patient_surname;
				
				$visit_type = $row->visit_type_name;
				$personnel_othernames = $row->personnel_onames;
				$personnel_fname = $row->personnel_fname;
				$total_payments = $row->total_payments;
				$total_debit_notes = $row->total_debit_notes;
				$total_credit_notes = $row->total_credit_notes;
				$consultation = $row->consultation;
				$counseling = $row->counseling;
				$dental = $row->dental;
				$ecg = $row->ecg;
				$laboratory = $row->laboratory;
				$nursing_fee = $row->nursing_fee;
				$paediatrics = $row->paediatrics;
				$pharmacy = $row->pharmacy;
				$physician = $row->physician;
				$physiotherapy = $row->physiotherapy;
				$procedures = $row->procedures;
				$radiology = $row->radiology;
				$ultrasound = $row->ultrasound;
				$invoice_total = $consultation + $counseling + $dental + $ecg + $laboratory + $nursing_fee + $paediatrics + $pharmacy + $physician + $physiotherapy + $procedures + $radiology + $ultrasound;
				
				$total_invoiced = ($invoice_total + $total_debit_notes) - $total_credit_notes;
				$balance = $total_payments - $total_invoiced;
				$doctor = $personnel_othernames.' '.$personnel_fname;
				
				if($debtors == 'true' && ($balance > 0))
				{
					$result .= 
						'
							<tr>
								<td>'.$count.'</td>
								<td>'.$visit_date.'</td>
								<td>'.$patient_surname.' '.$patient_othernames.'</td>
								<td>'.$visit_type.'</td>
								<td>'.$doctor.'</td>
								<td>'.$strath_no.'</td>
								<td>'.$total_invoiced.'</td>
								<td>'.$total_payments.'</td>
								<td>'.($balance).'</td>
								<td><a href="'.site_url().'/accounts/print_receipt_new/'.$visit_id.'" target="_blank" class="btn btn-sm btn-info">Receipt</a></td>
								<td><a href="'.site_url().'/accounts/print_invoice_new/'.$visit_id.'" target="_blank" class="btn btn-sm btn-success">Invoice </a></td>
							</tr> 
					';
				}
				
				//display cash & all transactions
				else
				{
					$result .= 
						'
							<tr>
								<td>'.$count.'</td>
								<td>'.$visit_date.'</td>
								<td>'.$patient_surname.' '.$patient_othernames.'</td>
								<td>'.$visit_type.'</td>
								<td>'.$doctor.'</td>
								<td>'.$strath_no.'</td>
								<td>'.$total_invoiced.'</td>
								<td>'.$total_payments.'</td>
								<td>'.($balance).'</td>
								<td><a href="'.site_url().'/accounts/print_receipt_new/'.$visit_id.'" target="_blank" class="btn btn-sm btn-info">Receipt</a></td>
								<td><a href="'.site_url().'/accounts/print_invoice_new/'.$visit_id.'" target="_blank" class="btn btn-sm btn-success">Invoice </a></td>
							</tr> 
					';
				}
				
				if($count == 2)
				{
					//var_dump($result);die();
				}
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no visits";
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