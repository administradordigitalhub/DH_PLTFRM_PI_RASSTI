<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/head.php"); ?>
    <link href="./assets/style/style.css" rel="stylesheet">
</head>

<body>
    <div style="min-height: 100vh;" class="container-fluid d-flex align-items-center justify-content-center">
        <div class="container-login my-auto">
            <div class="row">
                <div class="col-md-12">
                    <form action="index.php?action=login" method="post">
                        <img src="./assets/img/logo-digitalhub.png" class="rounded img-fluid mx-auto d-block m-b-10px" height="200" width="200" alt="logoDH">
                        <h4 class="col-md-12 text-center m-b-22px">Iniciar Sesión</h4>
                        <label for="exampleFormControlInput1" class="form-label">DNI:</label>
                        <input type="text" id="dni" name="dni"  class="form-control m-b-10px" id="exampleFormControlInput1">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>