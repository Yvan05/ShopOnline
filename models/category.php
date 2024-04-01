<?php 
class category{
    //los atributos son private porque solo poddresmos accceder a ellos
    //mediante metodos
   private $id;	
   private $nombre;	
   private $db;
   
   //CONTRUCTOR PARA DARLEVALOR A LA PROPIEDAD db
  public function __construct() {
       $this->db = database::conectar();
   }
  public function getId() {
       return $this->id;
   }

  public function getNombre() {
       return $this->nombre;
   }

   public function setId($id): void {
       $this->id = $id;
   }

   public function setNombre($nombre): void {
        $this->nombre = $this->db->real_escape_string($nombre);
       
   }
   //metodo para listar categorias
   public function getAll() {
       $query="SELECT *FROM categorias";
      $category= $this->db->query($query);
      return $category;
       
       
   }
   public function getCategory(){
       //sacando todo los productos que tienen las misma categoria
       $query="SELECT p.*, c.nombre AS catName FROM productos p INNER JOIN categorias c ON c.id=p.categoria_id WHERE p.categoria_id={$this->id}";
       $productos_cat= $this->db->query($query);
      return $productos_cat;  
       
   }
     public function getOne() {
      //sacando un producto para mandar los datos alformulario de editar
     $query="SELECT *FROM categorias WHERE id={$this->id}";
      $category= $this->db->query($query);
      return $category->fetch_object();
      
  }
    public function delete() {
     $query=" DELETE FROM categorias WHERE id={$this->id}";
      $category= $this->db->query($query);
          //bandera
                $result = false;
                //comprobamos que se inserta
                if ($category) {

                    $result = true;
                } else {
                    $result = false;
                    //echo mysqli_error($this->db);
                    //  die();
                }

                return $result;
     
      
  }
   public function save() {

        $query = "SELECT nombre FROM categorias WHERE nombre='{$this->getNombre()}';";
        
        /* $res=mysqli_query($this->db, $query);
          var_dump($res);
          die(); */
        if ($resultado = mysqli_query($this->db, $query)) {
             $result = false;
            if (mysqli_num_rows($resultado) == 0) {

                //Si no hay registros con ese id
                //Pasas a insertar el registro...
                $sql = "INSERT INTO categorias VALUES("
                        . "NULL,"
                        . "'{$this->getNombre()}');";
                $save = $this->db->query($sql);
                $result = false;
                if ($save) {

                    $result = true;
                } else {
                    $result = false;
                    //echo mysqli_error($this->db);
                    //   die();
                }

                return $result;
            }
             return $result;
        }
    }
    
       public function edit() {
    
                $sql = "UPDATE categorias SET nombre='{$this->getNombre()}'  WHERE id='{$this->getId()}';";
               
                $save = $this->db->query($sql);
                $result = false;
                if ($save) {

                    $result = true;
                } else {
                    $result = false;
                    //echo mysqli_error($this->db);
                    //   die();
                }
                return $result;
                
               
            }
             
            

}
?>
