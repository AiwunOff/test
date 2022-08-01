import React from 'react';
import store from './components/redux/store';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import Wrapper from './components/wrapper/wrapper';
require('./bootstrap');

ReactDOM.render(
  <Provider store={store}>
    <React.StrictMode>
      <Wrapper />
    </React.StrictMode>
  </Provider>,
  document.getElementById('cours')
);
