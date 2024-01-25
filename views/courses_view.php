<?php if (isset($data)) extract($data); ?>
<?php
$fecha_actual = date('Y-m-d H:i:s');
$timestamp = strtotime($fecha_actual);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle del Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./assets/style/styles.css" rel="stylesheet">
</head>



<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div>
                <h3 style="margin: 0">REPORTE DE HORAS: SERVICIO DIGITALHUB - SOAINT - WIN</h3>
            </div>
            <div class="container-welcome-logout">
                <div>
                    <h4 style="margin: 0">Bienvenido
                        <?php if (isset($usuarioVista)) : ?>
                            <?= htmlspecialchars(strtoupper($usuarioVista['nombre'])) ?>
                            <?= htmlspecialchars(strtoupper($usuarioVista['apellido'])) ?>
                        <?php endif; ?>
                    </h4>
                </div>

                <form action="utils/cerrar.php" method="post">
                    <button type="submit" id="botonCerrarSesion" class="btn btn-danger">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        <div class="container-info">
            <div class="col-md-2 col-lg-2 col-sm-12 images">
                <img src="assets/img/logo-digitalhub.png" alt="Logo" class="img-fluid">

                <img src="assets/img/SOAINT.png" alt="Logo" class="img-fluid">

                <img src="assets/img/win.png" alt="Logo" class="img-fluid">
            </div>
            <?php if (isset($informacionEquipo)) : ?>
                <div class="col-md-10 col-lg-10 col-sm-12 info-principal">
                    <div class="font-arial text-left">
                        <p><strong>CLIENTE FINAL:</strong> <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['cliente_final'])) ?></span></p>
                        <p><strong>CLIENTE INTERMEDIO:</strong> <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['cliente_intermedio'])) ?></span></p>
                        <p><strong>ÁREA:</strong> <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['area'])) ?></span></p>
                        <p><strong>NOMBRE DE EQUIPO:</strong> <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['nombre_equipo'])) ?></span></p>
                        <p><strong>LÍDER DE EQUIPO:</strong> <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['lider_equipo'])) ?></span></p>
                        <p><strong>NOMBRE DEL CONSULTOR:</strong> <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['nombre_consultor'])) ?></span></p>
                    </div>
                    <div class="mt-3 container-buttons">
                        <button id="botonRegistrar" class="btn btn-primary">Registrar Nueva Actividad</button>
                        <button id="botonExportar" class="btn btn-success">Exportar a Excel</button>
                    </div>

                    <section>
                        <div class="table-container">
                            <table class="table table-striped">
                                <thead style="text-align: center;">
                                    <tr style = "vertical-align: middle">
                                        <th style="border: 1px solid #ddd; padding: 10px;">FECHA INICIO</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">HORA INICIO</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">HORA FIN</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">ESFUERZO (Hrs)</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">MODALIDAD</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">ACTIVIDAD/TAREA</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">SOLICITANTE</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">RESULTADO</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">COMENTARIOS</th>
                                        <th style="border: 1px solid #ddd; padding: 10px;">ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cursos as $curso) : ?>
                                        <tr>
                                            <?php
                                            $fechaInicio = new DateTime($curso['fecha_inicio']);
                                            $fechaFormateadaInicio = $fechaInicio->format('d/m/Y');
                                            ?>

                                            <td style="text-align: center;"><?= htmlspecialchars($fechaFormateadaInicio) ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($curso['hora_inicio']) ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($curso['hora_fin']) ?></td>
                                            <td style="text-align: right;"><?= number_format((float)$curso['esfuerzo'], 2, '.', ',') ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($curso['modalidad']) ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($curso['actividad_tarea']) ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($curso['solicitante']) ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($curso['resultado']) ?></td>
                                            <td style="text-align: left;"><?= htmlspecialchars($curso['comentarios']) ?></td>
                                            <td class="buttons-actions">
                                                <button id="btnIdEditar" onclick="mostrar_datos(<?= $curso['id'] ?>)" class="btn btn-primary btn-sm">Editar</button>
                                                <button id="btnIdEliminar" onclick="eliminar_dato(<?= $curso['id'] ?>)" class="btn btn-danger btn-sm">Eliminar</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            <?php else : ?>
                <div class="col md-10">
                    <p style="text-align: center;">El usuario no tiene un cliente asignado</p>
                </div>
            <?php endif; ?>
        </div>


        <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo htmlspecialchars($userId); ?>">
        <div id="modalBackdrop"></div>
        <div id="editModal" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="tituloActividad">Editar Actividad</h2>
                        <button type="button" id="botonCancelar" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <input type="hidden" id="cursoId" name="cursoId">
                            <div class="mb-3">
                                <label for="fechaInicio" class="form-label">Fecha Inicio:</label>
                                <input type="date" id="fechaInicio" name="fechaInicio" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="horaInicio" class="form-label">Hora Inicio:</label>
                                <input type="time" id="horaInicio" name="horaInicio" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="horaFin" class="form-label">Hora Fin:</label>
                                <input type="time" id="horaFin" name="horaFin" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="esfuerzo" class="form-label">Esfuerzo (hrs) - EJ. 20, 4.50, 13.00</label>
                                <input type="number" id="esfuerzo" name="esfuerzo" class="form-control" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="modalidad" class="form-label">Modalidad:</label>
                                <select id="modalidad" name="modalidad" class="form-select">
                                    <option value="" disabled selected>SELECCIONE MODALIDAD</option>
                                    <option value="PRESENCIAL">PRESENCIAL</option>
                                    <option value="REMOTO">REMOTO</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="actividadTarea" class="form-label">Actividad/Tarea:</label>
                                <input type="text" id="actividadTarea" name="actividadTarea" class="form-control" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="solicitante" class="form-label">Solicitante:</label>
                                <input type="text" id="solicitante" name="solicitante" list="resultados-list" class="form-control" autocomplete="off" placeholder="Seleccione o escriba">
                                <datalist id="resultados-list">
                                    <option value="NO INFORMADO">
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="resultado" class="form-label">Resultado:</label>
                                <input type="text" id="resultado" name="resultado" list="resultados-list" class="form-control" placeholder="Seleccione o escriba" autocomplete="off">
                                <datalist id="resultados-list">
                                    <option value="PENDIENTE">
                                    <option value="EN DESARROLLO">
                                    <option value="PRUEBAS">
                                    <option value="COMPLETADO">
                                    <option value="RE-ABIERTO">
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="comentarios" class="form-label">Comentarios:</label>
                                <textarea id="comentarios" name="comentarios" class="form-control"></textarea>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" id="botonGuardarCambios" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <script>
        document.getElementById('botonRegistrar').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'block';
            document.getElementById('modalBackdrop').style.display = 'block';
        });
        document.getElementById('btnIdEditar').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'block';
            document.getElementById('modalBackdrop').style.display = 'block';
        });

        document.getElementById('botonCancelar').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('modalBackdrop').style.display = 'none';
        });

        // Inicializar el modal con opciones
        var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
            backdrop: 'static',
            keyboard: false
        });
    </script>
    <script src="scripts.js?v=<?php echo $timestamp; ?>"></script>

</body>

</html>