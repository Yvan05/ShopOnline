<?php
class user{
    //los atributos son private porque solo poddresmos accceder a ellos
    //mediante metodos
   private $id;	
   private  $nombre;	
   private $apellidos;	
   private $email;	
   private $rol;	
   private $imagen;	
   private $password;	
   private $db;
   
   //CONTRUCTOR PARA DARLEVALOR A LA PROPIEDAD db
   function __construct() {
       $this->db = database::conectar();
   }

   //METODOS GETER AND SETTER
   function getId() {
       return $this->id;
   }

   function getNombre() {
       return $this->nombre;
   }

   function getApellidos() {
       return $this->apellidos;
   }

   function getEmail() {
       return $this->email;
   }

   function getRol() {
       return $this->rol;
   }

   function getImagen() {
       return $this->imagen;
   }

   function getPassword() {
       return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);

   }

   function setId($id): void {
       $this->id = $id;
   }

   function setNombre($nombre): void {
       $this->nombre = $this->db->real_escape_string($nombre);
   }

   function setApellidos($apellidos): void {
       $this->apellidos = $this->db->real_escape_string($apellidos);
   }

   function setEmail($email): void {
       $this->email = $this->db->real_escape_string($email);
   }

   function setRol($rol): void {
       $this->rol = $this->db->real_escape_string($rol);
   }

   function setImagen($imagen): void {
       $this->imagen = $this->db->real_escape_string($imagen);
   }

   function setPassword($password): void {
       $this->password = $password;
       
   }

   public function save() {
       $sql="INSERT INTO usuarios VALUES("
       . "NULL,"
       . "'{$this->getNombre()}',"
       . "'{$this->getApellidos()}',"
       . "'{$this->getEmail()}',"
       . "'{$this->getRol()}',"
       . "'{$this->getImagen()}',"
       . "'{$this->getPassword()}');";
       $save= $this->db->query($sql);
       $result=false;
       if($save){
           
          $result=true; 
       } else {
           $result=false; 
           /*echo mysqli_error($this->db);
                    die();*/
       }
       
       return $result;
       
   }
   public function login() {
         $result=false;
         $email= $this->email;
         $passwd= $this->password;
       //comprobar si existe el usuario
       //acceder ala base de datos
       $query="SELECT * FROM usuarios WHERE email='$email'";
      $login= $this->db->query($query);
      //si la consulta es verdadera y en numero de registros es igual a uno entonces entra
      if($login&&$login->num_rows==1){
          //sacar el objeto que nos a manddado la base de datos
          $usuario=$login->fetch_object();
          
          //verficamos la contraseña
          $verify= password_verify($passwd, $usuario->password);
        
          if($verify){
              $result =$usuario;
              
          }
          
          
      }
      return $result;
       
   }
   
   
   
   
}
?>

