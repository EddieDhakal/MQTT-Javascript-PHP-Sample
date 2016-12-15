<?php
    require_once 'vendor/autoload.php';
    require_once 'repo.php';

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);

    $repo = new Repository();
    $pushup_target = $repo->fetch_pushup_target();

    echo $twig->render('backend.twig', array('pushup_target' => $pushup_target));
