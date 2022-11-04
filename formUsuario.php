<?php include('parciales/cabecera.php') ?>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php');
		include('Usuario.php');
		include('Tipo.php');
		if (isset($_GET['id'])){
			$arr=Paquete::seleccionarTodo($_GET['id']);
		}
		$arrTipos=Tipo::seleccionarTodo(); 
		$sw = isset($arr);
		?>
		<div class="container">
		<form action="" method="POST" role="form" id="fpaquete">
			<?php if ($sw) { ?>
				<legend>Modificacion Usuario</legend>
			<?php }
			else {
			 ?>
			
			<legend>Añadir Nuevo Usuario</legend>
			<?php } ?>

			<div class="form-group">
				<label for="idTipo">Tipo de Usuario</label>
				<select name="idTipo" id="idTipo" class="form-control" required="required">
				<?php foreach ($arrTipos as $tipo) { ?>
				<option value="<?=$tipo->getIdTipo()?>"><?=$tipo->getTipo()?></option>
				<?php } ?>
			</select>
			<div class="form-group">
				<label for="ci">Numero de carnet</label>
				<input type="text" class="form-control" id="ci" name="ci" value="<?=$sw?$arr[0]->getCi():''?>" placeholder="Numero de carnet">
			</div>
			</div>
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" id="nombre" name="nombre" value="<?=$sw?$arr[0]->getNombre():''?>" placeholder="Nombre">
			</div>
			<div class="form-group">
				<label for="apPat">Apellido Paterno</label>
				<input type="text" class="form-control" id="apPat" name="apPat" value="<?=$sw?$arr[0]->getApPat():''?>" placeholder="Apellido Paterno">
			</div>
			<div class="form-group">
				<label for="apMat">Apellido Materno</label>
				<input type="text" class="form-control" id="apMat" name="apMat" value="<?=$sw?$arr[0]->getApMat():''?>" placeholder="Apellido Materno">
			</div>
			<div class="form-group">
				<label for="celular">Celular</label>
				<input type="text" class="form-control" id="celular" name="celular" value="<?=$sw?$arr[0]->getCelular():''?>" placeholder="Celular">
			</div>
			<div class="form-group">
				<label for="correo">Email</label>
				<input type="email" class="form-control" id="correo" name="correo" value="<?=$sw?$arr[0]->getCorreo():''?>" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" value="<?=$sw?$arr[0]->getPassword():''?>" placeholder="Password">
			</div>				
			<?php if($sw){ ?>
			<input type="hidden" name="id" value="<?=$sw?$arr[0]->getIdUsuario():''?>">
				
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
					xht.open('POST','modificarUsuario.php');
				}
				else{
					xht.open('POST','insercionUsuario.php');
				}
				xht.send(new FormData(f));	
			}
		</script>
<?php include('parciales/footer.php') ?>	