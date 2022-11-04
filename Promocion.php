<?php 
	include_once('conexion.php');
	/**
	* 
	*/
	class Promocion
	{
		private $idPromocion, $temporada, $porcentaje;
		function __construct($temporada, $porcentaje,$id=null)
		{
			$this->temporada= $temporada;
			$this->porcentaje=$porcentaje;
			$this->idPromocion=$id;
		}
		public function getTemporada()
		{
			return $this->temporada;
		}
		public function getPorcentaje()
		{
			return $this->porcentaje;
		}
		public function getIdPromocion()
		{
			return $this->idPromocion;
		}
		public function insertar()
		{
			$pdo = Conexion::conectar();
			$sql = 'INSERT INTO promociones(temporada, porcentaje) values(:temporada,:porcentaje)';			
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':temporada',$this->temporada);
			$sentencia->bindParam(':porcentaje',$this->porcentaje);
			return $sentencia->execute();
		}
		static public function seleccionarTodo()
		{
			$pdo = Conexion::conectar();			
			$sql='SELECT * FROM promociones';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Promocion',array('temp','porcentaje'));
		}
		public function actualizar()
		{
			$pdo = Conexion::conectar();
			$sql="UPDATE promociones SET temporada = :temporada, porcentaje = :porcentaje WHERE idPromocion = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':temporada',$this->temporada);
			$query->bindParam(':porcentaje',$this->porcentaje);			
			$query->bindParam(':id',$this->idPromocion);
			return $query->execute();
		}
		static public function seleccionarPromocion($id)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM promociones WHERE idPromocion = :id';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':id',$id,PDO::PARAM_INT); 
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Promocion',array('temp','porcentaje'));
		}
		static function eliminar($id)
		{
			$pdo = Conexion::conectar();
			$sql = "DELETE FROM promociones WHERE idPromocion = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':id',$id,PDO::PARAM_INT);
			$query->execute();
		}
	}
 ?>