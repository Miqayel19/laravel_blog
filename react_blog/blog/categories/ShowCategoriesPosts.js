import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom";
import  './Categories.css' 
class ShowCategoriesPosts extends Component {
 	constructor(props){
 	 	super(props);
 	 	this.state = {
 			categories:[],
            posts:[]
 	 	}	
    }		
    componentDidMount(){
        axios.get('/api/me/categories/'+this.props.match.params.id)
        .then((response)=>{
            console.log(response.data);
            //this.setState({name:response.data.mycategories.title});  
        }).catch((err)=>{console.log(err);})
         axios.get('/api/posts').then((response) => {
            console.log(response.data);
             this.setState({ posts: response.data.posts});
             }).catch((err)=>{console.log(err);})
    }	
    render() {  
        return ( 
            <div>
          	    <div className="container">
          		    <div className="row">
                        <div className="row_post">
                            <h1>Posts</h1> 
                            {this.state.posts.map((value, index) => {
                                return <li className="list-group-item li-post" key = {value.id}>{value.title}</li>
                            })}   
                        </div>
          	 	   </div>
      		    </div>
            </div>
    	);
    }	
}

export default ShowCategoriesPosts
