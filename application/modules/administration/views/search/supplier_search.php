<!-- Widget -->
<div class="widget boxed">
    <!-- Widget head -->
    <div class="widget-head">
        <h4 class="pull-left"><i class="icon-reorder"></i>Search Service Charge</h4>
        <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
            <a href="#" class="wclose"><i class="icon-remove"></i></a>
        </div>
    
        <div class="clearfix"></div>
    
    </div>             
    
    <!-- Widget content -->
    <div class="widget-content">
        <div class="padd">
            
            <?php echo form_open("administration/supplier_search/".$module."", array("class" => "form-horizontal"));?>
              <div class="row">
                    <div class="col-md-4">
                          <div class="form-group">
                              <label class="col-lg-4 control-label">Supplier name</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" name="supplier_name" placeholder="Supplier  Name" value="">
                              </div>
                          </div>
                           
                           
                    
                    
                         
                    </div>
                     <div class="col-md-4">
							<div class="form-group">
								<label class="col-lg-4 control-label">Supplier From: </label>
								
								<div class="col-lg-8">
									<div id="datetimepicker1" class="input-append">
										<input data-format="yyyy-MM-dd" class="form-control" type="text" name="supplier_date_from" placeholder="Supplier Date From">
										<span class="add-on" style="cursor:pointer;">
											&nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
											</i>
										</span>
									</div>
								</div>
							</div>
							
                    </div>
					<div class="col-md-4">
							<div class="form-group">
								<label class="col-lg-4 control-label">Supplier To: </label>
								
								<div class="col-lg-8">
									<div id="datetimepicker_other_patient" class="input-append">
										<input data-format="yyyy-MM-dd" class="form-control" type="text" name="supplier_date_to" placeholder="Supplier Date To">
										<span class="add-on" style="cursor:pointer;">
											&nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar">
											</i>
										</span>
									</div>
								</div>
							</div>
					</div>
                     
                </div>
            
            <div class="center-align">
                <button type="submit" class="btn btn-info btn-lg">Search</button>
            </div>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>