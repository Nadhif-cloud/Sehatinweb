<?php
require_once __DIR__ . '/controller/fileController.php';

$controller = new FileController();
$action = $_GET['action'] ?? 'index';

if ($action === 'show') {
    $controller->show();
} elseif ($action === 'Procces') {
    $controller->Procces();
} else {
    $controller->index();
}
