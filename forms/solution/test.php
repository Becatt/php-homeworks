<?php 

if (!empty($_GET)) {
	if (array_key_exists('test_number', $_GET)) {
		$test_number = "tests/" . $_GET['test_number'] . "_тест.json" ;
		
		if (file_exists($test_number)) {
		$testJson = file_get_contents($test_number);
		$test = json_decode($testJson) or exit('Ошибка декодирования json');
        }else {
		    http_response_code(404);
			exit('Нет теста c таким номером.');
	    }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Тест</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

	<form action=<?php echo "test.php?test_number=" . $_GET['test_number'] ?> method="POST">
		<div>Введите Ваше имя: <input type="text" name="name"></div>
		<?php 
		$q = 0;
		foreach ($test as $question => $answers) { 
			$q++;
		?>
		<fieldset>
			<legend><?php echo $question ?></legend>
				<?php foreach ($answers as $key => $answer) { ?>
				<label><input type="radio" name=<?php echo "q" . $q ?> value=<?php echo $key ?>> <?php echo $answer ?></label>	
				<?php } ?>				
		</fieldset>
		<?php } ?>
		<input type="submit" value ="Посмотреть результат">
	</form>
	<ul class="resultTest">
		<?php
		if(!empty($_POST)) {
			$numQuestion = 0;
			for ($i=1; $i < count($_POST); $i++) {
				$numQuestion++;
				$value = $_POST['q' . $i];

				if($value == 'answer') { ?>
					<li><?php echo 'Вопрос ' . $numQuestion . ': верно.<br>'; ?></li>
				<?php }else { ?>
					<li><?php echo 'Вопрос ' . $numQuestion . ': неверно.<br>'; ?></li>
				<?php }
			}
		}

	?>
    </ul>

  <a href="list.php">Вернуться к списку тестов</a>

</body>
</html>   
