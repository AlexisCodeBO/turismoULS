<?php 
	include_once('conexion.php');
	/**
	* 
	*/
	class Tipo
	{
		private $idTipo, $tipo;
		function __construct($tipo, $idTipo=null)
		{
			$this->tipo= $tipo;
			$this->idTipo=$idTipo;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getIdTipo()
		{
			return $this->idTipo;
		}		
		public function insertar()
		{
			$pdo = Conexion::conectar();
			$sql = 'INSERT INTO tipo(tipo) values(:tipo)';			
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':tipo',$this->tipo);			
			return $sentencia->execute();
		}
		static public function seleccionarTodo()
		{
			$pdo = Conexion::conectar();			
			$sql='SELECT * FROM tipo';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Tipo',array('tipo'));
		}
		public function actualizar()
		{
			$pdo = Conexion::conectar();
			$sql="UPDATE tipo SET tipo = :tipo WHERE idTipo = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':tipo',$this->tipo);			
			$query->bindParam(':id',$this->idTipo);
			return $query->execute();
		}
		static public function seleccionartipoUsuario($id)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM tipo WHERE idTipo = :id';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':id',$id,PDO::PARAM_INT); 
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Tipo',array('tipo'));
		}
		static function eliminar($id)
		{
			$pdo = Conexion::conectar();
			$sql = "DELETE FROM tipo WHERE idTipo = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':id',$id,PDO::PARAM_INT);
			$query->execute();
		}
	}
 ?>