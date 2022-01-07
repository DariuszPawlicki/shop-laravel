import {call, put} from "redux-saga/effects";
import {requestGetOrders} from "../requests/orders";
import {setOrders} from "../../ducks/orders";

export function* handleGetUser(action) {
    try {
        const response = yield call(requestGetOrders);
        const {data} = response;
        yield put(setOrders(data));
    } catch (error) {
        console.log(error);
    }
}
