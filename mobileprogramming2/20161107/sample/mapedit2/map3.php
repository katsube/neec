<html>
<head>
	<title>MapEdit</title>
</head>
<body>

<?php
$buff  = file_get_contents('store.dat');
$store = unserialize($buff);
?>

<form action="map2_disp.php">
	<?php for($i=1; $i<=16; $i++){ ?>
	<input type="text" name="tile<?php print $i;?>" value="<?php print $store['tile'.$i] ?>">
		<?php if(($i%4) === 0){  ?>
		<br>
		<?php } ?>
	<?php } ?>
	<input type="submit" value="Apply">
</form>

</body>
</html>
