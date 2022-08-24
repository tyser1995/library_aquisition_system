import Head from 'next/head';
import mysql from '../providers/mysql';
import validateSession from '../lib/session';
import { useMemo } from 'react';
import Link from 'next/link';
import ReactTable from '../components/table';
import { Form, Field } from 'react-final-form';

export const getServerSideProps = async (context) => {
  try {
    const { account } = await validateSession(context);

    const result = await mysql.query(`SELECT * FROM requestform WHERE 
   savePub = 1 AND status = 0`);

    const post = JSON.parse(JSON.stringify(result));
    return {
      props: { publisherBook: post, account },
    };
  } catch (error) {
    return { props: { post: false } };
  }
};

export default function publisherBook({ publisherBook }) {
  console.log(publisherBook);
  const columns = useMemo(
    () => [
      {
        Header: 'Acquisition #',
        accessor: 'requestID', // accessor is the "key" in the data
      },
    
    {
        Header: 'Publisher Name',
        accessor: 'pubName', // accessor is the "key" in the data
      },
      {
        Header: 'Publisher Address',
        accessor: 'pubAddress', // accessor is the "key" in the data
      },
      {
        Header: 'Athor Name',
        accessor: 'authorName',
      },
      {
        Header: 'Title',
        accessor: 'title', // accessor is the "key" in the data
      },
      {
        Header: 'Publish Date',
        accessor: 'pubdate', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>
            {new Date(values.pubdate).toDateString()}
          </div>
        ),

      },
      {
        Header: 'User ID',
        accessor: 'userID', // accessor is the "key" in the data
      },
      {
        Header: 'Requested By',
        accessor: 'requestee', // accessor is the "key" in the data
      },
      {
        Header: 'Department',
        accessor: 'selectDepartment', // accessor is the "key" in the data
      },

      {
        Header: 'Status',
        accessor: 'status', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (

          <div>

          {values.status  === 0 && 'Processing'}
          {values.status  === 4 && 'Posted'}


          </div>
          
        ),
      },
      {
        Header: () => 'Action',
        accessor: 'action',
        Cell: ({ row: { values } }) => (
          <Link href={`/updatepublisherbook/${values.requestID}`}>
            <button
              type="button"
              className="mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                                     text-white bg-indigo-600 hover:bg-indigo-700
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Update
            </button>
          </Link>
        ),
      },
    ],
    [],
  );

  return (
    <>
      <Head>
        <title>Library Acquisition | Track </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>
      <section className="max-w-screen from-blue-900 to-yellow-600 bg-base  min-h-screen mx-auto ">
        <form className=" p-14 bg-white rounded-md my-16 w- mx-auto h-auto w-auto shadow-lg ">
          <div className="flex-shrink-0 flex content-around items-center">
            <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
            <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
            <h1 className="text-xl  text-gray-600 ">Track your book</h1>
          </div>
          <div />
          <div className="text-xs shadow-md w-full mt-10 ">
            <span className="block  text-xs  text-gray-500 "> All Books</span>

        
            <ReactTable data={publisherBook} columns={columns} />
          </div>
        </form>
      </section>
    </>
  );
}
