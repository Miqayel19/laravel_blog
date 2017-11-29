import React, { Component } from 'react';
import './App.css';
import Categories from './categories/Categories';
import Menu1 from './Menu1';
import Menu2 from './Menu2';
class App extends Component { 
 render() {
    if(sessionStorage.getItem('user_id')){
        return (
            <div>
                <Menu2 name = {sessionStorage.getItem('name')} />
                <Categories />
            </div>  
            );
        } else{
            return (
            <div>
                <Menu1 />
            </div>
                );
        }
  	}
}	

export default App;
