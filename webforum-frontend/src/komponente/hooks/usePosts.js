 import { useState, useEffect } from 'react';
import axios from 'axios';

//ova custom hook sluzi nam za dohvatanje postova sa prosledjenog urla
const usePosts = (url) => {
  const [Posts, setPosts] = useState([]);

  useEffect(() => {
    axios.get(url)
      .then(response => {
        setPosts(response.data.data);
      })
      .catch(error => console.error('Error fetching data:', error));
  }, [url]);

  return [Posts, setPosts];
};

export default usePosts;
