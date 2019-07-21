<?php

define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sbeketov');
define('DB_USER', 'sbeketov');
define('DB_PASSWORD', 'neto1800');

$connect_str = DB_DRIVER . ':host=' . DB_HOST . '; dbname=' . DB_NAME;
$db = new PDO($connect_str, DB_USER, DB_PASSWORD);

$errors = [];
$fields = [];
$tableDescript = [];

function CheckGet($get) {
	if(!empty($_GET[$get])){
		$get = $_GET[$get];
	} else {
		$get= '';
	}
	return $get;
}

function CheckPost($post, $noPost) {
	if(!empty($_POST[$post])){
		$post = strip_tags($_POST[$post]);
	} else {
		$post = $noPost;
	}
	return $post;
}

function CheckNull($null) {
if (!empty($_GET[$null])) {
		if($_GET[$null]=='NO'){
			$null = 'NOT NULL';
			
		} elseif($_GET[$null]=='YES') {
			$null = 'NULL';
		}
	}
	return $null;
}

function CheckDefault($default) {
	if(isset($_GET['default'])) {
		if(!empty($_GET['default'])) {
			$default = 'DEFAULT ' . $_GET['default'];
		} elseif ($_GET['default']=='0') {
			$default = 'DEFAULT ' . $_GET['default'];
		} else {
		$default = '';
		}
	return $default;
	}
}

$table = strip_tags(CheckGet('table'));
$column = strip_tags(CheckGet('column'));
$type = strip_tags(CheckGet('type'));
$extra = strip_tags(CheckGet('extra'));
$null = strip_tags(CheckNull('null'));
$default =  strip_tags(CheckDefault('default'));
$newName = CheckPost('new_name', $column);
$newType = CheckPost('new_type', $type);

if(!empty($_POST['tabName'])) {
	
	$tabName = strip_tags($_POST['tabName']);
	
	if(!preg_match('|^[A-Z0-9]+$|i', $tabName)) {
		$errors[]='Название таблицы может содержать только символы латинского алфавита и цифры';
	} else {

		$db->exec("CREATE TABLE `$tabName` (
								`id` int NOT NULL AUTO_INCREMENT,
								`name` varchar(50) NULL,
								`description` varchar(500) NULL,
								`price` float(11.2) NOT NULL DEFAULT '0',
								PRIMARY KEY (`id`)
								)ENGINE=InnoDB DEFAULT CHARSET=utf8
		");
	}
}

if(!empty($_POST['delete'])) {

	$db->exec("ALTER TABLE $table DROP COLUMN $column");
}

if(!empty($_POST['update'])) {

	$db->exec("ALTER TABLE $table CHANGE $column $newName $newType $null $extra $default");
}


$tablesStmt = $db->query("SHOW TABLES");
$tables = $tablesStmt->fetchAll();

if(!empty($table)){
	$tableDescriptStmt = $db->query("DESCRIBE $table");
	$tableDescript = $tableDescriptStmt->fetchAll(PDO::FETCH_ASSOC);
	$fields = $tableDescript[0];
}


?>