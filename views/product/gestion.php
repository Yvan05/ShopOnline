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
                LISTADO DE PRODUCTOS
                <small class="text-muted">Gestion</small>
            </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="text-center"><a href="<?= base_url ?>product/crear" class="btn btn-primary">
                        <i class="fa fa-plus-square"></i> Añadir Producto</a></div><br>
                <table id="table_view" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th hidden="">IDCAT</th>
                            <th>Nombre</th>
                            <th hidden="">Descripcion</th>
                            <th hidden="">Oferta</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Fecha</th>
                            <th hidden="">Imagen</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($proc = $productos->fetch_object()): ?>
                            <tr class="text-center">
                                <td><?= $proc->id; ?></td>
                                <td hidden=""><?= $proc->categoria_id; ?></td>
                                <td><?= $proc->nombre; ?> </td>
                                <td hidden=""><?= $proc->descripcion; ?></td>
                                <td hidden=""><?= $proc->oferta; ?></td>
                                <td><?= $proc->precio; ?>$</td>
                                <td><?= $proc->stock; ?> </td>
                                <td><?= $proc->fecha; ?></td>
                                <td hidden=""><?= $proc->imagen; ?> </td>
                                <td>
                                    <div class="row">
                                        <span href="#modaldelete_produc<?= $proc->id; ?>" class="delet" id="btndelete"
                                            data-toggle="modal" type="button" data-toggle="tooltip" title="Eliminar"> <i
                                                class="fa fa-trash" aria-hidden="true"></i> </span>
                                        <a href="<?= base_url ?>product/edit&id=<?= $proc->id; ?>" class="edit" type="button"
                                           title="Editar"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true"></i></a>
                                        <span href="#modal_detalle<?= $proc->id; ?>"  class="view"
                                        data-toggle="modal" type="button" title="Ver">
                                            <i class="fa fa-eye" aria-hidden="true"></i></span>
                                    </div>




                                </td>
                                <?php include 'views/modales/modal_eliminarProduct.php'; ?>
                                <?php require 'views/modales/modal_view_product.php'; ?>

                            <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th hidden="">IDCAT</th>
                            <th>Nombre</th>
                            <th hidden="">Descripcion</th>
                            <th hidden="">Oferta</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Fecha</th>
                            <th hidden="">Imagen</th>
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