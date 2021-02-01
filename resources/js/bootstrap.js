
try {
    window.$ = window.jQuery = require('jquery');
    // window.Popper = Popper;
    require('bootstrap/dist/js/bootstrap.bundle.min.js');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
