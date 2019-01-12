<?php
	include 'functions.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php
			$rezultatas = new Medis();			
			$rezultatas->getList();
			$rezultatas->showResult();
		?>		
	</body>
</html>