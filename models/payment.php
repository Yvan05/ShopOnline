<?php

class payment {

    //los atributos son private porque solo poddresmos accceder a ellos
    //mediante metodos
    private $id;
    private $payment_id;
    private $payment_status;
    private $payment_id_user;
    private $payment_email;
    private $db;
   	
    //CONTRUCTOR PARA DARLEVALOR A LA PROPIEDAD db
    public function __construct() {
        $this->db = database::conectar();
    }

    function getId() {
        return $this->id;
    }

    function getPayment_id() {
        return $this->payment_id;
    }

    function getPayment_status() {
        return $this->payment_status;
    }

    function getPayment_id_user() {
        return $this->payment_id_user;
    }

    function getPayment_email() {
        return $this->payment_email;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setPayment_id($payment_id): void {
       
        $this->payment_id = $this->db->real_escape_string($payment_id);
    }

    function setPayment_status($payment_status): void {
       
        $this->payment_status = $this->db->real_escape_string($payment_status);
    }

    function setPayment_id_user($payment_id_user): void {
      
        $this->payment_id_user = $this->db->real_escape_string($payment_id_user);
    }

    function setPayment_email($payment_email): void {
     
        $this->payment_email = $this->db->real_escape_string($payment_email);
    }
      /* public function getOne() {
        
          //consulta para sacar el ultimo dato registrado de payment
        $pay_sql="SELECT id FROM payment ORDER BY id DESC LIMIT 1;";
        $pay_query = $this->db->query($sql);
       
        return $pay_id;
    }*/
     public function save() {
        //hacemos la consulta
        $sql = "INSERT INTO payment VALUES("
                . "NULL,"
                . "'{$this->getPayment_id()}',"
                . "'{$this->getPayment_status()}',"
                . "'{$this->getPayment_id_user()}',"
                . "'{$this->getPayment_email()}');";
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



  

  
 
  


  

}
