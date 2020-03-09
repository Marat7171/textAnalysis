<?php
$id_db = $_POST['id_db'];
require_once 'connectdb.php';
require_once 'myFunctions.php';

textOutput($pdo, $id_db);
echo '<br>';
wordOutput($pdo, $id_db);
