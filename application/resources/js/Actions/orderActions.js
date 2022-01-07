import axios from "axios";

export const storeOrder = async orderData => {
    await axios.post('/api/orders', orderData);
};

export const updateOrder = async (orderId, orderData) => {
    await axios.put(`/api/orders/${orderId}`, orderData);
};

export const deleteOrder = async (orderId) => {
    await axios.delete(`/api/orders/${orderId}`);
};
