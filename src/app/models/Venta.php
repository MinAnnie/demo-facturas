<?php

class Venta
{
    private $conn;
    private $table = 'ventas';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getVentasFiltradas($fecha_inicio = null, $fecha_fin = null, $tipo_producto = null, $cantidad_m3 = null, $total_mxn = null, $grupo_negocio = null)
    {
        $query = "
        SELECT 
            v.id_venta,
            c.nombre AS cliente,
            p.nombre_producto,
            p.tipo_producto,
            v.fecha_venta,
            v.cantidad_m3,
            v.total_mxn,
            c.grupo_negocio
        FROM ventas v
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        INNER JOIN productos p ON v.id_producto = p.id_producto
        WHERE 1=1
    ";

        if ($fecha_inicio && $fecha_fin) {
            // Validar que la diferencia entre las fechas no supere los 30 días
            $fecha_inicio_obj = new DateTime($fecha_inicio);
            $fecha_fin_obj = new DateTime($fecha_fin);
            $diferencia = $fecha_inicio_obj->diff($fecha_fin_obj)->days;

            if ($diferencia > 30) {
                throw new Exception("La diferencia entre las fechas no puede ser mayor a 30 días.");
            }

            $query .= " AND v.fecha_venta BETWEEN :fecha_inicio AND :fecha_fin";
        }

        if ($tipo_producto) {
            $query .= " AND p.tipo_producto = :tipo_producto";
        }
        if ($cantidad_m3) {
            $query .= " AND v.cantidad_m3 >= :cantidad_m3";
        }
        if ($total_mxn) {
            $query .= " AND v.total_mxn >= :total_mxn";
        }
        if ($grupo_negocio) {
            $query .= " AND c.grupo_negocio = :grupo_negocio";
        }

        $stmt = $this->conn->prepare($query);

        if ($fecha_inicio && $fecha_fin) {
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
        }
        if ($tipo_producto) $stmt->bindParam(':tipo_producto', $tipo_producto);
        if ($cantidad_m3) $stmt->bindParam(':cantidad_m3', $cantidad_m3);
        if ($total_mxn) $stmt->bindParam(':total_mxn', $total_mxn);
        if ($grupo_negocio) $stmt->bindParam(':grupo_negocio', $grupo_negocio);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVentasPorGrupoNegocio($fecha_inicio = null, $fecha_fin = null, $tipo_producto = null, $cantidad_m3 = null, $total_mxn = null)
    {
        $query = "
        SELECT 
            c.grupo_negocio, 
            SUM(v.total_mxn) AS total_ventas
        FROM ventas v
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        INNER JOIN productos p ON v.id_producto = p.id_producto
        WHERE 1=1
    ";

        if ($fecha_inicio && $fecha_fin) {
            // Validar que la diferencia entre las fechas no supere los 30 días
            $fecha_inicio_obj = new DateTime($fecha_inicio);
            $fecha_fin_obj = new DateTime($fecha_fin);
            $diferencia = $fecha_inicio_obj->diff($fecha_fin_obj)->days;

            if ($diferencia > 30) {
                throw new Exception("La diferencia entre las fechas no puede ser mayor a 30 días.");
            }

            $query .= " AND v.fecha_venta BETWEEN :fecha_inicio AND :fecha_fin";
        }

        if ($tipo_producto) {
            $query .= " AND p.tipo_producto = :tipo_producto";
        }
        if ($cantidad_m3) {
            $query .= " AND v.cantidad_m3 >= :cantidad_m3";
        }
        if ($total_mxn) {
            $query .= " AND v.total_mxn >= :total_mxn";
        }

        $query .= " GROUP BY c.grupo_negocio";

        $stmt = $this->conn->prepare($query);

        if ($fecha_inicio && $fecha_fin) {
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
        }
        if ($tipo_producto) $stmt->bindParam(':tipo_producto', $tipo_producto);
        if ($cantidad_m3) $stmt->bindParam(':cantidad_m3', $cantidad_m3);
        if ($total_mxn) $stmt->bindParam(':total_mxn', $total_mxn);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVentasPorConcepto($fecha_inicio = null, $fecha_fin = null, $tipo_producto = null, $cantidad_m3 = null, $total_mxn = null)
    {
        $query = "
        SELECT 
            p.tipo_producto, 
            SUM(v.total_mxn) AS total_ventas
        FROM ventas v
        INNER JOIN productos p ON v.id_producto = p.id_producto
        WHERE 1=1
    ";

        if ($fecha_inicio && $fecha_fin) {
            // Validar que la diferencia entre las fechas no supere los 30 días
            $fecha_inicio_obj = new DateTime($fecha_inicio);
            $fecha_fin_obj = new DateTime($fecha_fin);
            $diferencia = $fecha_inicio_obj->diff($fecha_fin_obj)->days;

            if ($diferencia > 30) {
                throw new Exception("La diferencia entre las fechas no puede ser mayor a 30 días.");
            }

            $query .= " AND v.fecha_venta BETWEEN :fecha_inicio AND :fecha_fin";
        }

        if ($tipo_producto) {
            $query .= " AND p.tipo_producto = :tipo_producto";
        }
        if ($cantidad_m3) {
            $query .= " AND v.cantidad_m3 >= :cantidad_m3";
        }
        if ($total_mxn) {
            $query .= " AND v.total_mxn >= :total_mxn";
        }

        $query .= " GROUP BY p.tipo_producto";

        $stmt = $this->conn->prepare($query);

        if ($fecha_inicio && $fecha_fin) {
            $stmt->bindParam(':fecha_inicio', $fecha_inicio);
            $stmt->bindParam(':fecha_fin', $fecha_fin);
        }
        if ($tipo_producto) $stmt->bindParam(':tipo_producto', $tipo_producto);
        if ($cantidad_m3) $stmt->bindParam(':cantidad_m3', $cantidad_m3);
        if ($total_mxn) $stmt->bindParam(':total_mxn', $total_mxn);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientesSaldoVencido()
    {
        $query = "
        SELECT 
            c.nombre AS cliente, 
            SUM(v.total_mxn) AS saldo_vencido
        FROM ventas v
        INNER JOIN clientes c ON v.id_cliente = c.id_cliente
        WHERE v.fecha_venta < NOW() AND v.total_mxn > 0
        GROUP BY c.id_cliente
        HAVING saldo_vencido > 0
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
