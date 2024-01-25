import { useState, useEffect } from 'react';
import axios from 'axios';

const useUsers = (url) => {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchUsers = async () => {
      try {
        const response = await axios.get(url);
        setUsers(response.data.data);
      } catch (error) {
        setError(error.message);
      } finally {
        setLoading(false);
      }
    };

    fetchUsers();
  }, [url]);

  return { users, loading, error };
};

export default useUsers;