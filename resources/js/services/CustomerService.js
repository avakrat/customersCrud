import axios from 'axios'

const apiClient = axios.create({
    baseURL: process.env.MIX_API_BASE_URL,
    withCredentials: false,
    headers: {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
    }
})

export default {
    getCustomers() {
        return apiClient.get('/customers')
    },
    deleteCustomer(customer_id) {
        return apiClient.delete('/customers/'+customer_id)
    },
    updateCustomer(customer_id,data) {
        return apiClient.put('/customers/'+customer_id,data)
    },
    addCustomer(data) {
        return apiClient.post('/customers',data);
    }
}
