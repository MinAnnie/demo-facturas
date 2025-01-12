<?php
class FileModel
{
    private $uploadDir = __DIR__ . '/../../uploads/';

    public function __construct()
    {
        // Crear el directorio de uploads si no existe
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function saveFile($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors = [
                UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño máximo permitido por el servidor.',
                UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño máximo especificado en el formulario.',
                UPLOAD_ERR_PARTIAL => 'El archivo fue subido parcialmente.',
                UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo.',
                UPLOAD_ERR_NO_TMP_DIR => 'Falta un directorio temporal.',
                UPLOAD_ERR_CANT_WRITE => 'No se pudo escribir el archivo en el disco.',
            ];

            $errorMsg = $errors[$file['error']] ?? 'Error desconocido.';
            return ['error' => $errorMsg];
        }

        // Validar que sea un archivo PDF
        $fileType = mime_content_type($file['tmp_name']);
        if ($fileType !== 'application/pdf') {
            return ['error' => 'El archivo debe ser un PDF.'];
        }

        // Obtener el nombre original del archivo
        $fileName = $file['name'];
        // Definir la ruta completa donde se guardará el archivo
        $filePath = $this->uploadDir . $fileName;

        // Mover el archivo al directorio de uploads
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return ['success' => 'El archivo se subió correctamente.', 'fileName' => $fileName];
        }

        return ['error' => 'Ocurrió un error al mover el archivo.'];
    }

    public function getUploadedFiles()
    {
        $files = array_diff(scandir($this->uploadDir), ['.', '..']);
        return $files;
    }
}
