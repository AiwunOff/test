import { createStore, compose } from 'redux';
import rootReducer from "./root-reducer";

const store =  createStore(rootReducer,
    window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__());


export default store;