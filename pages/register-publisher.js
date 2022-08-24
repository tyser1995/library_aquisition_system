import { Form, Field } from 'react-final-form';
import { useSession } from 'next-auth/client';
import Head from 'next/head';
import Link from 'next/dist/client/link';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import axios from 'axios';

export default function RegistrationForm() {
  const handleOnSubmit = async (payload) => {
    try {
      const { data } = await axios.post('/api/registerPublisher', payload);

      toast.success('Registration Success');
    } catch (error) {
      toast.error('Error in Registration');
    }
  };
  const [session] = useSession();

  return (
    <>
      <Head>
        <title>Library Acquisition | Sign Up </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />

      </Head>
      <section className="mx-auto pr-10 pl-10 pt-10 bg-base min-h-screen">
        {!session && (
        <>
          <div className=" mx-auto p-10 md:flex bg-base h-1/5 border-blue-900 border-1 rou">
            <Link href="/login">
              <span className=" hover:bg-blue-900 hover:text-white
         text-gray-600 px-3 py-2 rounded-md text-sm font-medium"
              >
                Please Sign In First
              </span>

            </Link>
          </div>

        </>
        )}

        {session && (
        <>

          <Form
            onSubmit={handleOnSubmit}
            render={({ handleSubmit }) => (
              <form onSubmit={handleSubmit} className=" px-8 pt-8  bg-white rounded-md my-16 shadow-md mx-auto w-auto h-auto">

                <div className="content-around justify-center  flex items-center">
                  <img className="hidden lg:block h-20 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                </div>

                <div className="justify-center  flex items-center">
                <h3 className="text-xl m-4 text-gray-600 cursor-not-allowed">Sign  Up </h3>
                </div>

                <label htmlFor="uname" className="block">
                  <span className="block text-xs text-gray-500 mb-">User Name</span>
                  <Field
                    className="block mt-2
                     text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50"
                    component="input"
                    name="uname"
                    type="text"
                    placeholder="User Name"
                    required
                  />
                </label>

                <div className="flex space-x-6 content-around items-center mt-3">
                  <label htmlFor="password" control className="block">
                    <span className="block  text-xs   text-gray-500 mb-">Password</span>
                    <Field
                      className=" block mt-2
                      text-gray-500 rounded-md  w-full
                     focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50"
                      name="password"
                      component="input"
                      type="password"
                      placeholder="Password"
                    />
                  </label>

                  <label htmlFor="cpassword">

                    <span className="block  text-xs  text-gray-500 ml-3">Confirm Password</span>
                    <Field
                      className="block mt-2
                      text-gray-500 rounded-md  w-full
                     focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50"
                      name="cpassword"
                      component="input"
                      type="password"
                      placeholder="Confirm Password"
                    />
                  </label>
                </div>

                <label htmlFor="fname" className="block mt-3">
                  <span className="block mt-1 text-xs  text-gray-500 mb-1">Publisher Name</span>
                  <Field
                    className="block mt-2
                    text-gray-500 rounded-md  w-full
                   focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50 "
                    component="input"
                    name="pubName"
                    type="text"
                    placeholder="Publisher Name"
                  />
                </label>

                <label htmlFor="fname" className="block mt-3">
                  <span className="block mt-1 text-xs  text-gray-500 mb-1">Publisher Address</span>
                  <Field
                    className="block mt-2
                    text-gray-500 rounded-md  w-full
                   focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50 "
                    component="input"
                    name="pubAddress"
                    type="text"
                    placeholder="Publisher Name"
                  />
                </label>


                <div className="flex space-x-6 content-around items-center mt-3">

                  <label htmlFor="email">
                    <span className="block text-gray-500   text-xs f mb-1">Email</span>
                    <Field
                      className=" block mt-2
                      text-gray-500 rounded-md  w-full
                     focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50 "
                      name="email"
                      component="input"
                      type="email"
                      placeholder="@"
                      autoComplete="email"
                    />
                  </label>
                  <label htmlFor="pnumber" className="block mt- ">
                    <span className="block  text-xs  text-gray-500 mb-1">Contact Number</span>
                    <Field
                      className=" block mt-2
                      text-gray-500 rounded-md  w-full
                     focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50 "
                      name="pnumber"
                      component="input"
                      type="number"
                      placeholder="Contact#"
                    />
                  </label>
                  <Field
                      className=" block mt-2
                      text-gray-500 rounded-md  w-full
                     focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50 "
                      name="selectPosition"
                      component="input"
                      type="hidden"
                      initialValue= "Publisher"
                    />

                </div>
                <div className="block text-right mt-5 pb-5">
                  <button
                    type="submit"
                    className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Sign Up

                  </button>
                </div>
              </form>
            )}
          />

        </>
        )}
      </section>

    </>
  );
}
