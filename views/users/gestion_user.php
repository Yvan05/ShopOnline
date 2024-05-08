<div class="container clearfix">

    <!-- perfil -->
    <div class="card ">
        <div class="card-header">
            <?php if (isset($_GET['id'])&&$_SESSION['identity']->rol='admin'):?>
                <h1 class="text-center">
                    PERFIL DE USUARIOS
                </h1>
            <?php elseif ( isset($_SESSION['identity'])):
                $user = $_SESSION['identity']; ?>
                <h1 class="text-center">
                    MI PERFIL DE USUARIO
                </h1>
            <?php endif; ?>
        </div>
        <div class="card-body">


            <form id="userEdit" class="user">


                <div class="row justify-content-center">

                    <div class="col-xl-10 col-lg-12 col-md-9">

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label id="lbl_nom">Nombre</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input type="text" disabled class="form-control form-control-registro"
                                                placeholder="nombre" name="first_name" value="<?= $user->nombre ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label id="lbl_app">Apellidos</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input type="text" disabled class="form-control form-control-registro"
                                                name="last_name" placeholder="apellido paterno"
                                                value="<?= $user->apellidos ?>">
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="form-group row">
                                        <div class="col-lg-3">
                                            <label id="lbl_pass">Contraseña</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="col-sm-10 mb-3 mb-sm-0">
                                                <input  type="password" disabled class="form-control form-control-registro "
                                                    placeholder="********" name="password" value="<?= $user->password ?>">
                                            </div>
                                        </div>
                                    </div>-->
                                <div hidden class="form-group row">
                                    <div class="col-lg-3">
                                        <label id="lbl_passcon">Confirmar</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-registro "
                                                placeholder="********">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label id="lbl_red">Email</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input type="text" disabled class="form-control form-control-registro "
                                                id="disableid" name="social_network" value="<?= $user->email ?>"
                                                placeholder="https://www.facebook.com/profile/user1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label id="lbl_red">Rol</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                            <input type="text" disabled class="form-control form-control-registro "
                                                name="social_network" value="<?= $user->rol ?>"
                                                placeholder="https://www.facebook.com/profile/user1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div id="preview"></div>
                                    <div class="col-lg-3">
                                        <label id="lbl_img">Imagen</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="col-sm-10 mb-3 mb-sm-0">

                                            <div class="input-group mb-2">
                                                <input type="file" disabled class="form-control form-control-registro"
                                                    name="file" value="">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <a href="#" style="color:#4A4949;">
                                                            <i class="fa fa-fw fa-image">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-5">

                                <div class="form-group row">
                                    <?php if (isset($user) && is_object($user) && !empty($user->imagen)): ?>
                                        <img class="img-responsive img-rounded" src="<?= base_url ?>profile/img/<?= $user->imagen ?>" alt="">
                                    <?php else: ?>
                                        <img class="img-responsive img-rounded" src="<?= base_url ?>assets/img/DefaultUser.png" alt="">
                                    <?php endif; ?>

                                    
                                    





                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row justify-content-center">
                            <a href="<?= base_url ?>user/edit&id=<?= $user->id ?>" class="btn btn-primary">
                                <i class="fa fa-pencil-square-o"></i> Editar perfil</a>

                        </div><br>

            </form>


        </div>
        <br>
    </div>
</div>