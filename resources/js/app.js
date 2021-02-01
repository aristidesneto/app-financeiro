require('./bootstrap');

// Admin LTE
require('admin-lte/dist/js/adminlte.min.js');
require('bootstrap-switch/dist/js/bootstrap-switch.min.js');
require('./pages')

// Select 2
require('select2/dist/js/select2.full.min.js');
$('.select2').select2()

// Toastr
window.toastr = require('toastr/build/toastr.min.js');


// Input Mask
require('moment/dist/moment.js');
// require('inputmask/dist/jquery.inputmask.min.js');
require('jquery-mask-plugin');

// Data dd/mm/yyyy
// $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

$(".datemask").mask('00/00/0000')
$(".only-numbers").mask('0#')
$('.money').mask('#.##0,00', {reverse: true});

// Valor monetário
// $("#money").inputmask('decimal', {
//     'alias': 'numeric',
//     'groupSeparator': '.',
//     'autoGroup': true,
//     'digits': 2,
//     'radixPoint': ",",
//     'digitsOptional': false,
//     'allowMinus': false,
//     'prefix': 'R$ ',
//     'placeholder': '0,00'
// });
