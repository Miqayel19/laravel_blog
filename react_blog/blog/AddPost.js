import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyPosts.css';
import Menu2 from './Menu2';
class AddPost extends Component {
  	 constructor(props){
  	 	super(props);
  	 	this.state = {
  			text:"",
        title:"",
        cat_id:"",
        image:"",
        mycategories:[]
  	 	 }	
  this.getName = this.getName.bind(this);
  this.getTitle = this.getTitle.bind(this);
  this.onChangeFile = this.onChangeFile.bind(this);
  this.onChangeSelect = this.onChangeSelect.bind(this);
  this.addPost = this.addPost.bind(this);
    }		       
  componentWillMount(){
    axios.get('/api/me/categories').then((response)=>{
      this.setState({mycategories:response.data.mycategories});
        })
    }
   getName(e) {
    this.setState({
      text:e.target.value
        })
    }
   getTitle(e) {
    this.setState({
      title:e.target.value
        })
    }
    onChangeFile(e) {
    this.setState({
      image:e.target.files[0]})
    }
    onChangeSelect(e){
      this.setState({
        cat_id:e.target.value
        });
    }
  addPost(){
    let info = new FormData();
    info.append('text',this.state.text);
    info.append('title',this.state.title);
    info.append('image',this.state.image);
    info.append('cat_id',this.state.cat_id);
    axios.post('/api/me/posts/add',info).then((response) => {
        console.log(response.data);
        this.setState({ myposts: response.data.myposts});
        }).catch((err)=>{           
        }) 
    }
  render() 
    {  
    return  (
      <div> 
          <Menu2 name = {sessionStorage.getItem('name')}/>
          <input type="text" className="form-control" placeholder="Add Title"  name='name' id = "add_input" value = {this.state.name} onChange={this.getName}/>
          <input type="text" className="form-control" id = 'add_post_text' placeholder="Add Text"  name='title' value = {this.state.title} onChange = {this.getTitle}/>
          <select name='cat_id' className='form-control' id = 'cat_id' onChange={this.onChangeSelect}>
              <option></option>
              {this.state.mycategories.map((value, index)=>{
                 return  <option  value = {value.id} key = {index}>{value.title}</option>
              })}
          </select>
          <div className="form-group" id = 'image_div'>
            <input type="file" className="filestyle" data-icon="false" name='image' onChange={this.onChangeFile}/>
          </div>
          <button type="submit" onClick = {this.addPost} className="btn" id = 'add_button'><Link to = '/my-posts'>Add</Link></button>
      </div>    
          );   
    }	
}

export default AddPost
