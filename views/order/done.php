<?php if (!isset($_SESSION['identity'])): ?>
    <div class="col-sm ">

        <h1 class="text-center">
            Necesitas estar Identificado
        </h1>
        <hr>
    </div>
<?php else: ?>

    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <?= Utilities::alert('msj_missed()'); ?>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'vacio'): ?>
        <?= Utilities::alert('msj_empty()'); ?>
    <?php endif; ?>
    <?php
    if (isset($_SESSION['buff'])):
        $data = $_SESSION['buff'];
    endif;
    ?>



    <div class="card">
        <div class="card-header">
            <h1 class="text-center">
                REGISTRO DE PEDIDO
            </h1>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container clearfix">




                        <div class="col-md-12">

                            <form name="f1" id="orderform" action="<?= base_url ?>order/add" method="POST"
                                enctype="multipart/form-data">
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="pais">Pais</label>
                                    <select name="pais" class="form-control" id="item-details-countryValue">
                                    </select>
                                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'pais') : ' '; ?>

                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-outline">
                                            <label for="estado" class="form-label">Estado</label>
                                            <select name="estado" class="form-control" id="item-details-stateValue">
                                            </select>

                                            <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'estado') : ' '; ?>

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline">

                                            <label for="municipio" class="form-label">Municipio</label>
                                            <select name="municipio" class="form-control" id="item-details-cityValue">

                                            </select>

                                            <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'municipio') : ' '; ?>
                                        </div>
                                    </div>
                                </div>


                                <!-- Text input -->
                                <div class="form-outline mb-4" onchange>
                                    <label class="form-label" for="direccion">Direccion</label>
                                    <input type="text" id="direc" name="direccion" class="form-control"
                                        value="<?= isset($data['direccion']) ? ($data['direccion']) : '' ?>" />
                                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'direccion') : ' '; ?>

                                </div>
                                <input type="text" hidden="" id="Id_paypal" name="Id_paypal" class="form-control" />
                                <input type="text" hidden="" id="Status_paypal" name="Status_paypal" class="form-control" />
                                <input type="text" hidden="" id="emailpay" name="emailpay" class="form-control" />
                                <input type="text" hidden="" id="iduserpay" name="iduserpay" class="form-control" />

                            </form>
                            <?php Utilities::deleteSession('register'); ?>
                            <?php Utilities::deleteSession('error'); ?>
                            <?php Utilities::deleteSession('buff'); ?>
                        </div>
                        <div class="row justify-content-center">
                        
                        <div class="col-md-6 ">
                            <h1 class="text-center">
                                PROCESAR EL PAGO CON PAYPAL
                            </h1> <?php $stats = Utilities::statsCar(); ?>


                            <input type="hidden" id="t_amount" value="<?= $stats['total'] ?>">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"> </div>
                            </div>
                            <script type="text/javascript" src="<?= base_url ?>assets/js/api_paypal.js?2.7"
                                media="all"></script>
                        </div>
                        
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br>
<?php endif; ?>