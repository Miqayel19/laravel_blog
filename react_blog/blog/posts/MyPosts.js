import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyPosts.css';
import Menu2 from '../Menu2';
class MyPosts extends Component {
 	constructor(props){
 	super(props);
 	this.state = {
        id:"",
        name:"",
        deleted:null,
 		myposts:[]
 	}	
    this.deletePost = this.deletePost.bind(this);
    this.getId = this.getId.bind(this);
    }		
    getId(value){
      this.setState({deleted: value})
    }
    deletePost(){
        axios.delete('/api/me/posts/'+this.state.deleted).then((response)=>
            {this.setState({myposts:response.data.myposts});
        })    
    }
    componentDidMount(){
        axios.get('/api/me/posts').then((response) => {
            this.setState({ myposts: response.data.myposts});
        }).catch((err)=>{ console.log(error)})
    }
    componentWillReceiveProps(nextProps){            
         if(nextProps.posts !== this.props.posts){
            this.setState({ myposts : nextProps.posts});
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
                        <h1 className= 'post_h1'>My Posts</h1>
                        <button className="btn" id='add_post'><Link to ={'/me/posts/add'}>Add Post</Link></button>        
                        <div className='row_second_part'>
                            {this.state.myposts.map((value, index) => {
                                return <div key = {index}>
                                        <ul className='post_li'>
                                            <li className="list-group-item post_title">{value.category.title}</li>
                                            <li className="list-group-item post_title">{value.title}</li>
                                            <li className="list-group-item post_text">{value.text}</li>
                                            <li><img src={'/image/' + value.image}/></li>
                                            <li className='del_post'>
                                            <button data-id={value.id} type="button" onClick = {() => {this.getId(value.id)}} className="btn btn-primary post_mod" data-toggle="modal" data-target="#exampleModal">
                                                Delete
                                            </button>
                                            </li>
                                            <li className="btn  btn-info post_edit" ><Link to ={'/me/posts/'+value.id+'/edit'}>Edit</Link></li>
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
                            <h5 className="modal-title" id="exampleModalLabel">Are you sure you want to delete the Post</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-footer">
                            <input type='hidden' name='_method' value='DELETE'/>
                            <button type="submit" className="btn btn-secondary" id='yes'  data-dismiss="modal" onClick = {this.deletePost}>Yes </button>
                            <button type="button" className="btn btn-default" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        );
    }	
}

export default MyPosts
