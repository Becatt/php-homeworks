<?php 

$list = scandir("./tests");

foreach ($list as $test) { 
  	if (substr($test, -5) == '.json') {
  		$listJson [] = $test;
  	}
  }

if (!empty($_GET)) {
	if (array_key_exists('test_number', $_GET)) {

		$options = [
			'options' => [
				'min_range' => 1,
				'max_range' => count($listJson)
			]
		];

		$validate = filter_input(INPUT_GET, 'test_number', FILTER_VALIDATE_INT, $options);

		if ($validate) {
			$test_number = (int)$_GET['test_number'];
			$testFile = "tests/" . $listJson[$test_number-1];
			$testJson = file_get_contents($testFile);
			$test = json_decode($testJson) or exit('Ошибка декодирования json');

		} else {
			http_response_code(404);
      		exit('Нет теста c таким номером.');
		}

	}
} else {
	exit('Данные не получены');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Тест</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

	<form action=<?php echo "test.php?test_number=" . $test_number ?> method="POST">
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
            $correctAnswer = 0;
			for ($i=1; $i < count($_POST); $i++) {
				$numQuestion++;
				$value = $_POST['q' . $i];

				if($value == 'answer') { 
                    $correctAnswer++; ?>
					<li><?php echo 'Вопрос ' . $numQuestion . ': верно.<br>'; ?></li>
           
				<?php }else { ?>
					<li><?php echo 'Вопрос ' . $numQuestion . ': неверно.<br>'; ?></li>
				<?php }
			} 
	        $userName = $_POST['name'];
	        $percent = ($correctAnswer / $numQuestion * 100); 

	        if($percent<70) {
	        	echo 'Тест не пройден';
	        } else {
	        	echo 'Поздравляем!!!<br>';

	        ?>

	        <img src="certificate.php"><br>   
  
  <?php 
  		}
    } 

  ?>
    </ul>

  <a href="list.php">Вернуться к списку тестов</a>

</body>
</html>