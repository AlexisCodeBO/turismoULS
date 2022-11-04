<?php include('parciales/cabecera.php') ?>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php');
		include('Promocion.php');
		if (isset($_GET['id'])){
			$arr=Promocion::seleccionarTodo($_GET['id']);
		} 
		$sw = isset($arr);
		
		?>
		<div class="container">
		<form action="" method="POST" role="form" id="fpromocion">
			<?php if ($sw) { ?>
				<legend>Modificacion Promocion</legend>
			<?php }
			else {
			 ?>
			
			<legend>Añadir Nueva Promocion</legend>
			<?php } ?>
			<div class="form-group">
				<label for="temporada">Temporada</label>
				<input type="text" class="form-control" id="temporada" name="temporada" value="<?=$sw?$arr[0]->getTemporada():''?>" placeholder="Temporada">
			</div>
			<div class="form-group">
				<label for="porcentaje">Porcentaje</label>
				<input type="text" class="form-control" id="porcentaje" name="porcentaje" value="<?=$sw?$arr[0]->getPorcentaje():''?>" placeholder="Porcentaje">
			</div>			
			<?php if($sw){ ?>
			<input type="hidden" name="id" value="<?=$sw?$arr[0]->getIdPromocion():''?>">
					
			<?php } ?>
			<hr>
			<?php if($sw){ ?>
			<button type="submit" class="btn btn-primary" id="btn">Modificar</button>
			<?php } 
			else { ?>
			<button type="submit" class="btn btn-primary" id="btn">Guardar</button>
			<?php } ?>
		</form>
		<div id="res"></div>

		<?php include('parciales/cabecera_footer.php') ?>
		<script type="text/javascript">
			var f = document.getElementById('fpromocion');
			f.onsubmit=insertar;
			function insertar(e) {
				e.preventDefault();
				var xht = new XMLHttpRequest();
				xht.onreadystatechange=function () {
					if (this.status==200&&this.readyState==4) {
						document.getElementById('res').innerHTML=this.responseText;	
					}
				}
				var btn=document.getElementById("btn").innerHTML;
				if (btn == 'Modificar') {
					xht.open('POST','modificarPromocion.php');
				}
				else{
					xht.open('POST','insercionPromocion.php');
				}
				xht.send(new FormData(f));	
			}
		</script>
<?php include('parciales/footer.php') ?>	