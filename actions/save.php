<?php

include __DIR__ . '/../autoload.php';

$data = $_POST;

$article = new \App\Models\Article();

if (!empty($data['id'])) {
    $article->unpacking($data);
    $article->save();
}

header('Location: https://php2.local/');