<?php
$drug_size ="";
$drug_size_type ="";

$rs21 = $this->nurse_model->get_visit_type($visit_id);

$num_type= count($rs21);
foreach ($rs21 as $key):
	$visit_t = $key->visit_type;
endforeach;

$drug_dose ="";
$dose_unit_id ="";
$drug_type_name ="";
$admin_route ="";
$dose_unit ="";
$service_charge_name ="";

$temp_visit_charge_amount="";
$total_visit_charge_amount="";
if(!empty($service_charge_id)){

	$rs2 = $this->pharmacy_model->get_drug($service_charge_id);
	
	$s = 0;
	foreach ($rs2 as $key2):
		$drug_type_id = $key2->drug_type_id;
		$admin_route_id = $key2->drug_administration_route_id;
		$drug_dose = $key2->drugs_dose;
		$dose_unit_id = $key2->drug_dose_unit_id;
		$drug_size = $key2->drug_size;
		$drug_size_type = $key2->drug_size_type;
		$service_charge_name = $key2->service_charge_name;
	endforeach;
		
		if(!empty($drug_type_id)){
			$rs3 = $this->pharmacy_model->get_drug_type_name($drug_type_id);
			$num_rows3 = count($rs3);
			if($num_rows3 > 0){
				foreach ($rs3 as $key3):
					$drug_type_name = $key3->drug_type_name;
				endforeach;
			}
		}
		if(!empty($dose_unit_id)){
			$rs3 = $this->pharmacy_model->get_dose_unit2($dose_unit_id);
			$num_rows3 = count($rs3);
			if($num_rows3 > 0){
				foreach ($rs3 as $key3):
					$dose_unit = $key3->drug_dose_unit_name;
				endforeach;
			}
		}
		if(!empty($admin_route_id)){
			$rs3 = $this->pharmacy_model->get_admin_route2($admin_route_id);
			$num_rows3 = count($rs3);
			if($num_rows3 > 0){
				foreach ($rs3 as $key3):
					$admin_route = $key3->drug_administration_route_name;
				endforeach;
			}
		}
}else{
	$service_charge_id =0;
}

if(!empty($delete)){
	
	$visit_charge_id = $_GET['visit_charge_id'];
	$del = new prescription();
	$del->delete_visit_charge($visit_charge_id);
	
	$del = new prescription();
	$del->delete_prescription($delete);
}
//if the update button is clicked
$rs_forms = $this->pharmacy_model->get_drug_forms();
$num_forms = count($rs_forms);

if($num_forms > 0){
	
	$xray = "'";
	$t = 0;
	foreach ($rs_forms as $key_forms):
		if($t == ($num_forms-1)){
	
			$xray = $xray."".$key_forms->drug_type_name."'";
		}

		else{
			$xray = $xray."".$key_forms->drug_type_name."','";
		}
		$t++;
	endforeach;
}

$rs_admin = $this->pharmacy_model->get_admin_route();
$num_admin = count($rs_admin);

if($num_admin > 0){
	
	$xray2 = "'";
	$k = 0;
	foreach ($rs_admin as $key_admin):

		if($k == ($num_admin-1)){
	
			$xray2 = $xray2."".$key_admin->drug_administration_route_name."'";
		}

		else{
	
			$xray2 = $xray2."".$key_admin->drug_administration_route_name.",";
		}
		$k++;
	endforeach;
}

$rs_units = $this->pharmacy_model->get_dose_unit();
$num_units = count($rs_units);

if($num_units > 0){
	
	$xray3 = "'";
	$l=0;
	foreach ($rs_units as $key_units):

		if($l == ($num_units-1)){
	
			$xray3 = $xray3.$key_units->drug_dose_unit_name."'";
		}

		else{
	
			$xray3 = $xray3.$key_units->drug_dose_unit_name."','";
		}
	endforeach;
}

//get drug times
$times_rs = $this->pharmacy_model->get_drug_times();
$num_times = count($times_rs);
$time_list = "<select name = 'x' class='form-control'>";

	foreach ($times_rs as $key_items):

		$time = $key_items->drug_times_name;
		$drug_times_id = $key_items->drug_times_id;
		
		if($drug_times_id == set_value('x'))
		{
			$time_list = $time_list."<option value='".$drug_times_id."' selected='selected'>".$time."</option>";
		}
		
		else
		{
			$time_list = $time_list."<option value='".$drug_times_id."'>".$time."</option>";
		}
	endforeach;
$time_list = $time_list."</select>";

