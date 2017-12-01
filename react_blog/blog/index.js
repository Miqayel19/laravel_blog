import React , { Component } from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import Login from './Login';
import Register from './Register';
import UnloggedMenu from './UnloggedMenu';
import MyCategories from './categories/MyCategories';
import MyPosts from './posts/MyPosts';
import EditCategory from './categories/EditCategory';
import EditPost from './posts/EditPost';
import AddCategory from './categories/AddCategory';
import AddPost from './posts/AddPost';
import {Route,HashRouter} from "react-router-dom";
import registerServiceWorker from './registerServiceWorker';
class Home extends Component{
    constructor(props){
        super(props);
        this.state = {
            posts: [],
            categories:[]
        }
        this.addPost = this.addPost.bind(this);
        this.addCategory = this.addCategory.bind(this);     
    }              
    addPost(posts){
        this.setState({posts})
    }
    addCategory(categories){
        this.setState({categories})
    }
    render() {
        return (
            <div>
                <Route exact path ='/' component={App}/>
                <Route path = '/login' component={Login}/>
                <Route path = '/register' component={Register}/>
                <Route path = '/logout' component={UnloggedMenu}/>
                <Route exact path = '/me/categories' render={() => <MyCategories categories={this.state.categories}/>}/>
                <Route path = '/me/categories/add' render={() => <AddCategory addCategory = {this.addCategory}/>}/>
                <Route path = '/me/categories/:id/edit' component={EditCategory}/>
                <Route path = '/me/categories/:id/deleted' component={MyCategories}/>
                <Route exact path='/me/posts' render={() => <MyPosts posts={this.state.posts} />}/>
                <Route path = '/me/posts/add' render={() => <AddPost addPost = {this.addPost} />}/>
                <Route path = '/me/posts/:id/edit' component={EditPost}/>
                <Route path = '/me/posts/:id/deleted' component={MyPosts}/>
            </div>
        );
    }
} 
ReactDOM.render(
    <HashRouter>
        <Home  />
    </HashRouter>,document.getElementById('root'));
registerServiceWorker();
