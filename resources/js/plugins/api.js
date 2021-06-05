import axios from 'axios'

const token = document.querySelector('meta[name="csrf-token"]')

if (! token) {
    console.log('Token not found')
}

const api = axios.create({
    baseURL: 'http://localhost:8080/api/',
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': token.getAttribute('content')
    }
})

export default api
