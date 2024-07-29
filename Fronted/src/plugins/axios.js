import axios from 'axios'


axios.defaults.baseURL =  import.meta.env.VITE_BASE_URL;


axios.interceptors.request.use(request => {
    return request
})

axios.interceptors.response.use(response => response, error => {
    const { status, data } = error.response
    if (status >= 500) console.error(error)
    if (status === 400) throw data
    if (status === 401){
        location.href = "login"
    }
    return Promise.reject(error)
})
