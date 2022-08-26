/* eslint-disable no-shadow */
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
import validateSession from "../lib/session";
import mysql from "../providers/mysql";
import ReactTable from "../components/table";

export const getServerSideProps = async (context) => {
  try {
    const { account } = await validateSession(context);

    const result = await mysql.query(
      `SELECT * FROM requestform WHERE approvalVpaa = 1  `
    );

    const post = JSON.parse(JSON.stringify(result));
    return {
      props: { approvedVPAA: post, account },
    };
  } catch (error) {
    return { props: { post: false } };
  }
};

export default function AllApprovedVPAA({ approvedVPAA }) {
  console.log(approvedVPAA);
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
        Header: "Approved By VPAA",
        accessor: "approvalVpaa", // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>{values.approvalVpaa ? "Yes" : "No"}</div>
        ),
      },
      {
        Header: "Approved Date",
        accessor: "approvalDateVPAA", // accessor is the "key" in the data
        Cell: ({ row: { values } }) => (
          <div>{new Date(values.approvalDateVPAA).toDateString()}</div>
        ),
      },
    ],
    []
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
            <h1 className="text-xl  text-gray-600 "> Approved Books by VPAA</h1>
          </div>

          <div className="text-xs shadow-md w-full mt-10 p">
            <label htmlFor="selectDepartment" className="block ">
              <span className="block  text-xs  text-gray-500 "> All Books</span>

              <ReactTable data={approvedVPAA} columns={postRequestedBooks} />
            </label>
          </div>
        </form>
      </section>
    </>
  );
}
