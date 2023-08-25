<?php

include_once "config.php";
include_once "entidades/producto.php";
$pg = "Listado de Productos";

$producto = new Producto();
$aProducto = $producto-> obtenerTodos();



if($_POST){
  if(isset($_POST["btnGuardar"])){
    $nombreImagen = "";
  }
}

include_once("header.php"); 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Listado de Productos</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($aProducto as $Producto): ?>
              <tr>
                  <td><img src="img/<?php echo $Producto->imagen; ?>" class="img-thumbnail"></td>
                  <td><?php echo $Producto->nombre; ?></td>
                  <td><?php echo $Producto->cantidad; ?></td>
                  <td><?php echo $Producto->precio; ?></td>
                  <td style="width: 110px;">
                      <a href="producto-formulario.php?id=<?php echo $Producto->idproducto; ?>"><i class="fas fa-search"></i></a>   
                  </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>