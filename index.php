<?php
// index.php

require_once 'config/database.php';
require_once 'controllers/UserController.php';

$controller = new UserController($db);

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store($_POST, $_FILES);
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_POST, $_FILES);
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    default:
        header('Location: index.php');
        exit;
}