import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyCategories.css';
import Menu2 from '../Menu2';
class MyCategories extends Component {
 	 constructor(props){
 	 	super(props);
 	 	this.state = {
 			mycategories:[],
            id:"",
            name:"",
            deleted: null
        } 
     this.deleteCat = this.deleteCat.bind(this);
     this.getId = this.getId.bind(this);
    }		
    getId(value){
      this.setState({deleted: value})
    }
    deleteCat(){
         axios.delete('/api/me/categories/'+this.state.deleted).then((response)=>
            {this.setState({mycategories:response.data.mycategories});
        })    
    }
    componentDidMount(){
        axios.get('/api/me/categories').then((response) => {
            this.setState({ mycategories: response.data.mycategories});
        }).catch((err)=>{console.log(err)}) 
    }
    componentWillReceiveProps(nextProps){            
         if(nextProps.categories !== this.props.categories){
            this.setState({ mycategories : nextProps.categories});
         }
    }
render() 
    {  
    return (
        <div> 
            <Menu2 name = {sessionStorage.getItem('name')}/>
            <div className="container">
                <div className="row">
                    <div className='row_second'>
                        <h1 className = 'cat_h1'>My Categories</h1>
                        <button className="btn" id='add_cat'><Link to ={'/me/categories/add'}>Add Category</Link></button>        
                        <div className='row_second_part'>
                      {this.state.mycategories.map((value, index) => {
                        return <div key = {index} >
                                    <ul className = 'ul_cat'>
                                        <li className="list-group-item list_cat">{value.title}</li>
                                        <li>
                                        <button data-id={value.id} type="button"  className="btn btn-primary delete_mod" data-toggle="modal" data-target="#exampleModal" onClick = {() => {this.getId(value.id)}}>
                                            Delete
                                        </button> 
                                        </li>
                                        <li className="btn  btn-info delete_category" data-id = {value.id}><Link to ={'/me/categories/'+value.id+'/edit'} >Edit</Link></li>
                                    </ul> 
                                </div>           
                                    })}
                        </div> 
                    </div>
                </div>
            </div> 
            <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title" id="exampleModalLabel">Are you sure you want to delete the category</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-footer">
                            <input type='hidden' name='_method' value='DELETE'/>
                            <button type="submit" className="btn btn-secondary" data-dismiss = 'modal' onClick = {this.deleteCat} >Yes </button>
                            <button type="button" className="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      );     
    }
}

export default MyCategories
