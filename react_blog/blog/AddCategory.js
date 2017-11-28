import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyCategories.css';
import Menu2 from './Menu2';
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
      axios.post('/api/me/categories/add',{'title':this.state.name}).then((response) => {
             this.setState({ mycategories: response.data.mycategories});
             }).catch((err)=>{}) 
   }
   getName(e) {
    this.setState({
      name:e.target.value
      })
  }
  render() 
       {  
    return (
      <div> 
          <Menu2 name = {sessionStorage.getItem('name')}/>
         <input type="text" className="form-control" placeholder="Add Category"  name='name' id = "add_input" value = {this.state.name} onChange={this.getName}/>
        <button type="submit" onClick = {this.addCategory} className="btn" id = 'add_button'><Link to = '/my-categories'>Add</Link></button>
      </div>    
        );   
    }	
}

export default AddCategory
