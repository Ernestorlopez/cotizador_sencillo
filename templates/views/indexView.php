<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizador App</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">
</head>

<body>
    <!-- Inicio NAVBAR -->
    <header data-bs-theme="dark">
        <div class="collapse text-bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4>Nosotros</h4>
                        <p class="text-body-secondary">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4>Contacto</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white">Twitter</a></li>
                            <li><a href="#" class="text-white">Facebook</a></li>
                            <li><a href="#" class="text-white">Email</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>Cotizador App</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>
    <!-- Termina NAVBAR -->
    <!-- Inicio Contenido -->
    <div class="container-fluid py-5">
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
                        <form action="">
                            <div class="form-group row">
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
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="0,00" required>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Agregar concepto</button>
                            <button class="btn btn-damger" type="reset">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">Resumen de cotización</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-borderer">
                                <thead>
                                    <tr>
                                        <td>Concepto</td>
                                        <td>Cantidad</td>
                                        <td>Precio</td>
                                        <td class="text-right">Subtotal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Playera</td>
                                        <td>1</td>
                                        <td>$399,00</td>
                                        <td class="text-right">$399,00</td>
                                    </tr>
                                    <tr>
                                        <td>Guitarra</td>
                                        <td>2</td>
                                        <td>$250,00</td>
                                        <td class="text-right">$500,00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="3">Subtotal</td>
                                        <td class="text-right">$123,00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="3">Impuestos</td>
                                        <td class="text-right">$123,00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="3">Envio</td>
                                        <td class="text-right">$50,00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><b>Total</b><h3 class="text-success"><b>$799,00</b></h3></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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

    <!-- Inicio Footer -->
    <footer class="bg-light text-body-secondary py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Arriba</a>
            </p>
            <p class="mb-0"><a href="/">Cotizador App</a> Todos los derechos reservados &copy; <?php echo date('Y')?>.</p>
        </div>
    </footer>
    <!-- Termina Footer -->
    <!-- Inicio Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- Termina Scripts -->
</body>

</html>