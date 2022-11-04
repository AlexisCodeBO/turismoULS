<?php 
	include_once('conexion.php');
	/**
	* 
	*/
	class Reserva
	{
		private $idUsuario,$idPaquete,$precio,$fecha,$idReserva,$nroPlazas;
		function __construct($idUsuario,$idPaquete,$precio,$fecha,$nroPlazas,$idReserva=null)
		{
			$this->idUsuario= $idUsuario;
			$this->idPaquete=$idPaquete;
			$this->precio=$precio;
			$this->fecha= $fecha;
			$this->nroPlazas = $nroPlazas;			
			$this->idReserva = $idReserva;			
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdPaquete()
		{
			return $this->idPaquete;
		}
		public function getPrecio()
		{
			return $this->precio;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getIdReserva()
		{
			return $this->idReserva;
		}		
		public function getNroPlazas()
		{
			return $this->nroPlazas;
		}	
		public function insertar()
		{
			$sql = 'INSERT INTO reservas(idUsuario,idPaquete,precio,fecha,nroPlazas) values(:idUsuario,:idPaquete,:precio,:fecha,:nroPlazas)';
			$pdo = Conexion::conectar();
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':idUsuario',$this->idUsuario);
			$sentencia->bindParam(':idPaquete',$this->idPaquete);
			$sentencia->bindParam(':precio',$this->precio);
			$sentencia->bindParam(':fecha',$this->fecha);	
			$sentencia->bindParam(':nroPlazas',$this->nroPlazas);		
			return $sentencia->execute();
		}
		static public function seleccionarTodo()
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM reservas';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Reserva',array(1,1,0,'1999-01-01',0));
		}
		public function actualizar()
		{
			$pdo = Conexion::conectar();
			$sql="UPDATE reservas SET idUsuario = :idUsuario,idPaquete = :idPaquete, precio = :precio,fecha = :fecha, nroPlazas = :nroPlazas WHERE idReserva = :id";
			$sentencia = $pdo->prepare($sql);
			$sentencia->bindParam(':idUsuario',$this->idUsuario);
			$sentencia->bindParam(':idPaquete',$this->idPaquete);
			$sentencia->bindParam(':precio',$this->precio);
			$sentencia->bindParam(':fecha',$this->fecha);	
			$sentencia->bindParam(':nroPlazas',$this->nroPlazas);	
			$sentencia->bindParam(':id',$this->idReserva);	
			return $sentencia->execute();
		}
		static public function seleccionarReserva($id)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT * FROM reservas WHERE idReserva = :id';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':id',$id,PDO::PARAM_INT); 
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Reserva',array(1,1,0,'1999-01-01',0));
		}
		static public function eliminar($id)
		{
			$pdo = Conexion::conectar();
			$sql = "DELETE FROM reservas WHERE idReserva = :id";
			$query = $pdo->prepare($sql);
			$query->bindParam(':id',$id,PDO::PARAM_INT);
			$query->execute();
		}
		static public function seleccionarTodoSitioyProm()
		{
			$pdo = Conexion::conectar();
			$sql='SELECT p.idPaquete,p.fechaSalida, p.fechaRetorno, r.precio, r.numeroPlazas, s.nombre r.fecha from (paquetes p inner join reservas r on (p.idPaquete = r.idPaquete) inner join usuarios u on (u.idUsuario=r.idUsuario) inner join sitios s on(p.idSitio = s.IdSitio))
			where r.estado=0';
			$stn = $pdo->prepare($sql);	
			$stn->execute();
			return $stn->FetchAll(PDO::FETCH_OBJ);
		}
		static public function cantReservas($id)
		{
			$pdo = Conexion::conectar();
			$sql='SELECT SUM(nroPlazas) as cant FROM reservas WHERE idPaquete = :id and completada = 0';
			$stn = $pdo->prepare($sql);	
			$stn->bindParam(':id',$id,PDO::PARAM_INT); 
			$stn->execute();
			$row=$stn->fetch(PDO::FETCH_ASSOC);
			//var_dump($row);
			if (is_null($row['cant'])) {
				return 0;
			}
			else{
				return $row['cant'];
			}
			
		}

	}
 ?>