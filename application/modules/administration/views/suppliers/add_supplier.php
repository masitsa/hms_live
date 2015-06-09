<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
		 <a href="<?php echo site_url()?>/administration/suppliers" class="btn btn-sm btn-primary"> Back to suppliers List  </a>

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

            <?php
            if($supplier_id > 0)
            {
            	if($supplier_query->num_rows > 0)
            	{
            		foreach ($supplier_query->result() as $key) {
            			# code...
            			$supplier_name = $key->supplier_name;
            			$recepient = $key->recepient;
            			$dateofissue = $key->dateofissue;
            			$amount = $key->amount;
            			$reason = $key->reason;
            		}
            	}
            	?>
            	<?php echo form_open('administration/update_supplier/'.$supplier_id, array('class' => 'form-horizontal'));?>
                 <div class="row">
                    <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-lg-4 control-label">Supplier name</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="supplier_name" placeholder="Supplier  Name" value="<?php echo $supplier_name;?>">
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-lg-4 control-label">Transaction Date</label>
                              <div class="col-lg-8">
  								<div id="datetimepicker1" class="input-append">
	                                <input data-format="yyyy-MM-dd" class="form-control" type="text" name="transaction_date" placeholder="Transaction Date" value="<?php echo $dateofissue;?>">
	                                <span class="add-on">
	                                    &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
	                                    </i>
	                                </span>
	                            </div>
                            </div>
                          </div>
                         
                    </div>
                     <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-lg-4 control-label">Amount</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="transacted_amount" placeholder="e.g 1000"  value="<?php echo $amount;?>">
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-lg-4 control-label">supplier Description</label>
                              <div class="col-lg-8">
                              	<textarea class="form-control" name="supplier_description"><?php echo $reason;?></textarea>
                              </div>
                          </div>
                    </div>
                     
                </div>

                <div class="center-align">
                  <button type="submit" class="btn btn-info btn-lg"> Update Service</button>
                </div>
            	<?php echo form_close();
            }else
            {
            	?>
            	<?php echo form_open('administration/supplier_add', array('class' => 'form-horizontal'));?>
                 <div class="row">
                    <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-lg-4 control-label">Supplier name</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="supplier_name" placeholder="Supplier  Name" value="">
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-lg-4 control-label">Transaction Date</label>
                              <div class="col-lg-8">
  								<div id="datetimepicker1" class="input-append">
	                                <input data-format="yyyy-MM-dd" class="form-control" type="text" name="transaction_date" placeholder="Registration Date" value="<?php echo set_value('registration_date');?>">
	                                <span class="add-on">
	                                    &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
	                                    </i>
	                                </span>
	                            </div>
                            </div>
                          </div>
                         
                    </div>
                     <div class="col-md-6">
                          <div class="form-group">
                              <label class="col-lg-4 control-label">Amount</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="transacted_amount" placeholder="e.g 1000" >
                              </div>
                          </div>
                           <div class="form-group">
                              <label class="col-lg-4 control-label">Supplier Description</label>
                              <div class="col-lg-8">
                              	<textarea class="form-control" name="supplier_description"></textarea>
                              </div>
                          </div>
                    </div>
                     
                </div>

                <div class="center-align">
                  <button type="submit" class="btn btn-info btn-lg">Add New Supplier</button>
                </div>
            	<?php echo form_close();
            }
            ?>
            
          </div>
        </div>
      </div>
  </div>
</div>