<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'success'): ?>
<?= Utilities::alert('msj_succes()'); ?>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
<?= Utilities::alert('msj_missed()'); ?>
<?php endif; ?>
<div class="container clearfix">

    <!-- Shopping cart table -->
    <div class="card ">
        <div class="card-header">
            <h1 class="text-center">
                LISTADO DE CATEGORIAS
                <small class="text-muted">Gestion</small>
            </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="text-center">  <button class="btn btn-primary" data-toggle="modal" data-target="#modalcategory">
                        <i class="fa fa-plus-square"></i> Añadir Categoria</button></div><br>
        
                <table id="table_view" class="table table-striped table-bordered">
                   
                    <!--href="<d?=base_url?>category/crear"-->

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($cat = $categorys->fetch_object()): ?>
                            <tr>
                                <td><?= $cat->id; ?> </td>
                                <td><?= $cat->nombre; ?> </td>
                                <td>
                                <div class="row">
                                        <span href="#modaldelete_cat<?= $cat->id; ?>" class="delet"
                                            data-toggle="modal" type="button" data-toggle="tooltip" title="Eliminar"><i
                                                class="fa fa-trash" aria-hidden="true"></i> </span>
                                        <span href="#modal_cat_edit<?= $cat->id; ?>" class="edit"  data-toggle="modal" type="button"
                                            data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true"></i></span>
                                        
                                    </div>

                                   

                                </td>


                                <?php include 'views/modales/modal_cat_delete.php'; ?> 
                                <?php include 'views/modales/modal_cat_edit.php'; ?>
                            </tr>

                        <?php endwhile; ?>


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>

                        </tr>
                    </tfoot>
                </table>

                <?php require_once 'views/modales/modal_cat.php'; ?>
                <?php Utilities::deleteSession('delete'); ?>
                <?php Utilities::deleteSession('save'); ?>
                <?php Utilities::deleteSession('error'); ?>

            </div>

        </div>
        <br>
    </div>
