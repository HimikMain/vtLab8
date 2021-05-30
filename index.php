<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="blackVosem.png">
	<title>Восемь</title>
</head>
<body>
	<table>
		<tr>
			<th>ip-адрес</th>
			<th>кол-во посещений</th>
		</tr>

		<?php 

		$connect = mysqli_connect('localhost', 'mysql', 'mysql', 'ipvisitors');

		if (!connect) {
			die("Не подключились к базе данных");
		}

		$visitorIp = $_SERVER['REMOTE_ADDR'];

 		$currentIp = mysqli_query($connect, "SELECT * FROM `visitors` WHERE `ip`='$visitorIp'");

 		$tmpVisitor =  mysqli_num_rows($currentIp);
 		$getViews = mysqli_fetch_row($currentIp);

 		if ($tmpVisitor == 1) {
 			mysqli_query($connect, "UPDATE `visitors` SET `views` = '$getViews[2]'+1 WHERE `visitors`.`ip` = '$visitorIp'");
 		} else {
 			mysqli_query($connect, "INSERT INTO `visitors` (`id`, `ip`, `views`) VALUES (NULL, '$visitorIp', '1')");
 		}

		$ipViews = mysqli_query($connect, "SELECT * FROM `visitors` ORDER BY `visitors`.`views` DESC");
		$ipViews = mysqli_fetch_all($ipViews);

		foreach ($ipViews as $ip) {

			?>
			<tr>
				<td><?= $ip[1] ?></td>
				<td><?= $ip[2] ?></td>
			</tr>
			<?php 

		}
		?>
	</table>
	
</body>
</html>