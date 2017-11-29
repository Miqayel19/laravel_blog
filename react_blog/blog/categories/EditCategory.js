import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyCategories.css';
import Menu2 from '../Menu2';
class EditCategory extends Component {
 	constructor(props){
 	 	super(props);
 	 	this.state = {
 			name:"",
            id:""
 	 	}	
    this.getName = this.getName.bind(this);
    this.updateCat= this.updateCat.bind(this);
}
    componentDidMount(){
        axios.get('/api/me/categories/'+this.props.match.params.id)
        .then((response)=>{
        this.setState({name:response.data.mycategories.title});  
   })
}
    updateCat(){
        axios.put('/api/me/categories/'+this.props.match.params.id,{name:this.state.name,id:this.props.match.params.id}).then((response)=>{   
    })
}
	getName(e){
    this.setState({
        name:e.target.value
    })
}
render() 
    {  
    return (
        <div> 
            <Menu2 name = {sessionStorage.getItem('name')}/>
            <input type="text" className="form-control add_input" name='name' value = {this.state.name} onChange={this.getName}/>
            <button type="submit" className="btn btn-danger upd" onClick = {this.updateCat}><Link to = '/me/categories'> Update</Link></button>
        </div>    
        ); 
    }	
}

export default EditCategory