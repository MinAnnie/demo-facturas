<?php

use config\db;

require_once __DIR__ . '../../models/Venta.php';
require_once __DIR__ . '../../config/db.php';

class VentasController
{
    private $venta;
    private $db;

    public function __construct()
    {
        $db = new db();
        $database = $db->connect();
        $this->venta = new Venta($database);
    }

    public function index()
    {
// Obtener las fechas de inicio y fin desde el formulario (GET o POST)
        $filtro_fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
        $filtro_fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;
        $filtro_tipo_producto = isset($_GET['tipo_producto']) ? $_GET['tipo_producto'] : null;
        $filtro_cantidad_m3 = isset($_GET['cantidad_m3']) ? $_GET['cantidad_m3'] : null;
        $filtro_total_mxn = isset($_GET['total_mxn']) ? $_GET['total_mxn'] : null;
        $filtro_grupo_negocio = isset($_GET['grupo_negocio']) ? $_GET['grupo_negocio'] : null;

        try {
// Obtener las ventas filtradas
            $ventas = $this->venta->getVentasFiltradas(
                $filtro_fecha_inicio,
                $filtro_fecha_fin,
                $filtro_tipo_producto,
                $filtro_cantidad_m3,
                $filtro_total_mxn,
                $filtro_grupo_negocio
            );
        } catch (Exception $e) {
// En caso de que las fechas sean inválidas (más de 30 días de diferencia)
            echo "Error: " . $e->getMessage();
            return;
        }

// Agregar los totales para mostrar en la vista
        $totales = [
            'total_mxn' => 0,
            'total_m3' => 0
        ];

        foreach ($ventas as $venta) {
            $totales['total_mxn'] += $venta['total_mxn'];
            $totales['total_m3'] += $venta['cantidad_m3'];
        }

// Obtener los conceptos (tipo de producto)
        $conceptos = $this->venta->getVentasPorConcepto($filtro_fecha_inicio, $filtro_fecha_fin, $filtro_tipo_producto, $filtro_cantidad_m3, $filtro_total_mxn);

// Obtener los clientes con saldo vencido
        $clientes = $this->venta->getClientesSaldoVencido($filtro_fecha_inicio, $filtro_fecha_fin);

// Obtener ventas por grupo de negocio
        $grupoNegocio = $this->venta->getVentasPorGrupoNegocio($filtro_fecha_inicio, $filtro_fecha_fin, $filtro_tipo_producto, $filtro_cantidad_m3, $filtro_total_mxn);

// Pasar los datos a la vista
        include_once(__DIR__ . '/../views/ventas/index.php');
    }
}

