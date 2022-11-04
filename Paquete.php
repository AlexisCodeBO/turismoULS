<?php 
	include_once('conexion.php');
	/**
	* 
	*/
	class Paquete
	{
		private $fechaSalida, $fechaRetorno, $precio,$numeroPlazas,$idPromocion,$idSitio,$idPaquete;
		function __construct($fechaSalida, $fechaRetorno, $precio,$numeroPlazas,$idPromocion,$idSitio,$idPaquete=null)
		{
			$this->fechaSalida= $fechaSalida;
			$this->fechaRetorno=$fechaRetorno;
			$this->precio=$precio;
			$this->numeroPlazas= $numeroPlazas;
			$this->idPromocion = $idPromocion;
			$this->idSitio = $idSitio;
			$this->idPaquete = $idPaquete;
		}
		public function getFechaSalida()
		{
			return $this->fechaSalida;
		}
		public function getFechaRetorno()
		{
			return $this->fechaRetorno;
		}
		public function getPrecio()
		{
			return $this->precio;
		}
		public function getNumeroPlazas()
		{
			return $this->numeroPlazas;
		}
		public function getIdPromocion()
		{
			return $this->idPromocion;
		}public function getIdSitio()
		{
			return $this->idSitio;
		}public function getIdPaquete()
		{
			return $this->idPaquete;
		}

		public function insertar()
		{
			$sql = 'INSERT INTO paquetes(fechaSalida, fechaRetorno, precio, numeroPlazas, idPromocion, idSitio) values(:fechaSalida, :fechaRetorno, :precio,:numeroPlazas,:idPromocion,:idSitio)';
			$pdo = Conexion::conectar();
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':fechaSalida',$this->fechaSalida);
			$sentencia->bindParam(':fechaRetorno',$this->fechaRetorno);
			$sentencia->bindParam(':precio',$this->precio);
			$sentencia->bindParam(':numeroPlazas',$this->numeroPlazas);
			$sentencia->bindParam(':idPromocion',$this->idPromocion);
			$sentencia->bindParam(':idSitio',$this->idSitio);			
			return $sentencia->execute();
		}
		static public function seleccionarTodo()
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM paquetes';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Paquete',array('1900-01-01','1900-01-01',0.00,0,1,1));
		}
		public function actualizar()
		{
			$pdo = Conexion::conectar();
			$sql="UPDATE paquetes SET fechaSalida = :fechaSalida,fechaRetorno = :fechaRetorno, precio = :precio,numeroPlazas = :numeroPlazas, idPromocion = :idPromocion,idSitio = :idSitio WHERE idPaquete = :id";
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':fechaSalida',$this->fechaSalida);
			$sentencia->bindParam(':fechaRetorno',$this->fechaRetorno);
			$sentencia->bindParam(':precio',$this->precio);
			$sentencia->bindParam(':numeroPlazas',$this->numeroPlazas);
			$sentencia->bindParam(':idPromocion',$this->idPromocion);
			$sentencia->bindParam(':idSitio',$this->idSitio);
			$sentencia->bindParam(':id',$this->idPaquete);	
			return $sentencia->execute();
		}
		static public function seleccionarPaquete($id)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM paquetes WHERE idPaquete = :id';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':id',$id,PDO::PARAM_INT); 
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Paquete',array('1900-01-01','1900-01-01',0.00,0,1,1));
		}
		static public function eliminar($id)
		{
			$pdo = Conexion::conectar();
			$sql = "DELETE FROM paquetes WHERE idPaquete = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':id',$id,PDO::PARAM_INT);
			$query->execute();
		}
		static public function seleccionarTodoSitioyProm()
		{
			$pdo = Conexion::conectar();
			$sql='SELECT p.idPaquete,p.fechaSalida, p.fechaRetorno, p.precio, p.numeroPlazas, pr.porcentaje, s.nombre, pr.idPromocion,s.idSitio from (paquetes p inner join promociones pr on (p.idPromocion = pr.idPromocion) inner join sitios s on (p.idSitio=s.IdSitio))';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_OBJ);
		}

	}
 ?>