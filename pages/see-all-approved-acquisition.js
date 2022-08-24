import { useMemo } from 'react';
import Head from 'next/head';
import Link from 'next/link';
import validateSession from '../lib/session';
import mysql from '../providers/mysql';
import ReactTable from '../components/table';

export const getServerSideProps = async (context) => {
  try {
    const { account } = await validateSession(context);

    const result = await mysql.query(`SELECT * FROM requestform WHERE approvalAcqui = 1  `);

    const post = JSON.parse(JSON.stringify(result));
    return {
      props: { approvalAcqui: post, account },
    };
  } catch (error) {
    return { props: { post: false } };
  }
};

export default function AllApprovedDirector({ approvalAcqui }) {
  console.log(approvalAcqui);
  const postRequestedBooks = useMemo(
    () => [
      {
        Header: 'Acquisition #',
        accessor: 'requestID', // accessor is the "key" in the data
      },

      {
        Header: 'Requested Date',
        accessor: 'date', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>
            {new Date(values.date).toDateString()}
          </div>
        ),
      },
      {
        Header: 'Author',
        accessor: 'authorName', // accessor is the "key" in the data
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
        Header: 'Position',
        accessor: 'selectPosition', // accessor is the "key" in the data
      },
      {
        Header: 'Department',
        accessor: 'selectDepartment', // accessor is the "key" in the data
      },
      {
        Header: 'Approved By Acquisition',
        accessor: 'approvalAcqui', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>
            {values.approvalAcqui ? 'Yes' : 'No'}
          </div>
        ),
      },
      {
        Header: 'Approved Date',
        accessor: 'entryDate', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>
            {new Date(values.entryDate).toDateString()} 
            {/* {/* entryDate is ApprovalDateAcquisition */ }
          </div>
        ),

      },

    ],
    [],
  );

  return (
    <>
      <Head>
        <title>Library Acquisition | Approved Books </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>
      <section className="max-w-screen bg-base min-h-screen mx-auto ">

        <form className=" p-14 bg-white rounded-md my-16 w- mx-auto h-auto w-auto shadow-lg ">
          <div className="flex-shrink-0 flex content-around items-center">

            <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
            <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
            <h1 className="text-xl  text-gray-600 ">Approved Books by Acquisition</h1>

          </div>

          <div className="text-xs shadow-md w-full mt-10 p">
            <label htmlFor="selectDepartment" className="block ">
              <span className="block  text-xs  text-gray-500 "> All Books</span>

              <ReactTable data={approvalAcqui} columns={postRequestedBooks} />
            </label>
          </div>

        </form>
      </section>
    </>
  );
}
