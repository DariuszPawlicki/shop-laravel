import {takeLatest} from "redux-saga/effects";
import {GET_ORDERS} from "../ducks/orders";
import {handleGetUser} from "./handlers/orders";

export function* watcherSaga() {
    yield takeLatest(GET_ORDERS, handleGetUser);
}
