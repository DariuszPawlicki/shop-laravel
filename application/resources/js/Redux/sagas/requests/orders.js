import axios from "axios";

export function requestGetOrders() {
    return axios.request({
        method: 'get',
        url: '/api/orders'
    });
}
