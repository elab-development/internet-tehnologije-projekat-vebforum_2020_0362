import { useState, useEffect } from 'react';
import axios from 'axios';

const usePost = (postId) => {
  const [post, setPost] = useState(null);

  useEffect(() => {
    axios.get(`http://127.0.0.1:8000/api/posts/${postId}`)
      .then(response => {
        setPost(response.data.data);
      })
      .catch(error => console.error('Error fetching data:', error));
  }, [postId]);

  return post;
};

export default usePost;