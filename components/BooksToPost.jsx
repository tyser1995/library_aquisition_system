import Link from 'next/link';

export default function BooksDirector({ postBooks }) {
  return (
    <div className="md:container md:mx-aut ">
      <div className=" w-full lg:max-w-full lg:flex flex text-sm">
        <div className="border-2 rounded-l border-gray-400 lg:border-l-1 lg:border-t\
   lg:border-gray-400 bg-white  lg:rounded-b-1
    lg:rounded-r p-4 flex flex-col justify-between leading-normal"
        >
          <div className="mb-8">
            <img className="w-auto h-auto  lazy mr-4" src="bookcover.jpg" alt="Book Cover" />
          </div>
          <h4 className="text-gray-600 font-bold text-2xl mb-2">{postBooks.title}</h4>
          <p className="text-gray-600 mb-5">
            {postBooks.notereqform}
          </p>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold">Author</small>
              <p className="text-gray-600 mb-2 font-thin ">
                {postBooks.authorName}
              </p>
            </div>
          </div>
          <div>
            <small className="font-bold mr-2">Requestee ID</small>
            <p className=" font-thin ">
              { postBooks.userID}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Name</small>
            <p className=" font-thin ">
              { postBooks.requestee}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Position</small>
            <p className=" font-thin ">
              { postBooks.selectPosition}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Requestee Department</small>
            <p className=" font-thin ">
              { postBooks.selectDepartment}
            </p>
          </div>
          <div>
            <small className="font-bold">Publication Date</small>
            <p className=" font-thin">
              {new Date(postBooks.pubdate).toDateString()}
            </p>
          </div>
          <div>
            <small className="font-bold">Requested Date</small>
            <p className=" font-thin">
              {new Date(postBooks.date).toDateString()}
            </p>
            <Link href={`/books-to-print/${postBooks.requestID}`}>
              <button
                type="button"
                className="mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                     text-white bg-indigo-600 hover:bg-indigo-700
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Print Request
              </button>
            </Link>

          </div>

        </div>
      </div>
    </div>
  );
}
