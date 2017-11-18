import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import Login from './Login';
import Register from './Register'; 
import {BrowserRouter as Router,Route,HashRouter} from "react-router-dom";
import registerServiceWorker from './registerServiceWorker';

ReactDOM.render(
	<HashRouter>
		<div>
      <Route path='/' component={App}/>
      <Route path='/login' component={Login}/>
      <Route path='/register' component={Register}/>
      	</div>
    </HashRouter>,document.getElementById('root'));
registerServiceWorker();
