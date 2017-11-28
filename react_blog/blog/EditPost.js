import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyPosts.css';
import Menu2 from './Menu2';
class EditPost extends Component {
 	 constructor(props){
 	 	super(props);
 	 	this.state = {
 			text:"",
      title:"",
      image:"",
      id:"",
      myposts:[]
 	 	}	
    this.getText = this.getText.bind(this);
    this.getTitle = this.getTitle.bind(this);
    this.onChangeFile = this.onChangeFile.bind(this);
    this.updatePost= this.updatePost.bind(this);
 }
componentWillMount(){
   axios.get('/api/me/posts/'+this.props.match.params.id+'/edit')
   .then((response)=>{
       this.setState({text:response.data.myposts.text});
       this.setState({title:response.data.myposts.title});
       this.setState({image:response.data.myposts.image}); 
   })
  // axios.get('/api/me/categories').then((response)=>{
  //     this.setState({mycategories:response.data.mycategories});
  //   })
}
updatePost(){
      let info = new FormData()
    info.append('text',this.state.text);
    info.append('title',this.state.title);
    info.append('image',this.state.image);
    info.append('id',this.props.match.params.id);
    info.append('_method', 'PUT');
    axios.post('/api/me/posts/'+this.props.match.params.id,info).then((response) => {
        this.setState({ myposts: response.data.myposts});
        }).catch((err)=>{           
          }) 
    }
    getText(e) {
      this.setState({
      text:e.target.value
        })
    }
    getTitle(e) {
      this.setState({
      title:e.target.value
        })
    }
    onChangeFile(event) {
      this.setState({
      image:event.target.files[0]})
  }
  //   onChangeSelect(e){
  //     this.setState({
  //       cat_id:e.target.value
  //       });
  // }
    
  render() 
       {  
    return (
      <div> 
          <Menu2 name = {sessionStorage.getItem('name')}/>
          <input type="text" className="form-control"   name='text' id = "add_post_text" value = {this.state.text} onChange={this.getText}/>
          <input type="text" className="form-control" name='title' id = 'add_post_title'  value = {this.state.title} onChange = {this.getTitle}/>
          <div className="form-group" id = 'image_div'>
              <input type="file" className="filestyle" data-icon="false" name='image' onChange={this.onChangeFile} />
          </div>
        <button type="submit" className="btn btn-danger update_post" onClick = {this.updatePost}><Link to = '/my-posts'> Update</Link></button>
      </div>    
        ); 
    }	
}

export default EditPost
