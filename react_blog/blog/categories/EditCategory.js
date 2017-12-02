import React, { Component } from 'react';
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyCategories.css';
import LoggedMenu from '../LoggedMenu';
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
        }).catch((error)=>{console.log(error);})
    }
    updateCat(){
        let info = {
            name:this.state.name,
            id:this.props.match.params.id
        }
        axios.put('/api/me/categories/'+this.props.match.params.id,info).then((response)=>{   
        }).catch((error)=>{console.log(error);})
    }
    getName(e){
        this.setState({name:e.target.value})
    }
    render() {  
        return (
            <div> 
                <LoggedMenu name = {sessionStorage.getItem('name')}/>
                <input  type="text"
                        className="form-control add-input" 
                        name='name' 
                        value = {this.state.name}
                        onChange={this.getName}/>
                <button 
                    type="submit" 
                    className="btn btn-danger upd" 
                    onClick = {this.updateCat}>
                    <Link to = '/me/categories'>
                        Update
                    </Link>
                </button>
            </div>    
        ); 
    }   
}

export default EditCategory
