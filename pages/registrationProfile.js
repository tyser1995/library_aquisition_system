import { Form, Field } from 'react-final-form';
import { useSession } from 'next-auth/client';
import Head from 'next/head';
import Link from 'next/dist/client/link';
import { toast } from 'react-toastify';

import axios from 'axios';

export default function RegistrationForm() {
  const handleOnSubmit = async (payload) => {
    try {
      const { data } = await axios.post('/api/register', payload);

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
          <div className=" mx-auto p-10 md:flex bg-white h-1/5 border-blue-900 border-1 rou">
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
              <form onSubmit={handleSubmit} className=" px-8 pt-8  bg-white rounded-md my-16 shadow-md mx-auto w-auto min-h-screen">

                <div className="content-around justify-center  flex items-center">
                  <img className="hidden lg:block h-20 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                  <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />

                </div>
                <div className="justify-center  flex items-center">

                  <h3 className="text-xl mb-4 font-bold text-gray-600 ">Sign  Up </h3>
                </div>

                <label htmlFor="uname" className="block">
                  <span className="block text-xs font-bold text-gray-500 mb-">ID</span>
                  <Field
                    className="  text-xs font-bold text-gray-500  placeholder-gray-400 mt-1 focus:placeholder-gray-500 placeholder-opacity-50
           rounded-md border-gray-300 shadow-sm w-full"
                    component="input"
                    name="uname"
                    type="text"
                    placeholder="Username"
                    required
                  />
                </label>

                <div className="flex space-x-6 content-around items-center mt-3">
                  <label htmlFor="password" control className="block">
                    <span className="block  text-xs font-bold  text-gray-500 mb-">Password</span>
                    <Field
                      className=" text-xs font-bold text-gray-500   placeholder-gray-400 mt-1 focus:placeholder-gray-500 placeholder-opacity-50
          rounded-md border-gray-300 shadow-sm"
                      name="password"
                      component="input"
                      type="password"
                      placeholder="Password"
                    />
                  </label>

                  <label htmlFor="cpassword">

                    <span className="block  text-xs font-bold text-gray-500 ml-3">Confirm Password</span>
                    <Field
                      className="text-xs font-bold text-gray-500 mt-1 ml-3 placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-50
           rounded-md border-gray-300 shadow-sm"
                      name="cpassword"
                      component="input"
                      type="password"
                      placeholder="Confirm Password"
                    />
                  </label>
                </div>
                <label htmlFor="fname" className="block mt-3">
                  <span className="block mt-1 text-xs font-bold text-gray-500 mb-1">Firstname</span>
                  <Field
                    className="text-xs font-bold text-gray-500   placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-50
          rounded-md border-gray-300 shadow-sm  w-full "
                    component="input"
                    name="fname"
                    type="text"
                    placeholder="Firstname"
                  />
                </label>

                <label htmlFor="mname" className="block mt-2">
                  <span className="block text-xs  font-bold text-gray-500  mb-1">Middlename</span>
                  <Field
                    className=" text-xs font-bold text-gray-500   placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-50
           rounded-md border-gray-300 shadow-sm w-full"
                    name="mname"
                    component="input"
                    type="text"
                    placeholder="Middlename"
                  />
                </label>

                <label htmlFor="lname" className="block mt-2">
                  <span className="block text-xs   font-bold text-gray-500 mb-1">Lastname</span>
                  <Field className="text-xs font-bold text-gray-500  placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-50 rounded-md border-gray-300 w-full shadow-sm " name="lname" component="input" type="text" placeholder="Lastname" />
                </label>

                <label htmlFor="selectDosition" className="block mt-2">
                  <span className="block  text-xs font-bold text-gray-500 p">Select Department</span>
                  <Field name="selectDepartment" component="select" className="rounded-md  text-xs font-bold text-gray-500 border-gray-300  mt-1 pr-36 ">
                    <option value="">Select Department</option>
                    <option className="text-xs font-bold text-gray-500" value="COLLEGE OF AGRICULTURE, RESOURCES AND ENVIRONMENTAL SCIENCES">College of Agriculture</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Arts & Sciences">College of Arts & Sciences</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Business & Accountancy">College of Business & Accountancy</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Computer Studies">College of Computer Studies</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Education">College of Education</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Engineering">College of Engineering</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Hospitality Management">College of Hospitality Management</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Medical Laboratory Science">College of Medical Laboratory Science</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Nursing">College of Nursing</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Pharmacy">College of Pharmacy</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Law">College of Law</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Medicine">College of Medicine</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Theology">College of Theology</option>
                    <option className="text-xs font-bold text-gray-500" value="College of Theology">Admin</option>

                  </Field>
                </label>

                <div className="flex space-x-6 content-around items-center mx-auto mt-3">
                  <label htmlFor="selectPosition" className="block mt-">
                    <span className="block  text-xs font-bold text-gray-500 ">Select Positon </span>
                    <Field name="selectPosition" component="select" className="rounded-md border-gray-300 text-xs font-bold text-gray-500 mt-1 pr-72">
                      <option value=""> </option>
                      <option className="text-xs font-bold text-gray-500" value="Dean">Dean </option>
                      <option className="text-xs font-bold text-gray-500" value="Librarian">Librarian</option>
                      <option className="text-xs font-bold text-gray-500" value="Acquisition">Acquisition</option>
                      <option className="text-xs font-bold text-gray-500" value="Faculty">Faculty</option>
                      <option className="text-xs font-bold text-gray-500" value="VPAA">VPAA</option>
                      <option className="text-xs font-bold text-gray-500" value=">Director of Library">Director of Library</option>
                      f
                    </Field>
                  </label>
                </div>

                <div className="flex space-x-6 content-around items-center mt-3">

                  <label htmlFor="email">
                    <span className="block text-gray-500   text-xs font-bold mb-1">Email</span>
                    <Field
                      className="  text-xs font-bold text-gray-500 placeholder-gray-400 focus:placeholder-gray-500 placeholder-opacity-50
         rounded-md border-gray-300 shadow-sm"
                      name="email"
                      component="input"
                      type="email"
                      placeholder="@"
                      autoComplete="email"
                    />
                  </label>
                  <label htmlFor="pnumber" className="block mt- ">
                    <span className="block  text-xs font-bold text-gray-500 mb-1">Contact Number</span>
                    <Field
                      className=" text-xs font-bold text-gray-500 rounded-md border-gray-300 shadow-sm   placeholder-gray-400
        focus:placeholder-gray-500 placeholder-opacity-50"
                      name="pnumber"
                      component="input"
                      type="text"
                      autoComplete
                      placeholder="Contact#"
                    />
                  </label>

                </div>
                <div className="block text-right mt-5">
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
