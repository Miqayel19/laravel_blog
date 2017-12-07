import React, { Component } from 'react';
import axios from 'axios';
import './index.css';
import {Redirect} from 'react-router';
import {Link} from "react-router-dom";
class Login extends Component {
    constructor(props){
        super(props);
        this.state = {
            email:"",
            password:"",
            error:"",
            name: "",
            id:null     
        }
        this.isLogged = this.isLogged.bind(this);
        this.getEmail = this.getEmail.bind(this);
        this.getPass = this.getPass.bind(this);
    }
    isLogged(event){
        event.preventDefault();
        if(this.state.email == ''){
            this.setState({ error: 'Email field is required'});
            return false;
        } else if(this.state.password == ''){
            this.setState({ error: 'Password field is required'});
            return false;
        } 
        let info  = {
            email:this.state.email,
            password:this.state.password            
        }
        axios.post('/api/login',info).then((response)=>  
        {           
            sessionStorage.setItem('name',response.data.resource.name);
            sessionStorage.setItem('user_id',response.data.resource.id);
            this.setState({id:response.data.resource.id, error:""});
        }).catch((error) => {
            this.setState({error:"Incorrect login or password"});
        });
        return false;
    }
    getEmail(e){
        this.setState({email:e.target.value})
    }
    getPass(e){
        this.setState({password:e.target.value})
    }
    render() {
       let back_to_home;
        if(this.state.id){
            back_to_home = <Redirect to='/' />;
        }   
        return ( 
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-body">
                                <div className="form-group">
                                    <label htmlFor="email" className="col-md-4 control-label">E-Mail Address</label>
                                    <div className="col-md-6">
                                        <input 
                                            type="email" 
                                            className="form-control" 
                                            name="email"  value = {this.state.email} 
                                            onChange={this.getEmail} required autoFocus/>
                                    </div>
                                </div>      
                                <div className="form-group">
                                    <label htmlFor="password" className="col-md-4 control-label">Password</label>
                                    <div className="col-md-6">
                                        <input  id="password" 
                                                type="password" 
                                                className="form-control" 
                                                name="password" 
                                                value = {this.state.password} 
                                                onChange = {this.getPass} required/>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <div className="col-md-6 col-md-offset-4">
                                        <div className="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"/> Remember Me
                                            </label>
                                            <Link to ="" className="btn btn-link">Forgot Your Password?</Link>
                                        </div>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <div className="col-md-8 col-md-offset-4">
                                        <button type="submit" className="btn btn-primary" onClick = {this.isLogged}>
                                            Login
                                            <div>
                                                {back_to_home}
                                            </div>  
                                        </button>
                                        <Link to ="" className="btn btn-foursquare btn-social btn-facebook log" href='/login/facebook'>
                                            <span className="fa fa-facebook"></span> Sign in with Facebook
                                        </Link>
                                        <Link to ="" className="btn btn-foursquare btn-social btn-google reg" href='/login/google'>
                                            <span className="fa fa-facebook"></span> Sign in with Google
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>      
        );
    }
}

export default Login
