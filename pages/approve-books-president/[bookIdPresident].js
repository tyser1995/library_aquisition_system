import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import { toast } from 'react-toastify';
import api from '../../lib/api';
import 'react-toastify/dist/ReactToastify.css';
import { useRouter } from 'next/router';


export const getServerSideProps = async (context) => {
  const { bookIdPresident } = context.query;
  const { data } = await api.get(`/api/presidentbooks/${bookIdPresident}`);

  console.log(data);

  return {
    props: { bookIdPresident: data },

  };
};

export default function RequestForm({ bookIdPresident }) {
  const router = useRouter();

  const handleOnSubmit = async (payload) => {

    try {  
        const { data } = await axios.post('/api/bookUpdatePresident', payload);

    toast.success('Update Successfully!', {
      position: 'bottom-right',
      autoClose: 5000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: false,
      draggable: true,
      progress: undefined,
    }, data);
    router.push('/see-all-books-president');

      
    } catch (error) {
      
    }

  };
  Date.prototype.toDateInputValue = (function () {
    const local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
  });

  const [session] = useSession();
  return (

    <section className=" mx-auto  md:flex bg-base min-h-screen ">

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

              <form onSubmit={handleSubmit} className=" p-8 bg-white rounded-md my-16 w-full  shadow-md  mx-auto min-h-screen ">

                <div className="flex-shrink-0 flex content-around items-center p-8">

                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl  text-gray-600 ">Library Acquisition Approval Books</h1>

                </div>

                <div className="flex space-x-6 content-around items-center  justify-end p-8">

                  <label htmlFor="date" className="block ">
                    <span className="block  text-xs   text-gray-500 ">Approved Date</span>
                    <Field
                      className="text-gray-500 rounded-md border-gray-300  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                      name="approvalDatePresident"
                      component="input"
                      type="date"
                      required
                      initialValue={new Date().toDateInputValue()}

                    />
                  </label>

                </div>

                <div className="grid grid-cols-3 gap-4  border-1  p-8">
                  <div className="row-start-1 col-span-1">

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red  text-xs text-gray-500 ">User ID</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={bookIdPresident.userID}
                        disabled
                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red  text-xs  text-gray-500 ">Name</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={bookIdPresident.requestee}
                        disabled
                      />
                    </label>
                  </div>

                  <div className="row-start-1 col-span-2">
                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs  text-gray-500 ">Author</span>
                      <Field
                        className=" text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Author"
                        type="text"
                        placeholder="Author"
                        initialValue={bookIdPresident.authorName}
                        disabled
                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs  text-gray-500">Title</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Title"
                        type="text"
                        placeholder="Title"
                        initialValue={bookIdPresident.title}
                        disabled
                      />
                    </label>

                  </div>
                  <div className="row-start-2">
                    <label htmlFor="edition" className="">
                      <span className="block  text-xs text-gray-500 ">Number of Copies</span>
                      <Field
                        className="  text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="NumberOfCopies"
                        type="text"
                        initialValue={bookIdPresident.copvol}
                        disabled
                      />
                    </label>
                    <label htmlFor="edition" className=" ">
                      <span className="block  text-xs  text-gray-500 ">Edition</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Edition"
                        type="text"
                        initialValue={bookIdPresident.edition}
                        disabled
                      />
                    </label>

                    <label htmlFor="edition" className="">
                      <span className="block  text-xs  text-gray-500 ">Price:</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-auto
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="price"
                        type="text"
                        initialValue={bookIdPresident.price}
                        disabled
                      />
                    </label>

                  </div>
                  <div className="row-start-2 col-span-2">
                    <label htmlFor="publicationDate" className="">
                      <span className="block  text-xs text-gray-500 ">Publication Date</span>
                      <Field
                        className="text-s focus:placeholder-gray-400  placeholder-gray-500 placeholder-opacity-25 pt-3 pb-2
                                        block w-36 px-0  text-gray-500  mt-0 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                        component="input"
                        name="publicationDate"
                        type="text"
                        initialValue={new Date(bookIdPresident.pubdate).toDateString()}
                        disabled
                      />
                    </label>
                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs  text-gray-500">Note:</span>
                      <Field
                        className=" resize-none text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50 "
                        component="textarea"
                        name="noteDeanbook"
                        type="input"
                        initialValue={bookIdPresident.notereqform}
                        disabled
                      />
                    </label>

                  </div>

                  <div className="col-span-1 row-start-6">

                    <label htmlFor="selectDosition" className="block ">
                      <span className="block  text-xs text-gray-500 ">For Approval</span>
                      <Field
                        required
                        name="approvalPresident"
                        component="select"
                        className="  text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-1 bg-gray-50 "
                        required
                      >

                        <option value="">Enter Status </option>
                        <option className="block text-xs  text-gray-500" value="0">On Going</option>
                        <option className="block text-xs  text-gray-500" value="1">Approved</option>

                      </Field>
                    </label>

                  </div>
                </div>

                <label htmlFor="requesID" className="">
                  <span className="block hover:textColor-red  text-xs  text-gray-500" />
                  <Field
                    className="form-text  text-xs    text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                    component="input"
                    name="requestID"
                    type="hidden"
                    initialValue={bookIdPresident.requestID}
                  />
                </label>
                <div className="block text-right p-8">
                  <button
                    type="submit"
                    className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white
                    bg-secondary hover:bg-indigo-700
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
