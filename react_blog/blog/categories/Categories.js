import React, { Component } from 'react';
import axios from 'axios';
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
            this.setState({ categories: response.data.resource});
            }).catch((error)=>{console.log(error);           
        })
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
                        <div className="row_cat">
                            <h1>Categories</h1> 
                            <p>Number of Categories:{this.state.categories.length}</p> 
                            {this.state.categories.map((value,index) => {
                                return <li  className="list-group-item li-cat" key = {value.id}>{value.title}</li>
                            })}
                        </div>
                   </div>
                </div>
            </div>
        );
    }   
}

export default Categories
