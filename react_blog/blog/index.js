import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import Login from './Login';
import Register from './Register';
import Menu1 from './Menu1';
import MyCategories from './MyCategories';
import MyPosts from './MyPosts';
import EditCategory from './EditCategory';
import EditPost from './EditPost';
import AddCategory from './AddCategory';
import AddPost from './AddPost';
import {BrowserRouter as Router,Route,HashRouter} from "react-router-dom";
import registerServiceWorker from './registerServiceWorker';

ReactDOM.render(
	<HashRouter>
		<div>
      <Route exact path='/' component={App}/>
      <Route path='/login' component={Login}/>
      <Route path='/register' component={Register}/>
      <Route path='/logout' component={Menu1}/>
  	  <Route exact path='/my-categories' component={MyCategories}/>
      <Route path='/my-categories/add' component={AddCategory}/>
      <Route path='/my-categories/:id/edit' component={EditCategory}/>
      <Route path = '/my-categories/:id/deleted' component={MyCategories}/>
      <Route exact path='/my-posts' component={MyPosts}/>
      <Route path='/my-posts/add' component={AddPost}/>
      <Route path='/my-posts/:id/edit' component={EditPost}/>
      <Route path = '/my-posts/:id/deleted' component={MyPosts}/>

      	</div>
    </HashRouter>,document.getElementById('root'));
registerServiceWorker();
