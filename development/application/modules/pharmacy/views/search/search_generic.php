<!-- Widget -->
<div class="widget boxed">
    <!-- Widget head -->
    <div class="widget-head">
        <h4 class="pull-left"><i class="icon-reorder"></i>Search Generics </h4>
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
            echo form_open("pharmacy/search_generic", array("class" => "form-horizontal"));
            ?>
            <div class="row">
                <div class="col-md-10">
                    
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Generic name: </label>
                        
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="generic_name" placeholder="Generic name">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="center-align">
            	<button type="submit" class="btn btn-info btn-lg">Search generic</button>
            </div>
            
            <?php
            echo form_close();
            ?>
    	</div>
    </div>
</div>