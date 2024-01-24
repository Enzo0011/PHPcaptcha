<?php

// index.php

error_reporting(E_ALL);
ini_set("display_errors", 1);


include 'Database.php';
include 'ColorUtils.php';
include 'CaptchaHandler.php';
include 'CaptchaGenerator.php';


$captchaHandler = new CaptchaHandler();
$captchaHandler->handleRequest();


/* 


librairie pour simplifier la gestion des formulaires en php

class d'un formulaire
avec les champs, le type, les options et contrainte 

form manager pour afficher et gérer le formulaire

regarder symfony pour exemple


*/