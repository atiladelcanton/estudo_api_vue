import axios from 'axios'

export const http = axios.create({
    baseURL: 'http://integrare-teste-atila.groupdevs.com/api/'
})