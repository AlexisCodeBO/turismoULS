<?php
include('seguridad.php'); 
include('parciales/cabecera.php') ?>	
<style type="text/css">
	#carousel-turismo div div img{
		width: 100%;
	}
</style>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php'); 
				include('Paquete.php');
				$arr = Paquete::seleccionarTodoSitioyProm();
				$i=0;
				var_dump($arr);
		?>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h2>Lista de Paquetes</h2>

				</div>
				<hr>
			</div>
			<div class="row">
				<?php foreach ($arr as $obj) { ?>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><?=$obj->nombre?></h3>
						</div>
						<div class="panel-body">
							Fecha de partida: <?=$obj->fechaSalida?>
						</div>
						<div class="panel-body">
							Fecha de Retorno: <?=$obj->fechaRetorno?>
						</div>
						<div class="panel-body">
							Precio del paquete: <?=$obj->precio?> Bs.
						</div>
						<div class="panel-body">
							Numero de plazas disponibles: <span class="badge"><?=$obj->numeroPlazas?></span> 
						</div>
						<div class="panel-body">
							Porcentaje de descuento: <?=$obj->porcentaje?>
						</div>
						<div class="panel-body">
							Total: <?=$obj->precio-($obj->precio*($obj->porcentaje/100))?>
						</div>
						<div class="panel-footer">
							<a href="#" class="btn btn-primary btn-block">Reservar Paquetes</a>
								<div class="btn-group btn-group-justified">
									<a href="formPaquete.php?id=<?=$obj->idPaquete?>" class="btn btn-default">Modificar</a>
									<a href="#" class="btn btn-warning">Eleminar</a>
								</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php include('parciales/cabecera_footer.php') ?>

<?php include('parciales/footer.php') ?>	