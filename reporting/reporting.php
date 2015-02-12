<?php

//helpers
$this->load->helper('html');
$this->load->helper('url');
$this->load->helper('form');

echo meta(array('name' => 'viewport', 'content' => 'width=device-width', 'initial-scale' => '1.0'));
?>
<html lang="en">
<head>
	<title>Control Panel</title>
 	<link type="text/css" rel="stylesheet" href="<?php echo base_url("css/interface.css"); ?>" />
 
	<script type="text/javascript" src="<?php echo base_url('jquery/jquery-1.4.1.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('jquery/custom.js');?>"></script>
<link rel="stylesheet" href="../application/views/menu.css" type="text/css" media="screen" />
<title>Pharmacy</title>
</head>
<body onLoad="get_personnel_departments(<?php echo $personnel_id?>)">
  <div id="header" class="container">
    	<div id="logo">
			<h1><a href="#">SUMC</a></h1>
			<p><a href="http://www.strathmore.edu">control panel</a></p>
		</div>
</div>
	<!-- end #header -->
<div class="row-fluid">
		<div class="container" style="margin-top:10%;">  
			<div class="row">  
            	<div id="departments"></div>
			</div>  

	
  <script type="text/javascript" src="<?php echo base_url('js/script.js');?>"></script>
  <script src="../application/views/jquery/jquery-css-transform.js" type="text/javascript"></script>
  <script src="../application/views/jquery/jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
  <script>
  	get_personnel_departments(<?php echo $personnel_id?>)
            $('.item').hover(
                function(){
                    var $this = $(this);
                    expand($this);
                },
                function(){
                    var $this = $(this);
                    collapse($this);
                }
            );
            function expand($elem){
                var angle = 0;
                var t = setInterval(function () {
                    if(angle == 1440){
                        clearInterval(t);
                        return;
                    }

                    angle += 40;
                    $('.link',$elem).stop().animate({rotate: '+=-40deg'}, 0);
                },10);
                $elem.stop().animate({width:'268px'}, 1000)
                .find('.item_content').fadeIn(400,function(){
                    $(this).find('p').stop(true,true).fadeIn(600);
                });
            }
            function collapse($elem){
                var angle = 1440;
                var t = setInterval(function () {
                    if(angle == 0){
                        clearInterval(t);
                        return;
                    }
                    angle -= 40;
                    $('.link',$elem).stop().animate({rotate: '+=40deg'}, 0);
                },10);                $elem.stop().animate({width:'52px'}, 1000)
                .find('.item_content').stop(true,true).fadeOut().find('p').stop(true,true).fadeOut();

            }
        </script>
	  </div>
</div>
 </div>
				<!-- end wrapper -->
				<div id="footer">
					<p>Copyright &copy; 2012 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org">james brian studio</a>.</p>
				</div>
</body>
</html>