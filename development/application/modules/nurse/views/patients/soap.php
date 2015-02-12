<?php echo form_open("reception/register-other-patient", array("class" => "form-horizontal"));?>
<?php
if($dental == 1)
{

}
else{
?>
<div class="row">
	<div class="col-md-12">
        <div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget boxed">
                    <!-- Widget head -->
                    <div class="widget-head">
                      <h4 class="pull-left"><i class="icon-reorder"></i>Symptoms</h4>
                      <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        <a href="#" class="wclose"><i class="icon-remove"></i></a>
                      </div>
                      <div class="clearfix"></div>
                    </div>             

                <!-- Widget content -->
                    <div class="widget-content">
                        <div class="padd">
                              <!-- vitals from java script -->
                                <div id="symptoms"></div>
                                <!-- end of vitals data -->
                        </div>

                     </div>
                
                </div>
            </div>
        </div>
    </div>
   
</div>
<div class="row">
 <div class="col-md-12">
       <div class="row">
        <div class="col-md-12">

          <!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Objective Findings</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
                            <!-- visit Procedures from java script -->
                                <div id="objective_findings"></div>
                             <!-- end of visit procedures -->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="row">
 <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget boxed">
                    <!-- Widget head -->
                    <div class="widget-head">
                      <h4 class="pull-left"><i class="icon-reorder"></i>Assessment</h4>
                      <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        <a href="#" class="wclose"><i class="icon-remove"></i></a>
                      </div>
                      <div class="clearfix"></div>
                    </div>             

                <!-- Widget content -->
                    <div class="widget-content">
                        <div class="padd">
                              <!-- vitals from java script -->
                                <div id="assessment"></div>
                                <!-- end of vitals data -->
                        </div>

                     </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<div class="row">
 
    <div class="col-md-12">
       <div class="row">
        <div class="col-md-12">

          <!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Plan</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
                            <!-- visit Procedures from java script -->
                             <div id="plan"></div>
                             <!-- end of visit procedures -->
                             <div id='visit_diagnosis_original'></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget boxed">
                    <!-- Widget head -->
                    <div class="widget-head">
                      <h4 class="pull-left"><i class="icon-reorder"></i>Prescription</h4>
                      <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        <a href="#" class="wclose"><i class="icon-remove"></i></a>
                      </div>
                      <div class="clearfix"></div>
                    </div>             

                <!-- Widget content -->
                    <div class="widget-content">
                        <div class="padd">
                              <!-- vitals from java script -->
                                <div id="prescription"></div>
                                <!-- end of vitals data -->
                        </div>

                     </div>
                
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
  <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">

              <!-- Widget -->
              <div class="widget boxed">
                    <!-- Widget head -->
                    <div class="widget-head">
                      <h4 class="pull-left"><i class="icon-reorder"></i>Doctor's Notes</h4>
                      <div class="widget-icons pull-right">
                        <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                        <a href="#" class="wclose"><i class="icon-remove"></i></a>
                      </div>
                      <div class="clearfix"></div>
                    </div>             

                <!-- Widget content -->
                    <div class="widget-content">
                        <div class="padd">
                              <!-- vitals from java script -->
                                <div id="doctor_notes"></div>
                                <!-- end of vitals data -->
                        </div>

                     </div>
                
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
       <div class="row">
        <div class="col-md-12">

          <!-- Widget -->
          <div class="widget boxed">
                <!-- Widget head -->
                <div class="widget-head">
                  <h4 class="pull-left"><i class="icon-reorder"></i>Nurse Notes</h4>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="icon-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="icon-remove"></i></a>
                  </div>
                  <div class="clearfix"></div>
                </div>             

            <!-- Widget content -->
                <div class="widget-content">
                    <div class="padd">
                            <!-- visit Procedures from java script -->
                                <div id="nurse_notes"></div>
                             <!-- end of visit procedures -->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php echo form_close();?>




<script type="text/javascript">

  $(document).ready(function(){
      symptoms(<?php echo $visit_id;?>);
      objective_findings(<?php echo $visit_id;?>);
      assessment(<?php echo $visit_id;?>);
      plan(<?php echo $visit_id;?>);
      doctor_notes(<?php echo $visit_id;?>);
      nurse_notes(<?php echo $visit_id?>);
      get_disease(<?php echo $visit_id?>);
      display_prescription(<?php echo $visit_id?>,2);
      
  });
  
  function symptoms(visit_id){

  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
   var config_url = $('#config_url').val();

  var url = config_url+"/nurse/view_symptoms/"+visit_id;
 
  if(XMLHttpRequestObject) {
    
    var obj = document.getElementById("symptoms");
      
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
        
        // patient_details(visit_id);
        // objective_findings(visit_id);
        // assessment(visit_id);
        // plan(visit_id);
        // doctor_notes(visit_id);
        // nurse_notes(visit_id);
      }
    }
        
    XMLHttpRequestObject.send(null);
  }
}


