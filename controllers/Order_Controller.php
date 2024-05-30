<?php

require_once 'models/order.php';
require_once 'models/payment.php';

class order_Controller
{

    public function done()
    {



        if (!isset($_SESSION['identity'])) {
            $_SESSION['login'] = 'indeti';


            header("Location:" . base_url . 'car/index');
        } elseif (count($_SESSION['car']) == 0) {
            header("Location:" . base_url . 'car/index');
        } else {
            require_once 'views/order/done.php';
        }
    }
    public function delete()
    {
        Utilities::isAdmin();
        if (isset($_GET['id'])) {
            $id = isset($_GET['id']) ? $_GET['id'] : false;
            $order = new order();
            $order->setId($id);
            $delete = $order->delete();
            if ($delete) {
                $alert = $_SESSION['delete'] = "success";
            } else {
                //fallido al eliminar
                $alert = $_SESSION['delete'] = "failed";
            }
        } else {
            $alert = $_SESSION['delete'] = "failed";
        }

        header('Location:' . base_url . 'order/gestion');
        ob_end_flush();
    }

    public function myorder()
    {

        Utilities::isIdentity();
        $usuario_id = $_SESSION['identity']->id; //es un objeto
        $order = new order();
        $order->setUsuario_id($usuario_id);

        $orders = $order->getAllByUser();
        require_once 'views/order/myorder.php';
    }


    public function gestion()
    {
        //renderizar vista
        Utilities::isAdmin();
        $order = new order();
        $orders = $order->getALL();
        require_once 'views/order/gestion.php';
    }

    public function add()
    {

        if (isset($_SESSION['identity']) && isset($_POST)) {
            $usuario_id = $_SESSION['identity']->id;

            //datos recibidos del api de paypal
            $status_transc = isset($_POST['Status_paypal']) ? $_POST['Status_paypal'] : false;
            $id_transc = isset($_POST['Id_paypal']) ? $_POST['Id_paypal'] : false;
            $id_user_payment = isset($_POST['iduserpay']) ? $_POST['iduserpay'] : false;
            $email_payment = isset($_POST['emailpay']) ? $_POST['emailpay'] : false;

            //guardamos datos
            $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utilities::statsCar();
            $coste = $stats['total'];
            ///array de errores
            $errores = array();
            //validar los datos antes de guardarlos en la base de datos
//VALIDANDO CAMPO PAIS
            if (!empty($pais)) {
                $pais_validate = true;
            } else {
                $pais_validate = false;
                $errores['pais'] = 'El campo no puede estar vacio';
            }
            //VALIDANDO CAMPO ESTADO
            if (!empty($estado)) {
                $estado_validate = true;
            } else {
                $estado_validate = false;
                $errores['estado'] = 'El campo no puede estar vacio';
            }
            //VALIDANDO CAMPO MUNICIPIO
            if (!empty($municipio)) {
                $municipio_validate = true;
            } else {
                $municipio_validate = false;
                $errores['municipio'] = 'El campo no puede estar vacio';
            }
            //VALIDANDO CAMPO DIREECION
            if (!empty($direccion) && !is_numeric($direccion)) {
                $direccion_validate = true;
            } else {
                $direccion_validate = false;
                $errores['direccion'] = 'El campo no puede estar vacio';
            }

            if (count($errores) == 0) {
                //hacemos los set de los datos y creamos el objeto
                $order = new order();
                $order->setUsuario_id($usuario_id);
                $order->setPais($pais);
                $order->setEstado($estado);
                $order->setMunicipio($municipio);
                $order->setDireccion($direccion);
                $order->setCoste($coste);
                $save_order = $order->save();

                //ingresando datos ala tabla de payment datos de paypal
                $payment = new payment();
                $payment->setPayment_status($status_transc);
                $payment->setPayment_id($id_transc);
                $payment->setPayment_id_user($id_user_payment);
                $payment->setPayment_email($email_payment);
                $payment_save = $payment->save();



                //relacion entre pedidos y producto 
                $save_orderline = $order->save_line();


                if ($save_order && $save_orderline && $payment_save) {

                    //cambiar el stock
                    $alert = $_SESSION['register'] = "success";
                    $order->stockUpdate();
                    header("Location:" . base_url . 'order/confirmado');
                } else {
                    $alert = $_SESSION['register'] = "failed";
                }
            } else {
                //regresamos una alerta cuando hay errores en el formularui de registro
                $alert = $_SESSION['register'] = "vacio";
                $_SESSION['buff'] = $_POST;
                $form = $_SESSION['error'] = $errores;
                header("Location:" . base_url . 'order/done');
            }
        } else {
            $alert = $_SESSION['register'] = "failed";
            header("Location:" . base_url);
        }
        //header("Location:" . base_url.'order/done');
    }

    public function edit()
    {
        Utilities::isAdmin();
        if (isset($_GET['id']) && isset($_POST['status'])) {
            $id = $_GET['id'];
            $sts = $_POST['status'];
            $edit = true;

            $order = new order();
            $order->setId($id);
            $order->setStatus($sts);
            $update = $order->edit();
            if ($update) {
                $_SESSION['save'] = 'success';
            } else {
                $_SESSION['save'] = 'failed';
            }


            header('Location:' . base_url . 'order/gestion');
        } else {
            $_SESSION['save'] = 'failed';
            header('Location:' . base_url . 'order/gestion');
            ob_end_flush();
        }
    }

    public function confirmado()
    {
        Utilities::datos_order_pdf('views/order/confirmado.php');

    }

    public function factura()
    {

        Utilities::datos_order_pdf('views/fpdf/INVOICE-main/invoice.php');
    }

}
?>