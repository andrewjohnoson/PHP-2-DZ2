<?php

require __DIR__ . '/../autoload.php';

$article = new \App\Models\Article();
$article->id = $_POST['id'];
$article->delete();

header('Location: https://php2.local/');