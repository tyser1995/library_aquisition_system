import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import api from '../../lib/api';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { useRouter } from 'next/router';


export const getServerSideProps = async (context) => {
  const { bookIdFinance } = context.query;
  const { data } = await api.get(`/api/books/${bookIdFinance}`);

  console.log(data);

  return {
    props: { bookIdFinance: data },

  };
};

export default function RequestForm({ bookIdFinance }) {
  const router = useRouter();

  const handleOnSubmit = async (payload) => {

    try {
      const { data } = await axios.post('/api/bookUpdateFinance', payload);

      toast.success('Update Successfully!', {
        position: 'bottom-right',
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: false,
        draggable: true,
        progress: undefined,
      }, data);
      router.push('/see-all-books-finance');

      
    } catch (error) {
      console.log(error);
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

              <form onSubmit={handleSubmit} className=" p-8 bg-white rounded-md my-16 shadow-md mx-auto min-h-screen w-full ">

                <div className="flex-shrink-0 flex content-around items-center p-8">

                  <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                  <h1 className="text-xl   text-gray-600 ">Finance Library Acquisition Approval Books</h1>

                </div>

                <div className="flex space-x-6 content-around items-center  justify-end p-8">

                  <label htmlFor="date" className="block ">
                    <span className="block  text-xs   text-gray-500 ">Approved Date</span>
                    <Field
                      className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                      name="approvalFinanceDate"
                      component="input"
                      type="date"
                      required
                      initialValue={new Date().toDateInputValue()}

                    />
                  </label>

                </div>

                <div className="grid grid-cols-3 gap-x-4 gap-y-6 p-8 border-1 mt-1 gap-2.5 ">

                  <div className="row-start-1">
                    <label htmlFor="author" className="">
                      <span className=" hover:textColor-red  text-xs  text-gray-500">User ID</span>
                      <Field
                        className="block text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="userID"
                        type="text"
                        initialValue={bookIdFinance.userID}
                        disabled
                      />
                    </label>

                    <label htmlFor="author" className="">
                      <span className="hover:textColor-red  text-xs  text-gray-500 ">Name</span>
                      <Field
                        className=" block text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="requestee"
                        type="text"
                        initialValue={bookIdFinance.requestee}
                        disabled
                      />
                    </label>

                  </div>
                  <div className="row-start-1 col-span-2">
                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs  text-gray-500 ">Author</span>
                      <Field
                        className=" text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Author"
                        type="text"
                        placeholder="Author"
                        initialValue={bookIdFinance.authorName}
                        disabled
                      />
                    </label>
                    <label htmlFor="author" className="">
                      <span className="block hover:textColor-red text-xs  text-gray-500 ">Title</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                   placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Title"
                        type="text"
                        placeholder="Title"
                        initialValue={bookIdFinance.title}
                        disabled
                      />
                    </label>
                  </div>

                  <div className="row-start-2 ">
                    <label htmlFor="edition" className="">
                      <span className="block  text-xs  text-gray-500 ">Number of Copies</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="NumberOfCopies"
                        type="text"
                        initialValue={bookIdFinance.copvol}
                        disabled
                      />
                    </label>

                    <label htmlFor="edition" className=" ml">
                      <span className="block  text-xs  text-gray-500 ">Edition</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-full
                      focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="Edition"
                        type="text"
                        initialValue={bookIdFinance.edition}
                        disabled
                      />
                    </label>
                    <label htmlFor="edition" className="">
                      <span className="block  text-xs  text-gray-500 ">Price</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-auto
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="price"
                        type="text"
                        initialValue={bookIdFinance.price}
                        disabled
                      />
                    </label>
                    <label htmlFor="requesID" className="block">
                      <span className="  text-xs text-gray-500 mt-23">Dean Signature</span>
                      <img
                        src={bookIdFinance.signatureDean}
                        alt="College Dean Signature"
                        width="100"
                        height="100"
                        className=" mt-2 border-solid border-4 border-gray-blue-900"
                      />  
                      <div className="text-xs mt-2 text-gray-500 underline">
                        {bookIdFinance.deanName}
                        </div>

                    </label>

                  </div>               
                 

                  <div className="row-start-2 col-span-2">

                    <label htmlFor="publicationDate" className=" ">
                      <span className="block  text-xs  text-gray-500 ">Publication Date</span>
                      <Field
                        className="text-gray-500 rounded-md border-gray-300  w-auto
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="input"
                        name="publicationDate"
                        type="text"
                        initialValue={new Date(bookIdFinance.pubdate).toDateString()}
                        disabled
                      />
                    </label>
                    <label htmlFor="notereqform" className="">
                      <span className="block  text-xs  text-gray-500 ">Note:</span>
                      <Field
                        className="resize-none text-gray-500 rounded-md border-gray-300  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 border-0 bg-gray-50"
                        component="textarea"
                        name="noteDeanbook"
                        type="input"
                        initialValue={bookIdFinance.notereqform}
                        disabled
                      />
                    </label>

                  </div>
                  
                  <div className="row-start-3 col-span-2">

                    <label htmlFor="selectDosition" className="block ">
                      <span className="block  text-xs  text-gray-500 p">For Approval</span>
                      <Field
                        name="approvalFinance"
                        component="select"
                        required
                        className="   mb-2 text-gray-500 rounded-md border-gray-300  w-1/4
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                  required
                      >

                        <option value="">Enter Status </option>
                        <option className="block text-xs text-gray-500" value="0">On Going</option>
                        <option className="block text-xs  text-gray-500" value="1">Approved</option>

                      </Field>
                    </label>
                  </div>
                </div>

                <label htmlFor="requesID" className="">
                  <span className="block hover:textColor-red  text-xs  text-gray-500 " />
                  <Field
                    className="form-text  text-xs   text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
                    component="input"
                    name="requestID"
                    type="hidden"
                    initialValue={bookIdFinance.requestID}
                  />
                </label>
                <div className="block text-right p-8 ">
                  <button
                    type="submit"
                    className="cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm
                  font-medium rounded-md text-white bg-secondary hover:bg-indigo-700
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
