<html>
<head>
	<title>MapEdit</title>
</head>
<body>

<form action="map2_disp.php">
	<?php for($i=1; $i<=16; $i++){ ?>
	<input type="text" name="tile<?php print $i;?>">
		<?php if(($i%4) === 0){  ?>
		<br>
		<?php } ?>
	<?php } ?>
	<input type="submit" value="Apply">
</form>

</body>
</html>
