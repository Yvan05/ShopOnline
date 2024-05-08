<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'success'): ?>
    <?= Utilities::alert('msj_succes()'); ?>

<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <?= Utilities::alert('msj_missed()'); ?>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'vacio'): ?>
    <?= Utilities::alert('msj_empty()'); ?>
<?php endif; ?>
<?php if (isset($_SESSION['buff'])):
    $data = $_SESSION['buff'];
endif; ?>

<div class="col-sm ">
    <div class="tr-form">
        <?php if (isset($edit) && isset($user) && is_object($user)): ?>
            <h1 class="text-center">
                EDITAR DE USUARIO
            </h1>
            <?php $action_url = base_url . "user/save&id=" . $user->id; ?>
            <?php
            //var_dump($_SESSION);
         
            $val_nom = isset($user) && is_object($user) ? ($user->nombre) : '';
            $val_ap = isset($user) && is_object($user) ? ($user->apellidos) : '';
            $val_rol = isset($user) && is_object($user) ? ($user->rol) : '';
            $val_img = isset($user) && is_object($user) ? ($user->imagen) : '';
            $val_ema = isset($user) && is_object($user) ? ($user->email) : '';
            //los datos son los de la base de datos
            ?>
        <?php else: ?>
            <h1 class="text-center">
                REGISTRO DE USUARIOS
            </h1>
            <?php $action_url = base_url . "user/save"; ?>
        <?php endif; ?>
        <br>
        <div class="container">
            <div class="row justify-content-md-center">
                <form action="<?= $action_url ?>" method="POST" enctype="multipart/form-data">

                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">



                                <label for="name" class="form-label">First name</label>
                                <input style="" type="text" name="name" class="form-control"
                                    value="<?= isset($data['name']) ? ($data['name']) : (isset($edit) ? $val_nom : '') ?>" />
                                <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'name') : ' '; ?>


                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label for="lastname" class="form-label">Last name</label>
                                <input type="text" name="lastname" class="form-control"
                                    value="<?= isset($data['lastname']) ? ($data['lastname']) : (isset($edit) ? $val_ap : '') ?>" />
                                <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'lastname') : ' '; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Text input -->
                    <div   class="form-outline mb-4">
                        <label class="form-label" for="rol">Rol</label>
                        <?php if(isset($_SESSION['admin'])&&isset($edit)): ?>
                            <select class="form-control" type="text"name="rol">

                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                </select>
                                <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'rol') : ' '; ?>
                        <?php else :?>
                        <input <?=isset($edit) ? "readonly" :' ' ?>  class="form-control" type="text" name="rol" value="<?= isset($data['rol']) ? ($data['rol']) : (isset($edit) ? $val_rol : '') ?>"/>
                        
                        <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'rol') : ' '; ?>
                        <?php endif;?>
                    </div>



                    <!-- Email input -->
                    <div  class="form-outline mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input <?=isset($edit) ? "readonly" :' ' ?> type="email" name="email" class="form-control"
                            value="<?= isset($data['email']) ? ($data['email']) :(isset($edit) ? $val_ema : '') ?>" />
                        <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'email') : ' '; ?>
                    </div>
                    <!-- Text input -->
                    <div <?=isset($edit) ? "hidden" :' ' ?> class="form-outline mb-4">
                        <label class="form-label" for="passwd">Password</label>
                        <input type="password" name="passwd" class="form-control"
                            value="<?= isset($data['passwd']) ? ($data['passwd']) :  '' ?>" />
                        <?= isset($_SESSION['error']) ? Utilities::mostrarError($_SESSION['error'], 'passwd') : ' '; ?>
                    </div>
                    <!-- file input-->


                    <div class="form-outline mb-4">
                        <label for="img" class="form-label">Imagen</label>
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