<!---->
<?php if (isset($_SESSION['car']) && count($_SESSION['car']) >= 1): ?>
    <?php Utilities::rutaActual(); ?>
   <div class="container clearfix">

        <!-- Shopping cart table -->
        <div class="row">
            <div class="col-lg-12">      
                <div class="card">


            <div class="card-header">
                 
                <h2>Shopping Cart</h2>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                        <table class="table table-bordered m-0">
                            <thead>
                               
                                <tr>
                                    <!-- Set columns width -->
                                    <th class="text-center py-3 px-4" style="min-width: 230px;">Product Name &amp; Details</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;">Price</th>
                                    <th class="text-center py-3 px-4" style="width: 150px;">Quantity</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php foreach ($carrito as $indice => $elemento):
                                               $producto = $elemento['producto'];
                                               $toalprice=$producto->precio*$elemento['cantidad'];
                                               ?>
                                <tr>
                                    <td class="p-4">
                                        <div class="media align-items-center">
                                            <a href="<?= base_url ?>product/ver&id=<?= $producto->id ?>"><img src="<?= base_url ?>productos/img/<?= $producto->imagen ?>" class="d-block ui-w-40 ui-bordered mr-4" alt=""></a>
                                            <div class="media-body">
                                                <a href="<?= base_url ?>product/ver&id=<?= $producto->id ?>" class="d-block text-dark"><?= $producto->nombre ?></a>
                                                <small>
                                                    <span class="text-muted">Descripcion: </span><?= substr($producto->descripcion, 0, 55) . ' ....' ?>
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-right font-weight-semibold align-middle p-4">$<?= $producto->precio ?></td>
                                    <td class="text-center font-weight-semibold align-middle p-4">
                                        <div class="quantity" data-trigger="spinner">
                                          
                                             <a href="<?=base_url?>car/down&index=<?=$indice?>" class="btn pull-left hover"  ><i class="fa fa-minus"></i></a>
                                            <input type="numbre" name="cant"  value="<?= $elemento['cantidad']?>" disabled  />
                                              <?=isset($_SESSION['error'])? Utilities::mostraralert($_SESSION['error']['stockup']): '';?>
                                            <a href="<?=base_url?>car/up&index=<?=$indice?>" class="btn pull-right hover" ><i class="fa fa-plus"></i></a>
                                           
                                           </div>
                                     
                                            
                                    </td>
                                    <?php $stats = Utilities::statsCar(); ?>
                                    <td class="text-right font-weight-semibold align-middle p-4">$<?=$toalprice?></td>
                                    <td class="text-center align-middle px-0"><a href="<?= base_url ?>car/remove&index=<?= $indice ?>" class="close float-none btn-del"><span class="fa fa-times"></span>&nbsp;</a></td>
                                </tr>
                                <?php endforeach; ?>
                                 
                               
                            </tbody>
                        </table>
    
                </div>

                <!-- / Shopping cart table -->

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="mt-4">
                        <label class="text-muted font-weight-normal">Promocode</label>
                        <input type="text" placeholder="ABC" class="form-control">
                    </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="text-right mt-4 mr-2">
                            <label class="text-muted font-weight-normal m-0">Items</label>
                            <div class="text-large"><strong><?=$stats['count']?></strong></div>
                        </div>
                        <div class="text-right mt-4 mr-2">
                            <label class="text-muted font-weight-normal m-0">Subtotal</label>
                            <div class="text-large"><strong>$<?= $stats['subtotal'] ?></strong></div>
                        </div>
                        <div class="text-right mt-4 mr-2">
                            <label class="text-muted font-weight-normal m-0">Descuento</label>
                            <div class="text-large"><strong>-$<?= $stats['oferta'] ?></strong></div>
                        </div>
                        <div class="text-right mt-4 mr-2">
                            <label class="text-muted font-weight-normal m-0">Total price</label>
                                <div class="text-large"><strong>$<?= $stats['total'] ?></strong></div>
                        </div>
                    </div>
                    
                    
                 
                </div>
             
       
                
                
                  
            </div>
            <div class="card-footer text-center">
                   <div class="float-left">
                    <a href="<?=base_url?>" class="btn btn-success btn-sm"><span class="fa fa-arrow-left"></span>&nbsp;Continuar</a>
               </div>

                <div class="float-right">
                    <a href="<?= base_url ?>car/delete_all" class="btn btn-danger btn-sm "><span class="fa fa-trash-o"></span>&nbsp;Delete</a>
                    
                            <a href="<?= base_url ?>order/done" class="btn btn-primary btn-sm"><span class="fa fa-credit-card"></span>&nbsp;Buy</a>
                     


                   
                </div>
 
  </div>

        </div>
            </div>
     
        </div>
  
    </div>
<?php Utilities::deleteSession('error');?>
<?php else: ?>
    <div class="container px-3 my-5 clearfix">

        <!-- Shopping cart table -->
        <div class="card">


            <div class="card-header">
                <h2>Shopping Cart</h2>

            </div>
            <div class="card-body">

              

                <!-- / Shopping cart table -->

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="mt-4">
                        <label class="text-muted font-weight-normal">Promocode</label>
                        <input type="text" placeholder="ABC" class="form-control">
                    </div>
                    <div class="d-flex">
                        <div class=" mt-4 mr-5">
                            <label class="text-muted font-weight-normal m-0">Subtotal</label>
                            <div class="text-large"><strong>$0</strong></div>
                        </div>
                        <div class="mt-4 mr-5">
                            <label class="text-muted font-weight-normal m-0">Descuento</label>
                            <div class="text-large"><strong>-$0</strong></div>
                        </div>
                        <div class="mt-4 mr-5">
                            <label class="text-muted font-weight-normal m-0">Total price</label>
                            <div class="text-large"><strong>$0</strong></div>
                        </div>
                    </div>
                </div>
                <div class="float-left">
                    <a href="<?= base_url ?>" class="btn btn-success"><span class="fa fa-arrow-left"></span>&nbsp;Continuar comprando</a>

                </div>

            </div>

        </div>
    </div>

<?php endif; ?>

<?php if(isset($_SESSION['login'])): ?>
<?php require_once "views/modales/modal_login.php"; ?>

<?= Utilities::alert('msj_identity()'); ?>
<?php Utilities::deleteSession('login'); ?>

<?php endif; ?>