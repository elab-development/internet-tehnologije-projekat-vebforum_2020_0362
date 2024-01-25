import React from 'react';
import { useNavigate } from 'react-router-dom';

const Post = ({ post }) => {
  const navigate = useNavigate();

  const goToDetails = () => {
    navigate(`/posts/${post.id}`);
  };

  return (
    <div className="post">
      <h2>{post.name}</h2>
      <p>{post.text}</p>
      <button onClick={goToDetails} className="details-button">See more</button>
    </div>
  );
};

export default Post;
