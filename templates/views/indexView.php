<?php require_once INCLUDES . 'head.php' ?>
<?php require_once INCLUDES . 'navbar.php' ?>
<!-- Inicio Contenido -->
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-12 wrapper_notifications">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="card mb-3">
                <div class="card-header">Información del Cliente</div>
                <div class="card-body">
                    <form action="">
                        <div class="form-group row">
                            <div class="col-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre del cliente" name="nombre" id="nombre" required>
                            </div>
                            <div class="col-4">
                                <label for="empresa">Empresa</label>
                                <input type="text" class="form-control" placeholder="Empresa del cliente" name="empresa" id="empresa" required>
                            </div>
                            <div class="col-4">
                                <label for="email">E-mail</label>
                                <input type="text" class="form-control" placeholder="E-mail del cliente" name="email" id="email" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Agregar nuevo concepto</div>
                <div class="card-body">
                    <form id="add_to_quote" method="POST">
                        <div class="form-group row pb-4">
                            <div class="col-3">
                                <label for="concepto">Concepto</label>
                                <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Artículo" required>
                            </div>
                            <div class="col-3">
                                <label for="tipo">Tipo de producto</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="producto">Producto</option>
                                    <option value="servicio">Servicio</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" max="99999" value="1" required>
                            </div>
                            <div class="col-3">
                                <label for="precio_unitario">Precio unitario</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="0,00" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Agregar concepto</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="wrapper_update_concept" style="display: none;">
                <div class="card mb-2">
                    <div class="card-header">Editar concepto</div>
                    <div class="card-body">
                        <form id="save_concept" method="POST">
                            <input type="hidden" name="id_concepto" id="id_concepto">
                            <div class="form-group row pb-4">
                                <div class="col-3">
                                    <label for="concepto">Concepto</label>
                                    <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Artículo" required>
                                </div>
                                <div class="col-3">
                                    <label for="tipo">Tipo de producto</label>
                                    <select name="tipo" id="tipo" class="form-control">
                                        <option value="producto">Producto</option>
                                        <option value="servicio">Servicio</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" max="99999" value="1" required>
                                </div>
                                <div class="col-3">
                                    <label for="precio_unitario">Precio unitario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="0,00" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Guardar cambios</button>
                            <button class="btn btn-danger" type="reset" id="cancel_edit">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Resumen de cotización <button class="btn btn-danger float-end restart_quote">Reiniciar</button></div>
                <div class="card-body wrapper_quote">

                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Descargar PDF</button>
                    <button class="btn btn-success">Enviar por correo</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Termina Contenido -->
<?php require_once INCLUDES . 'footer.php' ?>