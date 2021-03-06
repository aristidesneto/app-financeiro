import { full_months, short_months } from './functions'


function getEntries(period = null, type = 'expense')
{
    let now = new Date()
    let currentMonth = period === null ? `${now.getFullYear()}/${now.getMonth() + 1}` : period

    let yearPeriod = currentMonth.split('/')[0]
    let monthPeriod = currentMonth.split('/')[1]

    axios.get('/api/entry', {params: {month: currentMonth, type: type}})
    .then(response => {
        let data = response.data.data
        let table1, table2 = ''

        let expenseList = data.filter(item => !item.credit_card)
        let expenseCreditCardList = data.filter(item => item.credit_card)

        // Pagination
        let pagination = `
                <ul class="pagination pagination-month justify-content-center">
                    <li class="page-item"><a class="page-link" style="cursor: pointer;" data-month="${parseInt(yearPeriod) - 1}">«</a></li>
                `
        for (let i = 1; i <= 12; i++) {
            pagination += `
                <li class="page-item" id="month-${i}">
                    <a class="page-link" style="cursor: pointer;" data-month="${yearPeriod}/${i}">
                        <p class="page-month">${short_months(i)}</p>
                        <p class="page-year">${yearPeriod}</p>
                    </a>
                </li>
            `
        }

        pagination += `
                <li class="page-item"><a class="page-link" style="cursor: pointer;" data-month="${parseInt(yearPeriod) + 1}">»</a></li>
            </ul>
        `

        // Table
        expenseList.forEach(row => {
            table1 += `
                <tr>
                    <td>${row.id}</td>
                    <td>${row.category.name}</td>
                    <td>${row.title}</td>
                    <td>${row.due_date}</td>
                    <td>${row.payday === null ? 'Em aberto' : row.payday}</td>
                    <td>R$ ${row.amount}</td>
                </tr>
            `
        });

        expenseCreditCardList.forEach(row => {
            let parcel = row.total_parcel > 1 ? `(${row.parcel}/${row.total_parcel})` : ''
            table2 += `
                <tr>
                    <td>${row.id}</td>
                    <td>${row.credit_card.name}</td>
                    <td>${row.title} ${parcel}</td>
                    <td>${row.due_date}</td>
                    <td>${row.payday === null ? 'Em aberto' : row.payday}</td>
                    <td>R$ ${row.amount}</td>
                </tr>
            `
        });

        if (expenseList.length == 0) {
            table1 += `<tr><td colspan='6' class='text-center'>Não há despesas para esse mês</td></tr>`
        }

        if (expenseCreditCardList.length == 0) {
            table2 += `<tr><td colspan='6' class='text-center'>Não há despesas para esse mês</td></tr>`
        }

        $('#pagination').html(pagination)

        // Expenses
        $('#expenseData').html(table1)
        $('#totalExpense').html(`R$ ${response.data.totalExpense}`)

        // Credit Card
        $('#expenseCardData').html(table2)
        $('#totalCard').html(`R$ ${response.data.totalCard}`)

        $('#descCurrentMonth').html(`<strong>${full_months(monthPeriod)}/${yearPeriod}</strong>`)

        $('#month-' + monthPeriod).addClass('active')

    })
    .catch(error => console.log(error))
}

if ($('.expenseTable').length == 2) {
    getEntries()
}

$('#pagination').on('click', '.page-link', function (e) {
    e.preventDefault()
    let period = $(this).data('month')

    let active = document.getElementsByClassName('page-item active')
    let currentMonth = active[0].id
    active[0].classList.remove('active');

    if (period.toString().length == 4) {
        period = `${period}/${currentMonth.split('-')[1]}`
    }

    getEntries(period)
})

