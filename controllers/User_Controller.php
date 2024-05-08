<?php

require_once 'models/user.php';

class user_controller
{

    public function register()
    {
        //renderizar vista
        require_once 'views/users/register_user.php';
    }
    public function view()
    {
        Utilities::isIdentity();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = new user();
            $usuario->setId($id);
            $user = $usuario->getOne();

            require_once 'views/users/gestion_user.php';
        } else {
            //renderizar vista
            require_once 'views/users/gestion_user.php';
        }


    }
    public function gestion()
    {
        Utilities::isAdmin();
        $user = new user();
        $usuarios = $user->getALL();
        ///renderizar la vista de la paguina
        require_once 'views/users/admin_user.php';
    }
    public function edit()
    {
        Utilities::isIdentity();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $usuario = new user();
            $usuario->setId($id);
            $user = $usuario->getOne();

            if ($user) {
                require_once 'views/users/register_user.php';
            } else {
                show_error();
            }



        } else {
            header('Location:' . base_url . 'user/view');
            ob_end_flush();
        }

    }
    public function delete()
    {
        Utilities::isAdmin();

        if (isset($_GET['id'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            $usuario = new user();
            $usuario->setId($id);
            $delete = $usuario->delete();
            if ($usuario) {
                $alert = $_SESSION['delete'] = "success";
            } else {
                //fallido al registrar
                $alert = $_SESSION['delete'] = "failed";
            }
        } else {
            $alert = $_SESSION['delete'] = "failed";
        }
        header('Location:' . base_url . 'user/gestion');
        ob_end_flush();
    }

    public function save()
    {
        //comprobando los datos que nos llegan por POST
        if (isset($_POST)) {


            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['passwd']) ? $_POST['passwd'] : false;
            $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
            $img = isset($_POST['img']) ? $_POST['img'] : false;
            ///array de errores
            $errores = array();

            //validar los datos antes de guardarlos en la base de datos
//VALIDANDO CAMPO NOMBRE
            if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
                $name_validate = true;
            } else {
                $name_validate = false;
                $errores['name'] = 'verifique el nombre';
            }
            //VALIDANDO CAMPO APELLIDO
            if (!empty($lastname) && !is_numeric($lastname) && !preg_match("/[0-9]/", $lastname)) {
                $lastname_validate = true;
            } else {
                $lastname_validate = false;
                $errores['lastname'] = 'verifique el apellido';
            }
            if (!isset($_GET['id'])) {
                //VALIDANDO CAMPO EMAIL
                if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $email_validate = true;
                } else {
                    $email_validate = false;
                    $errores['email'] = 'verifique el email';
                }

                //VALIDANDO CAMPO CONTRASEÑA
                if (!empty($password)) {
                    $passwd_validate = true;
                } else {
                    $passwd_validate = false;
                    $errores['passwd'] = 'verifique el contraseña   ';
                }
            }
            //VALIDANDO CAMPO ROL
            if (!empty($rol) && !is_numeric($rol) && !preg_match("/[0-9]/", $rol)) {
                $rol_validate = true;
            } else {
                $rol_validate = false;
                $errores['rol'] = 'verifique el rol';
            }
            //VALIDANDO CAMPO IMG
            /* if (!empty($img)) {
              $img_validate = true;
              } else {
              $img_validate = false;
              $errores['img'] = 'Debes ingresar una imagen';
              } */
            if (count($errores) == 0) {

                //if($name && $lastname && $email && $password && $rol ){   
                $user = new user();
                $user->setNombre($name);
                $user->setApellidos($lastname);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setRol($rol);
                //la img se podria redimencionar usando compeser una libreria como thumds
                ////guardando la imagen  en una carpeta y en labase de datos
                $file = $_FILES['img'];
                $filename = $file['name'];
                $minetype = $file['type'];
                if ($minetype == "image/jpg" || $minetype == "image/jpeg" || $minetype == "image/png" || $minetype == "image/gif") {
                    if (!is_dir('profile/img')) {
                        mkdir('profile/img', 0777, true);
                    }

                    move_uploaded_file($file['tmp_name'], 'profile/img/' . $filename);

                    $user->setImagen($filename);
                }

                if (isset($_GET['id'])) {

                    $id = $_GET['id'];
                    $user->setId($id);
                    $save = $user->edit();
                    if ($save) {

                        $alert = $_SESSION['register'] = "success";
                        ///actualizar datos de session

                        if ($_SESSION['identity']->id == $id) {
                            Utilities::updateSession();
                            if ($_SESSION['identity']->rol == 'user') {
                                Utilities::deleteSession('admin');
        
                            }
                        }

                    } else {
                        $alert = $_SESSION['register'] = "failed";
                        $_SESSION['buff'] = $_POST;
                        $form = $_SESSION['error'] = $errores;
                    }


                    
                    header('Location:' . base_url . 'user/edit&id=' . $id);

                } else {
                    $save = $user->save();
                    if ($save) {
                        $alert = $_SESSION['register'] = "success";

                    } else {
                        $alert = $_SESSION['register'] = "failed";
                        $_SESSION['buff'] = $_POST;
                        $form = $_SESSION['error'] = $errores;

                    }
                    header('Location:' . base_url . 'user/register');
                }

                //$save = $user->save();

            } else {
                $alert = $_SESSION['register'] = "vacio";
                $_SESSION['buff'] = $_POST;
                $form = $_SESSION['error'] = $errores;
                if (isset($_GET['id'])) {
                    header('Location:' . base_url . 'user/edit&id=' . $_GET['id']);
                } else {
                    header('Location:' . base_url . 'user/register');
                }
            }
        } else {
            $alert = $_SESSION['register'] = "failed";
            if (isset($_GET['id'])) {
                header('Location:' . base_url . 'user/edit&id=' . $_GET['id']);
            } else {
                header('Location:' . base_url . 'user/register');
            }


        }


        ob_end_flush();

    }
    ///METODO PARA IDENTIFICACION DEL USUARIO LOGIN
    public function login()
    {
        //comprobando los datos que nos llegan por POST
        if (isset($_POST)) {

            $errores = array();
            //VALIDANDO CAMPO EMAIL
            if (!empty($_POST['Lemail']) && filter_var($_POST['Lemail'], FILTER_VALIDATE_EMAIL)) {
                $email_validate = true;
            } else {
                $email_validate = false;
                $errores['email'] = 'verifique el email';
            }
            //VALIDANDO CAMPO CONTRASEÑA esta validacion se va hacer desde el fron con JS
            if (!empty($_POST['Lpasswd'])) {
                $passwd_validate = true;
            } else {
                $passwd_validate = false;
                $errores['passwd'] = 'verifique el contraseña   ';
            }
            //identificar al usuario
            //consulta ala base de datos para comprobar las credencuals y luego
            if (count($errores) == 0) {
                $user = new user();
                $user->setEmail($_POST['Lemail']);
                $user->setPassword($_POST['Lpasswd']);
                //objeto sacado de la base de datos
                $identity = $user->login();
                //crear una session para guardas sus datos
                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                    if ($identity->rol == 'admin') {
                        $_SESSION['admin'] = true;
                    }
                } else {
                    $_SESSION['error_login'] = true;
                }
            } else {
                // $_SESSION['error_login'] = vacio;
                $_SESSION['errores'] = $errores;
            }
        }


        $size = strlen($_SESSION['url']);
        $ruta = substr($_SESSION['url'], 25, $size);

        Utilities::deleteSession('url');


        header("Location:" . base_url . $ruta);

        ob_end_flush();
        Utilities::deleteSession('url');
    }
    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location:" . base_url);
        ob_end_flush();
    }
}
?>