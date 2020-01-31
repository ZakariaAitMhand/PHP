<html lang="en">
<head>
    <meta charset="utf-8" />
   
    <link rel="stylesheet" href="css/jquery-ui.css" />
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui.js"></script>
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>
</head>
<body>
 
<p><input name="back" class="txt" type="text" id="datepicker"  value="<?php echo Date("Y-m-d")?>"/></p>
 
 
</body>
</html>