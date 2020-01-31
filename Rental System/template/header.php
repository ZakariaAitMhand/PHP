<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="style_mobile.css" />-->
	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" media="screen" type="text/css" href="css/style.css" />
	<!--<link rel="stylesheet" href="css/style_mobile.css" media="handheld">--> 
	<!--<link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 480px)" href="style_mobile.css" />-->
	<link rel='stylesheet' href='css/style_index.css' />
	<link href="images/icone.png" rel="SHORTCUT ICON">
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui.js"></script>

	<!--
	<script type="text/javascript" src="rec_library/record_action.js"></script>
	-->
	
	
	<script type="text/javascript" src="scripts/jquery.js"></script>
	<script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="rec_library/jquery.js"></script>
	<script type="text/javascript" src="scripts/jquery.nivo.slider.pack.js"></script>
	<script type="text/javascript" src="js/datepicker.js"></script>
    <script type="text/javascript">
	$J=$.noConflict();
	$J(window).load(function() {
        $J('#slider').nivoSlider();
	});
	$J(document).ready(function(){
		$J("#ul #p").click(function(){
			$J(this).toggleClass("actif");
			$J(this).next(".sub_menu").slideToggle(500).siblings(".sub_menu").slideUp("slow");
			$J(this).siblings().removeClass("actif");
		});
		$J("#phone").click(function(){
			$J(this).next("#hidden").show(300).fadeOut(2000);
		});
		$J("#custid").click(function(){
			$J(this).prev("div#hidden1").show(300).fadeOut(2000);
		});
	});
    </script>
<title>Video Rental System</title>
</head>
<body>