//get consumption
$rs_cons = $this->pharmacy_model->get_consumption();
$num_cons = count($rs_cons);
$cons_list = "<select name = 'consumption' class='form-control'>";
	foreach ($rs_cons as $key_cons):

	$con = $key_cons->drug_consumption_name;
	$drug_consumption_id = $key_cons->drug_consumption_id;
		
	if($drug_times_id == set_value('consumption'))
	{
		$cons_list = $cons_list."<option value='".$drug_consumption_id."' selected='selected'>".$con."</option>";
	}
	
	else
	{
		$cons_list = $cons_list."<option value='".$drug_consumption_id."'>".$con."</option>";
	}
	endforeach;
$cons_list = $cons_list."</select>";

//get durations
$duration_rs = $this->pharmacy_model->get_drug_duration();
$num_duration = count($duration_rs);
$duration_list = "<select name = 'duration' class='form-control'>";
	foreach ($duration_rs as $key_duration):
	$durations = $key_duration->drug_duration_name;
	$drug_duration_id = $key_duration->drug_duration_id;
		
	if($drug_times_id == set_value('duration'))
	{
		$duration_list = $duration_list."<option value='".$drug_duration_id."' selected='selected'>".$durations."</option>";
	}
	
	else
	{
		$duration_list = $duration_list."<option value='".$drug_duration_id."'>".$durations."</option>";
	}
	endforeach;
$duration_list = $duration_list."</select>";

//warnings
$warnings_rs = $this->pharmacy_model->get_warnings();
$num_warnings = count($warnings_rs);

$warning = "'";
$i = 0;
	foreach ($warnings_rs as $key_warning):

		if($i == ($num_warnings-1)){
		
			$warning = $warning."".$key_warning->warnings_name."'";
		}

		else{
		
			$warning = $warning."".$key_warning->warnings_name."','";
		}
		$i++;
	endforeach;

//instructions
$instructions_rs = $this->pharmacy_model->get_instructions();
$num_instructions = count($instructions_rs);

$inst = "'";
$p = 0;

	foreach ($instructions_rs as $key_instructions):
		if($p == ($num_instructions-1)){
		
			$inst = $inst."".$key_instructions->instructions_name."'";
		}

		else{
			$inst = $inst."".$key_instructions->instructions_name."','";
		}
	$p++;
	endforeach;
?>



    
<div class="center-align">
	<?php
	$error = $this->session->userdata('error_message');
	$validation_error = validation_errors();
	$success = $this->session->userdata('success_message');
	
	if(!empty($error))
	{
		echo '<div class="alert alert-danger">'.$error.'</div>';
		$this->session->unset_userdata('error_message');
	}
	
	if(!empty($validation_error))
	{
		echo '<div class="alert alert-danger">'.$validation_error.'</div>';
	}
	
	if(!empty($success))
	{
		echo '<div class="alert alert-success">'.$success.'</div>';
		$this->session->unset_userdata('success_message');
	}
?>
</div>
	<!-- end #header -->
<div class="row">
 <div class="col-md-12">

      <!-- Widget -->
      <div class="widget boxed">
        <!-- Widget head -->
        <div class="widget-head">
          <h4 class="pull-left"><i class="icon-reorder"></i><?php echo $patient;?> </h4>
          <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="icon-remove"></i></a>
          </div>
          <div class="clearfix"></div>
        </div>             

        <!-- Widget content -->
        <div class="widget-content">
          <div class="padd">