function objective_findings(visit_id){
  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
   var config_url = $('#config_url').val();
  var url = config_url+"/nurse/view_objective_findings/"+visit_id;
  
  if(XMLHttpRequestObject) {
    
    var obj = document.getElementById("objective_findings");
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
      }
    }
        
    XMLHttpRequestObject.send(null);
  }
}
function save_doctor_notes(visit_id){
      var config_url = $('#config_url').val();
        var data_url = config_url+"/nurse/save_doctor_notes/"+visit_id;
        //window.alert(data_url);
         var doctor_notes = $('#doctor_notes_item').val();//document.getElementById("vital"+vital_id).value;
        $.ajax({
        type:'POST',
        url: data_url,
        data:{notes: doctor_notes},
        dataType: 'text',
        success:function(data){
        //obj.innerHTML = XMLHttpRequestObject.responseText;
        },
        error: function(xhr, status, error) {
        //alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
        alert(error);
        }

        });

      
}

function assessment(visit_id){
  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var config_url = $('#config_url').val();
  var url = config_url+"/nurse/view_assessment/"+visit_id;
  
  if(XMLHttpRequestObject) {
    
    var obj = document.getElementById("assessment");
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
      }
    }
        
    XMLHttpRequestObject.send(null);
  }
}

function plan(visit_id){
  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var config_url = $('#config_url').val();
  var url = config_url+"/nurse/view_plan/"+visit_id;
  
  if(XMLHttpRequestObject) {
    
    var obj = document.getElementById("plan");
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
         get_test_results(100, visit_id);
         closeit(79, visit_id);
         display_prescription(visit_id, 2);
      }
    }
        
    XMLHttpRequestObject.send(null);
  }
}

function get_test_results(page, visit_id){

  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var config_url = $('#config_url').val();
  if((page == 1) || (page == 65) || (page == 85)){
    
    url = config_url+"/laboratory/test/"+visit_id;
  }
  
  else if ((page == 75) || (page == 100)){
    url = config_url+"/laboratory/test2/"+visit_id;
  }
  //alert(url);
  if(XMLHttpRequestObject) {
    if((page == 75) || (page == 85)){
      var obj = window.opener.document.getElementById("test_results");
    }
    else{
      var obj = document.getElementById("test_results");
    }
    XMLHttpRequestObject.open("GET", url);
    
    XMLHttpRequestObject.onreadystatechange = function(){
    
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
  //window.alert(XMLHttpRequestObject.responseText);
        obj.innerHTML = XMLHttpRequestObject.responseText;
        if((page == 75) || (page == 85)){
          window.close(this);
        }
        
      }
    }
    XMLHttpRequestObject.send(null);
  }
}



function display_prescription(visit_id, page){
  
  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
   var config_url = $('#config_url').val();
  var url = config_url+"/pharmacy/display_prescription/"+visit_id;
  
  if(page == 1){
    var obj = window.opener.document.getElementById("prescription");
  }
  
  else{
    var obj = document.getElementById("prescription");
  }
  if(XMLHttpRequestObject) {
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
        
        if(page == 1){
          window.close(this);
        
        }
        plan(visit_id);
      }
    }
    
    XMLHttpRequestObject.send(null);
  }
}

function open_window_lab(test, visit_id){
  var config_url = $('#config_url').val();
  window.open(config_url+"/laboratory/laboratory_list/"+test+"/"+visit_id,"Popup","height=1200, width=800, , scrollbars=yes, "+ "directories=yes,location=yes,menubar=yes," + "resizable=no status=no,history=no top = 50 left = 100");
}

function open_symptoms(visit_id){
  var config_url = $('#config_url').val();
  window.open(config_url+"/nurse/symptoms_list/"+visit_id,"Popup","height=1000,width=600,,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=no status=no,history=no top = 50 left = 100");
    
  
}

function open_objective_findings(visit_id){
  var config_url = $('#config_url').val();
  window.open(config_url+"/nurse/objective_finding/"+visit_id,"Popup","height=600,width=1000,,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=no status=no,history=no top = 50 left = 100");
    
  
}


function save_assessment(visit_id){
 
  var config_url = $('#config_url').val();
  var data_url = config_url+"/nurse/save_assessment/"+visit_id;
  //window.alert(data_url);
   var assessment = $('#visit_assessment').val();//document.getElementById("vital"+vital_id).value;
  $.ajax({
  type:'POST',
  url: data_url,
  data:{notes: assessment},
  dataType: 'text',
  success:function(data){
    window.alert("You have successfully updated the assessment");
  //obj.innerHTML = XMLHttpRequestObject.responseText;
  },
  error: function(xhr, status, error) {
  //alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
  alert(error);
  }

  });
}

