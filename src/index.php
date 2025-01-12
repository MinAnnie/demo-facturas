<?php
// Ruta base para controladores
require_once './app/controllers/VentasController.php';
require_once './app/controllers/UploadController.php';

// Obtener los parámetros de la URL (controller y action)
$controllerName = $_GET['controller'] ?? 'ventas';  // Default controller: ventas
$action = $_GET['action'] ?? 'index';               // Default action: index

// Instanciamos el controlador correspondiente
switch ($controllerName) {
    case 'ventas':
        $controller = new VentasController();
        break;
    case 'upload':
        $controller = new UploadController();
        break;
    default:
        die('Controlador no encontrado.');
}

// Llamamos a la acción especificada
if (method_exists($controller, $action)) {
    if ($action == 'download') {
        $controller->$action($_GET['filename']); // Pasamos el filename a la acción de descarga
    } else {
        $controller->$action();
    }
} else {
    die('Acción no encontrada.');
}

