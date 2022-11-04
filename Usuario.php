<?php 
	/**
	* 
	*/
	include_once('conexion.php');
	class Usuario
	{
		private $ci,$nombre,$apPat,$apMat,$cel,$correo,$password,$tipo,$idUsuario;
		function __construct($ci,$nombre,$apPat,$apMat,$cel,$correo,$password,$tipo,$idUsuario=null)
		{
			$this->ci=$ci;
			$this->nombre=$nombre;
			$this->apPat=$apPat;
			$this->apMat=$apMat;
			$this->cel=$cel;
			$this->correo=$correo;
			$this->password=password_hash($password,PASSWORD_DEFAULT);
			$this->tipo=$tipo;
			$this->idUsuario=$idUsuario;
		}
		public function getCi()
		{
			return $this->ci;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApPat()
		{
			return $this->apPat;
		}
		public function getApMat()
		{
			return $this->apMat;
		}
		public function getCel()
		{
			return $this->cel;
		}
		public function getCorreo()
		{
			return $this->correo;
		}
		public function getPassword()
		{
			return $this->password;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function insertar()
		{
			$sql = 'INSERT INTO usuarios(ci,nombre,apPat,apMat,cel,correo,password,tipo) values(:ci,:nombre,:apPat,:apMat,:cel,:correo,:password,:tipo)';
			$pdo = Conexion::conectar();			
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':ci',$this->ci);
			$sentencia->bindParam(':nombre',$this->nombre);
			$sentencia->bindParam(':apPat',$this->apPat);
			$sentencia->bindParam(':apMat',$this->apMat);			
			$sentencia->bindParam(':cel',$this->cel);
			$sentencia->bindParam(':correo',$this->correo);
			$sentencia->bindParam(':password',$this->password);
			$sentencia->bindParam(':tipo',$this->tipo);
			return $sentencia->execute();
		}
		static public function sleccionarTodo()
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM usuarios';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Usuario',array('1','nombre','apPat','apMat','1','mail','pass',1));
		}
		public function actualizar()
		{
			$pdo = Conexion::conectar();
			$sql="UPDATE usuarios SET ci = :ci nombre = :nombre, apPat = :apPat, apMat = :apMat, cel = :cel, correo = :correo, password = :password, tipo = :tipo WHERE idUsuario = :id";
			$query = $pdo->prepare($sql);
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':ci',$this->ci);
			$sentencia->bindParam(':nombre',$this->nombre);
			$sentencia->bindParam(':apPat',$this->apPat);
			$sentencia->bindParam(':apMat',$this->apMat);			
			$sentencia->bindParam(':cel',$this->cel);
			$sentencia->bindParam(':correo',$this->correo);
			$sentencia->bindParam(':password',$this->password);
			$sentencia->bindParam(':tipo',$this->tipo);
			$query->bindParam(':id',$this->idUsuario);
			return $query->execute();
		}
		static public function seleccionarUsuario($id)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM usuarios WHERE idUsuario = :id';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':id',$id); 
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Usuario',array('1','nombre','apPat','apMat','1','mail','pass',1));
		}
		static public function seleccionarUsuarioMail($mail)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM usuarios WHERE correo = :mail';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':mail',$mail); 
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Usuario',array('1','nombre','apPat','apMat','1','mail','pass',1));
		}
		static function eliminar($id)
		{
			$pdo = Conexion::conectar();
			$sql = "DELETE FROM usuarios WHERE idUsuario = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':id',$id,PDO::PARAM_INT);
			$query->execute();
		}
	}
 ?>