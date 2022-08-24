import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import api from '../../lib/api';

export const getServerSideProps = async (context) => {
  const { requestedDetailsID } = context.query;
  const { data } = await api.get(`/api/details/${requestedDetailsID}`);

  console.log(data);

  return {
    props: { requestedDetailsID: data },

  };
};

export default function RequestForm({requestedDetailsID }) {
  const handleOnSubmit = async (payload) => {
    const { data } = await axios.post('/api/bookUpdatePresident', payload);
    alert(data.message);
  };

  const [session] = useSession();
  return (

    <section className=" mx-auto bg-base   md:flex min-h-screen ">

      <Head>
        <title>Library Acquisition | Entry of Books </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>
      {!session && (
        <>
          <div className=" mx-auto p-10 md:flex bg-gray-500  border-blue-900 border-1 rounded">
            <span className="
         text-gray-600 px-3 py-2 rounded-md text-sm font-medium"
            >
              Please Sign In First
            </span>
          </div>
        </>
      )}

      {session && (
        <>
          <Form
            onSubmit={handleOnSubmit}
            render={({ handleSubmit }) => (

              <form onSubmit={handleSubmit} className=" px-8 pt-8 pb-8 bg-white rounded-md my-16 shadow-md w-full mx-auto h-auto  ">

                <div className="flex-shrink-0 flex content-around items-center">

                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl  text-gray-600 ">Print</h1>
                </div>

                <div className="flex space-x-6 content-around items-center mt-10 justify-end p-8">
   
                  <label htmlFor="date" className="block  mr-3">
                    <span className="block  text-xs text-gray-500 ">Requested Date</span>
                    <Field
                      className="text-gray-500 rounded-md  w-full
                        focus:placeholder-gray-700 focus:border-gray-500 border-0
                        cursor-pointer placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                      name="date"
                      component="input"
                      type="text"
                      Required
                      initialValue={new Date(requestedDetailsID.date).toDateString()}
                      disabled
                    />
                  </label>

                </div>
                <div className="grid grid-cols-3 gap-x-4 gap-y-6 p-8 border-1 ">
                  <div className="row-start-1">
                    <label htmlFor="title" className=" ">
                      <span className=" mt-2 text-xs  text-gray-500 ">User ID</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={requestedDetailsID.userID}
                        disabled
                      />
                    </label>
                    <label htmlFor="title" className=" ">
                      <span className="  text-xs  text-gray-500 ">Name</span>

                      <Field
                        className="  block text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={requestedDetailsID.requestee}
                        disabled
                      />
                    </label>
                    <label htmlFor="title" className=" ">
                      <span className="  text-xs  text-gray-500 ">Department</span>

                      <Field
                        className=" block text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="selectDepartment"
                        type="text"
                        initialValue={requestedDetailsID.selectDepartment}
                        disabled
                      />
                    </label>

                    <label htmlFor="title" className=" ">
                      <span className="  text-xs  text-gray-500 ">Position</span>

                      <Field
                        className=" block text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="selectPosition"
                        type="text"
                        initialValue={requestedDetailsID.selectPosition}
                        disabled
                      />
                    </label>

                  </div>
                  <div className="row-start-1 col-span-2">
                    <label htmlFor="author" className="">
                      <span className=" hover:textColor-red text-xs  text-gray-500 mb-1">Author</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-2/4
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="authorName"
                        type="text"
                        placeholder="Author"
                        initialValue={requestedDetailsID.authorName}
                        disabled
                      />
                    </label>

                    <label htmlFor="title" className=" ">
                      <span className="  text-xs text-gray-500 ">Title</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="title"
                        type="text"
                        placeholder="Title"
                        initialValue={requestedDetailsID.title}
                        disabled
                      />
                    </label>
                    <label htmlFor="chargedto" className="">
                      <span className="  text-xs  text-gray-500 mb-1">Publisher Name</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-2/4
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="pubName"
                        type="text"
                        initialValue={requestedDetailsID.pubName}
                        disabled
                      />
                    </label>
                    <label htmlFor="chargedto" className=" ">
                      <span className="  text-xs  text-gray-500 ">Publisher Address</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-2/4
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="pubAddress"
                        type="text"
                        placeholder="Publisher Address"
                        initialValue={requestedDetailsID.pubAddress}
                        disabled
                      />
                    </label>

                  </div>

                  <div className="row-start-2 ">
                    <label htmlFor="copvol" className=" ">
                      <span className="  text-xs  text-gray-500">Copies</span>
                      <Field
                        className="  block text-gray-500 rounded-md  w-full
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="copvol"
                        type="text"
                        placeholder="#"
                        initialValue={requestedDetailsID.copvol}
                        disabled
                      />
                    </label>
                    <label htmlFor="edition" className="">
                      <span className="  text-xs  text-gray-500 ">Edition</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-full
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="edition"
                        type="text"
                        placeholder="Edition"
                        initialValue={requestedDetailsID.edition}
                        disabled
                      />
                    </label>
                    <label htmlFor="chargedto" className=" h-48">
                      <span className="block  text-xs  text-gray-500 mb-1">Charge to</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="chargeto"
                        type="text"
                        placeholder="Charge to"
                        initialValue={requestedDetailsID.chargeto}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-2 col-span-2">
                    <label htmlFor="subjectr" className="">
                      <span className="  text-xs text-gray-500 mb-1">Subject</span>
                      <Field
                        className=" block text-gray-500 rounded-md  w-full
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="subject"
                        type="text"
                        placeholder="Subject "
                        initialValue={requestedDetailsID.subject}
                        disabled
                      />
                    </label>
                    <label htmlFor="pdate" className="  ">

                      <span className="  text-xs text-gray-500">Publication Date</span>
                      <Field
                        className="block text-gray-500 rounded-md  w-full
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="pubdate"
                        type="text"
                        placeholder="#"
                        initialValue={new Date(requestedDetailsID.pubdate).toDateString()}
                        disabled
                      />
                    </label>
                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs  text-gray-500 mb-1">Note:</span>
                      <Field
                        className="resize-none text-gray-500 rounded-md  w-full h-2/4
                        focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50 "
                        component="textarea"
                        name="notereqform"
                        type="input"
                        placeholder="Note here"
                        initialValue={requestedDetailsID.notereqform}
                        disabled
                      />
                    </label>
                  </div>
          

                </div>
                <div className="block text-right mt-5">
                  <button
                    type="button"
                    className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    onClick={() => window.print()}
                  >
                    Print this page

                  </button>

                </div>
                  
              </form>
            )}

          />
        </>
      )}

    </section>
  );
}
