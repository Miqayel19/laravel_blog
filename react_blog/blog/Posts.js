import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
class  Posts extends Component {
 	 constructor(props){
 	 	super(props);
 	 	this.state = {
 			posts:[],
 	 	}	
    // this.CurrentCategory = this.CurrentCategory.bind(this);
 }		

  componentWillMount(){
     axios.get('/api/posts').then((response) => {
            //console.log(response.data.categories[0]);
            //console.log(response.data.user.title);
            //console.log(response.data.user.id);
            //console.log(response.data.posts[0]);
            this.setState({ posts: response.data.posts});
            //console.log(this.state.posts);

            //console.log(response.data.posts.length);
            }).catch((err)=>{           
        }) 
  }
	
  render() 
       {  
    return ( 
          <div>
          	<div className="container">
          		<div className="row">
              		<div className="row_post">
                  		<h1 style = {{marginLeft:"50px"}}>Posts</h1> 
                       <p style = {{marginLeft:"50px"}}>Number of Posts:{this.state.posts.length}</p> 
                        {this.state.posts.map((value, index) => {
                            
                                return <li className="list-group-item" style={{width:"200px",marginLeft:"50px"}} key = {value.id}>{value.title}</li>
                            
                          })}   
              		</div>
          	 	 </div>
      		  </div>
          </div>
    	       );
        }	
}

export default Posts
