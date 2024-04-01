<?php

class order {

    //los atributos son private porque solo poddresmos accceder a ellos
    //mediante metodos
    private $id;
    private $usuario_id;
    private $pais;
    private $estado;
    private $municipio;
    private $direccion;
    private $coste;
    private $status;
    private $fecha;
    private $hora;
    private $db;

    //CONTRUCTOR PARA DARLEVALOR A LA PROPIEDAD db
    public function __construct() {
        $this->db = database::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getPais() {
        return $this->pais;
    }

    function getEstado() {
        return $this->estado;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getStatus() {
        return $this->status;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id): void {
        $this->usuario_id = $usuario_id;
    }

    function setPais($pais): void {

        $this->pais = $this->db->real_escape_string($pais);
    }

    function setEstado($estado): void {

        $this->estado = $this->db->real_escape_string($estado);
    }

    function setDireccion($direccion): void {

        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste): void {

        $this->coste = $this->db->real_escape_string($coste);
    }

    function setStatus($status): void {

        $this->status = $this->db->real_escape_string($status);
    }

    function setFecha($fecha): void {

        $this->fecha = $this->db->real_escape_string($fecha);
    }

    function setHora($hora): void {

        $this->hora = $this->db->real_escape_string($hora);
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function setMunicipio($municipio): void {
        $this->municipio = $this->db->real_escape_string($municipio);
    }

//$this->nombre = $this->db->real_escape_string($nombre);
    public function getALL() {
        $query = "SELECT *FROM pedidos";
        $product = $this->db->query($query);
        return $product;
    }

    public function getOne() {
        //sacando un producto para mandar los datos alformulario de editar
        $query = "SELECT *FROM pedidos WHERE id={$this->id}";
        $product = $this->db->query($query);
        return $product->fetch_object();
    }
  public function getOneByUser() {
        //sacando un producto para mandar los datos alformulario de editar
        $query = " SELECT p.* FROM pedidos p "
                //." INNER JOIN lineas_pedido lp ON lp.pedido_id=p.id "
                ." WHERE p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($query);
        return $pedido->fetch_object();
    }
      public function getAllByUser() {
        //sacando un producto para mandar los datos alformulario de editar
        $query = " SELECT p.* FROM pedidos p "
                ." WHERE p.usuario_id={$this->getUsuario_id()} ORDER BY id DESC";
        $pedido = $this->db->query($query);
        return $pedido;
    }
      public function getProductsByOrder($id) {
        //sacando un producto para mandar los datos alformulario de editar
       // $query = " SELECT * FROM productos WHERE id IN "
        //        ."(SELECT producto_id FROM lineas_pedido WHERE pedido_id={$id} );";
                
         $query = " SELECT pr.*,lp.unidades FROM productos pr "
                 . "INNER JOIN lineas_pedido lp ON pr.id=lp.producto_id"
                 . "  WHERE lp.pedido_id={$id};";
                        
                
        $producto = $this->db->query($query);
        return $producto;
    }
    
    
     public function getPaymentByOrder($id) {
      
                
         $query = " SELECT pay.* FROM payment pay "
                 . "INNER JOIN lineas_pedido lp ON pay.id=lp.paypal_id"
                 . "  WHERE lp.pedido_id={$id};";
                        
                
        $pay = $this->db->query($query);
         
        return $pay->fetch_object();
    }
    public function stockUpdate(){
        $result = false;
        $carrito = $_SESSION['car'];
        for ($i = 0; $i <count($_SESSION['car']); $i++) {         
            $sql = "SELECT nombre,stock FROM productos WHERE id={$carrito[$i]['producto']->id} AND stock >={$carrito[$i]['cantidad']};";
            $producto = $this->db->query($sql);
            
            if (mysqli_num_rows($producto) == 0) {
                $_SESSION['stock'] = 'nohay';
            } else {
                $stock = $_SESSION['car'][$i]['producto']->stock;
                $cantidad = $_SESSION['car'][$i]['cantidad'];
                $newstock = $stock - $cantidad;
                $sql2 = "UPDATE productos SET stock={$newstock}  WHERE id={$carrito[$i]['producto']->id};";
                $update = $this->db->query($sql2);
                //actualizando la sesion del carrito stock
                $_SESSION['car'][$i]['producto']->stock=$newstock;
                //actulizando la sesuin del carrito cantidad
                unset($_SESSION['car']);
               /* if($newstock === 0){
                    unset($_SESSION['car'][$i]);
                }else{
                   $_SESSION['car'][$i]['cantidad']=1; 
                }*/
                
                
            }
        }
        if (isset($producto)&&$producto&&isset($producto)&&$update) {
            $result = true;
        } else {
            $result = false; 
        }
        return $result;
    }

    public function edit(){
        //hacemos la consulta
        $sql = "UPDATE  pedidos SET status='{$this->getStatus()}'"
        . " WHERE id='{$this->getId()}';";

        //ejecutamos la query
        $save = $this->db->query($sql);
        //bandera
        $result = false;
        //comprobamos que se inserta
        if ($save) {
            $result = true;
        } else {
            $result = false;
            /* echo mysqli_error($this->db);
              die(); */
        }
        return $result;
        
    }
    public function save() {
        //hacemos la consulta
        $sql = "INSERT INTO pedidos VALUES("
                . "NULL,"
                . "'{$this->getUsuario_id()}',"
                . "'{$this->getPais()}',"
                . "'{$this->getEstado()}',"
                . "'{$this->getMunicipio()}',"
                . "'{$this->getDireccion()}',"
                . "{$this->getCoste()},"
                . "'confirm',"
                . "CURDATE(),"
                . "CURTIME());";
        //ejecutamos la query
        $save = $this->db->query($sql);
        //bandera
        $result = false;
        //comprobamos que se inserta
        if ($save) {
            $result = true;
        } else {
            $result = false;
            /* echo mysqli_error($this->db);
              die(); */
        }
        return $result;
    }
    public function save_line() {
        //hacemos la consulta
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
            //ejecutamos la query
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        
        
        $pay_sql="SELECT id FROM payment ORDER BY id DESC LIMIT 1;";
        $pay_query = $this->db->query($pay_sql);
        $pay_id = $pay_query->fetch_object()->id;
        

         foreach ($_SESSION['car'] as $elemento){
         
      
            $producto = $elemento['producto'];
            $insert="INSERT INTO lineas_pedido VALUES(NULL,{$pedido_id},{$producto->id},{$pay_id},{$elemento['cantidad']});";
            $save = $this->db->query($insert);
   
         }
          //bandera
        $result = false;
        //comprobamos que se inserta
        if ($save) {
            $result = true;
        } else {
            $result = false;
           /* echo mysqli_error($this->db);
             
              die();*/
        }
        return $result;
       
      
    }

}
