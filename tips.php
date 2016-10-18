<?php
$str_data = file_get_contents("data/tips.json");
$tips = json_decode(utf8_encode($str_data),true);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, target-densitydpi=medium-dpi" />
    <title>Eco de los Andes ONE - Tips</title>
    <script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <script src="js/eco.js"></script>
	<script>
		var eco = new eco()
		eco.redirect()
	</script>
</head>
<body >
<!-- Pagina TIPS -->
	<div id="tips" class="gradiente-gris" data-role="page">
		<div id="encabezado-wrapper">	
			<div data-role="header" id="encabezado">
			</div>
			<div data-role="header" id="header">
				<h1>Tips</h1>
				<a href="index.htm" data-icon="home" data-iconpos="notext" data-direction="reverse">Inicio</a>
			</div>
        </div>
		<div data-role="content" id="contenido">
			<?php
			if(is_array($tips)):
				foreach($tips as $tipo=>$tip):
					echo '<div id="tips-wrapper-'.$tipo.'" class="swipe tips-wrapper '.$tipo.' tipit">	
							<ul class="tips">';
						foreach($tip as $i=>$item):
							echo '<li>
								<div class="tip">
									<div class="texto-tip" >
										<p>
										'.$item.'
										</p>
									</div>
									<span class="icono-tip checked"></span>
									<span class="numero-tip">'.($i+1).'</span>
								</div>
							</li>';
							
						endforeach;
					echo '	</ul>
						</div>';
				endforeach;
			endif;
			?>
			<a href='#' onclick='sliderAntes.prev();return false;' class="anterior antes tipit"><</a> 
			<a href='#' onclick='sliderAntes.next();return false;' class="siguiente antes tipit">></a>
			<a href='#' onclick='sliderDurante.prev();return false;' class="anterior durante tipit"><</a> 
			<a href='#' onclick='sliderDurante.next();return false;' class="siguiente durante tipit">></a>
			<a href='#' onclick='sliderDespues.prev();return false;' class="anterior despues tipit"><</a> 
			<a href='#' onclick='sliderDespues.next();return false;' class="siguiente despues tipit">></a>
			<span id="position-antes" class="bullets antes tipit">
				<em class="on">•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em>
			</span>
			<span id="position-durante" class=" bullets durante tipit">
				<em class="on">•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em>
			</span>
			<span id="position-despues" class=" bullets despues tipit">
				<em class="on">•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em><em>•</em>
			</span>
        </div>
		<div data-role="footer" id="footer-tips">
			<div data-role="navbar">
				<ul>
					<li><a href="javascript: void(0)" onclick="showTips('antes', this)" class="btn-antes activo">ANTES</a></li>
					<li><a href="javascript: void(0)" onclick="showTips('durante', this)" class="btn-durante">DURANTE</a></li>
					<li><a href="javascript: void(0)" onclick="showTips('despues', this)" class="btn-despues">DESPUÉS</a></li>
				</ul>
			</div><!-- /navbar -->
		</div>
	</div>
</body>
</html>