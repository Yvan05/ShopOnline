<div class="container clearfix">

    <!-- Shopping cart table -->
    <div class="card ">
        <div class="card-header">
            <h1 class="text-center">
        LISTADO DE MIS PEDIDOS
        <small class="text-muted">Gestion</small>
    </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="table_view" class="table table-striped table-bordered">
                <thead>
                    <tr>
                     
                        <th>No Pedido</th>
                        <th>Coste</th>
                        <th>Fecha</th>
                        <th>Status Envio</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                  <?php while($ord=$orders->fetch_object()):?>
                      
                 

                        <tr class="text-center">
                            <td><?=$ord->id?></td>
                            <td> <?=$ord->coste?>$</td>
                            <td><?=$ord->fecha?></td>
                            <td><?= Utilities::status($ord->status)?></td>
                            <td>
                            <div class="row">
                                        <span  href="#modaldelete_produc" id="btndelete" data-toggle="modal" class="delet"  type="button" data-toggle="tooltip" title="Eliminar"> <i
                                                class="fa fa-trash" aria-hidden="true"></i> </span>
                                        <span href="#modal_ord_edit<?=$ord->id;?>" data-toggle="modal"  class="edit" type="button"
                                           title="Editar"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true"></i></span>
                                        <a href="<?= base_url ?>order/confirmado&id=<?= $ord->id; ?>"   type="button" class="view" title="Ver">
                                            <i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                
                            </td>
                        </tr>  
                         <?php include 'views/modales/modal_order_edit.php'; ?>
                         <?php endwhile;?>

                       
                </tbody>
                 <tfoot>
                <tr>
                     <th>No Pedido</th>
                     <th>Coste</th>
                     <th>Fecha</th>
                     <th>Status Envio</th>
                     <th>Acciones</th>
                </tr>
                </tfoot>
            </table>
            
            <?php Utilities::deleteSession('save'); ?>
        </div>
    </div>
    <br>
</div>
</div>
