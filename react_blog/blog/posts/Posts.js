import React, { Component } from 'react';
import axios from 'axios';
import  './Posts.css' 
class Posts extends Component {
    constructor(props){
        super(props);
        this.state = {
            posts:[]
        }   
    }       
    componentDidMount(){
        axios.get('/api/posts').then((response) => {
            this.setState({ posts: response.data.resource});
            }).catch((error)=>{console.log(error);           
        })
    }   
    render() {  
        return ( 
            <div>
                <div className="container">
                    <div className="row">
                        <div className="row_post">
                            <h1>Posts</h1> 
                            <p>Number of Posts:{this.state.posts.length}</p> 
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

export default Posts
