<?php include('parciales/cabecera.php') ?>	
<style type="text/css">
	#carousel-turismo div div img{
		width: 100%;
	}
</style>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php'); 
				include('Promocion.php');
				$arr = Promocion::seleccionarTodo();			
		?>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h2>Lista de Promociones</h2>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>TEMPORADA</th>
								<th>PORCENTAJE</th>
								<th>ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($arr as $prom) { ?>
							<tr>
								<td><?=$prom->getIdPromocion()?></td>
								<td><?=$prom->getTemporada()?></td>
								<td><?=$prom->getPorcentaje()?></td>
								<td>
									<div class="btn-group">
									<a href="formPromocion.php?id=<?=$prom->getIdPromocion()?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="eliminarPromocion.php?id=<?=$prom->getIdPromocion()?>" class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span></a>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php include('parciales/cabecera_footer.php') ?>

<?php include('parciales/footer.php') ?>	