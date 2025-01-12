<?php

require_once __DIR__ . '../../models/FileModel.php';
class UploadController
{
    private $fileModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
    }

    // Mostrar todos los archivos PDF subidos
    public function index()
    {
        $uploadedFiles = $this->fileModel->getUploadedFiles();
        require_once(__DIR__ . '../../views/upload/index.php');
    }

    // Subir un archivo PDF
    public function upload()
    {
        $message = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
            $message = $this->fileModel->saveFile($_FILES['pdf']);
        }

        $uploadedFiles = $this->fileModel->getUploadedFiles();
        require_once(__DIR__ . '../../views/upload/index.php');
    }

    // Descargar un archivo PDF seleccionado
    public function download($filename)
    {
        $filePath = __DIR__ . '/../../uploads/' . $filename;

        // Verificar si el archivo existe
        if (!file_exists($filePath)) {
            die("El archivo no existe.");
        }

        // Forzar la descarga del archivo
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Leer el archivo y enviarlo al navegador
        readfile($filePath);
        exit();
    }
}
