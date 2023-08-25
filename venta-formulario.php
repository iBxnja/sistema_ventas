<?php

include_once "config.php";
include_once "entidades/venta.php";
include_once "entidades/cliente.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";
$pg = "Venta Formulario";



$venta = new Venta();
$aVenta = $venta->obtenerTodos();

$venta = new Venta();
$venta->cargarFormulario($_REQUEST);


$cliente = new Cliente();
$aCliente = $cliente->obtenerTodos();

$pruducto = new Producto();
$aPruducto = $pruducto->obtenerTodos();



if($_POST){
    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
              //Actualizo un  registro existente 
              $venta->actualizar();
        } else {
            //Es nuevo
            $venta->insertar();
        }
    } else if(isset($_POST["btnBorrar"])){
        $venta->eliminar();
        header("Location: venta-listado.php");
    }
} else if(isset($_REQUEST["id"])){
    $venta->obtenerPorId();
}

if(isset($_REQUEST["id"])){
    $venta->obtenerPorId();
}

if(isset($_GET["do"]) && $_GET["do"] == "buscarProducto"){
    $aResultado = array();
    $idProducto = $_GET["id"];
    $producto = new Producto();
    $producto->idproducto = $idProducto;
    $producto->obtenerPorId();
    $aResultado["precio"] = $producto->precio;
    $aResultado["cantidad"] = $producto->cantidad;
    echo json_encode($aResultado);
    exit;
}




include_once("header.php"); 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Venta</h1>
          <div class="row">
                <div class="col-12 mb-3">
                    <a href="venta-listado.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="usuario-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" name="btnGuardar" id="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger mr-2" name="btnBorrar" id="btnBorrar">Borrar</button>
                </div>
            </div>
          <table class="table table-hover border">
            <tr>
                <div class="row">
                    <div class="col-6">
                        <h4>Fecha y hora</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                    <select name="txtDia" id="txtDia" class="form-control">
                        <?php
                            for($dia = 1; $dia <= 31; $dia++){
                                echo "<option value='$dia'>" . $dia . '</option>';
                        }?>
                    </select>
                    </div>
                    <div class="col-2">
                    <select name="txtMes" id="txtMes" class="form-control">
                        <option value="01">Enero</option>
                        <option value="02">febrero</option>
                        <option value="03">marzo</option>
                        <option value="04">abril</option>
                        <option value="05">mayo</option>
                        <option value="06">junio</option>
                        <option value="07">julio</option>
                        <option value="08">agosto</option>
                        <option value="09">septiembre</option>
                        <option value="10">octubre</option>
                        <option value="11">noviembre</option>
                        <option value="12">diciembre</option>
                    </select>
                    </div>
                    <div class="col-2">
                    <select name="txtAnio" id="txtAnio" class="form-control">
                        <?php
                            for($anio = 2023; $anio <= date("Y")+1; $anio++){
                                echo "<option value='$anio'>" . $anio . "</option>";
                        }?>
                    </select>
                    </div>
                    <div class="col-2">
                        <input type="time" name="txtHora" id="txtHora" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-4">
                        <label for="txtCliente">Cliente:</label>
                        <select name="txtCliente" id="txtCliente" class="form-control">
                            <option selected disabled>Seleccionar</option>
                            <?php foreach($aCliente as $clientesito): ?>
                                <option value="<?php echo $clientesito->idcliente ; ?>"><?php echo $clientesito->nombre ; ?></option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                    <div class="col-6 my-4">
                        <label for="lstProducto">Producto:</label>
                        <select name="lstProducto" id="lstProducto" class="form-control" onchange="fBuscarPrecio()";>
                            <option selected disabled>Seleccionar</option>
                            <?php foreach($aPruducto as $productito): ?>
                                <option value="<?php echo $productito->idproducto ; ?>"><?php echo $productito->nombre ; ?></option>
                            <?php endforeach ; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-4">
                        <label for="txtPrecioUnitario">Precio unitario:</label>
                        <input type="text" class="form-control" id="txtPrecioUniCurrency" value="$ <?php echo $venta->preciounitario; ?>" disabled>
                        <input type="hidden" name="txtPrecioUnitario" id="txtPrecioUnitario" class="form-control">
                    </div>
                    <div class="col-6 my-4">
                        <label for="txtCantidad">Cantidad:</label>
                        <input type="text" name="txtCantidad" id="txtCantidad" class="form-control" onchange="fPrecioTotal()";>
                        <input type="hidden" name="txtCantidad" id="txtCantidad" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 my-4">
                    <label for="txtTotal">Total:</label>
                    <input type="text" name="txtTotalCurrency" id="txtTotalCurrency" class="form-control" disabled>
                    <input type="hidden" name="txtTotal" id="txtTotal" class="form-control">
                    </div>
                </div>
            </tr>
          </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php include_once("footer.php"); ?>

<script>
function fBuscarPrecio(){
    let idProducto = $("#lstProducto option:selected").val();
      $.ajax({
            type: "GET",
            url: "venta-formulario.php?do=buscarProducto",
            data: { id:idProducto },
            async: true,
            dataType: "json",
            success: function (respuesta) {
                let strResultado = Intl.NumberFormat("es-AR", {style: 'currency', currency: 'ARS'}).format(respuesta.precio);
                //let strResultado = Intl.NumberFormat("es-CO", {style: 'currency', currency: 'COP'}).format(respuesta.precio);
                //let strResultado = Intl.NumberFormat("es-ES", {style: 'currency', currency: 'EUR'}).format(respuesta.precio);
                $("#txtPrecioUniCurrency").val(strResultado);
                $("#txtPrecioUnitario").val(respuesta.precio);
            }
        });
}

function fPrecioTotal(){
    //encierro en variables
    let precioUnitario = $("#txtPrecioUnitario").val();
    let cantidad = $("#txtCantidad").val();
    //declaro otra variable que es igual a precioUnitario * cantidad.
    let resultado = precioUnitario * cantidad;
    //lo guardo en el input hidden que va a la base de datos.
    $("#txtTotal").val(resultado);
    //lo formateo.
    let strResultado = Intl.NumberFormat("es-AR", {style: 'currency', currency: 'ARS'}).format(resultado);
    //lo muestro formateado en el input Currency.
    $("#txtTotalCurrency").val(strResultado);
}


</script>