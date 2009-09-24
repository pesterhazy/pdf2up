<?php
ob_start(); /* template body */ ?><html>

<head>
<title>PDF2Up</title>
<link rel="stylesheet" type="text/css" href="static/form.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/fonts/fonts-min.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.6.0/build/container/assets/skins/sam/container.css" />
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/utilities/utilities.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/container/container-min.js"></script>
</head>

<body class="yui-skin-sam">
<div id="wrapper">

	<h2>PDF2up 0.2</h2>

<?php echo $this->scope["content"];?>


	<p id="copyright">Created by Paulus Esterhazy.</p>
	
</div><!-- /wrapper -->
</body>
</html>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>