import Link from 'next/link';

export default function RequestedCardsPresident({ booksDisplayToPurchase }) {
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

          <h4 className="text-gray-600 font-bold text-2xl mb-2">{booksDisplayToPurchase.title}</h4>
          <p className="text-gray-600 mb-5">
            {booksDisplayToPurchase.notereqform}
          </p>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold">Author</small>
              <p className="text-gray-600 mb-2 font-thin ">
                {booksDisplayToPurchase.authorName}
              </p>
            </div>
          </div>
          <div>
            <small className="font-bold">Price</small>
            <p className="text-gray-600 mb-2 font-thin ">
              {booksDisplayToPurchase.price}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Requestee ID</small>
            <p className=" font-thin ">
              {booksDisplayToPurchase.userID}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Name</small>
            <p className=" font-thin ">
              {booksDisplayToPurchase.requestee}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Position</small>
            <p className=" font-thin ">
              {booksDisplayToPurchase.selectPosition}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Requestee Department</small>
            <p className=" font-thin ">
              {booksDisplayToPurchase.selectDepartment}
            </p>
          </div>
          <div>
            <small className="font-bold mr-2">Approved By:</small>
            <p className=" font-thin ">
              Finance 
              <div>{booksDisplayToPurchase.approvalFinance}</div>
            </p>
            <p className=" font-thin ">
              President 
              <div>{booksDisplayToPurchase.approvalPresident}</div>
            </p>
          </div>
          <div>
            <small className="font-bold">Publication Date</small>
            <p className=" font-thin">
              {new Date(booksDisplayToPurchase.pubdate).toDateString()}
            </p>
          </div>
          <div>
            <small className="font-bold">Requested Date</small>
            <p className=" font-thin">
              {new Date(booksDisplayToPurchase.date).toDateString()}
            </p>
            <Link href={`/send-to-custodian/${booksDisplayToPurchase.requestID}`}>
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
