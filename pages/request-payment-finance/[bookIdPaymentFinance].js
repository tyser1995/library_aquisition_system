import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import Popup from 'reactjs-popup';
import { useRef, useState } from 'react';
import SignaturePad from 'react-signature-canvas';
import api from '../../lib/api';
import dataURItoBlob from '../../lib/date-uri-to-blob';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import validateSession from '../../lib/session';
import { useRouter } from 'next/router';


export const getServerSideProps = async (context) => {
  const { bookIdPaymentFinance } = context.query;
  const { data } = await api.get(`/api/bookrequestpaymentvpaa/${bookIdPaymentFinance}`);
  const { account } = await validateSession(context);

  console.log(data);

  return {
    props: { bookIdPaymentFinance: data, account:account },

  };
};
export default function RequestForm({ bookIdPaymentFinance, account }) {
  const [imageURL, setImageURL] = useState(null);
  const router = useRouter();


  const handleOnSubmit = async (payload) => {
    try { 
      const { data } = await axios.post('/api/bookPaymentFinance', {
      ...payload,
      imageURL,
    });
    toast.success(' Sent Successfully!', {
      position: 'bottom-right',
      autoClose: 5000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: false,
      draggable: true,
      progress: undefined,
    }, data);

    router.push('/see-all-books-payment-finance');
      
    } catch (error) {
  console.log(error);
      
    }
   
  };

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
  
  Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

  return (

    <section className=" mx-auto  md:flex bg-base min-h-screen ">

      <Head>
        <title>Library Acquisition | Request Payment </title>
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
              <form onSubmit={handleSubmit} className=" px-8 pt-8 pb-8 bg-white rounded-md my-16 shadow-md mx-auto w-full min-h-screen">
                <div className="flex-shrink-0 flex content-around items-center">
                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl   text-gray-600 ">Finance Request Payment Signature</h1>
                </div>
                <label htmlFor="edition" className="">
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="vpaaName"
                        type="hidden"
                        initialValue={account.fname + " "+  account.mname + " " + account.lname} 
                        disabled
                      />
                    </label>
                <div className="flex space-x-6 content-around items-center  justify-end">

                  <label htmlFor="date" className=" ">
                    <span className=" text-xs text-gray-500 mb-1 p-8">Aprrove Date</span>
                    <Field
                      className=" block  text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 cursor-pointer placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                      name="approvalFinanceDatePayment"
                      component="input"
                      type="date"
                      required
                      initialValue={new Date().toDateInputValue()}

                    />
                  </label>
                </div>
                <div className="grid grid-cols-3 gap-x-2 p-8 border-1 ">
                  <div className="row-start-1">

                    <label htmlFor="author" className="">
                      <span className=" hover:textColor-red  text-xs  text-gray-500 ">User ID</span>
                      <Field
                        className="block text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={bookIdPaymentFinance.userID}
                        disabled
                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className=" block hover:textColor-red  text-xs  text-gray-500 ">Name</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={bookIdPaymentFinance.requestee}
                        disabled
                      />
                    </label>

                  </div>
                  <div className="row-start-1 col-span-2 ">

                    <label htmlFor="author" className="">
                      <span className=" hover:textColor-red text-xs  text-gray-500">Author</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="Author"
                        type="text"
                        placeholder="Author"
                        initialValue={bookIdPaymentFinance.authorName}
                        disabled
                      />
                    </label>
                    <label htmlFor="author" className="">
                      <span className=" hover:textColor-red text-xs text-gray-500 ">Title</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="Title"
                        type="text"
                        placeholder="Title"
                        initialValue={bookIdPaymentFinance.title}
                        disabled
                      />
                    </label>
                  </div>

                  <div className="row-start-2 gap-y-4">
                    <label htmlFor="edition" className="">
                      <span className="block  text-xs  text-gray-500 ">Number of Copies</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="NumberOfCopies"
                        type="text"
                        initialValue={bookIdPaymentFinance.copvol}
                        disabled
                      />
                    </label>
                    <label htmlFor="edition" className=" ml">
                      <span className="block  text-xs  text-gray-500 ">Edition</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="Edition"
                        type="text"
                        initialValue={bookIdPaymentFinance.edition}
                        disabled
                      />
                    </label>
                    <label htmlFor="edition" className=" ">
                      <span className="block  text-xs  text-gray-500 ">Price</span>
                      <Field
                        className="text-gray-500 rounded-md  w-auto
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="price"
                        type="text"
                        initialValue={bookIdPaymentFinance.price}
                        disabled
                      />
                    </label>
                    <small className=" block  text-xs text-gray-500  mr-2 ">Approved By:</small>

                    <span className="text-xs block mt-2 text-gray-500">
                      President:
                      {' '}
                      {bookIdPaymentFinance.approvalPresident ? 'Yes' : 'No'}

                    </span>
                    <span className="text-xs block mt-1 text-gray-500">
                      Finance:
                      {' '}
                      {bookIdPaymentFinance.approvalFinance ? 'Yes' : 'No'}

                    </span>
                  </div>

                  <div className="row-start-2 col-span-2">
                    <label htmlFor="publicationDate" className="">
                      <span className="block  text-xs  text-gray-500  ">Publication Date</span>
                      <Field
                        className="text-gray-500 rounded-md  w-auto
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="publicationDate"
                        type="text"
                        initialValue={new Date(bookIdPaymentFinance.pubdate).toDateString()}
                        disabled
                      />
                    </label>
                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs text-gray-500 mb-1">Note:</span>
                      <Field
                        className="resize-none text-gray-500 rounded-md  w-full h-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50
                    "
                        component="textarea"
                        name="noteDeanbook"
                        type="input"
                        initialValue={bookIdPaymentFinance.notereqform}
                        disabled
                      />
                    </label>
                    <div className="row-start-4 mt-2 ">
                    <div className="flex space-x-6 content-around items-center mt-5 justify-start ">

                      <label htmlFor="requesID" className="">
                        <span className="  text-xs  text-gray-500 p">Dean Signature</span>
                        <img src={bookIdPaymentFinance.signatureDean} alt="College Dean Signature" width="100" height="100" className=" border border-gray-blue-900" />
                        <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdPaymentFinance.deanName}
                        </div>
                      </label>
                      <label htmlFor="requesID" className="">
                        <span className="  text-xs  text-gray-500 p">Acquisition Signature</span>
                        <img src={bookIdPaymentFinance.signatureAcquisition} alt="College Dean Signature" width="100" height="100" className="  border  border-gray-blue-900" />
                        <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdPaymentFinance.acquisitionName}
                        </div>
                      </label>
                      <label htmlFor="requesID" className="">
                        <span className="  text-xs text-gray-500 p">Director Signature</span>
                        <img src={bookIdPaymentFinance.signtureDirector} alt="College Dean Signature" width="100" height="100" className=" border border-gray-blue-900" />
                       <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdPaymentFinance.directorName}
                        </div>
                      </label>
                      <label htmlFor="requesID" className="">
                        <span className="  text-xs text-gray-500 p">VPAA Signature</span>
                        <img src={bookIdPaymentFinance.signatureVPAA} alt="College Dean Signature" width="100" height="100" className="  border border-gray-blue-900" />
                        <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdPaymentFinance.vpaaName}
                        </div>
                      </label>
                    </div>

                  </div>
          
                  </div>
            

                  <label htmlFor="edition" className="">
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="financeName"
                        type="hidden"
                        initialValue={account.fname + " "+  account.mname + " " + account.lname} 
                        disabled
                      />
                    </label>

                  <div className="row-start-6 ">

                    {imageURL ? (
                      <img
                        name="signatureImage"
                        src={imageURL}
                        alt="signature"
                        style={{
                          display: 'block',
                          margin: '0 ',
                          border: '1px solid black',
                          width: '150px',
                          height: '100px',
                          backgroundColor: 'white',
                        }}
                      />
                    ) : save}
                    {imageURL &&(
                           <div className="text-sm font-medium mt-2 text-gray-500 underline">
                           {account.fname + " " + account.lname}
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
                              className="mx-auto mt-3 pr-4 text-center py-2 px-4 bg border border-transparent shadow-sm text-sm font-medium rounded-md
               text-white bg-indigo-600 hover:bg-indigo-700
              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              type="button"
                              onClick={clear}
                            >
                              clear
                            </button>
                            <button
                              className=" mx-auto mt-3 pr-2  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                              type="button"
                              onClick={close}
                            >
                              Close
                            </button>
                            <button
                              className=" mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700
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


                <div className="flex space-x-6 content-around items-center mt-5 justify-start p-8">


                </div>




                <label htmlFor="requesID" className="">
                  <span className=" hover:textColor-red  text-xs  text-gray-500 mb-1" />
                  <Field
                    className="form-text  text-xs   text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                    component="input"
                    name="requestID"
                    type="hidden"
                    initialValue={bookIdPaymentFinance.requestID}
                  />
                </label>
                <div className="block text-right ">
                  <button
                    type="submit"
                    className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-secondary hover:bg-indigo-700
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Send to Acquisition
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
