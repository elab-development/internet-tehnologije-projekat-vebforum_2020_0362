import './App.css';
import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Home from './komponente/home/Home';
import Details from './komponente/posts/Details';
import Posts from './komponente/posts/Posts';
import Users from './komponente/users/Users';

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
        <Route 
          path="/" 
          element={<Home/>} 
          />
          <Route 
          path="/posts/:id" 
          element={<Details/>} 
          />
          <Route 
          path="/posts" 
          element={<Posts/>} 
          />
           <Route 
          path="/users" 
          element={<Users/>} 
          />
         
        </Routes>
    </BrowserRouter>
    </div>
  );
}

export default App;
