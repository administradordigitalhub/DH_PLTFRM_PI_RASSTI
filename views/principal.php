<?php if (isset($data)) extract($data); ?>
<?php
$fecha_actual = date('Y-m-d H:i:s');
$timestamp = strtotime($fecha_actual);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/head.php"); ?>
    <link href="./assets/style/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row margin-10px-0">
            <div class="col-lg-8 col-md-8 col-sm-8 col-12 container-title">
                <h4 class="text-align">REPORTE DE HORAS: SERVICIO DIGITALHUB - SOAINT - WIN</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="row container-info-profile">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container-title-right d-flex align-items-center">
                        <span>Bienvenido <?= htmlspecialchars(strtoupper(isset($usuario) ? ($usuario['nombre'] . ' ' . $usuario['apellido']) : '')) ?> </span>
                        <form action="./utils/cerrar.php" method="post">
                            <button type="submit" id="botonCerrarSesion" class="btn btn-danger btn-sm">Salir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-10px-0">
            <div class="col-md-2 col-lg-2 col-sm-12">
                <div class="row styles-img">
                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                        <img src="./assets/img/logo-digitalhub.png" alt="Logo" class="margin-10px-0 rounded mx-auto d-block max-height-image-120px">
                    </div>
                </div>
                <div class="row styles-img">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-6">
                        <img src="./assets/img/SOAINT.png" alt="Logo" class="margin-10px-0 rounded mx-auto d-block max-height-image-70px">
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-6 col-6">
                        <img src="./assets/img/win.png" alt="Logo" class="margin-10px-0 rounded mx-auto d-block max-height-image-70px">
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-12">
                <?php if (isset($informacionEquipo)) : ?>
                    <div class="row mt-10">
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex container-info-item">
                            <p><strong>CLIENTE FINAL:</strong> </p>
                            <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['cliente_final'])) ?></span>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex container-info-item">
                            <p><strong>CLIENTE INTERMEDIO:</strong></p>
                            <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['cliente_intermedio'])) ?></span>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex container-info-item">
                            <p><strong>ÁREA:</strong> </p>
                            <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['area'])) ?></span>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex container-info-item">
                            <p><strong>NOMBRE DE EQUIPO:</strong> </p>
                            <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['nombre_equipo'])) ?></span>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex container-info-item">
                            <p><strong>LÍDER DE EQUIPO:</strong></p>
                            <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['lider_equipo'])) ?></span>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 d-flex container-info-item">
                            <p><strong>NOMBRE DEL CONSULTOR:</strong> </p>
                            <span class="font-weight-normal"><?= htmlspecialchars(strtoupper($informacionEquipo['nombre_consultor'])) ?></span>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-lg-3 col-md-6 col-6 justify-center-media-575">
                            <button id="botonRegistrar" data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-primary">Registrar Nueva Actividad</button>
                        </div>
                        <div class="col-lg-3 col-md-6 col-6 justify-center-media-575">
                            <button id="botonExportar" class="btn btn-success">Exportar a Excel</button>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead style="text-align: center;">
                                        <tr style="vertical-align: middle">
                                            <th class="th-custom">FECHA INICIO</th>
                                            <th class="th-custom">HORA INICIO</th>
                                            <th class="th-custom">HORA FIN</th>
                                            <th class="th-custom">ESFUERZO (Hrs)</th>
                                            <th class="th-custom">MODALIDAD</th>
                                            <th class="th-custom">ACTIVIDAD/TAREA</th>
                                            <th class="th-custom">SOLICITANTE</th>
                                            <th class="th-custom">RESULTADO</th>
                                            <th class="th-custom">COMENTARIOS</th>
                                            <th class="th-custom">ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($cursos)) : ?>
                                            <?php foreach ($cursos as $curso) : ?>
                                                <tr>
                                                    <?php
                                                    $fechaInicio = new DateTime($curso['fecha_inicio']);
                                                    $fechaFormateadaInicio = $fechaInicio->format('d/m/Y');
                                                    ?>

                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($fechaFormateadaInicio) ?></td>
                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($curso['hora_inicio']) ?></td>
                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($curso['hora_fin']) ?></td>
                                                    <td class="th-custom" style="text-align: right;"><?= number_format((float)$curso['esfuerzo'], 2, '.', ',') ?></td>
                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($curso['modalidad']) ?></td>
                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($curso['actividad_tarea']) ?></td>
                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($curso['solicitante']) ?></td>
                                                    <td class="th-custom" style="text-align: center;"><?= htmlspecialchars($curso['resultado']) ?></td>
                                                    <td class="th-custom" style="text-align: left;"><?= htmlspecialchars($curso['comentarios']) ?></td>
                                                    <td class="th-custom" class="buttons-actions">
                                                        <div class="d-flex gap-10px">
                                                            <button id="btnIdEditar" data-bs-toggle="modal" data-bs-target="#editModal" onclick="mostrar_datos(<?= $curso['id'] ?>)" class="btn btn-primary btn-sm">Editar</button>
                                                            <button id="btnIdEliminar" onclick="eliminar_dato(<?= $curso['id'] ?>)" class="btn btn-danger btn-sm">Eliminar</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="10" class="th-custom" style="text-align: center;">Sin resultados</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row mt-10">
                        <p style="text-align: center;">El usuario no tiene un cliente asignado</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo htmlspecialchars($userId); ?>">
    <div id="editModal" class="modal fade" tabindex="-1" aria-hidden="true">
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="scripts.js?v=<?php echo $timestamp; ?>"></script>

</html>