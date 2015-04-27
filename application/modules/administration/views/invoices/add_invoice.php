<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
		 <a href="<?php echo site_url()?>/administration/services" class="btn btn-sm btn-primary"> Back to Service List </a>

		</div>
	</div>
</div>
<div class="row">
    <div class="col-md-12">

      <!-- Widget -->
      <div class="widget boxed">
        <!-- Widget head -->
        <div class="widget-head">

          <h4 class="pull-left"><i class="icon-reorder"></i><?php echo $title;?> </h4>
          <div class="widget-icons pull-right">
         
            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="icon-remove"></i></a>
          </div>
          <div class="clearfix"></div>
        </div>             

        <!-- Widget content -->
        <div class="widget-content">
          <div class="padd">
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
			
            <div class="row">
            	<div class="col-md-6">
                	<?php
                    	if($custom_invoice_query->num_rows() > 0)
						{
							$row = $custom_invoice_query->row();
							
							$created =  date('jS M Y H:i a',strtotime($row->custom_invoice_created));
							$personnel_id = $row->custom_invoice_created_by;
							$invoice_number = $row->custom_invoice_number;
							$debtor = $row->custom_invoice_debtor;
							$contacts = $row->custom_invoice_debtor_contacts;	
							$status = $row->custom_invoice_status;			
							
							//get status
							if($status == 0)
							{
								$status = '<span class="label label-danger">Unpaid</span>';
							}
							
							else
							{
								$status = '<span class="label label-success">Paid</span>';
							}
							
							if($personnel_query->num_rows() > 0)
							{
								$personnel_result = $personnel_query->result();
								
								foreach($personnel_result as $adm)
								{
									$personnel_id2 = $adm->personnel_id;
									
									if($personnel_id == $personnel_id2)
									{
										$created_by = $adm->personnel_onames.' '.$adm->personnel_fname;
										break;
									}
									
									else
									{
										$created_by = '-';
									}
								}
							}
							
							?>
                            <table class="table table-condensed table-striped table-hover">
                            	<tr>
                                	<th>Debtor: </th>
                                    <td><?php echo $debtor;?></td>
                                </tr>
                            	<tr>
                                	<th>Debtor's contacts: </th>
                                    <td><?php echo $contacts;?></td>
                                </tr>
                            	<tr>
                                	<th>Invoice number: </th>
                                    <td><?php echo $invoice_number;?></td>
                                </tr>
                            	<tr>
                                	<th>Created on: </th>
                                    <td><?php echo $created;?></td>
                                </tr>
                            	<tr>
                                	<th>Created by: </th>
                                    <td><?php echo $created_by;?></td>
                                </tr>
                            	<tr>
                                	<th>Status: </th>
                                    <td><?php echo $status;?></td>
                                </tr>
                            <?php
						}
						
						//invoice items
						if($query->num_rows() > 0)
						{
							?>
                            <table class="table table-condensed table-striped table-hover">
                            	<tr>
                                	<th>#</th>
                                	<th>Description</th>
                                	<th>Cost</th>
                                	<th>Quantity</th>
                                	<th>Total</th>
                                </tr>
                            <?php
							$total = $count = 0;
							foreach($query->result() as $res)
							{
								$description = $res->custom_invoice_item_description;
								$cost = $res->custom_invoice_item_cost;
								$quantity = $res->custom_invoice_item_quantity;
								$total += ($cost*$quantity);
								$count++;
								
								?>
                                <tr>
                                	<td><?php echo $count;?></td>
                                	<td><?php echo $description;?></td>
                                	<td><?php echo $cost;?></td>
                                	<td><?php echo $quantity;?></td>
                                	<td><?php echo ($cost*$quantity);?></td>
                                </tr>
                                <?php
							}
							?>
                            	<tr>
                                	<th colspan="5">Total</th>
                                	<td><?php echo $total;?></td>
                                </tr>
                            </table>
                            <?php
						}
					?>
                </div>
                
                <div class="col-md-6">
					<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal'));?>
                         <div class="row">
                            <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">Item description</label>
                                      <div class="col-lg-8">
                                          <textarea class="form-control" name="custom_invoice_item_description" placeholder="Item description"><?php echo set_value('custom_invoice_item_description');?></textarea>
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">Item cost</label>
                                      <div class="col-lg-8">
                                          <input type="number" class="form-control" name="custom_invoice_item_cost" placeholder="Item cost" value="<?php echo set_value('custom_invoice_item_cost');?>">
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label class="col-lg-4 control-label">Item quantity</label>
                                      <div class="col-lg-8">
                                          <input type="number" class="form-control" name="custom_invoice_item_quantity" placeholder="Item quantity" value="<?php echo set_value('custom_invoice_item_quantity');?>">
                                      </div>
                                  </div>
                                 
                              </div>
                             
                        </div>
        
                        <div class="center-align">
                          <button type="submit" class="btn btn-info btn-lg"> Add item</button>
                        </div>
                        <?php echo form_close();
                    ?>
                </div>
          </div>
        </div>
      </div>
  </div>
</div>