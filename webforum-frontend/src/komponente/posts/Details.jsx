import { FaThumbsUp, FaThumbsDown, FaArrowLeft } from 'react-icons/fa';
import { useParams,  useNavigate } from 'react-router-dom';
import usePost from '../hooks/usePost';
import './Details.css';
import Footer from '../footer/Footer';
import Navbar from '../navbar/Navbar';


const Details = () => {
  const { id } = useParams();
  const post = usePost(id);
  const navigate = useNavigate();

  if (!post) {
    return <div>Loading...</div>;
  }

  const HandleBackToPosts = () => {
    navigate('/posts');
  };

  return (
    <>
    <Navbar></Navbar>
    <div className='details-page'>
    <div className="details-container">
      <div className="details-header" >
        <h2 className="details-title">{post.name}</h2>
        <p className="details-text">{post.text}</p>
        <p className="details-date">
          <strong>Date of posting: </strong> {post.date}</p>
      </div>
      <p className="details-info">
        <strong>Username: </strong> {post.user.name}
      </p>
      <p className="details-info">
        <strong>Thread name: </strong> {post.thread.name}
      </p>

      <div className="details-likes-dislikes">
        <strong>Likes and dislikes: </strong>
        <div className='icons-likes'>
        <strong>
          <FaThumbsUp style={{ color: 'pink' }} />
          {post.likes}
        </strong>
      </div>
      <div className="icons-dislikes">
        <strong>
          <FaThumbsDown style={{ color: 'pink' }} />
          {post.dislikes}
        </strong>
        </div>
      </div>
      <button onClick={HandleBackToPosts} className="back-to-posts-button">
        <FaArrowLeft style={{ marginRight: '5px' }} />
        Back to Posts
      </button>
      
     
  
    </div>
    </div>
    <Footer></Footer>

    </>
  );
};

export default Details;
