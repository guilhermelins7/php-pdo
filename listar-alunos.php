<?php

require_once 'vendor/autoload.php';

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);


$result = $pdo->query( 'SELECT * FROM students;');
$studentList = $result->fetchAll();

echo $studentList[1]['id'];