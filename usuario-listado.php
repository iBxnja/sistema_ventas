<?php

include_once "config.php";
$pg = "Listado de usuarios";

include_once "entidades/usuario.php";

$usuario = new Usuario;
$aUsuario = $usuario->obtenerTodos();
$usuario = new Usuario;



include_once("header.php"); 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Listado de usuarios</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="usuario-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($aUsuario as $datos): ?>
              <tr> 
                <td><?php echo $datos->usuario;?></td>
                <td><?php echo $datos->nombre;?></td>
                <td><?php echo $datos->apellido;?></td>
                <td><?php echo $datos->correo;?></td>
                <td style="width: 110px;">
                      <a href="#"><i class="fas fa-search"></i></a>   
                  </td>
              </tr>

              <?php  endforeach; ?>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>