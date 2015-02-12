<div class="row">
    <div class="col-md-12">
        <?php 
        $validation_error = validation_errors();
        
        if(!empty($validation_error))
        {
            echo '<div class="alert alert-danger">'.$validation_error.'</div>';
        }
        echo form_open('pharmacy/search_drugs/'.$visit_id, array('class'=>'form-inline'));
        ?>
        
        
         <div class="row" style="margin-bottom:5px;">
            <div class="center-align col-md-12">
                <div class="form-group">
                    <label class="col-lg-12 control-label">Drug Name: </label>
                    
                    <div class="col-lg-12">
                        <input type="text" class="col-lg-12 form-control" name="search_item" placeholder="Drug name">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-lg-12 control-label">Generic Name: </label>
                    
                    <div class="col-lg-12">
                        <input type="text" class="col-lg-12 form-control" name="generic_name" placeholder="Generic name">
                    </div>
                </div>
            </div>
            
        </div>
            
            <input type="hidden" value="<?php echo $visit_id?>" name="visit_id">
        <div class="center-align">
            <div class="form-group">
                <?php
                $search = $this->session->userdata('drugs_search');
                if(!empty($search))
                {
                ?>
                <a href="<?php echo site_url().'/pharmacy/close_drugs_search/'.$visit_id;?>" class="btn btn-warning">Close Search</a>
                <?php }?>
                <input type="submit" class="btn btn-info" value="Search" name="search"/>
            </div>
        </div>
        <?php echo form_close();?>
    </div>
</div>
      <div class="row">
        <div class="col-md-12">
              <!-- Widget -->
              <div class="widget boxed">
                    <!-- Widget head -->
                    <div class="widget-head">
                      <h4 class="pull-left"><i class="icon-reorder"></i>Drugs List</h4>
                      <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        <a href="#" class="wclose"><i class="icon-remove"></i></a>
                      </div>
                      <div class="clearfix"></div>
                    </div>             

                <!-- Widget content -->
                    <div class="widget-content">
                        <div class="padd">
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <table border="0" class="table table-hover table-condensed">
                                        <thead> 
                                            <th> Name</th>
                                            <th>Class</th>
                                            <th>Generic</th>
                                            <th>Brand</th>
                                            <th>In Stock</th>
                                            <th>Price</th>
                                        </thead>
                            
                                        <?php 
                                        //echo "current - ".$current_item."end - ".$end_item;
                                        
                                        $rs9 = $query->result();
                                        foreach ($rs9 as $rs10) :
                                        
                                        
	                                       	$service_charge_id = $rs10->service_charge_id;
											$drugname = $rs10->service_charge_name;
											$drugsclass = $rs10->class_name;
                                            $drugs_id = $rs10->drugs_id;
											$drugscost = $rs10->service_charge_amount;
											$generic_name = $rs10->generic_name;
											$brand_name = $rs10->brand_name;
											$visit_type_idv = $rs10->visit_type_id;
                                            $quantity = $rs10->quantity;
                                            $purchases = $this->pharmacy_model->item_purchases($drugs_id);
                                            $sales = $this->pharmacy_model->get_drug_units_sold($drugs_id);
                                            $deductions = $this->pharmacy_model->item_deductions($drugs_id);
                                            $in_stock = ($quantity + $purchases) - $sales - $deductions;
                                        
                                        ?>
                                       <tr>
							            <tr> </tr>
                                    <?php
									if($module == 1)
									{
										?> 
							        		<td><a onClick="close_drug('<?php echo $drugname;?>', <?php echo $visit_id?>, <?php echo $service_charge_id;?>,<?php echo $module?>)" href="#"><?php echo $drugname?></a></td>
                                    	<?php
									}
									
									else
									{
										?> 
							        		<td><a onClick="close_drug_soap('<?php echo $drugname;?>', <?php echo $visit_id?>, <?php echo $service_charge_id;?>)" href="#"><?php echo $drugname?></a></td>
                                    	<?php
									}
									?>
							                <td><?php echo $drugsclass;?></td>
							         
							                <td><?php echo $generic_name;?></td>
							                <td><?php echo $brand_name;?></td>
                                            <td><?php echo $in_stock;?></td>
							                <td><?php echo $drugscost;?></td>
							        	</tr>
                                        <?php endforeach;?>
                                    </table>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                        
                    <div class="widget-foot">
                    <?php
                    if(isset($links)){echo $links;}
                    ?>
                    </div>
                 </div>
            </div>
        </div>
<script type="text/javascript">
  
function close_drug(val, visit_id, service_charge_id,module){
	window.close(this);
	var config_url = $('#config_url').val();
	window.opener.location.href = config_url+"/pharmacy/prescription/"+visit_id+"/"+service_charge_id+"/"+module;
}
  
function close_drug_soap(val, visit_id, service_charge_id){

	var config_url = $('#config_url').val();
	window.open(config_url+"/pharmacy/prescription/"+visit_id+"/"+service_charge_id,"Popup","height=1200,width=1300,,scrollbars=yes,"+ 
						"directories=yes,location=yes,menubar=yes," + 
						 "resizable=no status=no,history=no top = 50 left = 100");
}
function close_drug1(val, visit_id, service_charge_id){

    window.close(this);
    var config_url = $('#config_url').val();
    window.opener.location.href = config_url+"/pharmacy/prescription/"+visit_id+"/"+service_charge_id;
    
    // window.open(config_url+"/pharmacy/prescription/"+visit_id+"/"+service_charge_id,"Popup","height=1200,width=1300,,scrollbars=yes,"+ 
 //                        "directories=yes,location=yes,menubar=yes," + 
 //                         "resizable=no status=no,history=no top = 50 left = 100"); 
}
</script>
