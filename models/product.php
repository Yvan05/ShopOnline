<?php
class product{
    //los atributos son private porque solo poddresmos accceder a ellos
    //mediante metodos
   private $id;
   private $id_category;	
   private $nombre;	
   private $precio;	
   private $stock;	
   private $fecha;	
   private $imagen;	
   private $descripcion;
   private $oferta;
   private $db;
   
   //CONTRUCTOR PARA DARLEVALOR A LA PROPIEDAD db
   public function __construct() {
       $this->db = database::conectar();
   }
   public function getId() {
       return $this->id;
   }

  public function getIdcategory() {
       return $this->id_category;
   }

  public function getNombre() {
       return $this->nombre;
   }

  public function getPrecio() {
       return $this->precio;
   }

  public function getStock() {
       return $this->stock;
   }

  public function getFecha() {
       return $this->fecha;
   }

 public  function getImagen() {
       return $this->imagen;
   }

  public function getDescripcion() {
       return $this->descripcion;
   }

  public function getOferta() {
       return $this->oferta;
   }

 public  function setId($id): void {
       $this->id = $id;
   }

  public function setIdcategory($id_category): void {
       $this->id_category = $id_category;
   }

  public function setNombre($nombre): void {
       $this->nombre =$this->db->real_escape_string($nombre);
   }

  public function setPrecio($precio): void {
       $this->precio =$this->db->real_escape_string($precio);
   }

  public function setStock($stock): void {
       $this->stock =$this->db->real_escape_string($stock);
   }

  public function setFecha($fecha): void {
       $this->fecha =$this->db->real_escape_string($fecha);
   }

  public function setImagen($imagen): void {
       $this->imagen =$this->db->real_escape_string($imagen);;
   }

  public function setDescripcion($descripcion): void {
       $this->descripcion =$this->db->real_escape_string($descripcion);
   }

  public function setOferta($oferta): void {
       $this->oferta=$this->db->real_escape_string($oferta);
   }
//$this->nombre = $this->db->real_escape_string($nombre);
  public function getALL() {
     $query="SELECT *FROM productos";
      $product= $this->db->query($query);
      return $product;
      
  }
  public function getOne() {
      //sacando un producto para mandar los datos alformulario de editar
     $query="SELECT *FROM productos WHERE id={$this->id}";
      $product= $this->db->query($query);
      return $product->fetch_object();
      
  }
  

   public function buscador() {
      //sacando un producto para mandar los datos alformulario de editar
     $query="SELECT *FROM productos WHERE nombre LIKE '%{$this->nombre}%'";
     $product= $this->db->query($query);
     return $product;
                
  
      
  }
  
   public function getRadom($limit) {
      //sacando un producto a lazr  para mostrarlo en la pagina de inicio
       // SELECT *FROM productos  ORDER BY RAND() LIMIT 6;
     $query="SELECT *FROM productos WHERE stock>=1 ORDER BY RAND() LIMIT $limit";
      $product= $this->db->query($query);
      return $product;
      
  }
  public function delete() {
     $query=" DELETE FROM productos WHERE id={$this->id}";
      $product= $this->db->query($query);
          //bandera
                $result = false;
                //comprobamos que se inserta
                if ($product) {

                    $result = true;
                } else {
                    $result = false;
                    //echo mysqli_error($this->db);
                    //  die();
                }

                return $result;
     
      
  }
  public function save() {
      //hacemos la consulta
       $sql = "INSERT INTO productos VALUES("
                        . "NULL,"
               . "'{$this->getIdcategory()}',"
               . "'{$this->getNombre()}',"
               . "'{$this->getDescripcion()}',"
               . "'{$this->getOferta()}',"
               . "'{$this->getPrecio()}',"
               . "'{$this->getStock()}',"
               . "'{$this->getFecha()}',"         
               . "'{$this->getImagen()}');";
    
                        
                 //ejecutamos la query
                $save = $this->db->query($sql);
                //bandera
                $result = false;
                //comprobamos que se inserta
                if ($save) {

                    $result = true;
                } else {
                    $result = false;
                    /*echo mysqli_error($this->db);
                      die();*/
                }

                return $result;
      
      
  }
  public function edit() {
      //hacemos la consulta
       $sql = "UPDATE  productos SET nombre='{$this->getNombre()}',"
               . "categoria_id='{$this->getIdcategory()}',"
               . "descripcion='{$this->getDescripcion()}',"
               . "oferta='{$this->getOferta()}',"
               . "precio='{$this->getPrecio()}',"
               . "stock='{$this->getStock()}',"
               . "fecha='{$this->getFecha()}'";
                if($this->getImagen()!=null){
               $sql.= ",imagen='{$this->getImagen()}'";
                }
               $sql.=  " WHERE id='{$this->getId()}';";       
               
                        
                 //ejecutamos la query
                $save = $this->db->query($sql);
                //bandera
                $result = false;
                //comprobamos que se inserta
                if ($save) {

                    $result = true;
                } else {
                    $result = false;
                   
                }

                return $result;
      
      
  }
   


}