<?php echo form_open($this->uri->uri_string, array("class" => "form-horizontal"));?>
<div class="row col-md-12">
	<div class="col-md-4">
          <!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Drugs</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Medicine: </label>
				            
				            <div class="col-lg-8">
				            		 <?php
									if($module == 1)
									{

										?> 
									<input type="text" name="passed_value" id="passed_value"  class="form-control" onClick="myPopup2(<?php echo $visit_id;?>,<?php echo $module;?>)" value="<?php echo $service_charge_name;?>"/>
                                   
                                    <a href="#" onClick="myPopup2(<?php echo $visit_id;?>,<?php echo $module;?>)">Get Drug</a>
                                    	<?php
									}
									
									else
									{
										?> 
									<input type="text" name="passed_value" id="passed_value"  class="form-control" onClick="myPopup2_soap(<?php echo $visit_id;?>)" value="<?php echo $service_charge_name;?>"/>
                                   
                                    <a href="#" onClick="myPopup2_soap(<?php echo $visit_id;?>)">Get Drug</a>
                                    	<?php
									}
									?>
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="col-lg-4 control-label">Allow substitution: </label>
				            
				            <div class="col-lg-8">
                            	<?php
                                	if(set_value('substitution') == 'Yes')
									{
										echo '<input name="substitution" type="checkbox" value="Yes" checked="checked" />';
									}
                                	else
									{
										echo '<input name="substitution" type="checkbox" value="Yes"/>';
									}
								?>
				            		
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Dose: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $drug_dose?>
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Dose Unit: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $dose_unit;?>
				            </div>
				        </div>

					</div>
				</div>
			</div>
		</div>
		<!-- end of drugs -->
		<!-- start of admission -->
		<div class="col-md-4">
          <!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Admission</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Form: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $drug_type_name?>
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Admin Route: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $admin_route?>
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="col-lg-4 control-label">Number of Days: </label>
				            
				            <div class="col-lg-8">
				            	<input type="text" id="days" class='form-control' name="number_of_days"  autocomplete="off" value="<?php echo set_value('days');?>"/>
				            </div>
				        </div>
				        <?php if($drug_size_type!=""){
				         ?>
					        <div class="form-group">
					            <label class="col-lg-4 control-label">Amount contained in One Pack: </label>
					            
					            <div class="col-lg-8">
					            	<?php echo $drug_size.'  '.$drug_size_type ?>
					            </div>
					        </div>
					      <?php
					      }
					      ?>

					</div>
				</div>
			</div>
		</div>
		<!-- end of admission -->
		<!-- start of usage -->
		<div class="col-md-4">
          <!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Usage</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Method: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $cons_list?>
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Quantity: </label>
				            
				            <div class="col-lg-8">
				            	<input type="text" name="quantity" class='form-control' autocomplete="off" value="<?php echo set_value('quantity');?>" /> <?php echo $drug_size_type?> <input name="service_charge_id" id="service_charge_id" value="<?php echo $service_charge_id;?>" type="hidden">
				            </div>
				        </div>
				        <div class="form-group">
				            <label class="col-lg-4 control-label">Times: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $time_list;?>
				            </div>
				        </div>

				        <div class="form-group">
				            <label class="col-lg-4 control-label">Duration: </label>
				            
				            <div class="col-lg-8">
				            	<?php echo $duration_list;?>
				            </div>
				        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- end of usage -->
		

	</div>
		<!-- end of drugs tab -->
	<div class="row col-md-12">
 		<div class="center-align">
			<input type="hidden" name="v_id" value="<?php echo $visit_id;?>"/>
			<input name="submit" type="submit" class="btn btn-lg btn-info" value="Prescribe" />
		</div>
	</div>

                         
