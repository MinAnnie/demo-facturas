<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h1>Ventas</h1>
    <form method="GET" action="">
        <div class="row g-3 mb-4">
            <div class="col">
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio">

                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin">
            </div>
            <div class="col">
                <label for="tipo_producto" class="form-label">Tipo de Producto:</label>
                <select name="tipo_producto" id="tipo_producto" class="form-select">
                    <option value="">Todos</option>
                    <option value="Molecula">Molécula</option>
                    <option value="Servicio">Servicio</option>
                </select>
            </div>
            <div class="col">
                <label for="cantidad_m3" class="form-label">Cantidad (m³):</label>
                <input type="number" name="cantidad_m3" id="cantidad_m3" class="form-control" step="0.01">
            </div>
            <div class="col">
                <label for="total_mxn" class="form-label">Total (MXN):</label>
                <input type="number" name="total_mxn" id="total_mxn" class="form-control" step="0.01">
            </div>
            <div class="col-auto align-self-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

<!--    <h2 class="my-4">Lista de Ventas</h2>-->
<!--    <table class="table table-striped table-bordered">-->
<!--        <thead class="table-dark">-->
<!--        <tr>-->
<!--            <th>ID Venta</th>-->
<!--            <th>Cliente</th>-->
<!--            <th>Producto</th>-->
<!--            <th>Fecha de Venta</th>-->
<!--            <th>Cantidad (m³)</th>-->
<!--            <th>Total (MXN)</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($ventas as $venta): ?>
<!--            <tr>-->
<!--                <td>--><?php //echo $venta['id_venta']; ?><!--</td>-->
<!--                <td>--><?php //echo $venta['cliente']; ?><!--</td>-->
<!--                <td>--><?php //echo $venta['nombre_producto']; ?><!--</td>-->
<!--                <td>--><?php //echo $venta['fecha_venta']; ?><!--</td>-->
<!--                <td>--><?php //echo $venta['cantidad_m3']; ?><!--</td>-->
<!--                <td>--><?php //echo '$' . number_format($venta['total_mxn'], 2); ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->

    <h2 class="my-4">Gráfica de Ventas por Grupo de Negocio</h2>
    <canvas id="grupoNegocioChart" width="400" height="200"></canvas>

    <h2 class="my-4">Gráfica de Ventas por Concepto</h2>
    <canvas id="conceptoChart" width="400" height="200"></canvas>

    <h2 class="my-4">Gráfica de Clientes con Saldo Vencido</h2>
    <canvas id="clientesVencidoChart" width="400" height="200"></canvas>
</div>

<!-- Bootstrap JS (opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Datos para las gráficas
    const labelsGrupoNegocio = <?php echo json_encode(array_column($grupoNegocio, 'grupo_negocio')); ?>;
    const dataGrupoNegocio = <?php echo json_encode(array_column($grupoNegocio, 'total_ventas')); ?>;

    const labelsConcepto = <?php echo json_encode(array_column($conceptos, 'tipo_producto')); ?>;
    const dataConcepto = <?php echo json_encode(array_column($conceptos, 'total_ventas')); ?>;

    const labelsClientesVencido = <?php echo json_encode(array_column($clientes, 'cliente')); ?>;
    const dataClientesVencido = <?php echo json_encode(array_column($clientes, 'saldo_vencido')); ?>;

    // Configuración de la gráfica de Grupo de Negocio
    const ctxGrupoNegocio = document.getElementById('grupoNegocioChart').getContext('2d');
    new Chart(ctxGrupoNegocio, {
        type: 'bar',
        data: {
            labels: labelsGrupoNegocio,
            datasets: [{
                label: 'Total de Ventas (MXN)',
                data: dataGrupoNegocio,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

    // Configuración de la gráfica de Concepto
    const ctxConcepto = document.getElementById('conceptoChart').getContext('2d');
    new Chart(ctxConcepto, {
        type: 'bar',
        data: {
            labels: labelsConcepto,
            datasets: [{
                label: 'Ventas por Concepto (MXN)',
                data: dataConcepto,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        }
    });

    // Configuración de la gráfica de Clientes con Saldo Vencido
    const ctxClientesVencido = document.getElementById('clientesVencidoChart').getContext('2d');
    new Chart(ctxClientesVencido, {
        type: 'bar',
        data: {
            labels: labelsClientesVencido,
            datasets: [{
                label: 'Saldo Vencido (MXN)',
                data: dataClientesVencido,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
</body>
</html>
