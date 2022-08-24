import Link from 'next/link';

export default function BookCards({ requestBook }) {
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
          <small className="font-thin text-gray-700">
            {requestBook.rushornrush}
          </small>

          <h4 className="text-gray-600 font-bold text-2xl mb-2">{requestBook.title}</h4>
          <p className="text-gray-600 mb-5">
            {requestBook.notereqform}
          </p>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold">Author</small>
              <p className="text-gray-600 mb-2 font-thin ">
                {requestBook.authorName}
              </p>
            </div>
            <div>
              <small className="font-bold">Publisher</small>
              <p className="font-thin ">
                {requestBook.pubName}
              </p>
            </div>
            <div>
              <small className="font-bold ">Publisher Address</small>
              <p className="font-thin px-4">
                {requestBook.pubAddress}
              </p>
            </div>
            <div>
              <small className="font-bold">Edition</small>
              <p className="font-thin  underline">
                {requestBook.edition}
              </p>
            </div>
            <div>
              <small className="font-bold">Copy of Volumes</small>
              <p className="px-9 underline font-thin ">
                {requestBook.copvol}
              </p>
            </div>
            <div>
              <small className="font-bold ">Subject</small>
              <p className=" font-thin ">
                {requestBook.subject}
              </p>
            </div>

          </div>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold ">Recommended By</small>
              <p className="mb-2 font-thin underline">
                {requestBook.recomby}
              </p>
            </div>
            <div>
              <small className="font-bold ">Position</small>
              <p className=" font-thin ">
                {requestBook.position}
              </p>
            </div>
            <div>
              <small className="font-bold ">Charge to</small>
              <p className=" font-thin underline ">
                {requestBook.chargeto}
              </p>
            </div>
            <div>
              <small className="font-bold mr-2">Existing # of Titles</small>
              <p className=" font-thin ">
                {requestBook.enumtitle}
              </p>
            </div>

          </div>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold mr-2">Dealer</small>
              <p className=" font-thin mb-2">
                {requestBook.dealer}
              </p>
            </div>
            <div>
              <small className="font-bold mr-2">Price</small>
              <p className=" font-thin ">
                {requestBook.price}
              </p>
            </div>
            <div>
              <small className="font-bold mr-2">Dated</small>
              <p className=" font-thin ">
                {requestBook.dated}
              </p>
            </div>
            <div>
              <small className="font-bold mr-2">SI #</small>
              <p className=" font-thin ">
                {requestBook.sinumb}
              </p>
            </div>
            <div>
              <small className="font-bold mr-2">Added As</small>
              <p className=" font-thin ">
                {requestBook.addedAs}
              </p>
            </div>

          </div>
          <div className="flex justify-between space-x-1 text-gray-600 text-xs">
            <div>
              <small className="font-bold mr-2">Status</small>
              <p className=" font-thin ">
                { requestBook.status}
              </p>
            </div>
            <div>
              <small className="font-bold">Publication Date</small>
              <p className=" font-thin">
                {new Date(requestBook.pubdate).toDateString()}
              </p>
            </div>
            <div>
              <small className="font-bold">Requested Date</small>
              <p className=" font-thin">
                {new Date(requestBook.date).toDateString()}
              </p>
              <Link href={`/approve-books-acquisition/${requestBook.requestID}`}>
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
    </div>
  );
}
