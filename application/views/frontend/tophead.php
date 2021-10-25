<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="e-commerce site well design with responsive view." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">-->
<link href="<?php echo base_url();?>assets/css/stylesheet.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url();?>assets/owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
<script src="<?php echo base_url();?>assets/javascript/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/javascript/jstree.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/javascript/template.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/javascript/common.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/javascript/global.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script>
$(window).scroll(function () { 
	if ($(this).scrollTop() > 50) {
		$(".cs-headertop").addClass("fixed-header");
	} else {
		$(".cs-headertop").removeClass("fixed-header");
	}
});
</script>
</head>
<body>