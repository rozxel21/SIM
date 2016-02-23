$.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});

base32 = new Nibbler({
    dataBits: 8,
    codeBits: 5,
    keyString: "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567",
    pad: "="
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

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}