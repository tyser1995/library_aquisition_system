/* eslint-disable react/jsx-one-expression-per-line */
/* eslint-disable max-len */
/* eslint-disable comma-dangle */
/* eslint-disable object-curly-newline */
/* eslint-disable global-require */
/* eslint-disable quotes */
/* eslint-disable jsx-a11y/heading-has-content */
/* eslint-disable react/jsx-indent */
/* eslint-disable react/self-closing-comp */
/* eslint-disable react/no-this-in-sfc */
/* eslint-disable react/jsx-filename-extension */
/* eslint-disable no-restricted-syntax */
/* eslint-disable no-extend-native */
/* eslint-disable no-unused-vars */
/* eslint-disable indent */

import { useMemo } from "react";
import Head from "next/head";
import Link from "next/link";
import validateSession from "../lib/session";
import mysql from "../providers/mysql";
import ReactTable from "../components/table";

export const getServerSideProps = async (context) => {
  try {
    const result = await mysql.query(
      "SELECT * FROM requestform WHERE approvalDean = 1 AND approvalVpaa = 0"
    );
    const session = await validateSession(context);

    const post = JSON.parse(JSON.stringify(result));

    return {
      props: { booksVPAADisplay: post, session },
    };
  } catch (error) {
    return { props: { post: false } };
  }
};
export default function seeAllBooksVPAA({ booksVPAADisplay }) {
  console.log(booksVPAADisplay);
  const postRequestedBooks = useMemo(
    () => [
      {
        Header: "Acquisition #",
        accessor: "requestID", // accessor is the "key" in the data
      },

      {
        Header: "Requested Date",
        accessor: "date", // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>{new Date(values.date).toDateString()}</div>
        ),
      },
      {
        Header: "Author",
        accessor: "authorName", // accessor is the "key" in the data
      },
      {
        Header: "Title",
        accessor: "title", // accessor is the "key" in the data
      },
      {
        Header: "Publish Date",
        accessor: "pubdate", // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>{new Date(values.pubdate).toDateString()}</div>
        ),
      },
      {
        Header: "Number of Copies",
        accessor: "copvol", // accessor is the "key" in the data
      },
      {
        Header: "User ID",
        accessor: "userID", // accessor is the "key" in the data
      },
      {
        Header: "Requested By",
        accessor: "requestee", // accessor is the "key" in the data
      },
      {
        Header: "Position",
        accessor: "selectPosition", // accessor is the "key" in the data
      },
      {
        Header: "Department",
        accessor: "selectDepartment", // accessor is the "key" in the data
      },

      {
        Header: "Note",
        accessor: "notereqform", // accessor is the "key" in the data
      },

      {
        Header: () => "Action",
        accessor: "action",
        Cell: ({ row: { values } }) => (
          <Link href={`/approve-books-VPAA/${values.requestID}`}>
            <div
              className="  bg-gray-100  text-center  border border-transparent shadow-sm text-sm  rounded-md
                       hover:bg-base-700
                    focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer text-gray-600
                flex "
            >
              Update Request{" "}
              <svg
                xmlns="http://www.w3.org/2000/svg"
                className="h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fillRule="evenodd"
                  d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                  clipRule="evenodd"
                />
              </svg>
            </div>
          </Link>
        ),
      },
    ],
    []
  );

  return (
    <>
      <Head>
        <title>Library Acquisition | Books Requested </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>
      <section className="max-w-screen bg-base min-h-screen mx-auto ">
        <form className=" p-14 bg-white rounded-md my-16 w- mx-auto h-auto w-auto shadow-lg ">
          <div className="flex-shrink-0 flex content-around items-center">
            <img
              className="hidden lg:block h-14 w-auto  mr-3"
              src="/cpulogo.png"
              alt="okay"
            />
            <img
              className="block lg:hidden h-14 w-auto  mr-3"
              src="/cpulogo.png"
              alt="cpu logo"
            />
            <h1 className="text-xl  text-gray-600 ">All Requested Books</h1>
          </div>

          <div className="text-xs shadow-md w-full mt-10 p">
            <label htmlFor="selectDepartment" className="block ">
              <span className="block  text-xs  text-gray-500 "> All Books</span>

              <ReactTable
                data={booksVPAADisplay}
                columns={postRequestedBooks}
              />
            </label>
          </div>
        </form>
      </section>
    </>
  );
}
