<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes de Servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link href="style.css" rel="stylesheet">
    <style>
.fila-peligro {
    background-color: #cc0000 !important;
    color: white !important;
}

.fila-alerta {
    background-color: #ffe599 !important;
    color: black !important;
}
</style>

    </head> 
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-4">Órdenes de Servicio</h1>

    <table class="table table-bordered table-hover">
  <thead class="table-dark encabezado-personalizado">
    <tr>
      <th>Cliente</th>
      <th>Placa</th>
      <th>Fecha Ingreso</th>
      <th>Tipo Servicio</th>
      <th>Observaciones</th>
      <th>Estado Pago</th>
      <th>Fecha Finalización</th>
    </tr>
  </thead>
  <tbody id="tablaOrdenes">
<?php

$ordenes = [
    [
        "cliente" => "Carlos Mora",
        "placa" => "ABC123",
        "fecha_ingreso" => "2024-06-15",
        "tipo" => "Cambio de aceite",
        "observaciones" => "Motor ruidoso",
        "estado_pago" => "Pagado",
        "fecha_final" => "2024-06-16"
    ],
    [
        "cliente" => "María Serrano",
        "placa" => "XYZ789",
        "fecha_ingreso" => "2024-06-10",
        "tipo" => "Revisión general",
        "observaciones" => "Sin observaciones",
        "estado_pago" => "Pendiente",
        "fecha_final" => "2024-06-11"
    ],
    [
        "cliente" => "José Rivera",
        "placa" => "DEF456",
        "fecha_ingreso" => "2024-06-17",
        "tipo" => "Frenos",
        "observaciones" => "Chirrido al frenar",
        "estado_pago" => "Pagado",
        "fecha_final" => ""
    ],

    [
    "cliente" => "Ana Chinchilla",
    "placa"   => "GHI234",
    "fecha_ingreso" => "2024-06-01",
    "tipo"    => "Alineación",
    "observaciones" => "Vibración en el volante",
    "estado_pago"   => "Pendiente",
    "fecha_final"   => "2024-06-03"
],
[
    "cliente" => "Luis Rivera",
    "placa"   => "JKL567",
    "fecha_ingreso" => "2024-05-28",
    "tipo"    => "Suspensión",
    "observaciones" => "Ruido en baches",
    "estado_pago"   => "Pagado",
    "fecha_final" => ""
],

];

foreach ($ordenes as $orden): 
    $fechaIngreso = new DateTime($orden["fecha_ingreso"]);
    $fechaHoy = new DateTime();
    $diferencia = $fechaIngreso->diff($fechaHoy)->days;

    $claseFila = "";
    if ($diferencia > 7) {
    $claseFila = "fila-alerta";
}
    if (!empty($orden["fecha_final"]) && strtolower($orden["estado_pago"]) !== "pagado") {
    $claseFila = "fila-peligro";
}

?>
<tr class="<?php echo $claseFila; ?>">
    <td><?php echo $orden["cliente"]; ?></td>
    <td><?php echo $orden["placa"]; ?></td>
    <td><?php echo $orden["fecha_ingreso"]; ?></td>
    <td><?php echo $orden["tipo"]; ?></td>
    <td><?php echo $orden["observaciones"]; ?></td>
    <td><?php echo $orden["estado_pago"]; ?></td>
    <td><?php echo $orden["fecha_final"]; ?></td>
</tr>
<?php endforeach; ?>

</tbody>
        
    </table>
    <!-- Definición del botón -->
    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalOrden">Agregar Orden de Servicio</button>
</div>


<div class="modal fade" id="modalOrden" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formNuevaOrden">
        <div class="modal-header">
          <h5 class="modal-title">Nueva Orden de Servicio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">

            <!-- Cliente -->
            <div class="mb-2">
                <label class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" name="cliente" required>
                <div class="invalid-feedback">Este campo es obligatorio</div>
            </div>

            <!-- Placa -->
            <div class="mb-2">
                <label class="form-label">Número de Placa</label>
                <input type="text" class="form-control" name="placa" required>
                <div class="invalid-feedback">Este campo es obligatorio</div>
            </div>

            <!-- Fecha de ingreso -->
            <div class="mb-2">
                <label class="form-label">Fecha de Ingreso</label>
                <input type="date" class="form-control" name="fecha_ingreso" required>
                <div class="invalid-feedback">Este campo es obligatorio</div>
            </div>

            <!-- Tipo de servicio -->
            <div class="mb-2">
                <label class="form-label">Tipo de Servicio</label>
                <select class="form-select" name="tipo" required>
                    <option value="">Seleccione</option>
                    <option value="Cambio de aceite">Cambio de aceite</option>
                    <option value="Revisión general">Revisión general</option>
                    <option value="Frenos">Frenos</option>
                    <option value="Suspensión">Suspensión</option>
                    <option value="Sistema eléctrico">Sistema eléctrico</option>
                    <option value="Cambio de llantas">Cambio de llantas</option>
                    <option value="Afinamiento">Afinamiento</option>
                    <option value="Reparación de motor">Reparación de motor</option>
                </select>
                <div class="invalid-feedback">Seleccione un tipo de servicio</div>
            </div>

            <!-- Observaciones -->
            <div class="mb-2">
                <label class="form-label">Observaciones</label>
                <input type="text" class="form-control" name="observaciones">
            </div>

            <!-- Estado del pago -->
            <div class="mb-2">
                <label class="form-label">Estado del Pago</label>
                <select class="form-select" name="estado_pago" required>
                    <option value="">Seleccione</option>
                    <option value="Pagado">Pagado</option>
                    <option value="Pendiente">Pendiente</option>
                </select>
                <div class="invalid-feedback">Este campo es obligatorio</div>
            </div>

            <!-- Fecha de finalización -->
            <div class="mb-2">
                <label class="form-label">Fecha de Finalización</label>
                <input type="date" class="form-control" name="fecha_final">
            </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar Orden</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
