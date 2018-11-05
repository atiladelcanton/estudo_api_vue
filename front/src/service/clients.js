import { http } from './config'

export default {

    list: () => {
        return http.get('clients')
    },
    save:(data) => {
        return http.post('clients',data)
    },
    update:(data) => {
        return http.put('clients/'+data.id,data)
    },
    toRemove: (client_id) => {
        return http.delete('clients/'+client_id)
    }


}