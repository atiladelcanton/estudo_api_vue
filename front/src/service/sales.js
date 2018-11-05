import { http } from './config'

export default {

    list: () => {
        return http.get('sales')
    },
    save:(data) => {
        return http.post('sales',data)
    },
    update: (data) => {
        return http.put('sales/'+data.id,data)
    },
    toRemove: (client_id,product_id) => {
        return http.delete('sales/'+client_id+'/'+product_id)
    }

}