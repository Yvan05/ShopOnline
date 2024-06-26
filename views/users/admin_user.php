<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'success'): ?>
    <?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
    <?= Utilities::alert('msj_delete()'); ?>
<?php endif; ?>
<div class="container clearfix">

    <!-- Shopping cart table -->
    <div class="card ">
        <div class="card-header">
            <h1 class="text-center">
                LISTADO DE USUARIOS
                <small class="text-muted">Gestion</small>
            </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                
                <table id="table_view" class="table table-striped table-bordered">
                    <thead>
                        <tr >
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Imagen</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $usuarios->fetch_object()): ?>
                            <tr class="text-center" >
                                <td><?= $user->id; ?></td>
                                <td ><?= $user->nombre; ?> </td>
                                <td><?= $user->apellidos; ?></td>
                                <td><?= $user->email; ?></td>
                                <td><?= $user->rol; ?> </td>
                                <td><?= $user->imagen; ?> </td>
                                <td>
                                    <div class="row text-center">
                                    <span href="#modaldelete_user<?= $user->id; ?>" class="delet" id="btndelete" data-toggle="modal"
                                        type="button"  data-toggle="tooltip" title="Eliminar"> <i
                                            class="fa fa-trash" aria-hidden="true"></i> </span>
                                    <a href="<?= base_url ?>user/edit&id=<?=$user->id;?>" class="edit" type="button" 
                                        data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i></a>
                                    <a href="<?= base_url ?>user/view&id=<?= $user->id; ?>" class="view" type="button" title="Ver">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div>
                                </td>

                                <?php
                               
                                include 'views/modales/modal_eliminarUser.php';
                                ?>
                            <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                <?php Utilities::deleteSession('delete'); ?>
                <?php Utilities::deleteSession('save'); ?>
                <?php Utilities::deleteSession('error'); ?>
            </div>
        </div>
    </div>
</div>