<?php echo form_close();?>
<div class="row col-md-12">
	<div class="col-md-12">
		<!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>All Prescriptions</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
                    	<table class='table table-striped table-hover table-condensed'>
                             <tr>
                                <th>No.</th>
                                <th>Medicine:</th>
                                <?php
                                if($module == 1)
                                {
                                	?>
                                	 <th>Unit Price:</th>
                                	  <th>Total:</th>
                                	  <th>Units given:</th>
                                	<?php
                                }
                                else
                                {

                                }
                                ?>
                                <th>Dose</th>
                                <th>Dose Unit</th>
                                <th>Method</th>
                                <th>Quantity</th>
                                <th>Times</th>
                                <th>Duration</th>
                                <th>Number of Days</th>
                                 <th>Allow Substitution</th>
                                <th>Delete </th>
                               
                                <th></th>
                            </tr>
                           <?php 
                           $rs = $this->pharmacy_model->select_prescription($visit_id);

                            $num_rows =count($rs);
                            $s=0;
                            if($num_rows > 0){
                            foreach ($rs as $key_rs):
                            	//var_dump($key_rs->prescription_substitution);
                                $service_charge_id =$key_rs->drugs_id;
                                $frequncy = $key_rs->drug_times_name;
                                $id = $key_rs->prescription_id;
                                $date1 = $key_rs->prescription_startdate;
                                $date2 = $key_rs->prescription_finishdate;
                                $sub = $key_rs->prescription_substitution;
                                 $duration = $key_rs->drug_duration_name;
                                $sub = $key_rs->prescription_substitution;
                                $duration = $key_rs->drug_duration_name;
                                $consumption = $key_rs->drug_consumption_name;
                                $quantity = $key_rs->prescription_quantity;
                                $medicine = $key_rs->drugs_name;
                                $charge = $key_rs->drugs_charge;
                                $visit_charge_id = $key_rs->visit_charge_id;
                                $number_of_days = $key_rs->number_of_days;
                                $units_given = $key_rs->units_given;
                                
                                $substitution = "<select name='substitution".$id."' class='form-control'>";
                                if($sub == "No"){
                                    $substitution = $substitution."<option selected>No</option><option>Yes</option>";
                                }
                                else{
                                    $substitution = $substitution."<option>No</option><option selected>Yes</option>";
                                }
                                $substitution = $substitution."</select>";
                                
                                //$drugs = new prescription();
                                //$medicine = $drugs->get_drugs_name($service_charge_id);
                                
                                $rs2 = $this->pharmacy_model->get_drug($service_charge_id);
                                
                                foreach ($rs2 as $key_rs2 ):
                                $drug_type_id = $key_rs2->drug_type_id;
                                $admin_route_id = $key_rs2->drug_administration_route_id;
                                $dose = $key_rs2->drugs_dose;
                                $dose_unit_id = $key_rs2->drug_dose_unit_id;
                                
                                endforeach;

                                if(!empty($drug_type_id)){
                                    $rs3 = $this->pharmacy_model->get_drug_type_name($drug_type_id);
                                    $num_rows3 = count($rs3);
                                    if($num_rows3 > 0){
                                        foreach ($rs3 as $key_rs3):
                                            $drug_type_name = $key_rs3->drug_type_name;
                                        endforeach;
                                    }
                                }
                                
                                if(!empty($dose_unit_id)){

                                    $rs3 = $this->pharmacy_model->get_dose_unit2($dose_unit_id);
                                    $num_rows3 = count($rs3);
                                    if($num_rows3 > 0){
                                        foreach ($rs3 as $key_rs3):
                                            $doseunit = $key_rs3->drug_dose_unit_name;
                                        endforeach;
                                    }
                                }else
                                {
                                	$doseunit = '';
                                }
                                
                                
                                if(!empty($admin_route_id)){
                                    $rs3 = $this->pharmacy_model->get_admin_route2($admin_route_id);
                                    $num_rows3 = count($rs3);
                                    if($num_rows3 > 0){
                                        foreach ($rs3 as $key_rs3):
                                            $admin_route = $key_rs3->drug_administration_route_name;
                                        endforeach;
                                    }
                                }
                                
                                $time_list2 = "<select name = 'x".$id."' class='form-control'>";
                                
                                    foreach ($times_rs as $key_items):

                                        $time = $key_items->drug_times_name;
                                      	$drug_times_id = $key_items->drug_times_id;
                                        if($time == $frequncy)
										{
											$time_list2 = $time_list2."<option value='".$drug_times_id."' selected>".$time."</option>";										
										}
										
										else
										{
                                        	$time_list2 = $time_list2."<option value='".$drug_times_id."'>".$time."</option>";
                                        }
                                    endforeach;
                                $time_list2 = $time_list2."</select>";
                                
                                $duration_list2 = "<select name = 'duration".$id."' class='form-control'>";
                                
                                foreach ($duration_rs as $key_duration):
                                    $durations = $key_duration->drug_duration_name;
                                    $drug_duration_id = $key_duration->drug_duration_id;
                                    if($durations == $duration)
									{
                                    	$duration_list2 = $duration_list2."<option value='".$drug_duration_id."' selected>".$durations."</option>";
									}
									
									else
									{
                                    	$duration_list2 = $duration_list2."<option value='".$drug_duration_id."'>".$durations."</option>";
                                    }
                                endforeach;
                                $duration_list2 = $duration_list2."</select>";
                                
                                $cons_list2 = "<select name = 'consumption".$id."' class='form-control'>";
                                
                                foreach ($rs_cons as $key_cons):
                                    $con = $key_cons->drug_consumption_name;
                                    $drug_consumption_id = $key_cons->drug_consumption_id;
                                    if($con == $consumption)
									{
                                    	$cons_list2 = $cons_list2."<option value='".$drug_consumption_id."' selected>".$con."</option>";
									}
									
									else
									{
                                    	$cons_list2 = $cons_list2."<option value='".$drug_consumption_id."'>".$con."</option>";
                                    }
                                endforeach;
                                $cons_list2 = $cons_list2."</select>";


								$rsf = $this->pharmacy_model->select_invoice_drugs($visit_id,$service_charge_id);
								$num_rowsf = count($rsf);
								foreach ($rsf as $key_price):
									$sum_units = $key_price->num_units;
								endforeach;
								
											
								$amoun=$charge* $sum_units ;
									
								$total_visit_charge_amount=$amoun+$temp_visit_charge_amount;
								$temp_visit_charge_amount=$total_visit_charge_amount; 
                                $s++;


                            ?>
                            <?php echo form_open('pharmacy/update_prescription/'.$visit_id.'/'.$visit_charge_id.'/'.$id.'/'.$module, array("class" => "form-horizontal"));?>
                            <tr>
                                <td><?php echo $s; ?></td>
                                <td><?php echo $medicine;?></td>
                                <?php
                                if($module == 1)
                                {
                                	?>
                                		<td><?php echo $charge;?></td>
                                		<td><?php echo $amoun;?></td>
                                		<td><input type="text" name="units_given<?php echo $id?>" class='form-control' id="units_given<?php echo $id?>" required="required" placeholder="units given" value="<?php echo $sum_units; ?>"  /></td>
                                	<?php
                                }
                                else
                                {

                                }
                                ?>
                                <td><?php echo $dose;?></td>
                                <td><?php echo $doseunit;?></td>
                                <td><?php echo $cons_list2; ?></td>
                                <td><input type="text" name="quantity<?php echo $id?>" class='form-control' autocomplete="off" value="<?php echo $quantity?>" size="3"/></td>
                                <td><?php echo $time_list2; ?></td>
                                <td><?php echo $duration_list2; ?></td>
                                <td><input type="text" id="datepicker3" name="days<?php echo $id?>" class='form-control' autocomplete="off" value="<?php echo  $number_of_days;?>" size="3"/></td>
       
                                <td><?php echo $substitution?></td>
                                <td>
                                    <div class='btn-toolbar'>
                                        <div class='btn-group'>
                                            <a class='btn btn-primary btn-sm' href='<?php echo site_url();?>/pharmacy/delete_prescription/<?php echo $id;?>/<?php echo $visit_id?>/<?php echo $visit_charge_id?>/<?php echo $module;?>' onclick="return confirm('Are you sure you want to remove this drug?');"><i class='icon-remove'></i></a>
                                        </div>
                                     </div>
                                 </td>
                                 <td>
                                    <input name="update" type="submit" value="Update" class="btn btn-sm btn-warning" />
                                    <input type="hidden" name="hidden_id" value="<?php echo $id?>" />
                                    <input type="hidden" name="v_id" value="<?php echo $visit_id;?>"/>
                                 </td>
                            </tr>
                            <?php echo form_close();?>
                      <?php
                      endforeach;
	                    if($module == 1)
	                    {
	                    	?>
	                    	<tr>
	                    		<td></td>
	                    		<td></td>
	                    		<td>Grand Total</td>
	                    		<td><?php echo $total_visit_charge_amount;?></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    		<td></td>
	                    	</tr>
	                    	<?php
	                    }
                        }

                      ?>
							</table>
                    </div>
                </div>
           </div>
	</div>
