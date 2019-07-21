<?php

if (!empty($_FILES)) {
	if ( $_FILES ['test']['error'] !== 0) {
		
		echo 'Файл не загружен, код ошибки: ' . $_FILES['test']['error'] . '<br>';

	} else if ($_FILES['test']['type'] !== 'application/json') {
		echo 'Неверный формат файла. Файл должен быть в формате JSON.<br>';

	} else {
		$updir = 'tests';
		$fname = $_FILES['test'] ['name'];
    
	    if (move_uploaded_file($_FILES['test'] ['tmp_name'], "$updir/$fname")) {
			header('Location: list.php');
            exit;
	    } else {
	        echo 'Ошибка при загрузке файла<br>';
		}
	}
}