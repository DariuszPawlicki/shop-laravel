export const SET_ORDERS = 'set_orders';

export const GET_ORDERS = 'get_orders'

export const getOrders = () => ({
    type: GET_ORDERS
});

export const setOrders = (orders) => ({
    type: SET_ORDERS,
    orders
});

const initialState = {
    orders: []
};

export default (state = initialState, action) => {
    switch (action.type) {
        case SET_ORDERS:
            const {orders} = action;
            return {
                ...state,
                orders: orders
            }
        default:
            return state
    }
};
