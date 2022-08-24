import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import Popup from 'reactjs-popup';
import { useRef, useState } from 'react';
import SignaturePad from 'react-signature-canvas';
import { toast } from 'react-toastify';
import api from '../../lib/api';
import dataURItoBlob from '../../lib/date-uri-to-blob';
import validateSession from '../../lib/session';
import 'react-toastify/dist/ReactToastify.css';
import { useRouter } from 'next/router';


export const getServerSideProps = async (context) => {
  const { bookIdDean } = context.query;
  const { data } = await api.get(`/api/deanbooks/${bookIdDean}`);
  const { account } = await validateSession(context);

  console.log(data);

  return {
    props: { bookDean: data, account },

  };
};

export default function RequestForm({ bookDean, account }) {
  const [imageURL, setImageURL] = useState(null);
  const router = useRouter();

  

  const handleOnSubmit = async (payload) => {
    try {
      const { data } = await axios.post('/api/bookUpdateDean', {
        ...payload,
        imageURL,
      });
  
      toast.success('Update Successfully!', {
        position: 'bottom-right',
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: false,
        draggable: true,
        progress: undefined,
      }, data);
      router.push('/see-all-books-dean');

    } catch (error) {
      
      toast.error('Error Updating', {
        position: "bottom-left",
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true,
        progress: undefined,
        });
    }
   
  }

  const sigCanvas = useRef({});
  const clear = () => sigCanvas.current.clear();

  const save = async () => {
    try {
      const blob = dataURItoBlob(sigCanvas.current.getTrimmedCanvas().toDataURL('image/png'));
      const img = new File([blob], 'fileName.jpg', { type: 'image/jpeg', lastModified: new Date() });

      const config = {
        headers: { 'content-type': 'multipart/form-data' },
      };

      const formData = new FormData();
      formData.append('file', img);

      const { data } = await api.post('/api/upload', formData, config);

      setImageURL(data.filePath);
    } catch (error) {
      alert('Error');// eslint-disable-line no-alert
    }
  };
  const [session] = useSession();

  Date.prototype.toDateInputValue = (function () {
    const local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
  });

  return (

    <section className=" mx-auto  md:flex bg-base  min-h-screen ">

      <Head>
        <title>Library Acquisition | Entry of Books </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>
      {!session && (
        <>
          <div className=" mx-auto p-10 md:flex bg-white  border-blue-900 border-1 rounded">
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

              <form onSubmit={handleSubmit} className=" px-8 pt-8 pb-8 bg-white rounded-md my-16  shadow-md mx-auto w-full min-h-screen ">

                <div className="flex-shrink-0 flex content-around items-center p-8">
                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl  text-gray-600 ">Dean's Form</h1>
                </div>

                <div className="flex space-x-6 content-around items-center justify-end p-8">
                  <label htmlFor="date" className="block ">
                    <span className="block  text-xs  text-gray-500 ">Approved Date</span>
                    <Field
                      className="text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 cursor-pointer placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                      name="approvalDateDean"
                      component="input"
                      type="date"
                      required
                      initialValue={new Date().toDateInputValue()}

                    />
                  </label>
                </div>

                <div className="grid grid-cols-3 gap-x-4 gap-y-6 p-8 border-1 ">

                  <div className="row-start-1">
                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red  text-xs  text-gray-500 ">User ID</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={bookDean.userID}
                        disabled
                      />
                    </label>
                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red  text-xs  text-gray-500">Name</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={bookDean.requestee}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-1 col-span-2">

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs  text-gray-500">Author</span>
                      <Field
                        className=" text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50  border-0 bg-gray-50"
                        component="input"
                        name="Author"
                        type="text"
                        initialValue={bookDean.authorName}
                        disabled
                      />
                    </label>
                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs text-gray-500  ">Title</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50  border-0 bg-gray-50"
                        component="input"
                        name="Title"
                        type="text"
                        initialValue={bookDean.title}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-2 gap-y-4">
                    <label htmlFor="edition" className="">
                      <span className="block  text-xs text-gray-500 ">Number of Copies</span>
                      <Field
                        className=" text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="NumberOfCopies"
                        type="text"
                        initialValue={bookDean.copvol}
                        disabled
                      />
                    </label>

                    <label htmlFor="edition" className="">
                      <span className="block  text-xs text-gray-500 ">Edition</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Edition"
                        type="text"
                        initialValue={bookDean.edition}
                        disabled
                      />
                    </label>
                    <label htmlFor="edition" className="">
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="deanName"
                        type="hidden"
                        initialValue={`${account.fname} ${account.mname} ${account.lname}`}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-2 col-span-2">
                    <label htmlFor="publicationDate" className="">
                      <span className="block  text-xs  text-gray-500 ">Publication Date</span>
                      <Field
                        className="text-s focus:placeholder-gray-400  placeholder-gray-500 placeholder-opacity-25 pt-3 pb-2
                                        block w-36 px-0  text-gray-500  mt-0 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                        component="input"
                        name="publicationDate"
                        type="text"
                        initialValue={new Date(bookDean.pubdate).toDateString()}
                        disabled
                      />
                    </label>
                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs text-gray-500 mb-">Note:</span>
                      <Field
                        className="resize-none  text-gray-500 rounded-md border-gray-300 w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50 "
                        component="textarea"
                        name="noteEntry"
                        type="input"
                        initialValue={bookDean.notereqform}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-3 ">

                    <label htmlFor="selectDosition" className=" ">
                      <span className="block  text-xs text-gray-500 p">Select Status</span>
                      <Field
                        name="approvalDean"
                        component="select"
                        className="  text-gray-500 rounded-md border-gray-300  w-2/4
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50  "
                        required
                      >

                        <option value=""> </option>
                        <option className="block text-xs font-bold text-gray-500" value="0">On Going</option>
                        <option className="block text-xs font-bold text-gray-500" value="1">Approved</option>

                      </Field>
                    </label>
                  </div>

                  <div className="row-start-4 ">

                    {imageURL ? (
                      <img
                        name="signatureImage"
                        src={imageURL}
                        alt="signature"
                        style={{
                          display: 'block',
                          margin: '0 right',
                          border: '1px solid black',
                          width: '150px',
                          backgroundColor: 'white',
                          height: '100px',
                        }}
                      />
                    ) : save}
                    {imageURL &&(
                        <div className="text-sm font-medium mt-2 text-gray-500 underline">
                        {`${account.fname} ${account.lname}`}
                      </div>
                    )}
                  

                    <Popup
                      modal
                      trigger={(
                        <button
                          className=" mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-secondary hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                          a
                          type="button"
                          required
                        >
                          {' '}
                          Sign Here
                        </button>
                  )}
                      closeOnDocumentClick={false}
                    >

                      {(close) => (
                        <>
                          <SignaturePad ref={sigCanvas} canvasProps={{ className: 'signatureCanvas' }} />
                          <div className="space-x-2  justify-items-center ">
                            <button
                              className="mx-auto mt-3 pr-4 text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
               text-white bg-secondary hover:bg-indigo-700
              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              type="button"
                              onClick={clear}
                            >
                              clear
                            </button>
                            <button
                              className=" mx-auto mt-3   bg-secondary text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-secondaryhover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              type="button"
                              onClick={close}
                            >
                              Close
                            </button>
                            <button
                              className=" mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-secondary hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              type="button"
                              onClick={save}
                            >
                              Save
                            </button>
                          </div>
                        </>
                      )}
                    </Popup>

                  </div>

                </div>

                <label htmlFor="requesID" className="">
                  <span className="block hover:textColor-red  text-xs  text-gray-500 mb-1" />
                  <Field
                    className="form-text  text-xs  font-bold   text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                    component="input"
                    name="requestID"
                    type="hidden"
                    initialValue={bookDean.requestID}
                  />
                </label>

                <div className="block text-right mt-5">
                  <button
                    type="submit"
                    className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-secondary hover:bg-indigo-700
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Update Request

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
