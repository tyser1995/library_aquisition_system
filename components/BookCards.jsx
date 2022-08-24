import Link from 'next/link';


const bookcards = ({ books }) => (
  <div className="md:container md:mx-auto">
    <div className=" w-full lg:max-w-full lg:flex flex text-sm">
      <div className="border-2 rounded-l border-gray-400 lg:border-l-1 lg:border-t
       lg:border-gray-400 bg-white  lg:rounded-b-1
        lg:rounded-r p-4 flex flex-col justify-between leading-normal"
      >
        <div className="mb-8">
          <img className="w-auto h-auto  lazy mr-4" src="bookcover.jpg" alt="Book Cover" />
        </div>
        <small className="font-thin text-gray-700">
          {books.bookRef}
        </small>
        <h3 className="text-gray-600 font-bold text-2xl mb-2">{books.title}</h3>
        <p className="text-gray-600 mb-5">
          {books.title}
        </p>
        <div className="flex justify-between text-gray-600 text-xs">
          <div>
            <small className="font-bold">Author</small>
            <p>
              {books.authorName}
            </p>
            <small className="font-bold">Publisher Address</small>
            <p>
              {books.pubAddress}
            </p>
         
          </div>
          <div>
            <small className="font-bold">Publisher Name</small>
            <p>
              {books.pubName}
            </p>
          </div>
          <div>
            <small className="font-bold">Publication Date</small>
            <p>
              {new Date(books.pubdate).toDateString()}
            </p>
            <small className="font-bold mt-2">Edition</small>
            <p>
              {books.edition}
            </p>
          </div>
          <div>
            <small className="font-bold">Posted Date</small>
            <p>
              {new Date(books.updateDate).toDateString()}
            </p>
            <small className="font-bold">Copy/Volume</small>
            <p>
              {books.copvol}
            </p>
            
          </div>
          <div></div>
          
        </div>
        <div className=" text-right mt-3 text-gray-600 text-xs">
        <Link href={`/requestbook/${books.requestID}`}>
              <button
                type="button"
                className="mx-auto mt-3 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                     text-white bg-indigo-600 hover:bg-indigo-700
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
              >
                Request this Books
              </button>
            </Link>

        </div>


    
      </div>
    </div>
  </div>
);

export default bookcards;
