<?php

include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";
include_once "entidades/cliente.php";

$pg = "Producto formulario";

$producto = new Producto();
$producto->cargarFormulario($_REQUEST);
$tipoProducto = new Tipoproducto();
$aTipoProducto = $tipoProducto->obtenerTodos();

$cliente = new Cliente();
$aCliente = $cliente->obtenerTodos();






if($_POST){
    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
              //Actualizo un  registro existente 
              $producto->actualizar();
        } else {
            //Es nuevo
            $producto->insertar();
        }
    } else if(isset($_POST["btnBorrar"])){
        $producto->eliminar();
        header("Location: producto-listado.php");
    }
} else if(isset($_REQUEST["id"])){
    $producto->obtenerPorId();
}


if(isset($_REQUEST["id"])){
    $producto->obtenerPorId();
    //print_r($producto);
    //exit;
}




//incluye el html
include_once("header.php"); 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Producto Formulario</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="producto-listado.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <div class="row">
                    <div class="col-6 my-3">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control" value="<?php echo $producto->nombre;?>">
                    </div>
                    <div class="col-6 my-3">
                        <label for="lstTipoProducto">Tipo de producto:</label>
                        <select name="lstTipoProducto" id="lstTipoProducto" class="form-control">
                             <option value="" disabled selected>Seleccionar</option> 

                            <!-- recorro TipoProducto->obtenerTodos(); -->
                             <?php foreach($aTipoProducto as $tipo): ?>
                                
                                <!--si $producto(producto.php) -> la "fk" idtipoproducto es 
                                    igual a "idtipoproducto"(tipoProducto.php) de tipo producto -->
                                    <?php if($producto->fk_idtipoproducto == $tipo->idtipoproducto): ?>
                                        
                                        <!--entonces imprimime un option con el value de "idtipoproducto"(tipoProducto.php), que este
                                            seleccionado y que figure el "nombre"(tipoProducto.php)-->
                                        <option value="<?php echo $tipo->idtipoproducto; ?>" selected><?php echo $tipo->nombre ;?></option>
                                        
                                        <!--sino no imprime nada(vacio)-->
                                        <?php else: ?>
                                            
                                            <!--tambien me muestra los demas tipos de productos-->
                                    <option value="<?php echo $tipo->idtipoproducto?>"><?php echo $tipo->nombre ; ?></option>
                                    <?php endif; ?>
                            <?php endforeach; ?>
                        </select>





                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-3">
                        <label for="txtCantidad">Cantidad:</label>
                        <input type="text" name="txtCantidad" id="txtCantidad" class="form-control" value="<?php echo $producto->cantidad ; ?>">
                    </div>
                    <div class="col-6 my-3">
                        <label for="txtPrecio">Precio:</label>
                        <input type="text" name="txtPrecio" id="txtPrecio" class="form-control" placeholder="0" value="<?php echo $producto->precio ; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="txtDescripcion">Descripción:</label>
                        <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="10" class="form-control" ><?php echo $producto->descripcion ; ?></textarea>
                        <script>
                            ClassicEditor
                                .create( document.querySelector( '#txtDescripcion' ) )
                                .catch( error => {
                                console.error( error );
                                } );
                        </script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="imagen" class="control-label">imagen:</label>
                        <input type="file" name="imagen" id="imagen" class="file" accept=".jpg, .jpeg, .png">
                    </div>
                </div>
            </tr>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>