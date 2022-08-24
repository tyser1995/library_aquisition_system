import Link from 'next/link';

export default function RequestedCardsPresident({ booksDisplayPresident }) {
  return (
    <div className="md:container md:mx-aut heat">
      <div className=" w-full lg:max-w-full lg:flex flex text-sm">
        <div className="border-2 rounded-l border-gray-400 lg:border-l-1 lg:border-t
   lg:border-gray-400 bg-white  lg:rounded-b-1
    lg:rounded-r p-4 flex flex-col justify-between leading-normal"
        >
          <div className="mb-8">
            <img className="w-auto h-auto  lazy mr-4" src="bookcover.jpg" alt="Book Cover" />
          </div>

          <h4 className="text-gray-600 font-bold text-2xl mb-2">{booksDisplayPresident.title}</h4>
          <p className="text-gray-600 mb-5">
            {booksDisplayPresident.notereqform}
          </p>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold">Author</small>
              <p className="text-gray-600 mb-2 font-thin ">
                {booksDisplayPresident.authorName}
              </p>
            </div>
          </div>
          <div>
            <small className="font-bold">Price</small>
            <p className="text-gray-600 mb-2 font-thin ">
              {booksDisplayPresident.price}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Requestee ID</small>
            <p className=" font-thin ">
              { booksDisplayPresident.userID}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Name</small>
            <p className=" font-thin ">
              { booksDisplayPresident.requestee}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Position</small>
            <p className=" font-thin ">
              { booksDisplayPresident.selectPosition}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Requestee Department</small>
            <p className=" font-thin ">
              { booksDisplayPresident.selectDepartment}
            </p>
          </div>
          <div>
            <small className="font-bold">Publication Date</small>
            <p className=" font-thin">
              {new Date(booksDisplayPresident.pubdate).toDateString()}
            </p>
          </div>
          <div>
            <small className="font-bold">Requested Date</small>
            <p className=" font-thin">
              {new Date(booksDisplayPresident.date).toDateString()}
            </p>
            <Link href={`/approve-books-president/${booksDisplayPresident.requestID}`}>
              <button
                type="button"
                className="mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                     text-white bg-indigo-600 hover:bg-indigo-700
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Update Request
              </button>
            </Link>

          </div>

        </div>
      </div>
    </div>
  );
}
