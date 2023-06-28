<?php

if (!empty($_SESSION['user'])) {
    $_SESSION['user'] = [];
}

Redirect::to();