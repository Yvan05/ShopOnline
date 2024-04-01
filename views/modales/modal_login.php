 <!-- END MODAL --> 
<!-- sMODAL -->
    <?php if (isset($_SESSION['error_login'])): ?> 
        <?= Utilities::alert('msj_loggin()'); ?>
       

    <?php endif; ?> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <p class="statusMsg"></p>
                     <form id="loginform" action="<?= base_url ?>user/login" method="POST" >
                        <div class="form-group">
                         
                            <label for="Lemail" class="col-form-label">Correo:</label>
                            <input type="text" autocomplete="username" class="form-control" id="Lemail" name="Lemail" >
                            <div id="msjerroremail"></div>
                                 </div>
                        <div class="form-group" id="divPadre">
                            <label for="Lpasswd" class="col-form-label">Contraseña:</label>
                            <input type="password" autocomplete="current-password" class="form-control"id="Lpasswd" name="Lpasswd" >
                            <div id="msjerrorpass"></div>
                                </div>
                        <div class="modal-footer">
                             
              
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button  onclick="verificar()" type="submit" id="btnlogin"  class="btn btn-primary">Login</button>
                           
                        </div>
                      
                    </form>
                    <div class="text-uppercase text-center">
                        <a   href="<?= base_url ?>user/register" >Registrarse</a> 
                    </div>
                     
                </div>
                
               

            </div>
        </div>
    </div>
                           
 <!-- END MODAL -->  
 
 
 
