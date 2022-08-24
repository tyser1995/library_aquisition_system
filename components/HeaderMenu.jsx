import axios from 'axios';
import Link from 'next/link';
import { mutate } from 'swr';
import isEmpty from 'lodash/isEmpty';

const HeaderMenu = ({ account, activities }) => {
  const booksToVerifyActivities = activities.filter((a) => a.identifier === 'books-to-verify');
  console.log('booksToVerifyActivities', booksToVerifyActivities);

  return (
    <div className="fixed shadow-xl items-end bg-base text-gray-700  rounded-md m-32 mt-20 z-50 w-auto h-72 pt-6">
      <div className="container  w-full flex flex-wrap justify-end">
        {account && (
          <>
            {['Acquisition', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-auto sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="justify-center items-center block">
                  <Link href="/see-all-books">
                    <span className="hover:bg-gray-300 cursor-pointer font-bold hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm "
                    >
                      See all requested books From Departments
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin   italic text-sm">All requested books coming from all Department</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}

        {account && (
          <>
            {['Acquisition', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">
                  <Link href="/see-all-verified-books">
                    <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      Verified Books from Custodian
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin italic text-sm">All requested books coming from all Department</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>
            {['Acquisition', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">
                  <Link href="/see-all-entry-form">
                    <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      Update Requested Books
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin italic text-sm">Entry of Books</p>
                    <p className=" text-gray-800 font-medium text-xs">Updating Requested Books</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
        <>
          {['Acquisition', 'Admin'].includes(account.selectPosition) && (
          <>
            <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
              <div className="block items-center">
                <Link href="/see-all-arrived-books">
                  <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                  >
                    All Arrived Books
                  </span>
                </Link>
                <div className="mt-1">
                  <p className=" text-gray-800 font-thin italic text-sm">All Books Arrived</p>
                  <p className=" text-gray-800 font-medium text-xs">Purchased Books</p>
                </div>
              </div>
            </ul>
          </>
          )}
        </>
        )}
        {account && (
          <>
            {['Acquisition', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">
                  <Link href="/see-all-confirmed-books">
                    <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      All Confirmed Books
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin italic text-sm">Ready to Release</p>
                    <p className=" text-gray-800 font-medium text-xs" />
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>
            {['Acquisition', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0  lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">
                  <Link href="/see-all-books-to-print">
                    <span className="hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      Print Request
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin italic text-sm">All requested books coming from all Department</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>
            {['Acquisition', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">
                  <Link href="/see-all-books-topurchase">
                    <button
                      className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                      type="button"
                      onClick={async () => {
                        await axios.post('/api/activities/update', {
                          identifier: 'books-to-verify',
                        });
                        mutate('/api/activities');
                      }}
                    >
                      Books to Verify
                      {!isEmpty(booksToVerifyActivities) && <div className="p-3 bg-red-500">{booksToVerifyActivities.length}</div>}
                    </button>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin italic text-sm">All requested books coming from all Department</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>

          </>
        )}
        {account && (
          <>
            {['Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">
                  <Link href="/registrationProfile">
                    <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      Register
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin italic  text-sm">All requested books coming from all Department</p>
                    <p className=" text-gray-800 font-medium text-xs">Approved by Dean</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>
            {['VPAA', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">

                  <Link href="/see-all-books-payment-vpaa">
                    <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      Requested Books for Payment
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin text-sm">All requested books coming from all Department</p>
                    <p className=" text-gray-800 font-medium text-xs">Approved by Dean</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>
            {['Finance', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center">

                  <Link href="/see-all-books-payment-finance">
                    <span className="hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                    >
                      Request for Payment
                    </span>
                  </Link>
                  <div className="mt-1">
                    <p className=" text-gray-800 font-thin text-sm">All requested books coming from all Department</p>
                    <p className=" text-gray-800 font-medium text-xs">Approved by Dean</p>
                  </div>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
          <>
            {['Custodian', 'Admin'].includes(account.selectPosition) && (
            <>
              <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
                <div className="block items-center" />
                <Link href="/see-all-books-custodian">
                  <span className="hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                  >
                    Books to Verify
                  </span>
                </Link>
                <div className="mt-1">
                  <p className=" text-gray-800 font-thin italic text-sm">All requested books coming from all Department</p>
                  <p className=" text-gray-800 font-medium text-xs">Approved by Dean</p>
                </div>
              </ul>
            </>
            )}
          </>
        )}
        {account && (
        <>
          {['Acquisition', 'Admin'].includes(account.selectPosition) && (
          <>
            <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
              <div className="block items-center" />
              <Link href="/see-all-books-inventory">
                <span className="hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                >
                  Inventory
                </span>
              </Link>
              <div className="mt-1">
                <p className=" text-gray-800 font-thin italic text-sm">All Books</p>
                {/* <p className=" text-gray-800 font-medium text-xs">Approved by Dean</p> */}
              </div>
            </ul>
          </>
          )}
        </>
        )}
        {['Acquisition', 'Admin'].includes(account.selectPosition) && (
        <>
          <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
            <div className="block items-center">
              <Link href="/budgeting-input-budget">
                <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                >
                  Budgeting
                </span>
              </Link>
              <div className="mt-1">
                <p className=" text-gray-800 font-thin italic text-sm">Go to Budgeting</p>
              </div>
            </div>
          </ul>
        </>
        )}
        {['Acquisition', 'Admin'].includes(account.selectPosition) && (
          <>
            <ul className="px-4 w-aut sm:w-1/2 lg:w-1/4 border-gray-400 border-b sm:border-r-0 lg:border-b-0 pb-3 pt-3 lg:pt-1 ">
              <div className="block items-center">
                <Link href="/see-all-total-cost">
                  <span className=" hover:bg-gray-300 cursor-pointer hover:text-gray-700 text-blue-700 px-auto mx-auto
                       text-sm font-medium"
                  >
                    Total Cost
                  </span>
                </Link>
                <div className="mt-1">
                  <p className=" text-gray-800 font-thin italic text-sm">Go to Total Cost</p>
                  <p className=" text-gray-800 font-medium text-xs">See all Total cost of Books per Department</p>

                </div>
              </div>
            </ul>
          </>
        )}

      </div>
    </div>
  );
};

export default HeaderMenu;
