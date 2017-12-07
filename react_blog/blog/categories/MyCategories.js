import React, { Component } from 'react';
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyCategories.css';
import LoggedMenu from '../LoggedMenu';
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
        axios.delete('/api/me/categories/'+this.state.deleted).then((response) => {
            this.setState({mycategories:response.data.resource});
            }).catch((err)=>{console.log(err);})   
    }
    componentDidMount(){
        axios.get('/api/me/categories').then((response) => {
            this.setState({mycategories: response.data.resource});
        }).catch((err)=>{console.log(err);}) 
    }
    componentWillReceiveProps(nextProps){            
        if(nextProps.categories !== this.props.categories){
            this.setState({ mycategories : nextProps.categories});
        }
    }
    render() {  
        return (
            <div> 
                <LoggedMenu name = {sessionStorage.getItem('name')}/>
                <div className="container">
                    <div className="row">
                        <div className='row-second'>
                            <h1 className = 'cat-h1'>My Categories</h1>
                            <button className="btn" id='add-cat'><Link to ={'/me/categories/add'}>Add Category</Link></button>        
                            <div className='row-second-part'>
                                {this.state.mycategories.map((value, index) => {
                                    return <div key = {index} >
                                                <ul className = 'ul-cat'>
                                                    <li className="list-group-item list-cat">{value.title}</li>
                                                    <li>
                                                    <button 
                                                        data-id={value.id} 
                                                        type="button"  
                                                        className="btn btn-primary" 
                                                        data-toggle="modal" 
                                                        data-target="#exampleModal" 
                                                        onClick = {() => {this.getId(value.id)}}>
                                                        Delete
                                                    </button> 
                                                    </li>
                                                    <li 
                                                        className="btn  btn-info" 
                                                        data-id = {value.id}>
                                                        <Link to ={'/me/categories/'+value.id+'/edit'} >
                                                            Edit
                                                        </Link>
                                                    </li>
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
                                <button 
                                    type="submit" 
                                    className="btn btn-secondary" 
                                    data-dismiss = 'modal' 
                                    onClick = {this.deleteCat} >
                                    Yes 
                                </button>
                                <button 
                                    type="button" 
                                    className="btn btn-default" 
                                    data-dismiss="modal">
                                    No
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );     
    }
}

export default MyCategories
