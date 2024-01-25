import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Home.css';
import Navbar from '../navbar/Navbar';
import Footer from '../footer/Footer';

const Home = () => {
  const [quote, setQuote] = useState('');
  const [author, setAuthor] = useState('');

  useEffect(() => {
    // Poziv API-ja za random citat
    axios.get('https://api.quotable.io/random')
      .then(response => {
        const { content, author } = response.data;
        setQuote(content);
        setAuthor(author);
      })
      .catch(error => console.error('Error fetching quote:', error));
  }, []);

  return (
    <>
    <Navbar></Navbar>
    <div className="home-container">
      <h1>Welcome to our Forum!</h1>
      <p>Explore, engage, and share your thoughts with the community.</p>
      
      <div className="quote-container">
        <blockquote>
          <p>{quote}</p>
          <footer>{author}</footer>
        </blockquote>
      </div>
      
      <div className="images-container">
        <img src="https://img.freepik.com/premium-vector/online-chatting-laptop-concept-people-connecting-together-work-from-anywhere-flat-vector_545399-1184.jpg?w=360" alt="Image 1" />
        <img src="https://img.freepik.com/free-vector/hand-drawn-flat-people-talking_23-2149051163.jpg" alt="Image 2" />
        <img src="https://st2.depositphotos.com/42829300/48296/v/450/depositphotos_482967492-stock-illustration-two-women-sitting-talking-cafe.jpg" alt="Image 3" />
      </div>
    </div>
    <Footer></Footer>
    </>
  );
};

export default Home;
