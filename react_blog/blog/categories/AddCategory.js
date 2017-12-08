import React, { Component } from 'react';
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
            console.log(response.data.resource);
            this.props.addCategory(response.data.resource);
            this.setState({ mycategories: response.data.resource});
        }).catch((error)=>{console.log(error);}) 
    }
    getName(e) {
        this.setState({name:e.target.value})
    }
    render() {
        return ( 
            <div> 
                <LoggedMenu name = {sessionStorage.getItem('name')}/>
                <input  
                    type="text" 
                    className="form-control add-input" 
                    placeholder="Add Category"  
                    name='name' 
                    value={this.state.name} 
                    onChange={this.getName}/>
                <button 
                    type="submit" 
                    onClick = {this.addCategory} 
                    className="btn add-button">
                    <Link to = '/me/categories'>
                        Add
                    </Link>
                </button>
            </div>    
        );
    }   
}

export default AddCategory
