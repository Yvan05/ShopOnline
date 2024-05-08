 
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'success'): ?>
<?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
 <?= Utilities::alert('msj_missed()'); ?>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'vacio'): ?>
 <?= Utilities::alert('msj_empty()'); ?>
<?php  endif; ?>
<?php
if (isset($_SESSION['buff'])):
$data = $_SESSION['buff'];

endif;
?>
 <div class="card">

   <div class="card-body">
       

    <?php if (isset($edit) && isset($proct) && is_object($proct)): ?>
        
    <h1 class="text-center">EDITAR  PRODUCTOS</h1>
    <?php $action_url = base_url . "product/save&id=" . $proct->id; ?>
    <?php
    $val_nom = isset($proct) && is_object($proct) ? ($proct->nombre) : '';
    $val_pre = isset($proct) && is_object($proct) ? ($proct->precio) : '';
    $val_des = isset($proct) && is_object($proct) ? ($proct->descripcion) : '';
    $val_ofe = isset($proct) && is_object($proct) ? ($proct->oferta) : '';
    $val_stk = isset($proct) && is_object($proct) ? ($proct->stock) : '';
    $val_dat = isset($proct) && is_object($proct) ? ($proct->fecha) : '';
    //los datos son los de la base de datos
    ?>
    <?php else: ?>
    <h1 class="text-center">REGISTRO DE PRODUCTOS</h1>
    <?php $action_url = base_url . "product/save"; ?>
    <?php
    $val_nom = isset($data['name']) ? ($data['name']) : '';
    $val_pre = isset($data['precio']) ? ($data['precio']) : '';
    $val_des = isset($data['desc']) ? ($data['desc']) : '';
    $val_ofe = isset($data['ofer']) ? ($data['ofer']) : '';
    $val_stk = isset($data['stock']) ? ($data['stock']) : '';
    $val_dat = isset($data['date']) ? ($data['date']) : '';
    ?>
    <?php endif; ?>

     <div class="container clearfix">
        <div class="col-md-12 bg-light text-right"><a href="<?= base_url ?>product/gestion" class="btn btn-primary">
                <i class="fa fa-chevron-circle-left"></i> Regresar</a></div>

        <div class="col-md-12">
            <form action="<?= $action_url ?>" method="POST" enctype="multipart/form-data">

                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">                        
                            <label for="name" class="form-label">Nombre</label>
                            <input style="" type="text" name="name" class="form-control" value="<?= $val_nom ?>" />
                            <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'name') : ' '; ?>                                                   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="text" name="precio"class="form-control" value="<?= $val_pre ?>" />
                            <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'precio') : ' '; ?>
                        </div>
                    </div>
                </div>
                
                    <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">                        
                             <label class="form-label" for="desc">Descripcion</label>
                    <input type="text" name="desc" class="form-control" value="<?= $val_des ?>" />
                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'desc') : ' '; ?>                                                  
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="ofer">Oferta</label>
                    <input type="text" name="ofer" class="form-control" value="<?= $val_ofe ?>"/>
                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'ofer') : ' '; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Text input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="cate">Categoria</label>
                    <select type="text" name="cate" class="form-control">
                        <?php $categorys = Utilities::showCategory() ?>
                        <?php while ($cat = $categorys->fetch_object()): ?>
                         <?php if (!isset($edit)):?>
                        
                        <option  value="0" selected disabled hidden>Choose here</option>
                        <?php endif; ?>
                        <option  value="<?= $cat->id ?>" <?=isset($proct)&& is_object($proct)&& $cat->id==$proct->categoria_id  ? 'selected' : '';?> ><?= $cat->nombre ?></option>
                        <?php endwhile; ?>

                    </select> 
                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'cate') : ' '; ?>


                </div>
                 <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">                        
                            <label class="form-label" for="date">Fecha</label>
                    <input type="date" name="date" class="form-control" value="<?= $val_dat ?>"  />
                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'date') : ' '; ?>                                                   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                           <label class="form-label" for="stock">Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?= $val_stk ?>"  />
                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'stock') : ' '; ?>
                        </div>
                    </div>
                </div>
                <div  class="form-outline mb-4">
                    <label for="img" class="form-label">Imagen</label>
                    <?php if(isset($proct) && is_object($proct) &&!empty($proct->imagen)): ?>
                    <img src="<?= base_url ?>productos/img/<?= $proct->imagen ?>" width="100px" height="100px"/>
                    <?php endif; ?>
                    <input class="form-control" name="img" type="file" />
                    <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'img') : ' '; ?>

                </div>
                <!-- Submit button -->

                <button type="submit" class="btn btn-primary btn-block mb-4">Registrar</button>

            </form>

            <?php Utilities::deleteSession('register'); ?>
            <?php Utilities::deleteSession('error'); ?>
            <?php Utilities::deleteSession('buff'); ?>
        </div>
    </div>
</div>
     </div>
 
