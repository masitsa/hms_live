<div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Total Collected for <?php echo date('d/m/Y');?></h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

                <!-- Widget content -->
                <div class="widget-content">
                  <div class="padd">

                    <!-- Bar chart (Blue color). jQuery Flot plugin used. -->
                    <div id="bar-chart"></div>
                    <hr />

                  </div>
                </div>
                <!-- Widget ends -->

              </div>
            </div>
          </div>
<script src="<?php echo base_url()."assets/bluish/"?>js/reports.js"></script> <!-- Custom chart codes -->