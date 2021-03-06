const { getCreditCards, getBankAccounts } = require("./functions")

if ($('#selectCreditCard').length == 1) {
    var listCreditCards = getCreditCards()
    listCreditCards.then(data => {
        let list = '<option value=""></option>'
        data.forEach(row => {
            list += `<option value='${row.id}'>${row.name}</option>`
        });

        $('#selectCreditCard').prop('disabled', false).html(list)
    })
}

if ($('#selectBankAccount').length == 1) {
    var listBankAccounts = getBankAccounts()
    listBankAccounts.then(data => {
        let list = '<option value=""></option>'
        data.forEach(row => {
            list += `<option value='${row.id}'>${row.name}</option>`
        });

        $('#selectBankAccount').prop('disabled', false).html(list)
    })
}

if ($('#categoriesExpense').length == 1) {
    axios.get('/api/categories')
    .then(response => {
        let data = response.data

        let expenseList = data.filter((item) => item.type === 'expense')
        let incomeList = data.filter((item) => item.type === 'income')

        let expense = '<option value=""></option>'
        let income = '<option value=""></option>'

        expenseList.forEach(row => {
            expense += `<option value='${row.id}'>${row.name}</option>`
        });

        incomeList.forEach(row => {
            income += `<option value='${row.id}'>${row.name}</option>`
        });

        $('#categoriesExpense').html(expense)
        $('#categoriesIncome').html(income)
    })
    .catch(error => console.log(error.response.data.errors))
}

$('#checkPaymentCreditCard').on('change', function () {
    $("#selectCreditCard").val('').trigger('change')
    document.getElementById('checkPaymentCreditCard').checked
        ? $('#checkIsRecurring').prop('disabled', true)
        : $('#checkIsRecurring').prop('disabled', false)

})

$('#checkIsRecurring').on('change', function () {
    $("#selectBankAccount").val('').trigger('change')
    !document.getElementById('checkIsRecurring').checked
        ? $('#checkPaymentCreditCard').prop('disabled', true)
        : $('#checkPaymentCreditCard').prop('disabled', false)

})

$('#selectCreditCard').on('change', function () {
    let value = $('#selectCreditCard').val()
    if (value) {
        listCreditCards.then(data => {
            let creditCard = data.find(item => item.id == value)
            let now = new Date()
            let day = ("0" + (creditCard.due_date)).slice(-2)
            let month = ("0" + (now.getMonth() + 1)).slice(-2)
            $('#due_date').val(`${day}/${month}/${now.getFullYear()}`)
        })
    }
})

$('.submitForm').on('submit', function (e) {
    e.preventDefault()
    let action = $(this).attr('action')
    let data = new FormData(this)

    axios.post(action, data)
        .then(response => {
            let data = response.data
            if (data.status === 'success') {
                toastr.success(data.message)
                this.reset()

                $('.select2').trigger('change')

                document.getElementById('divSelectBankAccount').style.display = 'none'
                document.getElementById('divSelectCreditCard').style.display = 'none'

                disabledElement('checkIsRecurring', false)
                disabledElement('checkPaymentCreditCard')
            } else {
                toastr.error(data.message)
            }
        })
        .catch(error => console.log(error.response.data.errors))
})



