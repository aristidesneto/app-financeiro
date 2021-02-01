
if ($('#expenseTable').length == 1) {
    
    axios.get('/api/entry')
    .then(response => {
        let data = response.data.data
        let total = `Valor total: R$ ${response.data.total}`
        let table = ''

        data.forEach(row => {
            table += `
                <tr>
                    <td>${row.id}</td>
                    <td>${row.category.name}</td>
                    <td>${row.title}</td>
                    <td>${row.due_date}</td>
                    <td>${row.amount}</td>
                </tr>
            `
        });

        $('#expenseData').html(table)
        $('#total').html(total)
    })
    .catch(error => console.log(error))

}

