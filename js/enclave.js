function Enclave(){
	this.debug = 0
}

Enclave.prototype.getOrientacion = function(){
 	r = ''
	if( $(window).height() > $(window).width()){
		r = 'portrait'
	}else{
		r ='landscape'
	}
	this.console('Enclave.Orientation: '+r)
	return r
}
Enclave.prototype.console = function(e){
	if (this.debug){
		console.log(e)
	}
}