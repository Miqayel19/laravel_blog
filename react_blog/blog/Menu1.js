import React, { Component } from 'react';
import Login from "./Login";
import Register from "./Register";
import {Link} from 'react-router-dom';
class Menu1 extends Component{
	render(){
	return( 
			<div id="app">
		        <nav className="navbar navbar-default navbar-static-top">
		            <div className="container">
		                <div className="navbar-header">
		                    <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
		                        <span className="sr-only">Toggle Navigation</span>
		                        <span className="icon-bar"></span>
		                        <span className="icon-bar"></span>
		                        <span className="icon-bar"></span>
		                    </button>
		                </div>
		                <div className="collapse navbar-collapse" id="app-navbar-collapse">
		                    <ul className="nav navbar-nav navbar-left">
		                        <li><Link to = {{ pathname:'/', component:{ Menu1 } }}> React</Link></li>
		                    </ul>
		                    <ul className="nav navbar-nav navbar-right">
		                        <li><Link to = '/login' component = {Login}>Login</Link></li>
		                        <li><Link to = '/register' component = {Register}>Register</Link></li>
		                    </ul>
		                </div>
		            </div>
        		</nav>       
           	</div>
		)
	}
}

export default Menu1		    