function open_window(plan, visit_id){
    var config_url = $('#config_url').val();
  if(plan == 6){
  
    window.open(config_url+"/nurse/disease/"+visit_id,"Popup","height=1000,width=600,,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=no status=no,history=no top = 50 left = 100");
  }
  else if (plan == 1){
    
    window.open(config_url+"/pharmacy/prescription/"+visit_id,"Popup","height=1200,width=1300,,scrollbars=yes,"+ 
                        "directories=yes,location=yes,menubar=yes," + 
                         "resizable=yes status=yes,history=yes top = 50 left = 100");
  }
}



function doctor_notes(visit_id){
    var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  var config_url = $('#config_url').val();
  var url = config_url+"/nurse/doctor_notes/"+visit_id;
  
  if(XMLHttpRequestObject) {
    
    var obj = document.getElementById("doctor_notes");
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
        symptoms3(visit_id);
        
      }
    }
        
    XMLHttpRequestObject.send(null);
  }
}


function nurse_notes(visit_id){
    var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var config_url = $('#config_url').val();
  var url = config_url+"/nurse/nurse_notes/"+visit_id;
  
  if(XMLHttpRequestObject) {
    
    var obj = document.getElementById("nurse_notes");
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
      }
    }
        
    XMLHttpRequestObject.send(null);
  }
}

function save_symptoms(visit_id){
  

  var config_url = $('#config_url').val();
  var data_url = config_url+"/nurse/save_symptoms/"+visit_id;
  //window.alert(data_url);
   var symptoms = $('#visit_symptoms').val();//document.getElementById("vital"+vital_id).value;
  $.ajax({
  type:'POST',
  url: data_url,
  data:{notes: symptoms},
  dataType: 'text',
  success:function(data){
    window.alert("You have successfully updated the symptoms");
  //obj.innerHTML = XMLHttpRequestObject.responseText;
  },
  error: function(xhr, status, error) {
  //alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
  alert(error);
  }

  });
}

function save_objective_findings(visit_id){
 
  var config_url = $('#config_url').val();
  var data_url = config_url+"/nurse/save_objective_findings/"+visit_id;
  //window.alert(data_url);
   var objective_findings = $('#visit_objective_findings').val();//document.getElementById("vital"+vital_id).value;
  $.ajax({
  type:'POST',
  url: data_url,
  data:{notes: objective_findings},
  dataType: 'text',
  success:function(data){
    window.alert("You have successfully updated the objective findings");
  //obj.innerHTML = XMLHttpRequestObject.responseText;
  },
  error: function(xhr, status, error) {
  //alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
  alert(error);
  }

  });
}
function save_plan(visit_id){
 
  var config_url = $('#config_url').val();
  var data_url = config_url+"/nurse/save_plan/"+visit_id;
  //window.alert(data_url);
   var plan = $('#visit_plan').val();//document.getElementById("vital"+vital_id).value;
  $.ajax({
  type:'POST',
  url: data_url,
  data:{notes: plan},
  dataType: 'text',
  success:function(data){
    window.alert("You have successfully updated the visit plan");
  //obj.innerHTML = XMLHttpRequestObject.responseText;
  },
  error: function(xhr, status, error) {
  //alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
  alert(error);
  }

  });
}

function get_disease(visit_id){
  
  var XMLHttpRequestObject = false;
    
  if (window.XMLHttpRequest) {
  
    XMLHttpRequestObject = new XMLHttpRequest();
  } 
    
  else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
  }
  var config_url = $('#config_url').val();
  var url = config_url+"/nurse/get_diagnosis/"+visit_id;

      
  if(XMLHttpRequestObject) {
    var obj = document.getElementById("visit_diagnosis_original");
    var obj2 = document.getElementById("visit_diagnosis");
        
    XMLHttpRequestObject.open("GET", url);
        
    XMLHttpRequestObject.onreadystatechange = function(){
      
      if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
        obj.innerHTML = XMLHttpRequestObject.responseText;
        obj2.innerHTML = XMLHttpRequestObject.responseText;
      }
    }
    
    XMLHttpRequestObject.send(null);
  }
}

$(document).on("click","a.delete_diagnosis",function() 
{
    var diagnosis_id = $(this).attr('href');
    var visit_id = $(this).attr('id');
	var config_url = $('#config_url').val();
	var url = config_url+"/nurse/delete_diagnosis/"+diagnosis_id;
	
	$.get(url, function( data ) {
		get_disease(visit_id);
	});
	
	return false;
});
</script>