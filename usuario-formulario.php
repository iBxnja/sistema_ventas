<?php

include_once "config.php";
include_once "entidades/usuario.php";

$pg = "Usuario Formulario";

$usuario = new Usuario();
$usuario->cargarFormulario($_REQUEST);

if($_POST){
    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
              //Actualizo un  registro existente
              $usuario->actualizar();
        } else {
            //Es nuevo
            $usuario->insertar();
            header("Location: usuario-formulario.php");
        }
    } else if(isset($_POST["btnBorrar"])){
        $usuario->eliminar();
        header("Location: usuario-listado.php");
    }
} else if(isset($_REQUEST["id"])){
    $usuario->obtenerPorId();
}


include_once("header.php"); 

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Usuario</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="usuario-listado.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="usuario-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" name="btnGuardar" id="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger mr-2" name="btnBorrar" id="btnBorrar">Borrar</button>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <div class="row">
                    <div class="col-6 my-3">
                        <label for="txtUsuario">Usuario:</label>
                        <input type="text" name="txtUsuario" id="txtUsuario" class="form form-control">
                    </div>
                    <div class="col-6 my-3">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form form-control">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-6 my-3">
                        <label for="txtApellido">Apellido:</label>
                        <input type="text" name="txtApellido" id="txtApellido" class="form form-control">
                    </div>
                    <div class="col-6 my-3">
                        <label for="txtCorreo">Correo:</label>
                        <input type="email" name="txtCorreo" id="txtCorreo" class="form form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-3">
                        <label for="txtClave">Clave:</label>
                        <input type="password" name="txtClave" id="txtClave" class="form form-control">
                    </div>
                    
                </div>
            </tr>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>