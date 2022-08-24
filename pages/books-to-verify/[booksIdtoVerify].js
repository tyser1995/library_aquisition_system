import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import api from '../../lib/api';
import 'react-toastify/dist/ReactToastify.css';
import { toast } from 'react-toastify';
import { useRouter } from 'next/router';


export const getServerSideProps = async (context) => {
  const { booksIdtoVerify } = context.query;
  const { data } = await api.get(`/api/bookstoverify/${booksIdtoVerify}`);

  console.log(data);

  return {
    props: { booksIdtoVerify: data },

  };
};

export default function RequestForm({ booksIdtoVerify }) {
  const router = useRouter();

  const handleOnSubmit = async (payload) => {

    try {
      const { data } = await axios.post('/api/bookUpdateVerified', payload);
    
      toast.success('Successfully Verified!', {
        position: 'bottom-right',
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: false,
        draggable: true,
        progress: undefined,
      }, data);
  
      toast.info(' Sent to Acquisition', {
        position: 'bottom-right',
        autoClose: 5000,
        hideProgressBar: false,
        pauseOnHover: false,
        draggable: true,
        progress: undefined,
      }, data);
      router.push('/see-all-books-custodian');
      
    } catch (error) {
      
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
        <title>Library Acquisition | Verify Books</title>
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

              <form onSubmit={handleSubmit} className=" p-8 bg-white rounded-md my-16 shadow-md mx-auto w-full min-h-screen  ">

                <div className="flex-shrink-0 flex content-around items-center">

                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl  text-gray-600 ">Custodian Library Acquisition Books to Verify</h1>

                </div>

                <div className="flex space-x-6 content-around items-center  justify-end p-8">

                  <label htmlFor="date" className="block ">
                    <span className="block  text-xs  text-gray-500 mb-1">Verified Date</span>
                    <Field
                      className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 cursor-pointer placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                      name="verifiedDate"
                      component="input"
                      type="date"
                      required
                      initialValue={new Date().toDateInputValue()}

                    />
                  </label>

                </div>
                <div className="grid grid-cols-3 gap-x-4 gap-y-8 p-8 border-1">
                  <div className="row-start-1">

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red  text-xs  text-gray-500 mb-1">User ID</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={booksIdtoVerify.userID}
                        disabled

                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red  text-xs x text-gray-500 mb-1">Name</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={booksIdtoVerify.requestee}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-1 col-span-2">

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs  text-gray-500 mb-1">Author</span>
                      <Field
                        className=" text-gray-500 rounded-md  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="Author"
                        type="text"
                        placeholder="Author"
                        initialValue={booksIdtoVerify.authorName}
                        disabled
                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs text-gray-500 mb-1">Title</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="Title"
                        type="text"
                        placeholder="Title"
                        initialValue={booksIdtoVerify.title}
                        disabled
                      />
                    </label>
                  </div>
                  <div className="row-start-2 gap-y-6">

                    <label htmlFor="edition" className="">
                      <span className="block  text-xs  text-gray-500 ">Number of Copies</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="NumberOfCopies"
                        type="text"
                        initialValue={booksIdtoVerify.copvol}
                        disabled
                      />
                    </label>

                    <label htmlFor="edition" className=" ">
                      <span className="block  text-xs  text-gray-500 ">Edition</span>
                      <Field
                        className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="Edition"
                        type="text"
                        initialValue={booksIdtoVerify.edition}
                        disabled
                      />
                    </label>
                    <label htmlFor="requesID" className="block p-8">
                      <span className="  text-xs text-gray-500 p">Dean Signature</span>
                      <img
                        src={booksIdtoVerify.signatureDean}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />  
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {booksIdtoVerify.deanName}
                        </div>
                    </label>

                  </div>
                  <div className="row-start-3 gap-y-2">

                    <label htmlFor="enumtitle" className="">
                      <span className="block  text-xs text-gray-500 mb-1">Existing Number of titles</span>
                      <Field
                        className="text-gray-500 rounded-md  w-2/4
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="enumtitle"
                        type="number"
                        placeholder="Enter Existing # of Titles/None"
                      />
                    </label>
                    <label htmlFor="selectDosition" className="block">
                      <span className="block  text-xs  text-gray-500 p">Verify</span>
                      <Field
                        name="verified"
                        component="select"
                        className=" text-gray-500 rounded-md  w-4/6
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50"
                        required
                      >

                        <option value=""> Select status </option>
                        <option className=" text-xs text-gray-500" value="0">Existing</option>
                        <option className=" text-xs text-gray-500" value="1">Verified</option>
                      </Field>
                    </label>
                  </div>
     
                  <div className="row-start-2 col-span-2">

                    <label htmlFor="publicationDate" className="mt-6 ml">
                      <span className="block  text-xs  text-gray-500 ">Publication Date</span>
                      <Field
                        className="text-gray-500 rounded-md  w-auto
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="input"
                        name="publicationDate"
                        type="text"
                        initialValue={new Date(booksIdtoVerify.pubdate).toDateString()}
                        disabled
                      />
                    </label>

                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs  text-gray-500 mb-1">Note:</span>
                      <Field
                        className="resize-none text-gray-500 rounded-md  w-full h-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                        component="textarea"
                        name="noteDeanbook"
                        type="input"
                        initialValue={booksIdtoVerify.notereqform}
                        disabled
                      />
                    </label>

                  </div>
                  <Field
                    className="text-gray-500 rounded-md  w-full h-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="requestID"
                    type="hidden"
                    initialValue={booksIdtoVerify.requestID}
                  />
                </div>

                <div className="block text-right mt-5 p-8 ">
                  <button
                    type="submit"
                    className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-secondary hover:bg-indigo-700
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Verified

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
