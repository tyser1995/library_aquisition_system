import Link from 'next/link';
import { signOut, useSession } from 'next-auth/client';
import { Fragment, useState } from 'react';
import useSWR from 'swr';
import isEmpty from 'lodash/isEmpty';
import HeaderMenu from './HeaderMenu';

export default function Header() {
  const [session] = useSession();
  const [open, setOpen] = useState(false);
  const { account } = session || {};

  const { data: activities } = useSWR('/api/activities', {
    refreshInterval: 10000,
  });

  // console.log('activities', activities);

  // console.log(account);

  return (
    <>
      <nav className="bg-navbg   fixed left-0 right-0 top-0 p-1">
        <div className="max-w-10xl MT mx-auto px-2 sm:px-6 lg:px-8">
          <div className=" flex items-center justify-between h-16">
            <div className=" inset-y-0 left-0 flex items-center sm:hidden">
              <button type="button" className="inline-flex  cursor-pointer items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                <span className="sr-only">Open main menu</span>

              </button>
            </div>
            <div className="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start ">
              <div className="flex-shrink-0 flex items-center cursor-pointer">
                <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                <Link href="/"><img className="hidden lg:block h-12 w-auto  cursor-pointerrounded mr-3" src="/cpulogo.png" alt="okay" /></Link>
                <Link href="/"><h1 className="mr- text-2xl text-gray-100   cursor-pointer"> University Library Acquisition</h1></Link>
                <div className="hidden sm:block sm:ml-6">
                  <div className="flex space-x-4">
                    <Link href="/">
                      <span className="hover:bg-gray-900 hover:text-white text-gray-300
                    px-3 py-2 rounded-md text-sm font-medium"
                      >
                        Home
                      </span>
                    </Link>
                    <Link href="/contactUs">
                      <span className="hover:bg-gray-900 hover:text-white text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium"
                      >
                        Contact Us
                      </span>
                    </Link>
                    <Link href="/aboutUs">
                      <span className=" hover:bg-gray-900 hover:text-white text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium"
                      >
                        About Us
                      </span>
                    </Link>
                  </div>
                </div>
              </div>
            </div>

            {account && (
              <>
                {['Acquisition', 'Admin', 'Acquisition'].includes(account.selectPosition) && (
                  <button
                    type="button"
                    className=" block py-2 px-2 lg:p-2 text-sm lg:text-base font-medium hover:bg-gray-400 hover:text-gray-700"
                    onClick={async () => {
                      setOpen(!open);
                    }}
                  >
                    Menu
                    {!isEmpty(activities) && <div className="p-3 bg-red-500">{activities.length}</div>}
                  </button>
                )}
              </>
            )}
            {account && (

              <>
                {['VPAA', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-vpaa">
                      <span className="hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        All Requested Books
                      </span>
                    </Link>
                  </>
                )}
                {['Director of Libraries', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-approved-director">
                      <span className="hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approved Books
                      </span>
                    </Link>
                  </>
                )}
                {['Director of Libraries', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-director">
                      <span className="hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Request for Payments
                      </span>
                    </Link>

                  </>
                )}
                {['VPAA', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-approved-vpaa">
                      <span className="hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approved Books
                      </span>
                    </Link>
                  </>
                )}

                {['Custodian', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-custodian">
                      <span className="hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Books to Verify
                      </span>
                    </Link>
                  </>
                )}

                {['Dean', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-dean">
                      <div className=" hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        All Requested Books

                      </div>

                    </Link>
                  </>
                )}
                {['Dean', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-approved-dean">
                      <div className=" hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approved Books

                      </div>

                    </Link>
                  </>
                )}
                {['President', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-president">
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approve Books From Finance
                      </div>

                    </Link>
                  </>
                )}
                {['President', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-approved-president">
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approved Books
                      </div>

                    </Link>
                  </>
                )}
                {['Finance', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-finance
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approve Price
                      </div>

                    </Link>
                  </>
                )}

                {['Finance', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-approved-finance
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Approved Books
                      </div>

                    </Link>
                  </>
                )}
                {['VPAA', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-payment-vpaa
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Books request Payment
                      </div>

                    </Link>
                  </>
                )}
                {['Finance', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-payment-finance
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Books request Payment
                      </div>

                    </Link>
                  </>
                )}
                {['Publisher', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/save-books-publisher
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Post your Books
                      </div>

                    </Link>
                  </>
                )}
                {['Acquisition'].includes(account.selectPosition) && (
                  <>
                    <Link href="/register-publisher
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Register a Publisher
                      </div>

                    </Link>
                  </>

                )}
                {['Acquisition'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-pub-req
"
                    >
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Update Books Publisher
                      </div>

                    </Link>
                  </>

                )}
                {['Faculty', 'Admin'].includes(account.selectPosition) && (
                  <>
                    <Link href="/see-all-books-track">
                      <div className="   hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      >
                        Track your Book
                      </div>
                    </Link>
                  </>
                )}

                {['Acquisition'].includes(account.selectPosition) && (
                  <Link href="/see-all-books-try">
                    <div
                      className="    hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                      s
                    >
                      Requested Books (New Edition)
                    </div>
                  </Link>
                )}
                {['Acquisition'].includes(account.selectPosition) && (
                  <Link href="/see-all-books-track-librarian">
                    <div className="    hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                    >
                      Track
                    </div>
                  </Link>
                )}

                {['Publisher'].includes(account.selectPosition) && (
                  <Link href="/see-all-track-publisher">
                    <div className="    hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                    >
                      See your Books
                    </div>
                  </Link>
                )}
                {['Acquisition'].includes(account.selectPosition) && (
                  <Link href="/see-all-approved-acquisition">
                    <div className="    hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                    >
                      Approved Books
                    </div>
                  </Link>
                )}
                {['Faculty'].includes(account.selectPosition) && (
                  <Link href="/requestform">
                    <div className="    hover:bg-gray-900 hover:text-white  cursor-pointer text-gray-300
                  px-3 py-2 rounded-md text-sm font-medium mr-2"
                    >
                      Request Books
                    </div>
                  </Link>
                )}
              </>
            )}
            {!account && (
              <>
                <Link href="/login">
                  <div className="cursor-pointer
                text-white px-3 py-2 rounded-md text-sm font-medium "
                  >
                    Sign In
                  </div>
                </Link>
              </>
            )}
            {account && (
              <>
                <div className="min-h-screen  flex flex-col justify-center sm:py-12">
                  <div className="flex items-center justify-center p-1">
                    <div className=" relative inline-block text-left dropdown">
                      <span className="rounded-md shadow-sm">
                        <button
                          className="inline-flex justify-center w-full transition duration-150 ease-in-out rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800"
                          type="button"
                          aria-haspopup="true"
                          aria-expanded="true"
                          aria-controls="headlessui-menu-items-117"
                        >
                          <div className="sec self-center pr-1">
                            <img data="picture" className="h-10 w-10 border rounded-full" src="https://lh3.googleusercontent.com/ogw/ADea4I6N5g9eo7pju00pg3_BF7q6WGS4m6iEzuLJ4iRskA=s32-c-mo" alt="" />
                          </div>
                        </button>
                      </span>
                      <div className="opacity-0 invisible dropdown-menu duration-300 transform origin-top-right -translate-y-2 scale-95">
                        <div className="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                          <div className="px-4 py-3">
                            <p className="text-sm font-bold leading-5">Signed in as:</p>
                            <div className="text-gray-800   ">
                              <div className="flex font-medium ">
                                <small>
                                  {' '}
                                  ID:
                                  {account.id}
                                </small>
                              </div>
                              <div className="flex py-0.5">
                                <div className="name text-xs font-medium ">
                                  {' '}
                                  {account.pubName && (
                                    <div className="text-xs text-gray-500">
                                      Publisher Name:
                                      <div className="text-xs font-normal">
                                        {' '}
                                        {account.pubName}
                                        {' '}
                                      </div>

                                      <div className="text-xs font-normal">
                                        {' '}
                                        Publisher: &nbsp;
                                        {' '}
                                        <div className="text-xs font-semibold">
                                          {' '}
                                          {account.pubAddress}
                                        </div>
                                        {' '}
                                      </div>

                                    </div>

                                  )}

                                  {account.fname}
                                  &nbsp;
                                  {account.mname}
                                  &nbsp;
                                  {account.lname}
                                </div>
                              </div>
                              <div className="flex">
                                <div className="name text-xs font-medium ">
                                  {' '}
                                  {account.selectPosition}
                                </div>
                              </div>
                              <div className="title text-xs font-medium ">
                                {' '}
                                {account.selectDepartment}
                              </div>
                            </div>

                          </div>
                          <div className="py-1">
                            <span role="menuitem" tabIndex="-1" className="flex justify-between w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 cursor-not-allowed opacity-50" aria-disabled="true">View Profile(Next Update)</span>

                          </div>

                          <Link href="/">

                            <div
                              onClick={signOut}
                              className="cursor-pointer
                            hover:text-gray-300
text-gray-900 px-3 py-2 rounded-md
 text-sm font-medium "
                            >
                              Sign Out
                            </div>
                          </Link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </>
            )}

          </div>
        </div>
      </nav>
      {open && (
        <>
          <HeaderMenu account={account} activities={activities} />
          <div className="dropdown-overlay" onClick={() => setOpen(false)} role="presentation" />
        </>
      )}
    </>
  );
}
