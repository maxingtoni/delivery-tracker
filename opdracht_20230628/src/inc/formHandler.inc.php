<?php

$_SERVER['DOCUMENT_ROOT'] = 'C:/xampp/htdocs/opdracht_20230628';
require_once "{$_SERVER['DOCUMENT_ROOT']}/src/core/init.core.php";
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Redirect::to($_SERVER['HTTP_REFERER']);
    return;
}


switch ($_POST['action']) {
    case "user-login":
        $loginHandler = new LoginHandler;
        $loginHandler->processForm($_POST);
        break;
    
    case "user-signup":
        $signupHandler = new SignupHandler;
        $signupHandler->processForm($_POST);
        break;

    
    case "location-add":
        $locationHandler = new LocationHandler;
        $locationHandler->addLocation($_POST);
        break;

    default:
        Redirect::to($_SERVER['HTTP_REFERER']);
        break;
}