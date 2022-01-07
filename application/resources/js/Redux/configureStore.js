import {combineReducers, createStore, applyMiddleware} from "redux";
import orderReducer from "./ducks/orders";
import createSagaMiddleware from 'redux-saga';
import {watcherSaga} from "./sagas/rootSaga";

const reducer = combineReducers({
    order: orderReducer
});

const sagaMiddleware = createSagaMiddleware();

const middleware = [sagaMiddleware];

const store = createStore(reducer, {}, applyMiddleware(...middleware));

sagaMiddleware.run(watcherSaga);

export default store;
