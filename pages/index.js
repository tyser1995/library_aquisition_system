import Head from 'next/head';
import { useSession } from 'next-auth/client';
import BookCards from '../components/BookCards';

export const getStaticProps = async () => {
  const res = await fetch('http://localhost:3000/api/postBooks');
  const posts = await res.json();

  console.log(res);
  return {
    props: { booksDisplay: posts },
  };
};

const Home = ({ booksDisplay }) => {
  const [session] = useSession();

  return (
    <>
      <Head>
        <title>Library Acquisition | Home </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />

      </Head>

      <div className=" w-full  sm:px-6 lg:px-8 shadow-md">
        <img src="/1234.jpg" className="  mt-16 w-full h-10/12  mx-auto" alt="1234" width={1348}/>
      </div>

      {/* <div>
        <h2 className=" bg-gray-500 text-yellow-50 text-center w-3/4 mx-auto p-4 mt-2 rounded">
          {!session && (
            <>
              <span className="mr-3 font-bold text-l">
                Sign In to
              </span>
            </>
          )}
          See Whats new!
        </h2>
      </div> */}
      <div className="p-28 grid grid-cols-3 gap-1
        sm:grid-cols-5 md:grid-cols-5 lg:grid-cols-5
         xl:grid-cols-4" >
        {session && (
        <>
          {
                booksDisplay && booksDisplay.map((books) => (
                  <BookCards books={books} key={books.entryBooksID} />
                ))
              }
        </>
        )}
      </div>

    </>
  );
};
export default Home;
