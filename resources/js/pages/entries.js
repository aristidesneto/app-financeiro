// const { default: axios } = require("axios");

import { toggle_visibility } from "./functions";


if ($('#listCategory').length == 1) {

    axios.get('/api/categories', {params: {type: 'expense'}})
    .then(response => {
        let data = response.data
        let list = '<option>Selecione</option>'

        data.forEach(row => {
            list += `<option value='${row.id}'>${row.name}</option>`
        });

        $('#listCategory').html(list)
    })
    .catch(error => console.log(error))
}

var dataCreditCard = ''
var typePayment = ''

$('#choosePayment').on('change', function () {
    typePayment = $('#choosePayment').val()

    if (typePayment === 'entries') {
        $('#selectPayment').prop('disabled', true)
        $('#parcel').prop('disabled', true)
        $('.datemask').prop('disabled', false).val($('.datemask').val())

        let option = '<option>Selecione a forma de pagamento</option>'
        $('#selectPayment').prop('disabled', true).html(option)

        // axios.get('/api/bank-account')
        // .then(response => {
        //     let data = response.data
        //     let list = '<option>Selecione</option>'

        //     data.forEach(row => {
        //         list += `<option value='${row.id}'>${row.name}</option>`
        //     });

        //     $('#selectPayment').prop('disabled', false).html(list)
        //     $('.datemask').prop('disabled', false).val('')
        // })
        // .catch(error => console.log(error))
    } else if (typePayment === 'credit-card') {

        axios.get('/api/credit-card')
        .then(response => {
            dataCreditCard = response.data
            let list = '<option>Selecione</option>'

            dataCreditCard.forEach(row => {
                list += `<option value='${row.id}'>${row.name}</option>`
            });

            $('#selectPayment').prop('disabled', false).html(list)
            $('#parcel').prop('disabled', false)
        })
        .catch(error => console.log(error))

    } else {
        let option = '<option>Selecione a forma de pagamento</option>'
        $('#selectPayment').prop('disabled', true).html(option)
    }
})

$('#selectPayment').on('change', function () {
    if (typePayment === 'credit-card') {
        let value = $('#selectPayment').val()
        let creditCard = dataCreditCard.find(item => item.id == value)
        let now = new Date()

        let dueDate = `${creditCard.due_date}/${now.getMonth() + 1}/${now.getFullYear()}`

        $('.datemask').prop('disabled', true).val(dueDate)
    }
})



$('#submitForm').on('submit', function (e) {
    e.preventDefault()
    let action = $(this).attr('action')
    let data = new FormData(this)

    axios.post(action, data)
    .then(response => {
        let data = response.data
        if (data.status === 'success') {
            toastr.success(data.message)
            $(this).trigger("reset");

            $('.select2').trigger('change')
        } else {
            toastr.error(data.message)
        }
    })
    .catch(error => console.log(error))
})
