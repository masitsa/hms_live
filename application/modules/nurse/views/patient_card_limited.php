
            <div class="row">
                <div class="col-md-12">
                    <div class="center-align">
                    	<button type="button" class="btn btn-danger btn-lg" id="treat_patient">Treat patient</button>
                    </div>
                </div>
            </div>
<!-- <div class="row">
    <div class="col-md-12">
       <div class="alert alert-danger">The process of keying in patient vitals has been changed from auto saving to a manual button saving. Please find a button named  <a hred="#" class="btn btn-sm btn-success" >Save Vitals</a> to save the keyed in vitals. The next row will display the vitals you have keyed in. ~ development team </div>
    </div>
</div> -->
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
         <div class="clearfix"></div>
          </div>

          <?php echo $this->load->view("allergies_brief", '', TRUE);?>
        
       <div class="clearfix"></div>

			<div class="tabbable" style="margin-bottom: 18px;">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#vitals-pane" data-toggle="tab">Vitals</a></li>
                <li><a href="#lifestyle" data-toggle="tab">Lifestyle</a></li>
                <?php if($mike == 1){

                }else{?>
                <li><a href="#previous-vitals" data-toggle="tab">Previous Vitals</a></li>
                <li><a href="#patient-history" data-toggle="tab">Patient history</a></li>
                <?php
                }
                ?>
                <li><a href="#soap" data-toggle="tab">SOAP</a></li>
                <li><a href="#medical-checkup" data-toggle="tab">Medical Checkup</a></li>
                <li><a href="#visit_trail" data-toggle="tab">Visit Trail</a></li>
              </ul>
              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                <div class="tab-pane active" id="vitals-pane">
                  <?php echo $this->load->view("patients_limited/vitals", '', TRUE);?>
                </div>
               
                
                <div class="tab-pane" id="lifestyle">
                	<?php echo $this->load->view("patients_limited/lifestyle", '', TRUE); ?>
                </div>
                <?php
                if($mike == 1){

                }else{?>
                 <div class="tab-pane" id="previous-vitals">
                  
                  <?php echo $this->load->view("patient_previous_vitals", '', TRUE);?>
                  
                </div>
                <div class="tab-pane" id="patient-history">
                  
                  <?php echo $this->load->view("patient_history", '', TRUE);?>
                  
                </div>
                <?php
                }
                ?>

                 <div class="tab-pane" id="soap">
                  
                  <?php echo $this->load->view("patients_limited/soap", '', TRUE);?>
                  
                </div>

                 <div class="tab-pane" id="medical-checkup">
                  
                  <?php echo $this->load->view("patients_limited/medical_checkup", '', TRUE);?>
                  
                </div>

                 <div class="tab-pane" id="visit_trail">
                  
                  <?php echo $this->load->view("patients_limited/visit_trail", '', TRUE);?>
                  
                </div>
                
              </div>
            </div>

              
            <div class="row">
                <div class="col-md-12">
                    <div class="center-align">
                    	<button type="button" class="btn btn-danger btn-lg" id="treat_patient">Treat patient</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- Widget ends -->

      </div>
    </div>
  </div>
  
  <script type="text/javascript">
  	
	var config_url = $("#config_url").val();
		
	$(document).ready(function(){
	
	  	$.get( config_url+"/nurse/get_family_history/<?php echo $visit_id;?>", function( data ) {
			$("#new-nav").html(data);
			$("#checkup_history").html(data);
		});
	});
	
	$(document).on("click","button#treat_patient",function() 
	{
		window.location.href = config_url+"/doctor/treat_patient/<?php echo $visit_id;?>";
	});
  </script>

