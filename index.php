<?php
session_start(); 
include('parciales/cabecera.php') ?>	
<style type="text/css">
	#carousel-turismo div div img{
		width: 100%;
	}
</style>
<?php include('parciales/foot_cabecera.php') ?>	
		<?php include('parciales/menu.php'); 
				include('Sitio.php');
				$arr = Sitio::listarTodo();
				$i=0;
				//var_dump($arr);
		?>

		<div class="container">
			<div class="jumbotron">
				<div class="container">
					<h1>Turismo La paz</h1>
					<p>Creamos recuerdos Inolvidables</p>					
				</div>
			</div>	
			<div id="carousel-turismo" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
							<?php foreach ($arr as $sitio) { ?>
								<li data-target="#carousel-turismo" data-slide-to="<?=$i; ?>" class="<?=$i==0?'active':''; ?>"></li>
							<?php $i++; } $i=0;?>
								
							</ol>
							<div class="carousel-inner">
								<?php foreach ($arr as $sitio) { ?>
								<div class="item <?=$i==0?'active':''; ?>">
									<img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide" src="<?=$sitio->getFoto(); ?>">
									<div class="container">
										<div class="carousel-caption">
											<h1>Example headline.</h1>
											<p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
											<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
										</div>
									</div>
								</div>
								<?php $i++;} ?>
								
							</div>
							<a class="left carousel-control" href="#carousel-turismo" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
							<a class="right carousel-control" href="#carousel-turismo" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
			<div class="row">
			 <?php foreach ($arr as $sitio) { ?>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
					<div class="thumbnail">
						<img src="<?=$sitio->getFoto(); ?>" alt="">
						<div class="caption">
							<h3><?=$sitio->getNombre(); ?></h3>
							<p>
								<?=$sitio->getDesc(); ?>
							</p>
							<p>
								<a href="#" class="btn btn-primary btn-block">Ver Paquetes</a>
								<?php if (isset($_SESSION['usuario'])&&$_SESSION['tipo']==1) { ?>
								<div class="btn-group btn-group-justified">
									<a href="formSitio.php?id=<?=$sitio->getId()?>" class="btn btn-default">Modificar</a>
									<a href="eliminarSitio.php?id=<?=$sitio->getId()?>" class="btn btn-warning">Eleminar</a>
								</div>
								<?php } ?>
							</p>
						</div>
					</div>
				</div>
			<?php } ?>	
		</div>
		<?php include('parciales/cabecera_footer.php') ?>

<?php include('parciales/footer.php') ?>	