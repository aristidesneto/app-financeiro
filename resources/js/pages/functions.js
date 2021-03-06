export function toggle_div(element, divId, inverse = false) {
    let target = document.getElementById(divId)
    let displayTrue, displayFalse = ''

    if (inverse === false) {
        displayTrue = 'block'
        displayFalse = 'none'
    } else {
        displayTrue = 'none'
        displayFalse = 'block'
    }

    document.getElementById(element.id).checked
        ? target.style.display = displayTrue
        : target.style.display = displayFalse
}

export function disabledElement(id, disabled = true) {
    document.getElementById(id).disabled = disabled
}

export function short_months(month) {
    let months = {
        1: 'Jan',
        2: 'Fev',
        3: 'Mar',
        4: 'Abr',
        5: 'Mai',
        6: 'Jun',
        7: 'Jul',
        8: 'Ago',
        9: 'Set',
        10: 'Out',
        11: 'Nov',
        12: 'Dez'
    }

    return months[month]
}


export function full_months(month) {
    let months = {
        1: 'Janeiro',
        2: 'Fevereiro',
        3: 'Março',
        4: 'Abril',
        5: 'Maio',
        6: 'Junho',
        7: 'Julho',
        8: 'Agosto',
        9: 'Setembro',
        10: 'Outubro',
        11: 'Novembro',
        12: 'Dezembro'
    }

    return months[month]
}


export function getCreditCards() {
    return axios.get('/api/credit-card')
        .then((response) => response.data)
        .catch((error) => error.response.data.errors)
}

export function getBankAccounts() {
    return axios.get('/api/bank-account')
        .then((response) => response.data)
        .catch((error) => error.response.data.errors)
}
