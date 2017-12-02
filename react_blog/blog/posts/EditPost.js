import React, { Component } from 'react';
import {Redirect} from "react-router";
import axios from 'axios';
import {Link} from "react-router-dom"; 
import './MyPosts.css';
import LoggedMenu from '../LoggedMenu';
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
componentDidMount(){
   axios.get('/api/me/posts/'+this.props.match.params.id)
   .then((response)=>{
       this.setState({text:response.data.myposts.text});
       this.setState({title:response.data.myposts.title});
       this.setState({image:response.data.myposts.image}); 
   }).catch((error)=>{console.log(error);})
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
        }).catch((error)=>{ console.log(error) }) 
    }
    getText(e) {
        this.setState({text:e.target.value})
    }
    getTitle(e) {
        this.setState({title:e.target.value})
    }
    onChangeFile(event) {
        this.setState({image:event.target.files[0]})
    }   
    render() {  
        return (
            <div> 
                <LoggedMenu name = {sessionStorage.getItem('name')}/>
                <input 
                    type="text" 
                    className="form-control add-post-title" 
                    name='text' 
                    value = {this.state.text} 
                    onChange={this.getText}/>
                <input 
                    type="text" 
                    className="form-control add-post-text" 
                    name='title' 
                    value = {this.state.title} 
                    onChange = {this.getTitle}/>
                <div className="form-group image-div">
                    <input 
                        type="file" 
                        className="filestyle" 
                        data-icon="false" 
                        name='image' 
                        onChange={this.onChangeFile} />
                </div>
                <button 
                    type="submit" 
                    className="btn btn-danger update-post" 
                    onClick = {this.updatePost}>
                    <Link to = '/me/posts'>
                        Update
                    </Link>
                </button>
            </div>    
        ); 
    }   
}

export default EditPost
