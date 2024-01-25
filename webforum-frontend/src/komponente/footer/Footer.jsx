import React from 'react';
import { FaArrowUp } from 'react-icons/fa';
import './Footer.css';

const Footer = () => {
  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <footer className="footer">
      <div className="footer-content">
        <p>  2024 Veb Forum. All rights reserved.</p>
        <button className="scroll-to-top" onClick={scrollToTop}>
          Scroll to top: <FaArrowUp />
        </button>
      </div>
    </footer>
  );
};

export default Footer;