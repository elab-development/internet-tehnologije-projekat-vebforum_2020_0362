import React from 'react';
import useUsers from '../hooks/useUsers';
import './Users.css';
import Navbar from '../navbar/Navbar';
import Footer from '../footer/Footer';

const Users = () => {
  const { users, loading, error } = useUsers('http://127.0.0.1:8000/api/users');

  if (loading) {
    return <div className="users-container loading-message">Loading...</div>;
  }

  if (error) {
    return <div className="users-container loading-error">Error: {error}</div>;
  }

//da se ne prikazuje administrator sajta medju korisnicima 
  const filteredUsers = users.filter(user => user.user_role !== "admin");

  return (
    <>
      <Navbar></Navbar>
      <div className="users-container">
        <h1>Users of the forum:</h1>
        <ul className="users-list">
          {filteredUsers.map(user => (
            <li key={user.id} className="user-item">
              <p>Name: {user.name}</p>
              <p>Email: {user.email}</p>
            </li>
          ))}
        </ul>
      </div>
      <Footer></Footer>
    </>
  );
};

export default Users;