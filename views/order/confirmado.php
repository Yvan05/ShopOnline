<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'success'): ?>
<?= Utilities::alert('msj_succes()'); ?>
<?php endif; ?>
<div class="container clearfix">

    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">
                DATOS DE PEDIDO 

            </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if (isset($pedido)): ?> 

                <h4 class="card-title text-center">Detalles del pedido</h4>
                <p class="card-description text-center">Tu pedido ha sido registrado correctamente ,puedes visualizarlo en Mis pedidos</p>
                <div class="template-demo">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="pl-0">#No Pedido:</th>
                                <th class="pr-0 text-right"><?= $pedido->id ?></th>
                            </tr>
                            <tr>
                                <th class="pl-0">#No Tranferencia:</th>
                                <th class="pr-0 text-right"><?= $paypal->payment_id ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="pl-0">Total a pagar:</td>
                                <td class="pr-0 text-right"><?= $pedido->coste ?></td>
                            </tr>


                            <tr>
                                <td class="pl-0">Estatus de envio:</td>
                                <td class="pr-0 text-right"><div class="badge badge-danger badge-pill"><?= Utilities::status($pedido->status) ?></div></td>
                            </tr>
                            <tr>
                                <td class="pl-0">Estatus de Pago:</td>
                                <td class="pr-0 text-right"><div class="badge badge-success badge-pill"><?= $paypal->payment_status ?></div</td>
                            </tr>
                            <tr>
                                <td class="pl-0">Usuario:</td>
                                <td class="pr-0 text-right"><div class="badge badge-success badge-pill"><?= $_SESSION['identity']->nombre ?></div</td>
                            </tr>
                            <tr>
                                <td class="pl-0">Destino:</td>
                                <td class="pr-0 text-right"><div class="badge badge-warning badge-pill"><?= $pedido->direccion ?></div></td>
                            </tr>

                        </tbody>
                    </table>
                    <br>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($producto = $productos->fetch_object()): ?> 
                            <tr>
                                <td><a href="<?= base_url ?>product/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>
                                <td><?= $producto->precio ?></td>
                                <td><?= $producto->unidades ?></td>

                            </tr>
                            <?php endwhile; ?> 
                        </tbody>
                    </table>

                </div>
                <br>
                <div class="pull-right">
                    <?php if(isset($_GET['id'])): ?>
                    <a target="_blank" href="<?= base_url ?>order/factura&id=<?= $pedido->id ?>" class="btn btn-primary"><i class="fa fa-print"> Generar recibo </i></a>

                    <?php else: ?>
                    <a target="_blank" href="<?= base_url ?>order/factura" class="btn btn-primary"><i class="fa fa-print"> Generar recibo </i></a>

                    <?php endif; ?>      
                </div>
            </div>
        </div>

        <?php else: ?> 
        <h1 class="text-center">
            NO TIENES NINGUN PEDIDO 
        </h1>

        <?php endif; ?> 
        <?php Utilities::deleteSession('register'); ?>

    </div>
</div>
