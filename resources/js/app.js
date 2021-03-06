require('./bootstrap');

// Admin LTE
require('admin-lte/dist/js/adminlte.min.js');
require('bootstrap-switch/dist/js/bootstrap-switch.min.js');
require('./pages')

// Select 2
require('select2/dist/js/select2.full.min.js');
$('.select2').select2({
    placeholder: "Selecione uma opção",
    allowClear: true
})

// Toastr
window.toastr = require('toastr/build/toastr.min.js');


// Jquery Mask
require('jquery-mask-plugin');

$(".datemask").mask('00/00/0000');
$(".only-numbers").mask('0#');
$('.money').mask('#.##0,00', {reverse: true});

// Daterange picker
require('daterangepicker/daterangepicker.js');

require('bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js');
require('bootstrap-datepicker');
$('.daterangepicker').daterangepicker();

$('.datepicker').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
    language: 'pt-BR',
    todayHighlight: true,
});

$('.datepicker-month').datepicker({
    autoclose: true,
    format: 'mm/yyyy',
    language: 'pt-BR',
    startView: 'months',
    minViewMode: 'months',
    todayHighlight: true
});

