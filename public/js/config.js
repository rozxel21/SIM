$.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});

var App = {
    name: 'SIM',
    api: 'http://localhost:721',
    year: new Date().getFullYear()
}

function guid() {
  	function s4() {
    	return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
  	}
  	var guid = s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
  	return guid.toUpperCase()
}