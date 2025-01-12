<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos PDF</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 600px;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        ul {
            margin: 20px 0;
            padding: 0;
            list-style-type: none;
        }

        ul li {
            margin: 5px 0;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }

        h1, h2 {
            text-align: center;
        }

        .btn-primary {
            width: 100%;
        }

        .form-select {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <button class="btn"><a href="/">Volver a ventas</a></button>
    <h1 class="mb-4">Subir Archivos PDF</h1>

    <?php if (!empty($message)): ?>
        <div class="message <?= isset($message['success']) ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message['success'] ?? $message['error']) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=upload&action=upload" method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="mb-3">
            <label for="pdf" class="form-label">Seleccionar archivo para subir:</label>
            <input type="file" name="pdf" id="pdf" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Subir</button>
    </form>

    <h2>Archivos subidos:</h2>
    <ul>
        <?php foreach ($uploadedFiles as $file): ?>
            <li>
                <?= htmlspecialchars($file) ?>
                <a href="index.php?controller=upload&action=download&filename=<?= urlencode($file) ?>" class="btn btn-link">Descargar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
