$.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});

var App = {
    name: 'SIM',
    api: 'http://localhost:721'
}
