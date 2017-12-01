import React, { Component } from 'react';
import './App.css';
import Categories from './categories/Categories';
import UnloggedMenu from './UnloggedMenu';
import LoggedMenu from './LoggedMenu';
class App extends Component { 
 render() {
    if(sessionStorage.getItem('user_id')){
        return (
            <div>
                <LoggedMenu name = {sessionStorage.getItem('name')} />
                <Categories />
            </div>  
            );
        } else{
            return (
            <div>
                <UnloggedMenu />
            </div>
                );
        }
    }
}   

export default App;
