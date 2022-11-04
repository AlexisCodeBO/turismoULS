<?php include('parciales/cabecera.php') ?>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php');
		include('Sitio.php');
		include('Promocion.php');
		include('Paquete.php');
		if (isset($_GET['id'])){
			$arr=Paquete::seleccionarTodo($_GET['id']);
		}
		$arrSitios=Sitio::listarTodo(); 
		$arrPromociones=Promocion::seleccionarTodo(); 
		$sw = isset($arr);
		
		?>
		<div class="container">
		<form action="" method="POST" role="form" id="fpaquete">
			<?php if ($sw) { ?>
				<legend>Modificacion Paquete</legend>
			<?php }
			else {
			 ?>
			
			<legend>Añadir Nuevo Paquete</legend>
			<?php } ?>

			<select name="idSitio" id="idSitio" class="form-control" required="required">
				<?php foreach ($arrSitios as $sitio) { ?>
				<option value="<?=$sitio->getId()?>"><?=$sitio->getNombre()?></option>
				<?php } ?>
			</select>
			
			<div class="form-group">
				<label for="temporada">Temporada</label>
				<select name="idPromocion" id="idPromocion" class="form-control" required="required">
				<?php foreach ($arrPromociones as $prom) { ?>
				<option value="<?=$prom->getIdPromocion()?>"><?=$prom->getTemporada()?></option>
				<?php } ?>
			</select>
			</div>
			<div class="form-group">
				<label for="fechaSalida">Fecha Salida</label>
				<input type="date" class="form-control" id="fechaSalida" name="fechaSalida" value="<?=$sw?$arr[0]->getFechaSalida():''?>" placeholder="Fecha salida">
			</div>
			<div class="form-group">
				<label for="fechaRetorno">Fecha Retorno</label>
				<input type="date" class="form-control" id="fechaRetorno" name="fechaRetorno" value="<?=$sw?$arr[0]->getFechaRetorno():''?>" placeholder="Fecha Retorno">
			</div>
			<div class="form-group">
				<label for="precio">Precio</label>
				<input type="number" class="form-control" id="precio" name="precio" value="<?=$sw?$arr[0]->getPrecio():''?>" placeholder="Precio">
			</div>
			<div class="form-group">
				<label for="numeroPlazas">Numero de plazas</label>
				<input type="number" class="form-control" id="numeroPlazas" name="numeroPlazas" value="<?=$sw?$arr[0]->getnumeroPlazas():''?>" placeholder="Numero de plazas">
			</div>			
			<?php if($sw){ ?>
			<input type="hidden" name="id" value="<?=$sw?$arr[0]->getIdPaquete():''?>">
			<input type="hidden" name="idPromocion" value="<?=$sw?$arr[0]->getIdPromocion():''?>">
			<input type="hidden" name="idSitio" value="<?=$sw?$arr[0]->getIdSitio():''?>">		
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
			var f = document.getElementById('fpaquete');
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
					xht.open('POST','modificarPaquete.php');
				}
				else{
					xht.open('POST','insercionPaquete.php');
				}
				xht.send(new FormData(f));	
			}
		</script>
<?php include('parciales/footer.php') ?>	