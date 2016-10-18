function eco(){
	this.debug = 1
	this.homepage = 'index.php'
}

eco.prototype.redirect = function(){
	window.location = this.homepage+'#'+$.mobile.path.parseUrl($.mobile.base.element.attr('href')).pathname
}
eco.prototype.console = function(e){
	if(debug){
		console.log(e)
	}
}	
