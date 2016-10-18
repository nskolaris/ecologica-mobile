<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes" /> 
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<link rel="apple-touch-icon" href="images/eco/apple/icon-57.jpg" />	
	<link rel="apple-touch-icon" sizes="114x114" href="images/eco/apple/icon-114.jpg" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/eco/apple/icon-72.jpg" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, target-densitydpi=medium-dpi" />
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
	<title>Ecológica</title>
    <link rel="stylesheet" href="css/eco-c.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/ieco.css" />
    <script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<!-- Swipejs -->
	<script src='js/swipe.min.js'></script>
	<link href='css/style.css' rel='stylesheet'/>
	<script src="js/enclave.js"></script>

	<script>
		var enclave = new Enclave()
		var sliderAntes
		var sliderDurante
		var sliderDespues
		var header
		var footer
		var todo
		var altoFinal
		var doit

		
		function showPageTips(){
			var bulletsAntes = document.getElementById('position-antes').getElementsByTagName('em')
			var bulletsDurante = document.getElementById('position-durante').getElementsByTagName('em')
			var bulletsDespues = document.getElementById('position-despues').getElementsByTagName('em')
			
			setTimeout(function(){
				enclave.console('Iniciando swipe Antes')
				sliderAntes = new Swipe(document.getElementById('tips-wrapper-antes'), {
				  callback: function(e, pos) {
					var i = bulletsAntes.length;
					while (i--) {
					  bulletsAntes[i].className = ' ';
					}
					bulletsAntes[pos].className = 'on';
				  }
				})

				sliderDurante = new Swipe(document.getElementById('tips-wrapper-durante'), {
				  callback: function(e, pos) {
					var i = bulletsDurante.length;
					while (i--) {
					  bulletsDurante[i].className = ' ';
					}
					bulletsDurante[pos].className = 'on';
				  }
				})
			
				sliderDespues = new Swipe(document.getElementById('tips-wrapper-despues'), {
				  callback: function(e, pos) {
					var i = bulletsDespues.length;
					while (i--) {
					  bulletsDespues[i].className = ' ';
					}
					bulletsDespues[pos].className = 'on';
				  }
				})
				actualizarAlto();
				showTips('antes', 'undefined')
			}, 200)
		}
		
		$(document).live('pageshow',function(event, ui){
			enclave.console('Viendo: '+$.mobile.activePage.attr('id'))
			try {
				ga('send', 'pageview', $.mobile.activePage.attr('id'));
				enclave.console('Analytics: '+$.mobile.activePage.attr('id'));
			  } catch(err) {
			  }

			  switch($.mobile.activePage.attr('id')){
				case 'tips':
					showPageTips()
				break	
				case 'vitalitud':
				case 'vitalitud-1':
				case 'vitalitud-2':
				case 'vitalitud-3':
				case 'vitalitud-4':
				case 'vitalitud-5':
				case 'vitalitud-6':
				case 'vitalitud-7':
				case 'vitalitud-8':
				case 'vitalitud-9':
				case 'vitalitud-resultado':
					vitalitudController.pageinit($.mobile.activePage)
					actualizarAltoVitalitud($.mobile.activePage)
				break;
				default:
					actualizarAlto();
				break;
			}
		}); 
		
		$(window).resize(function() {
		  clearTimeout(doit);
		  doit = setTimeout(actualizarAlto, 500);
		});
		
		function actualizarAlto(){
			enclave.console('Actualizar alto: '+$.mobile.activePage.attr('id'))
			switch($.mobile.activePage.attr('id')){
				case 'institucional':
					actualizarAltoInstitucional($.mobile.activePage);
				break
				case 'tips':
					actualizarAltoTips($.mobile.activePage);
				break	
				case 'producto':
					actualizarAltoProducto($.mobile.activePage);
				break	
				case 'vitalitud':
				case 'vitalitud-1':
				case 'vitalitud-2':
				case 'vitalitud-3':
				case 'vitalitud-4':
				case 'vitalitud-5':
				case 'vitalitud-6':
				case 'vitalitud-7':
				case 'vitalitud-8':
				case 'vitalitud-9':
				case 'vitalitud-resultado':
					actualizarAltoVitalitud($.mobile.activePage);
				break;
			}
		
		}

		function actualizarAltoTipsSelected(){

			$.each($('.tips-wrapper.resize:visible ul'), function(i, ul){
				$('.tips-wrapper.resize:visible').removeClass('resize')
				$.each($('li',ul), function(y, li){
					var eP = $('.texto-tip p', li)
					var pH = eP.height()
					var eParentH = eP.parent().height() - (parseInt(eP.parent().css('padding-top')) * 2)
					var fontSize = parseInt(eP.css('font-size'))
					//console.log('Empieza: pHeight => '+pH+' / Parent => '+eParentH+' / fontSize => '+fontSize)
					var s = 50;
					if(pH < eParentH){
						while( pH < eParentH){
							if(eParentH-pH > s){
								delta = 1
							}else{
								delta = 1
							}
							fontSize += delta
							eP.css({'font-size': fontSize+'px'})
							pH = eP.height()
							//console.log(pH+'/'+eParentH+'/'+fontSize)
						}
						eP.css({'font-size': (fontSize-delta)+'px'})
							pH = eP.height()
						//console.log('FontSize '+(fontSize-delta))
						if ( pH > eParentH){
							eP.css({'font-size': (fontSize-delta)+'px'})
						}
					}else{
						while( pH > eParentH){
							if(pH-eParentH > s){
								delta = 1
							}else{
								delta = 1
							}
							fontSize =  fontSize - delta
							eP.css({'font-size': fontSize+'px'})
							pH = eP.height()
						}
					}

				})
			}) 
		}

		function actualizarAltoTips(e){
			header = $('#encabezado-wrapper').height() ;
			footer = $('#footer-tips').height();
			quitar = header;
			todo = $(window).height();
			altoFinal = todo - quitar;
			$('#contenido').css({'top': header, 'bottom': footer});
			var altoContenido = $('#contenido').height();
			var altoTips = altoContenido
			var altoBullets = $('#position-antes').height();
			//console.log(altoTips)
			$('.tips-wrapper ul').css({'height':altoTips-altoBullets})
			$('.tips-wrapper ul li').css({'height':altoTips-altoBullets})
			var altoTip = $('.tips-wrapper').height();
			var shadowTip = 5;
			var tipPadding =  parseInt($('.tips-wrapper ul li .tip').css('padding-top')) + parseInt($('.tips-wrapper ul li .tip').css('padding-bottom'))
			var totalQuitarTip = parseInt($('.tips-wrapper ul li .tip').css('margin-top')) + parseInt($('.tips-wrapper ul li .tip').css('margin-bottom')) + tipPadding + shadowTip;
			$('.tips-wrapper ul li .tip').css({'height': altoTip - totalQuitarTip});
			$('.tips-wrapper ul li .tip .texto-tip' ).css({'height': $('.tips-wrapper ul li .tip').height() - tipPadding});
			$('.tips-wrapper').addClass('resize')
			actualizarAltoTipsSelected()
		}
		
		function actualizarAltoProducto(e){
			enclave.console('AltoProducto')
			var ancho = $('.placa-azul', e).width();
			$('.video-institucional', e).css({'height': parseInt((118*ancho)/357)+15})
			var padding = parseInt($('.ui-content',e).css('padding-top')) + parseInt($('.ui-content',e).css('padding-bottom'));
			var todo = $(window).height();
			enclave.console(altoFinal);
			$('.ui-content',e).css({'height': todo - ($('.encabezado-class',e).height() + padding) +1});
			$('.imagen',e).css({'height': $('.ui-content',e).height()})
		}

		function actualizarAltoInstitucional(e){
			enclave.console('INSTITUCIONAL - actualizar')
			var padding = parseInt($('.ui-content',e).css('padding-top')) + parseInt($('.ui-content',e).css('padding-bottom'));
			var quitar = ($('#encabezado-wrapper',e).height() + $('.redes-footer',e).height() + padding)
                        var minAltoContenido = parseInt($('.img_botella',e).css('min-height')) + ($('.ui-block-b',e).height() + $('.redes-top',e).height()+20)
                        todo = $(window).height();
                        if ( minAltoContenido > (todo - quitar)){
                           $('.ui-content',e).css({'height': minAltoContenido}); 
                        }else{
                           $('.ui-content',e).css({'height': todo - quitar});     
                        }
			
			$('.img_botella',e).css({'height': $('.ui-content',e).height() - padding})
			if( enclave.getOrientacion() == 'portrait'){
				// Portrait
				$('.img_botella',e).css({'height': $('.ui-content',e).height() - ( $('.ui-block-b',e).height() + 40)})
			} 
				
		}
		function actualizarAltoVitalitud(e){
			var quitar =  $('.encabezado-class',e).height()  + parseInt($('.ui-content',e).css('padding-top')) + parseInt($('.ui-content',e).css('padding-bottom'));
			var todo = $(window).height();
                        var minAltoContenido = parseInt($('.imagen',e).css('min-height')) + ($('.ui-block-b',e).height()+10)
                        enclave.console("Alto minimo: "+minAltoContenido)
                        enclave.console("Todo - quitar: "+(todo - quitar))
                        if ( minAltoContenido > (todo - quitar)){
                           $('.ui-content',e).css({'height': minAltoContenido}); 
                        }else{
                           $('.ui-content',e).css({'height': todo - quitar});     
                        }
                        
			var altoPosta = $('.ui-content',e).height();
			enclave.console("Alto Posta: "+ altoPosta)
                        enclave.console("Bloque de texto: "+($('.ui-block-b',e).height()+10))
			if( enclave.getOrientacion() == 'portrait'){
				// Portrait
				$('.imagen',e).css({'height': altoPosta - ($('.ui-block-b',e).height()+10)})
			} else {
				// Landscape
				$('.imagen',e).css({'height': altoPosta})
			}
		}
		
	</script>
	</head>
<body>
	<div data-role="header" id="encabezado">
    </div>
	<div id="inicio" data-role="page">
        <div data-role="content">
			<div class="txt-home" style="background-image:url(images/ecologica/txt-home.png);width:100%;height: 7%;background-size: 90% auto;background-position: center center;background-repeat: no-repeat;position:absolute;top:4%;"></div>
			<div class="montañas" style="background-image:url(images/ecologica/montañas.png);width:100%;height: 18%;background-size: auto 100%;background-position: center center;background-repeat: no-repeat;position:absolute;top:16%;"></div>
			<div class="logros" style="background-image:url(images/ecologica/logros-complete.png);background-repeat:no-repeat;background-size:contain;width:100%;height:40%;position:absolute;top: 28%;">
				<a class="btn-vertodos" style="display:block;background-image:url(images/ecologica/btn-vertodos.png);"></a>
			</div>
			<div class="inspirarte" style="background-image:url(images/ecologica/seguinos-complete.png);background-repeat:no-repeat;background-size:contain;width:100%;height:35%;position:absolute;top:65%;">
			</div>
        </div>
    </div>

</body>
</html>