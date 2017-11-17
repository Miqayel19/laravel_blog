import React, { Component } from 'react';
import Login from "./Login"
import Register from "./Register"
import {Link} from 'react-router-dom';
class Home extends Component{
	
	render(){
	return (

		    	<div class="flex-center position-ref full-height">

		                    <div class="top-right links">
		                        <Link to="/login" component = {Login}>Login</Link>
		                         <Link to="/register" component = {Register}>Register</Link>
		                   	</div>
		            		<div class="content">
		                		<div class="links">
                    				<a href="https://laravel.com/docs">Documentation</a>
                    				<a href="https://laracasts.com">Laracasts</a>
                    				<a href="https://laravel-news.com">News</a>
                    				<a href="https://forge.laravel.com">Forge</a>
                   	 				<a href="https://github.com/laravel/laravel">GitHub</a>
                				</div>
            				</div>
        			</div>
    			
		   
	)
	}
}

export default Home		    