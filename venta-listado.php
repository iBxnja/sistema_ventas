<?php

include_once "config.php";
include_once "entidades/venta.php";
$pg = "listado de ventas";



//nueva venta
$venta = new Venta;
$aVenta = $venta->cargarGrilla();



include_once("header.php"); 

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">listado de ventas</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="venta-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>

            <!--las muestro con el foreach-->
            <?php foreach ($aVenta as $ventas): ?>
            <tr>
                <td><?php echo $ventas->fecha;?></td>
                <td><?php echo $ventas->cantidad;?></td>
                <td><a href="<?php echo $ventas->fk_idproducto ; ?>"><?php echo $ventas->nombre_producto ;?></a></td>
                <td><a href="<?php echo $ventas->fk_idcliente ; ?>"><?php echo $ventas->nombre_cliente ;?></a></td>
                <td><?php echo $ventas->total;?></td>
                <td><a href="venta-listado.php?id=<?php echo $ventas->idventa ;?>"><i class="fas fa-search"></i></a></td>
            </tr> 
            <?php endforeach; ?>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>