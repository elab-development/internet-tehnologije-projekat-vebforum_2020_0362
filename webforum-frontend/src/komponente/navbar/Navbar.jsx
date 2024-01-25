import React from 'react';
import { Link } from 'react-router-dom';
import './Navbar.css';  

const Navbar = () => {
  return (
    <nav className="navbar">
      <Link to="/" className="nav-link">Home</Link>
      <Link to="/posts" className="nav-link">Posts</Link>
      <Link to="/users" className="nav-link">Users of forum</Link>
      
    </nav>
  );
};

export default Navbar;
