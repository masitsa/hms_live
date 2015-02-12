<!-- search -->
<?php echo $this->load->view('add/add_new_class', '', TRUE);?>
<!-- end search -->
<?php
if($class_id > 0)
{

}
else
{
?>
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

          
<?php
		$error = $this->session->userdata('error_message');
		$success = $this->session->userdata('success_message');
		
		if(!empty($error))
		{
			echo '<div class="alert alert-danger">'.$error.'</div>';
			$this->session->unset_userdata('error_message');
		}
		
		if(!empty($success))
		{
			echo '<div class="alert alert-success">'.$success.'</div>';
			$this->session->unset_userdata('success_message');
		}
		$search = $this->session->userdata('visit_search');
		
		if(!empty($search))
		{
			echo '<a href="'.site_url().'/nurse/close_queue_search" class="btn btn-warning">Close Search</a>';
		}
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
				'
					<table class="table table-hover table-bordered ">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Class Name</th>
						  <th colspan="2">Actions</th>
						</tr>
					  </thead>
					  <tbody>
				';
			$count = 0;
			
			foreach ($query->result() as $row)
			{
				
				$lab_test_class_name = $row->lab_test_class_name;
				$lab_test_class_id = $row->lab_test_class_id;
				$lab_test_class_delete = $row->lab_test_class_delete;
				$count++;
				if($lab_test_class_delete == 1)
				{
					$test_button = '<td><a href="'.site_url().'/lab_charges/activation/activate/test_class/'.$lab_test_class_id.'" class="btn btn-sm btn-default">Activate</a></td>';

				}
				else
				{
					$test_button = '<td><a href="'.site_url().'/lab_charges/activation/deactivate/test_class/'.$lab_test_class_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to deactivate this class?\');">Deactivate</a></td>';
				}
				
				$result .= 
					'
						<tr>
							<td>'.$count.'</td>
							<td>'.$lab_test_class_name.'</td>
							<td><a href="'.site_url().'/lab_charges/classes/'.$lab_test_class_id.'" class="btn btn-sm btn-success">Edit</a></td>
							'.$test_button.'
						</tr> 
					';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are lab test classes";
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
  <?php
}
  ?>