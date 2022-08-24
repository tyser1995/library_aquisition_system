import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { toast } from 'react-toastify';
import { useRouter } from 'next/router';
import 'react-toastify/dist/ReactToastify.css';
import validateSession from '../lib/session';

export const getServerSideProps = async (context) => {
  const { account } = await validateSession(context);

  return {
    props: { account },
  };
};

export default function RequestForm({ account }) {
  const router = useRouter();

  Date.prototype.toDateInputValue = (function () {
    const local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
  });

  const handleOnSubmit = async (payload) => {
    try {
      const { data } = await axios.post('/api/requestform', payload);

      toast.success('Request Sent!', {
        position: 'bottom-right',
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: false,
        draggable: true,
        progress: undefined,
      }, data);

      // router.push('/');
      location.reload();
    } catch (error) {
      console.error(error);
    }
  };

  return (

    <section className=" mx-auto  md:flex bg-base  min-h-screen ">

      <Head>
        <title>Library Acquisition | Request Form </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>
      <Form
        onSubmit={handleOnSubmit}
        render={({ handleSubmit }) => (

          <form onSubmit={handleSubmit} className=" px-8 pt-8 pb-4 bg-white rounded-md my-16 w- mx-auto h-auto w-full shadow-md ">

            {/* //hidden stuff starts here */}

            <Field
              className="form-text text-xs font-bold text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
              component="input"
              name="selectDepartment"
              type="hidden"
              initialValue={account.selectDepartment}
            />
            <Field
              className="form-text text-xs font-bold text-gray-500 focus:placeholder-gray-500 placeholder-gray-500 placeholder-opacity-50  pt-3 pb-2
                            block px-0 mb-2 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-400"
              component="input"
              name="selectPosition"
              type="hidden"
              initialValue={account.selectPosition}
            />
            {/* Hidden stuff ends here */}

            <div className=" flex content-around items-center p-4">
              <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
              <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
              <h1 className="text-xl  text-gray-500 ">Library Acquisition Request Form</h1>

            </div>

            <div className="flex space-y-8 justify-end p-4 ">

              <label htmlFor="date" className="block mr-4">
                <span className="  text-xs  text-gray-500 mb-1 ">Requested Date</span>
                <Field
                  className="block text-gray-400 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-701 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50  cursor-pointer"
                  name="date"
                  component="input"
                  type="date"
                  required
                  initialValue={new Date().toDateInputValue()}

                />
              </label>

              <label htmlFor="rush" className="">
                <Field className="text-gray-500   form-radio h-3 w-3 rounded-sm" name="rushornrush" component="input" type="radio" value="Rush" required />
                <span className="  text-xs  text-gray-500 mb-1">Rush</span>
              </label>

              <label htmlFor="nrush">
                <Field className=" text-xs  text-gray-500 form-radio h-3 w-3 rounded-sm " name="rushornrush" component="input" type="radio" value="Not Rush" />
                <span className="  text-xs   text-gray-500 mb-">Not Rush</span>
              </label>
            </div>

            <div className=" grid grid-cols-3 row-3  gap-x-4 gap-y-6 p-4 border-1 ">
              <div className="row-start-1 ">
                <label htmlFor="date" className="block mr-4">
                  <span className="  text-xs  text-gray-500 mb-1">User ID</span>

                  <Field
                    className="block text-gray-400 rounded-md  w-auto
              focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="userID"
                    type="text"
                    initialValue={account.id}
                    disabled
                  />
                </label>
                <label htmlFor="date" className="block mr-4">
                  <span className="  text-xs  text-gray-500 mb-1">Name</span>

                  <Field
                    className="block text-gray-400 rounded-md  w-auto
              focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="requestee"
                    type="text"
                    initialValue={account.fname + account.lname}
                    disabled
                  />
                </label>

              </div>

              <div className="row-start-2 ">
                <label htmlFor="author" className="">
                  <span className=" hover:textColor-red text-sm   text-gray-500 mb-">Author</span>
                  <Field
                    className="block rounded-md border-gray-300 shadow-sm w-2/4
                focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 text-gray-500 bg-gray-50"
                    component="input"
                    name="authorName"
                    type="text"
                    placeholder="Authors Name"
                  />
                </label>

                <label htmlFor="title" className=" ">
                  <span className="  text-xs  text-gray-500 ">Title</span>
                  <Field
                    className=" rounded-md border-gray-300 shadow-sm w-full
                focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-500 placeholder-opacity-50  text-gray-500 bg-gray-50"
                    component="input"
                    name="title"
                    type="text"
                    placeholder="Books' Title"
                  />
                </label>
                <label htmlFor="chargedto" className="">
                  <span className="  text-xs  text-gray-500 ">Publisher Name</span>
                  <Field
                    className="block rounded-md border-gray-300 shadow-sm w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-500 placeholder-opacity-50 text-gray-500 bg-gray-50"
                    component="input"
                    name="pubName"
                    type="text"
                    placeholder="Name of the Publisher"
                  />
                </label>
              </div>
              <div className="row-start-2   ">
                <label htmlFor="pbadress" className="">
                  <span className=" hover:textColor-red text-xs  text-gray-500 mb-">Publisher Address</span>
                  <Field
                    className="block rounded-md border-gray-300 shadow-sm w-full
                focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 text-gray-500 bg-gray-50"
                    component="input"
                    name="pubAddress"
                    type="text"
                  />
                </label>
                <label htmlFor="pdate" className="mt-">
                  <span className="  text-xs text-gray-500">Publish Date</span>
                  <Field
                    className=" block rounded-md border-gray-300  w-2/4
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 text-gray-500 bg-gray-50"
                    component="input"
                    name="pubdate"
                    type="date"
                    required
                  />
                </label>
                <label htmlFor="edition" className="">
                  <span className=" text-xs  text-gray-500 ">Edition</span>
                  <Field
                    className="block text-gray-500 rounded-md border-gray-300  w-3/4
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="edition"
                    type="text"
                    placeholder="Book's Edition"
                  />
                </label>

              </div>

              <div className="row-start-2 ">
                <label htmlFor="subjectr" className="">
                  <span className=" text-xs text-gray-500">Subject</span>
                  <Field
                    className="block text-gray-500 rounded-md border-gray-300  w-auto
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="subject"
                    type="text"
                    placeholder="Subject "
                  />
                </label>

                <label htmlFor="copvol" className="">
                  <span className=" block text-xs  text-gray-500">Copies/Volumes</span>
                  <Field
                    className="text-gray-500 rounded-md border-gray-300  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="copvol"
                    type="number"
                    placeholder="Number of Copies"
                  />
                </label>
                <label htmlFor="chargedto" className=" ">
                  <span className="  text-xs  text-gray-500 ">Charge to</span>
                  <Field
                    className="text-gray-400 w-full rounded-md border-gray-300 border-0
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="chargeto"
                    type="text"
                    initialValue={account.selectDepartment}
                    disabled
                  />
                </label>

              </div>
              <div className="row-start-3 ">
                <label htmlFor="notereqform" className="">
                  <span className="block  text-xs  text-gray-500 mb-1">Note:</span>
                  <Field
                    className=" resize-none h-full w-full  text-sm text-gray-400 rounded-md border-gray-300
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50  "
                    component="textarea"
                    name="notereqform"
                    type="input"
                  />
                </label>
              </div>

            </div>

            <div className="block text-right mt-5 p-4">
              <button
                type="submit"
                className=" mx-auto text-center py-2 px-10 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-secondary hover:bg-indigo-700
                 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                Send Request
              </button>
            </div>

          </form>
        )}
      />

    </section>
  );
}
