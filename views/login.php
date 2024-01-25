<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Iniciar Sesión</title>
    <!-- Agrega enlaces a tus archivos CSS aquí si los tienes -->
    
</head>
<body style="height: 100vh;" class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="container-sm bg-light p-4 rounded shadow mx-auto" style="max-width: 400px;">
        <div class="text-center">
            <img src="./assets/img/logo-digitalhub.png" alt="Logo de la Empresa" width="150">
            <h1 class="mb-4">Iniciar Sesión</h1>
        </div>
        <form  action="index.php?action=login" method="post">
            <div class="mb-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" id="dni" name="dni" class="form-control" required>
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>

            </div>
        </form>

        <?php if (isset($error)): ?>
            <p class="mt-3 text-danger"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </main>
</body>
</html>
