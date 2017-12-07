import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
class Register extends Component {
    constructor(props){
        super(props);
        this.state = {
            name:"",
            email:"",
            password:"",
            password_confirmation:"",
            reg_user:null
        }
        this.isRegistered = this.isRegistered.bind(this);
        this.getName = this.getName.bind(this);
        this.getEmail = this.getEmail.bind(this);
        this.getPassword = this.getPassword.bind(this);
        this.getConfirmPassword = this.getConfirmPassword.bind(this);
    }
    isRegistered(){
        let info = {
            name: this.state.name,
            email: this.state.email, 
            password: this.state.password, 
            password_confirmation:this.state.password_confirmation
        }
        axios.post('/api/register',info)
        .then((response) => {
            sessionStorage.setItem('name',response.data.reource.name);
            sessionStorage.setItem('user_id',response.data.resource.id);
            this.setState({reg_user:response.data.resource.id});
        }).catch((error)=>{console.log(error);})        
    }
    getName(e) {
        this.setState({name:e.target.value})
    }
    getEmail(e){
        this.setState({email:e.target.value})
    }
    getPassword(e){
        this.setState({password:e.target.value})
    }
    getConfirmPassword(e){
        this.setState({password_confirmation:e.target.value})
    }
    render() {
        let redirect_to_home;
        if(this.state.reg_user){
            redirect_to_home = <Redirect to='/' />;
        }
        return ( 
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-body">
                                <div className="form-group">
                                    <label htmlFor="name" className="col-md-4 control-label">Name</label>
                                    <div className="col-md-6">
                                        <input 
                                            id="name" 
                                            type="text" 
                                            className="form-control" 
                                            name="name"  value = {this.state.name} 
                                            onChange={this.getName} required autoFocus/>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <label htmlFor="email" className="col-md-4 control-label">E-Mail Address</label>
                                    <div className="col-md-6">
                                        <input 
                                            id="email" 
                                            type="email" 
                                            className="form-control" 
                                            name="email"  
                                            value = {this.state.email} 
                                            onChange={this.getEmail} required/>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <label htmlFor="password" className="col-md-4 control-label">Password</label>
                                    <div className="col-md-6">
                                        <input 
                                            id="password" 
                                            type="password" 
                                            className="form-control" 
                                            name="password" 
                                            value = {this.state.password} 
                                            onChange={this.getPassword} required/>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <label htmlFor="password-confirm" className="col-md-4 control-label">Confirm Password</label>
                                    <div className="col-md-6">
                                        <input 
                                            id="password-confirm" 
                                            type="password" 
                                            className="form-control" 
                                            name="password_confirmation" 
                                            value = {this.state.password_confirmation} 
                                            onChange={this.getConfirmPassword} required/>
                                    </div>
                                </div>
                                <div className="form-group">
                                    <div className="col-md-6 col-md-offset-4">
                                        <button type="submit" className="btn btn-primary" onClick = {this.isRegistered}>
                                            Register  
                                            <div>
                                                {redirect_to_home}
                                            </div>    
                                        </button>
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

export default Register
