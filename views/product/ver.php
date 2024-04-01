 <div class="container  clearfix">
    <?php if (isset($proct)): ?>
       <?php Utilities::rutaActual(); ?>
    <div class="card">
        <div class="card-header">
                <h2>DETALLES DEL PRODUCTO</h2>

            </div>
        <div class="card-body">
            <h2 class="card-title"><?= $proct->nombre ?></h2>
            <h6 class="card-subtitle">CODIGO#<?=$proct->categoria_id ?>_<?= $proct->id ?></h6>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="white-box text-center"><img src="<?= base_url ?>productos/img/<?= $proct->imagen ?>" class="img-responsive"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <h3 class="box-title mt-5">Descripcion del producto</h3>
                    <p><?= $proct->descripcion ?></p>
                    <h2 class="mt-5">
                        $<?= $proct->precio ?><small class="text-success">(<?=$proct->oferta?>%)</small>
                    </h2>
                    <a href="<?=base_url?>car/add&id=<?=$proct->id?>&añadirver" class="btn btn-success btn-rounded mr-1" data-toggle="tooltip"  data-original-title="Add to cart">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <a href="<?=base_url?>car/add&id=<?=$proct->id?>" class="btn btn-primary btn-rounded">Comprar</a>
                    <h3 class="box-title mt-5">Caracteristicas</h3>
                    <ul class="list-unstyled">
                        <?php $categorias = Utilities::shownameCategory($proct->categoria_id);?>
                        <li><i class="fa fa-check text-success"></i>Stock disponible <?= $proct->stock?></li>
                        <li><i class="fa fa-check text-success"></i>Categoria: <?=$categorias->nombre?></li>
                       
                    </ul>
                </div>
              
            </div>
        </div>
         <div class="card-footer text-center">
                   <div class="float-right">
                    <a href="<?=base_url?>" class="btn btn-success btn-sm"><span class="fa fa-arrow-left"></span>&nbsp;Continuar</a>
               </div>
         </div>
    </div>
     <?php if(isset($_SESSION['añadido'])): ?>
<?= Utilities::alert('msj_añadido()'); ?>
<?php Utilities::deleteSession('añadido'); ?>
     <?php endif; ?>
      <?php else: ?>
        <h1 class="text-center">
            NO EXISTE

            <hr>
        </h1>
    <?php endif; ?>
</div>