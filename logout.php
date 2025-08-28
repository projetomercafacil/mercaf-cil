<?php
// public/logout.php
require_once __DIR__ . '/../app/Controllers/AuthController.php';
$auth = new AuthController();
$auth->logout();
header('Location: index.php');
exit;