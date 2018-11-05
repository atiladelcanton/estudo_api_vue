import { http } from './config'

export default {

    list: () => {
        return http.get('products')
    },
    save:(data) => {
        return http.post('products',data)
    },
    update: (data) => {
        return http.put('products/'+data.id,data)
    },
    toRemove: (product_id) => {
        return http.delete('products/'+product_id)
    }
}