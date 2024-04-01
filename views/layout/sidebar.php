    <body>

        <div class="page-wrapper chiller-theme toggled">
            <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
                <i class="fa fa-bars"></i>
            </a>
            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content">
                    <div class="sidebar-brand">
                        <a href="<?=base_url?>">Tienda Online</a>
                        <div id="close-sidebar">
                            <i class="fa fa-chevron-left"></i>
                        </div>
                    </div>
                    <div class="sidebar-header">
                         <?php if (isset($_SESSION['identity'])):$user = $_SESSION['identity']; ?>
                        <div class="user-pic">
                           
                                 <?php if ($user->imagen != NULL): ?>
                            <img class="img-responsive img-rounded" src="<?= base_url ?>profile/img/<?= $user->imagen ?>" alt="User picture">
                                 <?php else: ?>
                            <img class="img-responsive img-rounded" src="<?= base_url ?>assets/img/user.png" alt="User picture">
                             <?php endif; ?>
                            
                        </div>
                        <div class="user-info">
                            <span class="user-name"><?= $user->nombre ?>
                                <strong><?= $user->apellidos ?></strong>
                            </span>
                            <span class="user-role"><?= $user->rol ?></span>
                            <span class="user-status">
                                <i class="fa fa-circle"></i>
                                <span>Online</span>
                                 
                            </span>
                            
                        </div>
                        <a  href="#" class="dropleft user-log btn-block" data-toggle="dropdown" style="">
                                <i class="fa fa-cog fa-2x" aria-hidden="true"></i>
                              
                                 
                            </a>
                          
                           
                        <div class="dropdown-menu">

                            <a  href="#" class="dropdown-item"  ><i class="fa fa-user"></i> Perfil</a>

                            <a   href="<?= base_url ?>user/logout" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
   
                        <?php else: ?>
                        <div class="text-center">
                            <div class="img-rounded" >
                             <img class="img-responsive img-rounded sizeim" src="<?= base_url ?>assets/img/logo.png">
                             
                            </div>
                            <a href="<?= base_url ?>user/register" class="link">Crea cuenta</a>
                             
                        </div>
                             <?php endif; ?>
                    </div>
                    <!-- sidebar-header  -->
                     
                    <div class="sidebar-search">
                        <div>
                            <form action="<?=base_url .'product/buscador'?>" method="POST">
                            <div class="input-group">
                               
                                <input type="text" name="busca" class="form-control search-menu" placeholder="Search...">
                                 
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text user-log">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                   
                                </div>
                                
                            </div>
                                </form>
                        </div>
                    </div>
                         
                    <!-- sidebar-search  -->
                    <div class="sidebar-menu">
                        <ul>
                            <li class="header-menu">
                                <span>General</span>
                            </li>
                             <?php if (!isset($_SESSION['identity'])): ?>
                            <li class="sidebar">
                                <a href="#"data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-user"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="sidebar">
                                <a href="<?= base_url ?>order/myorder">
                                    <i class="fa fa-money"></i>
                                    <span>Mis Pedidos</span>
                                </a>
                            </li>
                             <?php if (isset($_SESSION['admin'])): ?>
                            <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-lock "></i>
                                    <span>Administracion</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <li>
                                            <a href="<?= base_url ?>order/gestion">Gestion de Pedidos</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url ?>product/gestion">Gestion de Productos</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url ?>category/index">Gestion de Categorias</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                               <?php endif; ?>
                            <?php endif; ?>
                             <li class="sidebar">
                                <a href="<?= base_url ?>car/index">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Carrito</span>
                                    <?php if (isset($_SESSION['car']) && count($_SESSION['car']) >= 1):?>
                                       <span class="badge badge-pill badge-success">1</span> 
                                   <?php else: ?>
                                       <span class="badge badge-pill badge-danger">0</span> 
                                   <?php endif; ?>
                                    
                                </a>
                            </li>
                                <li class="sidebar-dropdown">
                                <a href="#">
                                    <i class="fa fa-plus-circle"></i>
                                    <span>Categorias</span>
                                </a>
                                <div class="sidebar-submenu">
                                    <ul>
                                        <?php $categorias = Utilities::showCategory(); ?>
                                          <?php while ($cat = $categorias->fetch_object()): ?>
                                        <li>
                                            <a href="<?= base_url ?>category/ver&id=<?= $cat->id; ?>"><?= $cat->nombre ?></a>
                                        </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
            </nav>
             <?php require_once "views/modales/modal_login.php";?> 
              <?php 
                Utilities::deleteSession('error_login');
                Utilities::deleteSession('errores');?>
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid">