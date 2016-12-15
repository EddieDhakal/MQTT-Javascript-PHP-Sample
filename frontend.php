<?php
require_once 'vendor/autoload.php';
require_once 'repo.php';

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

$repo = new Repository();
$pushup_target = $repo->fetch_pushup_target();
$pushup_target_arr = (array)json_decode($pushup_target);

$target_days = array_keys($pushup_target_arr);
$targets = array_values($pushup_target_arr);

echo $twig->render('frontend.twig', array('days' => $target_days, 'targets' => $targets));
//echo $twig->render('frontend.twig', array('pushup_target' => $pushup_target_arr));
