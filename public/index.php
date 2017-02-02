<?php
session_name('session');
session_start();
setcookie(session_name(), session_id(), 0, null, null, null, true);

error_reporting(E_ALL | E_STRICT);

require __DIR__ . '/../vendor/autoload.php';

$application = require_once __DIR__ . '/../app/bootstrap.php';

$application->start();