<html>
	<head>
		<title>Tutorial 1 - Task 1</title>
	</head>
	<body>
		<h1> my first php task </h1>
		<?php
		$SingleFamilyHome = 399500;
		$SingleFamilyHome_Display =
		number_format($SingleFamilyHome, 2);
		echo "<p>The current median price" .
		" of a single-family home in Australia" .
		" is $$SingleFamilyHome_Display.</p>";
		?>
	</body>
</html>