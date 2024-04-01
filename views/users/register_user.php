  
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'success'): ?>
<?= Utilities::alert('msj_succes()'); ?>
    
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <?= Utilities::alert('msj_missed()'); ?>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'vacio'): ?>
    <?= Utilities::alert('msj_empty()'); ?>
<?php endif; ?>
<?php if(isset($_SESSION['buff'])):
      $data=$_SESSION['buff'];
endif;?>

<div class="col-sm ">
  <div class="tr-form">
    <h1 class="text-center">
        REGISTRO DE USUARIOS
    </h1>
    <br>
    <div class="container">
        <div class="row justify-content-md-center">
            <form action="<?= base_url ?>user/save" method="POST" enctype="multipart/form-data">
               
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                          
                               
                        
                            <label for="name" class="form-label">First name</label>
                            <input style="" type="text" name="name" class="form-control" value="<?= isset($data['name']) ? ($data['name']) : '' ?>" />
                            <?=  isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'name') : ' '; ?>
                           
                               
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" name="lastname"class="form-control" value="<?= isset($data['lastname']) ? ($data['lastname']) : '' ?>" />
                              <?=  isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'lastname') : ' '; ?>
                        </div>
                    </div>
                </div>
                <!-- Text input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="rol">Rol</label>
                    <input type="text" name="rol" class="form-control" value="<?= isset($data['rol']) ? ($data['rol']) : '' ?>" />
                      <?=  isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'rol') : ' '; ?>
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= isset($data['email']) ? ($data['email']) : '' ?>"/>
                      <?=  isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'email') : ' '; ?>
                </div>
                <!-- Text input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="passwd">Password</label>
                    <input type="password" name="passwd" class="form-control" value="<?= isset($data['passwd']) ? ($data['passwd']) : '' ?>"  />
                      <?=  isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'passwd') : ' '; ?>
                </div>
                <!-- file input-->
                 
                
                <div  class="form-outline mb-4">
                   <label for="img" class="form-label">Imagen</label>
                    <input class="form-control" name="img" type="file" />
                    <?=  isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'img') : ' '; ?>
                              
                </div>
                <!-- Submit button -->

                <button type="submit" class="btn btn-primary btn-block mb-4">Registrar</button>

            </form>
            
<?php Utilities::deleteSession('register');?>
<?php Utilities::deleteSession('error');?>
<?php Utilities::deleteSession('buff');?>
        </div>
    </div>
</div>
</div>

