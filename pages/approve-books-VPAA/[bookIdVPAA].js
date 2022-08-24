import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import { toast } from 'react-toastify';
import api from '../../lib/api';
import validateSession from '../../lib/session';
import 'react-toastify/dist/ReactToastify.css';
import { useRouter } from 'next/router';


export const getServerSideProps = async (context) => {
  try {
    const { bookIdVPAA } = context.query;
    const { data } = await api.get(`/api/vpaabooks/${bookIdVPAA}`);
    const { account } = await validateSession(context);

    return {
      props: { bookVPAAId: data, account },

    };
  } catch (error) {
    console.log(error);
  }
};

export default function RequestForm({ bookVPAAId, account }) {
  console.log(bookVPAAId);
  const router = useRouter();

  const handleOnSubmit = async (payload) => {
    try {
      const { data } = await axios.post('/api/bookUpdateVPAA', payload);

      toast.success(' Update Successfully!', {
        position: 'bottom-right',
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: false,
        draggable: true,
        progress: undefined,
      }, data);
      router.push('/see-all-books-vpaa');

      
    } catch (error) {
      console.log(error);
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

              <form onSubmit={handleSubmit} className="  p-8 bg-white rounded-md my-16 shadow-md w-full  mx-auto min-h-screen ">

                <div className="flex-shrink-0 flex content-around items-center p-8">

                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl  text-gray-600 ">VPAA Library Acquisition Approval Books</h1>

                </div>

                <div className="flex space-x-6 content-around items-center justify-end p-8 ">

                  <label htmlFor="date" className="block ">
                    <span className="block  text-xs  text-gray-500 mb-1">Approved Date</span>
                    <Field
                      className="text-gray-500 rounded-md  border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                      name="approvalDateVPAA"
                      component="input"
                      type="date"
                      initialValue={new Date().toDateInputValue()}
                      required
                    />
                  </label>

                </div>

                <div className="grid grid-cols-3 gap-x-4 gap-y-6 p-8 border-1">
                  <div className="row-start-1">

                    <label htmlFor="author" className="">
                      <span className=" hover:textColor-red  text-xs block text-gray-500 ">User ID</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={bookVPAAId.userID}
                        disabled

                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className="hover:textColor-red  text-xs block text-gray-500">Name</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={bookVPAAId.requestee}
                        disabled
                      />
                    </label>
                  </div>

                  <div className="row-start-1 col-span-2">

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs text-gray-500 ">Author</span>
                      <Field
                        className=" text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Author"
                        type="text"
                        placeholder="Author"
                        initialValue={bookVPAAId.authorName}
                        disabled
                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className=" block hover:textColor-red text-xs  text-gray-500 ">Title</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Title"
                        type="text"
                        placeholder="Title"
                        initialValue={bookVPAAId.title}
                        disabled
                      />
                    </label>

                  </div>

                  <div className="row-start-2">
                    <label htmlFor="edition" className=" ml">
                      <span className="block  text-xs  text-gray-500 ">Edition</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Edition"
                        type="text"
                        initialValue={bookVPAAId.edition}
                        disabled
                      />
                    </label>
                    <div className="col-span-2 row-start-3">

                      <label htmlFor="edition" className="">
                        <span className="block  text-xs  text-gray-500 ">Number of Copies</span>
                        <Field
                          className=" text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                          component="input"
                          name="NumberOfCopies"
                          type="text"
                          initialValue={bookVPAAId.copvol}
                          disabled
                        />
                      </label>

                    </div>

                  </div>
                  <div className="row-start-2 col-span-2 ">
                    <label htmlFor="publicationDate" className=" mb-2">
                      <span className="block  text-xs  text-gray-500 ">Publication Date</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-auto
                 border-0 bg-gray-50"
                        component="input"
                        name="publicationDate"
                        type="text"
                        initialValue={new Date(bookVPAAId.pubdate).toDateString()}
                        disabled
                      />
                    </label>
                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs text-gray-500">Note:</span>
                      <Field
                        className="resize-none text-gray-500 rounded-md border-gray-300  w-full h-full
                  focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="textarea"
                        name="noteDeanbook"
                        type="input"
                        initialValue={bookVPAAId.notereqform}
                        disabled
                      />
                    </label>

                  </div>

                  <div className="row-start-3">

                    <label htmlFor="requesID" className="">
                      <span className="  text-xs text-gray-500 p">Dean Signature</span>
                      <img
                        src={bookVPAAId.signatureDean}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {bookVPAAId.deanName}
                      </div>

                    </label>
                    <label htmlFor="edition" className="">
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="vpaaName"
                        type="hidden"
                        initialValue={`${account.fname} ${account.mname} ${account.lname}`}
                        disabled
                      />
                    </label>

                  </div>

                  <div className="row-start-4">
                    <label htmlFor="selectDosition" className="block mb-2 ">
                      <span className="block  text-xs  text-gray-500 p">For Approval</span>
                      <Field
                        name="approvalVpaa"
                        component="select"
                        className=" text-gray-500 rounded-md border-1 border-gray-300  w-full
                   bg-gray-50"
                        required
                      >
                        <option value=""> </option>
                        <option className="block text-xs  text-gray-500" value="0">On Going</option>
                        <option className="block text-xs  text-gray-500" value="1">Approved</option>

                      </Field>
                    </label>
                  </div>

                </div>
                <Field
                  className="block text-gray-500 rounded-md  w-auto
              focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                  component="input"
                  name="requestID"
                  type="hidden"
                  initialValue={bookVPAAId.requestID}
                  disabled
                />

                <div className="block text-right p-8 ">
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
