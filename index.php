<html  lang="en">
    <head>
        <title>Inicio Sesion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./librerias/css/main.css" rel="stylesheet" type="text/css"/>
        <link href="./librerias/css/style-login.css" rel="stylesheet" type="text/css"/>
        <link  rel="icon"   href="./librerias/img//icono.png" type="image/png" />
    </head>

    <style>
        body {
            color: #999;
            background: #f5f5f5;
            background-image: url('./librerias/img/wood_1.png');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
        }
    </style>
    <?php
    session_start();
    if (isset($_SESSION["usuario"])) {
        header("location: ./PagMisVentas.php");
    }
    ?>
    <body class="login" >
        <div class="login-form">

            <form action="controlador/ControlUsuario.php"  method="post">
                <div class="avatar">
                    <img src="librerias/img/user.png" alt=""/>
                </div>

                <h2 class="text-center">Iniciar Sesion</h2>  
                <?php
                if (isset($_SESSION["error"]) && $_SESSION["error"] == 1) {
                    $_SESSION["error"] = 0;
                    ?>
                    <div align="center" class="col-sm-12">
                        <div role='alert' class="alert alert-danger" >
                            Usuario y/o Clave incorrecto
                        </div>
                    </div>
                    <?php
                }
                ?>

                <!--
                         <div align="center" class="col-sm-12">
                             <div role='alert' th:if="${param.error}" class="alert alert-danger" >
                                 Usuario y/o Clave incorrecto
                             </div>
                             <div role='alert' th:if="${param.logout}" class="alert alert-success" >
                                 Sesion cerrada correctamente
                             </div>
         
                         </div>
                -->
                <div class="form-group">
                    <input type="text"  class="form-control" name="username" id="username" placeholder="Username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" required="required">
                </div>        
                <div class="form-group">
                    <input type="hidden" name="accion" value="iniciar">
                    <button type="submit" class="btn btn-info btn-lg btn-block">Ingresar</button>
                </div>

            </form>
        </div>


    </body>
</html>