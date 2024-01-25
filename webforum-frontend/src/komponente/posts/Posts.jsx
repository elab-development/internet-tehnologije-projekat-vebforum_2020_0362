import React, { useState } from 'react';
import Post from './Post';
import './Posts.css';
import usePosts from '../hooks/usePosts';
import Navbar from '../navbar/Navbar';
import Footer from '../footer/Footer';

const Posts = () => {
  
  const [posts, setPosts] = usePosts('http://127.0.0.1:8000/api/posts');

  const [searchTerm, setSearchTerm] = useState('');

  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage, setItemsPerPage] = useState(3);  

  const handleSearchChange = (e) => {
    setSearchTerm(e.target.value);
    setCurrentPage(1); // Reset na prvu stranicu
  };

  const filteredPosts = posts.filter(post =>
    post.name.toLowerCase().includes(searchTerm.toLowerCase())
    || post.text.toLowerCase().includes(searchTerm.toLowerCase())
  );

  // paginacija
  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentItems = filteredPosts.slice(indexOfFirstItem, indexOfLastItem);

  const paginate = (pageNumber) => setCurrentPage(pageNumber);

  const pageNumbers = [];
  //za kreiranje broja dugmica za paginaciju
  for (let i = 1; i <= Math.ceil(filteredPosts.length / itemsPerPage); i++) {
    pageNumbers.push(i);
  }

  return (
    <>
    <Navbar></Navbar>
    <div className="posts">
      <div className='posts-search'>
      <input 
        type="text" 
        placeholder="Search posts..." 
        value={searchTerm}
        onChange={handleSearchChange}
        className="search-input"
      />
      </div>
      <div className='posts-section'>
      {currentItems.map(post => (
        <Post key={post.id} post={post} />
      ))}
      </div>
      <div className="pagination">
        {pageNumbers.map(number => (
          <button key={number} onClick={() => paginate(number)} className="page-number">
            {number}
          </button>
        ))}
      </div>
    </div>
    <Footer></Footer>
    </>
  );
};

export default Posts;
