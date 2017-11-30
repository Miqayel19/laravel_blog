import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyCategories.css';
import LoggedMenu from '../LoggedMenu';
class AddCategory extends Component {
  	constructor(props){
  	 	super(props);
  	 	this.state = {
  			name:"",
            mycategories:[]
  	 	}	
        this.addCategory = this.addCategory.bind(this);
        this.getName = this.getName.bind(this);
    }		
    addCategory(){
        axios.post('/api/me/categories',{'title':this.state.name}).then((response) => {
            this.props.addCategory(response.data.mycategories);
            this.setState({ mycategories: response.data.mycategories});
        }).catch((err)=>{console.log(err);}) 
    }
    getName(e) {
        this.setState({name:e.target.value})
    }
    render() {
        return ( 
            <div> 
                <LoggedMenu name = {sessionStorage.getItem('name')}/>
                <input  type="text" 
                        className="form-control add_input" 
                        placeholder="Add Category"  
                        name='name' 
                        value={this.state.name} 
                        onChange={this.getName}/>
                <button type="submit" onClick = {this.addCategory} className="btn add_button"><Link to = '/me/categories'>Add</Link></button>
            </div>    
        );
    }	
}

export default AddCategory
