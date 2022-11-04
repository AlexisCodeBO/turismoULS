<?php include('parciales/cabecera.php') ?>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php');
		include('Sitio.php');
		if (isset($_GET['id'])){
			$arr=Sitio::ListarSitio($_GET['id']);
		} 
		$sw = isset($arr);
		
		?>
		<div class="container">
		<form action="" method="POST" role="form" id="fsitio">
			<?php if ($sw) { ?>
				<legend>Modificacion Sitio</legend>
			<?php }
			else {
			 ?>
			
			<legend>Añadir Nuevo Sitio</legend>
			<?php } ?>
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre" value="<?=$sw?$arr[0]->getNombre():''?>" placeholder="Nombre sitio">
			</div>
			<div class="form-group">
				<label for="textareaDescripcion" class="col-sm-2 control-label">Descripcion:</label>
				<div class="col-sm-10">
					<textarea name="descripcion" id="textareaDescripcion"  class="form-control" rows="3" required="required"><?=$sw?$arr[0]->getDesc():''?></textarea>
				</div>
			</div>
			<input type="file" name="foto">
			<?php if($sw){ ?>
			<input type="hidden" name="id" value="<?=$sw?$arr[0]->getId():''?>">
			<input type="hidden" name="dir" value="<?=$sw?$arr[0]->getFoto():''?>">
			<div class="row">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="thumbnail">
					<img src="<?=$sw?$arr[0]->getFoto():''?>" alt="">
					<p>Si desea cambiar la imagen suba otra foto</p>
				</div>
			</div>
			</div>
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
			var f = document.getElementById('fsitio');
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
					xht.open('POST','modificarSitio.php');
				}
				else{
					xht.open('POST','insercionSitio.php');
				}
				xht.send(new FormData(f));	
			}
		</script>
<?php include('parciales/footer.php') ?>	