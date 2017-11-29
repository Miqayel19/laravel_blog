import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom";
import  './Categories.css' 
class Categories extends Component {
 	 constructor(props){
 	 	super(props);
 	 	this.state = {
 			categories:[],
            posts:[]
 	 	}	
    }		
  componentDidMount(){
     axios.get('/api/categories').then((response) => {          
            this.setState({ categories: response.data.categories});
            }).catch((err)=>{           
        })
    axios.get('/api/posts').then((response) => {
            this.setState({ posts: response.data.posts});
            }).catch((err)=>{           
        })
    }	
render() 
       {  
    return ( 
        <div>
          	<div className="container">
          		<div className="row">
              		<div className="row_cat">
                  		<h1>Categories</h1> 
                        <p>Number of Categories:{this.state.categories.length}</p> 
                        {this.state.categories.map((value, index) => {
                            return <Link to ={'/categories/'+value.id}   className="list-group-item li_cat" key = {value.id} >{value.title}</Link>
                        })}
              		</div>
                    <div className="row_post">
                        <h1>Posts</h1> 
                        <p>Number of Posts:{this.state.posts.length}</p> 
                        {this.state.posts.map((value, index) => {
                            return <li className="list-group-item li_post" key = {value.id}>{value.title}</li>
                        })}   
                    </div>
          	 	</div>
      		</div>
        </div>
    	   );
        }	
    }

export default Categories