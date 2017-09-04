<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="IE=edge">
	<title>Todoリスト</title>
	<link href="_common/css/reset.css" rel="stylesheet" type="text/css">
	<link href="_common/css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<style>
		input{
			font-size: 25px;
		}

	</style>
</head>
<body>
	<header>
		<div class="header-contents">
			<h1>Todoリスト</h1>
			<h2>2017/09/04</h2>
		</div><!-- /.header-contents -->
	</header>
	<div class="main-wrapper">
		<section>
			<form action="#" method="post">
				<input type="text" name="todo">
				<input type="submit" name="submit" value="追加" class="pure-button pure-button-primary">
			</form>
		</section>
		<section>
			<p>
				<?php 

				if($_SERVER['REQUEST_METHOD'] === 'POST'){
					if(!empty($_POST['todo'])){
						$todo = htmlspecialchars($_POST['todo'], ENT_QUOTES);

						$dsn = 'mysql:dbname=todo_170904;host=localhost;charset=utf8';
						$user = 'root';
						$password = 'root';

						$dbh = new PDO($dsn, $user, $password);
						$dbh->query('SET NAMES utf8');
						$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

						$sql = 'INSERT INTO todo_task (todo_comment) VALUES (?)';
						$stmt = $dbh->prepare($sql);


						$stmt->bindValue(1, $todo, PDO::PARAM_STR);

						$stmt->execute();

						$dbh = null;

						unset($todo);

					}else{
						echo "空";
					}
				}
				?>
			</p>
			<ul>
				<?php 
				$dsn = 'mysql:dbname=todo_170904;host=localhost;charset=utf8';
				$user = 'root';
				$password = 'root';

				$dbh = new PDO($dsn, $user, $password);
				$dbh->query('SET NAMES utf8');
				$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

				$sql = 'SELECT todo_no,todo_comment FROM todo_task ORDER BY todo_no DESC';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
				$dbh = null;


				while($tekito = $stmt->fetch(PDO::FETCH_ASSOC)){
					echo "<li>".$tekito['todo_no']."::".$tekito['todo_comment']."</li>";

				}
				?>
			</ul>
		</section>
	</div><!-- /.main-wrapper -->
	<footer>JavaScript Samples</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>

	</script>

</body>
</html>
