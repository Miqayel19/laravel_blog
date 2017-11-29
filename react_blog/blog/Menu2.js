import React, { Component } from 'react';
import axios from 'axios';
import {Link} from 'react-router-dom';
class Menu2 extends Component{
	constructor(props){
		super(props);
		this.Logout = this.Logout.bind(this);
	}
	Logout(){
		sessionStorage.clear();
		axios.get('/api/logout').then((response)=>{				
		}).catch((error) => {console.log(error);})
	}	
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
		                        <li><Link to ='/'>React</Link></li>
		                    </ul>
		                    <ul className="nav navbar-nav navbar-right">
		                        <li className="dropdown">
		                                <Link to = '' className="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
		                                    {this.props.name} <span className="caret"></span>
		                                </Link>
		                                <ul className="dropdown-menu" role="menu" id='drop_home'>
		                                    <li style={{textAlign:'center'}}><Link to='/me/categories'>My Categories</Link></li>
		                                    <li style={{textAlign:'center'}}><Link to = '/me/posts'>My Posts</Link></li>
		                                    <li style={{textAlign:'center'}}><Link to="/logout" onClick={this.Logout}>Logout</Link></li>                              
		                                </ul>
		                        </li>
		                    </ul>
		                </div>
		            </div>
        		</nav>       
           	</div>
		);
	}
}

export default Menu2		    