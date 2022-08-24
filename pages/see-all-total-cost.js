import Head from 'next/head';
import { useMemo } from 'react';
import Link from 'next/link';
import api from '../lib/api';
import ReactTable from '../components/table';

export const getServerSideProps = async () => {
  const { data } = await api.get('/api/totalCost');

  return {
    props: { totalCost: data },
  };
};

export default function TotalCost({ totalCost }) {
  console.log(totalCost);
  const columns = useMemo(
    () => [
      {
        Header: 'Department',
        accessor: 'selectDepartment', // accessor is the "key" in the data
      },
      {
        Header: 'Total Cost',
        accessor: 'sum(price)', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => `₱${values['sum(price)']}`,
      },
    ],
    [],
  );

  return (
    <>
      <Head>
        <title>Library Acquisition | Total Cost  </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>

      <section className=" mx-auto  md:flex bg-base  min-h-screen ">

        <form className=" px-8 p-10 bg-white rounded-md my-16 w- mx-auto h-auto w-4/5 shadow-lg ">

          <div className="flex-shrink-0 flex content-around items-center">

            <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
            <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
            <h1 className="text-xl  text-gray-600 ">Total Cost of Books by every Department</h1>

          </div>

          <div className="mt-9 shadow-md">
            <ReactTable data={totalCost} columns={columns} />
          </div>
          <div className="flex  justify-end mt-9">
            <Link href="/budgeting-input-budget">
              <div className="     cursor-pointer text-gray-600
                rounded-md text-sm font-medium flex "
              >
                Go to Budgeting
                {' '}
                <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fillRule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clipRule="evenodd" />
                </svg>
              </div>
            </Link>
          </div>

        </form>
      </section>
    </>
  );
}
