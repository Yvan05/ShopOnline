<!-- MAIN -->
<div class="col-sm">
    <?php if (isset($cat)): ?>
        <h1 class="text-center">
             
            <?= Strtoupper($cat->nombre) ?>
            <small class="text-muted">Ofertas</small>
            <hr>
        </h1>
    <?php if($all_produc_cat->num_rows==0): ?>
                        <h1 class="text-center">
                            NO HAY PRODUCTOS EN ESTA CATEGORIA
                        </h1>

        <?php else: ?>
            <div class="container">
                <div class="row justify-content-md-center">
                    <?php while ($proc = $all_produc_cat->fetch_object()): ?>
                           <div class="col-lg-4">
          <div class="card">
               <span class="percent">-<?= $proc->oferta ?>%</span> 
              <div class="text-center">
                  <br>
                  <a href="<?=base_url?>product/ver&id=<?=$proc->id?>">
                  <img  width="130px" height="150px"  src="<?= base_url ?>productos/img/<?= $proc->imagen ?>">
                </a>
                  </div>
              <div class="card-body">
                  <div class="text-center">
                      <a href="<?=base_url?>product/ver&id=<?=$proc->id?>"><h5 class="card-title"><?=$proc->nombre?></h5></a>
                      <p class="text-muted mb-4"> <?= substr($proc->descripcion, 0, 50) . ' ....' ?></p>
                  </div>
                  <div>
                      <div class="d-flex justify-content-between">
                          <strong>Precio</strong><span class="pricet">$<?=$proc->precio?></span>
                      </div>
                     
                      <div class="d-flex justify-content-between">
                          <span><strong>Stock</strong></span><span><?=$proc->stock?></span>
                      </div>
                  </div>
              </div>
               <div class="card-inner">
               <div class="mt-3 d-flex justify-content-between align-items-center">

                       <button class="btn btn-primary text-uppercase btn-sm details">Comprar</button>

                       <div class="d-flex flex-row">
                            <span class="wishlist"><i class="fa fa-heart"></i></span>
                           <a class="btn btn-success cart" href="<?=base_url?>car/add&id=<?=$proc->id?>"><i class="fa fa-shopping-cart"></i></a>

                       </div>
                   </div>
                </div>
                  
          </div>
              <br>
      </div>        
                    <?php endwhile; ?> 
                </div>
            </div>
        <?php endif; ?>
       
    <?php else: ?>
        <h1 class="text-center">
            LA CATEGORIA NO EXISTE
            <small class="text-muted">Ofertas</small>
            <hr>
        </h1>
    <?php endif; ?>

    <br>
</div>  
<!-- Main Col END END -->