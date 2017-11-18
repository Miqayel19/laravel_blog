import React, { Component } from 'react';
import './App.css';
import Login from "./Login"
import Register from "./Register"
import {Link} from 'react-router-dom';
class Home extends Component{
	
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
		                    {/*//<!-- Left Side Of Navbar -->*/}
		                    <ul className="nav navbar-nav">
		                        Laravel
		                    </ul>

		                    {/*<!-- Right Side Of Navbar -->*/}
		                    <ul className="nav navbar-nav navbar-right">
		                        {/*<!-- Authentication Links -->*/}
		                        
		                            <li><Link to = '/login' component = {Login}>Login</Link></li>
		                            <li><Link to = '/register' component = {Register}>Register</Link></li>
		                        
		                            <li className="dropdown">
		                                {/*<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
		                                    {{ Auth::user()->name }} <span class="caret"></span>
		                                </a>*/}

		                                <ul className="dropdown-menu" role="menu" id='drop_home'>
		                                    <li style={{textAlign:'center'}}><a href='{{url("/categories/")}}'>My Categories</a></li>
		                                    <li style={{textAlign:'center'}}><a href='{{url("/posts/")}}'>My Posts</a></li>
		                                    <li style={{textAlign:'center'}}>
		                                        <a href="{{ route('logout') }}"
		                                            onClick="event.preventDefault();
		                                                     document.getElementById('logout-form').submit();">
		                                            Logout
		                                        </a>

		                                       
		                                            
		                                        
		                                    </li>
		                                    
		                                </ul>
		                            </li>
		                      
		                    </ul>
		                </div>
		            </div>
        		</nav>       
           	</div>
		)
	}
}

export default Home		    