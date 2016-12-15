<?php
    require_once 'repo.php';
    require_once 'vendor/autoload.php';

    header('Content-Type: application/json');

    $payload = file_get_contents('php://input');
    $new_target = json_decode($payload);

    $repo = new Repository();
    $repo->save_pushup_target($new_target);