</div>

<div class="row col-md-12">
	<?php
		if($module == 1){
			?>
			<div class="center-align">
			<?php echo '<a href="'.site_url().'/pharmacy/send_to_accounts/'.$visit_id.'" onclick="return confirm(\'Send to accounts?\');" class="btn btn-sm btn-success">Send to Accounts</a>';?>
		 	</div>
			<?php
		}else{
			?>
			<div class="center-align">
		 	 <input type="hidden" name="v_id" value="<?php echo $visit_id;?>"/>
		            <input name="pharmacy_doctor" onClick="send_to_pharmacy2(<?php echo $visit_id;?>);unload()" type="button" class="btn btn-lg btn-success" value="Done" />
		    </div>
			<?php
		}
	?>
 	
 </div>  
 </div>
 </div>
    </div>
    </div>                                   
  

</div>

  
	<script type="text/javascript">

function myPopup2(visit_id,module) {
	var config_url = $('#config_url').val();
	window.open(config_url+"/pharmacy/drugs/"+visit_id+"/"+module,"Popup","height=1200,width=600,,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=no status=no,history=no top = 50 left = 100"); 
}

function myPopup2_soap(visit_id) {
	var config_url = $('#config_url').val();
	window.open(config_url+"/pharmacy/drugs/"+visit_id,"Popup","height=1200,width=600,,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=no status=no,history=no top = 50 left = 100"); 
}

function send_to_pharmacy2(visit_id){
 
	window.close(this);
	//display_prescription(visit_id, 2);
}
	</script>


                                        