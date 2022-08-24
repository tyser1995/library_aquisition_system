import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import api from '../../lib/api';

export const getServerSideProps = async (context) => {
  const { bookIdToPrint } = context.query;
  const { data } = await api.get(`/api/booktoprint/${bookIdToPrint}`);

  console.log(data);

  return {
    props: { bookIdToPrint: data },

  };
};

export default function RequestForm({ bookIdToPrint }) {
  const handleOnSubmit = async (payload) => {
    const { data } = await axios.post('/api/bookUpdatePresident', payload);

    alert(data.message);
  };

  const [session] = useSession();
  return (

    <section className=" mx-auto bg-base sh   md:flex min-h-screen ">

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
              Please Sign In First1
            </span>
          </div>
        </>
      )}

      {session && (
        <>

          <Head>
            <title>Library Acquisition | Request Form </title>
            <meta name="keywords" content="someting" />
            <link rel="icon" href="/icon.ico" />
          </Head>
          <Form
            onSubmit={handleOnSubmit}
            render={({ handleSubmit }) => (

              <form onSubmit={handleSubmit} className=" p-8 bg-white rounded-md my-16  shadow-md w-full mx-auto h-auto  ">

                <div className="flex-shrink-0 flex content-around items-center p-8">
                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl mt 4  text-gray-600 ">Library Acquisition Request Form</h1>

                </div>
                <div className="flex space-y-6 justify-end">

                  <label htmlFor="date" className="block mt-6 mr-3">
                    <span className="block  text-xs  text-gray-500 mb-1">Requested Date</span>
                    <Field
                      className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none
                            focus:ring-0 focus:border-black border-gray-400"
                      name="date"
                      component="input"
                      type="text"
                      disabled
                      initialValue={new Date(bookIdToPrint.date).toDateString()}

                    />
                  </label>
                  <label htmlFor="date" className="block">
                    <span className="block  text-xs  text-gray-500 mb-1">Rush or Not Rush</span>
                    <Field
                      className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none
                            focus:ring-0 focus:border-black border-gray-400"
                      name="rushornrush"
                      component="input"
                      type="text"
                      Required
                      initialValue={bookIdToPrint.rushornrush}
                      disabled
                    />
                  </label>

                </div>

                <span className="blockg hover:textColor-red text-xs  text-gray-500 mb-1"> Requested By</span>

                <label htmlFor="title" className="mt-2 ">
                  <span className="block mt-2 text-xs  text-gray-500 ">ID#</span>
                  <Field
                    className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                          block px-0 mb-2 bg-transparent border-0 border-b-2
                          appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                    component="input"
                    name="userID"
                    type="text"
                    placeholder="Title"
                    initialValue={bookIdToPrint.userID}
                    disabled
                  />
                </label>

                <Field
                  className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
      block px-0 mb-2 bg-transparent border-0 border-b-2
      appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                  component="input"
                  name="requestee"
                  type="text"
                  initialValue={bookIdToPrint.requestee}
                  disabled
                />

                <Field
                  className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
      block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                  component="input"
                  name="selectDepartment"
                  type="hidden"
                  initialValue={bookIdToPrint.selectDepartment}
                  disabled
                />
                <Field
                  className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
      block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                  component="input"
                  name="selectPosition"
                  type="text"
                  initialValue={bookIdToPrint.selectPosition}
                  disabled
                />
                <br />
                <label htmlFor="author" className="">
                  <span className="block hover:textColor-red text-xs  text-gray-500 mb-1">Author</span>
                  <Field
                    className="form-text text-xs  text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                    component="input"
                    name="authorName"
                    type="text"
                    placeholder="Author"
                    initialValue={bookIdToPrint.authorName}
                    disabled

                  />
                </label>

                <label htmlFor="title" className=" ">
                  <span className="block  text-xs  text-gray-500 ">Title</span>
                  <Field
                    className="focus:placeholder-gray-500 text-xs text-gray-500 bg-gray-50 placeholder-opacity-50   pt-3 pb-2 block px-0 mt-0 bg-transparent
                            border-0  w-auto  border-gray-400"
                    component="input"
                    name="title"
                    type="text"
                    placeholder="Title"
                    initialValue={bookIdToPrint.title}
                    disabled

                  />
                </label>

                <div className="flex flex-row space-x-4">
                  <label htmlFor="edition" className="mt-11">
                    <span className="block  text-xs  text-gray-500 underline">Edition</span>
                    <Field
                      className=" focus:placeholder-gray-400  md:w-full text-xs  text-gray-500 placeholder-gray-500 placeholder-opacity-25 pt-3 pb-2
                                        block w-36 px-0   mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="edition"
                      type="text"
                      placeholder="Edition"
                      initialValue={bookIdToPrint.edition}
                      disabled
                    />
                  </label>

                  <label htmlFor="copvol" className="mt-9 ">
                    <span className="  text-xs  text-gray-500">Copies/Volumes</span>
                    <Field
                      className="text-xs pt-3 pb-2 block md:w-full  text-gray-500  w-36 px-0 mt-0 focus:placeholder-gray-400  placeholder-gray-500 placeholder-opacity-50   bg-transparent border-0
                                    border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="copvol"
                      type="text"
                      placeholder="#"
                      initialValue={bookIdToPrint.copvol}
                      disabled
                    />
                  </label>

                  <label htmlFor="pdate" className="mt-9 relative z-0 w-36 mb-5 ">
                    <span className="  text-xs text-gray-500">Publication Date</span>
                    <Field
                      className="text-xs pt-3 pb-2 block  md:w-full  text-gray-500  w-full px-0 mt-0 bg-transparent border-0
                                     border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="pubdate"
                      type="text"
                      placeholder="#"
                      initialValue={new Date(bookIdToPrint.pubdate).toDateString()}
                      disabled
                    />
                  </label>
                </div>
                <div className="flex space-x-20 content-around items-center mx-auto  mt-3">

                  <label htmlFor="chargedto" className="">
                    <span className="block  text-xs text-gray-500 mb-1">Publisher Name</span>
                    <Field
                      className="text-xs mr-4  md:w-full  w-96 span-12 form-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="pubName"
                      type="text"
                      initialValue={bookIdToPrint.pubName}
                      disabled
                    />
                  </label>
                  <label htmlFor="chargedto" className=" ">
                    <span className="block  text-xs text-gray-500 mb-1">Publisher Address</span>
                    <Field
                      className="text-xs  md:w-full  mr-4 w-96 span-12 form-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="pubAddress"
                      type="text"
                      placeholder="Publisher Address"
                      initialValue={bookIdToPrint.pubAddress}
                      disabled
                    />
                  </label>
                </div>

                <div className="mt-7">
                  <label htmlFor="chargedto" className=" h-48">
                    <span className="block  text-xs  text-gray-500 mb-1">Charge to</span>
                    <Field
                      className="text-xs mr-4 w-5/12 span-12 form-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="chargeto"
                      type="text"
                      placeholder="Charge to"
                      initialValue={bookIdToPrint.chargeto}
                      disabled
                    />
                  </label>
                </div>

                <div className="flex space-y-6 space-x-2 justify-start">

                  <label htmlFor="requesID" className="mt-6">
                    <span className="  text-xs  text-gray-500 p">Dean Signature</span>
                    <img
                      src={bookIdToPrint.signatureDean}
                      alt="College Dean Signature"
                      width="100"
                      height="100"
                      className=" mt-2 border-solid border-4 border-gray-blue-900"
                    />
                    <div className="text-xs mt-2 text-gray-500 underline">
                      {bookIdToPrint.deanName}
                    </div>
                  </label>
                  {bookIdToPrint.signatureAcquisition && (
                    <label htmlFor="requesID" className="">
                      <span className="  text-xs text-gray-500 p">Acquisition Signature</span>
                      <img
                        src={bookIdToPrint.signatureAcquisition}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdToPrint.acquisitionName}
                      </div>
                    </label>

                  )}
                  {bookIdToPrint.signatureVPAA && (
                    <label htmlFor="requesID" className="">
                      <span className="  text-xs text-gray-500 p">VPAA Signature</span>
                      <img
                        src={bookIdToPrint.signatureVPAA}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdToPrint.vpaaName}
                      </div>
                    </label>

                  )}

                  {bookIdToPrint.signatureFinance && (
                    <label htmlFor="requesID" className="">
                      <span className="  text-xs text-gray-500 p">Finance Signature</span>
                      <img
                        src={bookIdToPrint.signatureFinance}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdToPrint.financeName}
                      </div>
                    </label>
                  )}

                  {bookIdToPrint.signtureDirector && (
                    <label htmlFor="requesID" className="">
                      <span className="  text-xs text-gray-500 p">Director Signature</span>
                      <img
                        src={bookIdToPrint.signtureDirector}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdToPrint.directorName}
                      </div>
                    </label>

                  )}

                </div>

                <div className="flex pl-2 justify-end">
                  <label htmlFor="subjectr" className="">
                    <span className="block  text-xs text-gray-500 mb-1">Subject</span>
                    <Field
                      className=" mr-8 text-xs  justify-endform-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="subject"
                      type="text"
                      placeholder="Subject "
                      initialValue={bookIdToPrint.subject}
                      disabled
                    />
                  </label>
                  <label htmlFor="subjectr" className="">
                    <span className="block  text-xs text-gray-500 mb-1">Copies/Number of Volume</span>
                    <Field
                      className=" mr-8 text-xs  justify-endform-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="copvol "
                      type="text"
                      placeholder="Subject "
                      initialValue={bookIdToPrint.copvol}
                      disabled
                    />
                  </label>
                </div>

                <div className="flex flex-row space-x-5 content-around items-center">
                  <label htmlFor="notereqform" className="">
                    <span className="block  text-xs text-gray-500 mb-1">Note:</span>
                    <Field
                      className="resize-none text-xs  rounded-md focus:placeholder-gray-500
                                 placeholder-gray-500 placeholder-opacity-50  border-0 "
                      component="textarea"
                      name="notereqform"
                      type="input"
                      placeholder="Note here"
                      initialValue={bookIdToPrint.notereqform}
                      disabled
                    />
                  </label>
                </div>

                <div className="flex flex-row space-x-3 content-around justify-start">

                  <label htmlFor="dealer" className="mt-4">
                    <span className="  text-xs text-gray-500 mb-1">Dealer :</span>
                    <Field
                      className="  text-xs w-1/10 form-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                             px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="dealer"
                      type="text"
                      placeholder="Dealer"
                      disabled
                    />
                  </label>

                  <label htmlFor="dated" className="mt-4">
                    <span className="  text-xs  text-gray-500 mb-1">Dated: </span>
                    <Field
                      className="  text-xs form-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                             mb-2 bg-transparent border-0 px-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="dated"
                      type="text"
                      placeholder=" Date"
                      disabled
                    />
                  </label>
                  <label htmlFor="SI#:" className="mt-4">
                    <span className="  text-xs  text-gray-500 mb-1">SI#:</span>
                    <Field
                      className="  text-xs w-auto form-text focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                             px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                      component="input"
                      name="sinumb"
                      type="text"
                      placeholder=" SI# "
                      disabled
                    />
                  </label>
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
