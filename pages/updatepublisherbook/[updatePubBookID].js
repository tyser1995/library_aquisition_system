import { Form, Field } from 'react-final-form';
import axios from 'axios';
import Head from 'next/head';
import { useSession } from 'next-auth/client';
import api from '../../lib/api';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import validateSession from '../../lib/session';


export const getServerSideProps = async (context) => {
    const { updatePubBookID } = context.query;
    const { data } = await api.get(`/api/updatepublisherbook/${updatePubBookID}`);

    console.log(data);

    return {
        props: { updatePubBookID: data },

    };
};

export default function EnterBook({ updatePubBookID }) {
    const handleOnSubmit = async (payload) => {
        const { data } = await axios.post('/api/bookPublisherUpdate', payload);

        toast.success(' Update Successfully!', {
            position: 'bottom-right',
            autoClose: 5000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: false,
            draggable: true,
            progress: undefined,
          }, data);

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
                                    <h1 className="text-xl  text-gray-600 ">Library Acquisition Entry of Books</h1>

                                </div>

                                <div className="flex space-x-6 content-around items-center  justify-end p-8">

                                    <label htmlFor="date" className="block ">
                                        <span className="block  text-xs  text-gray-500 mb-1">Books Posted</span>
                                        <Field
                                            className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 cursor-pointer placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                                            name="updateDate"
                                            component="input"
                                            type="date"
                                            required
                                            initialValue={new Date().toDateInputValue()}

                                        />
                                    </label>

                                </div>
                                <div className="grid grid-cols-3 gap-x-4 gap-y-8 ga p-8 border-1">
                                    <div className="row-start-1">

                                        <label htmlFor="author" className="">
                                            <span className="block hover:textColor-red  text-xs  text-gray-500 mb-1">User ID</span>
                                            <Field
                                                className="text-gray-500 rounded-md  w-full
                  focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                                                component="input"
                                                name="userID"
                                                type="text"
                                                initialValue={updatePubBookID.pubID}
                                                disabled

                                            />
                                        </label>

                                        <label htmlFor="author" className="">
                                            <span className="block hover:textColor-red  text-xs x text-gray-500 mb-1">Publisher Name</span>
                                            <Field
                                                className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                                                component="input"
                                                name="requestee"
                                                type="text"
                                                initialValue={updatePubBookID.pubName}
                                                disabled
                                            />
                                        </label>
                                        
                                        <label htmlFor="author" className="">
                                            <span className="block hover:textColor-red  text-xs x text-gray-500 mb-1">Publisher Name</span>
                                            <Field
                                                className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                                                component="input"
                                                name="pubAddress"
                                                type="text"
                                                initialValue={updatePubBookID.pubAddress}
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
                                                initialValue={updatePubBookID.authorName}
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
                                                initialValue={updatePubBookID.title}
                                                disabled
                                            />
                                        </label>
                                    </div>
                                    <div className="row-start-2 gap-y-6 space-y-2">

                               

                                        <label htmlFor="edition" className=" ">
                                            <span className="block  text-xs  text-gray-500 ">Edition</span>
                                            <Field
                                                className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                                                component="input"
                                                name="Edition"
                                                type="text"
                                                initialValue={updatePubBookID.edition}
                                                disabled
                                            />
                                        </label>
                                                 <label htmlFor="edition" className="">
                                            <span className="block  text-xs  text-gray-500 ">Number of Copies</span>
                                            <Field
                                                className="text-gray-500 rounded-md  w-full
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 border-0 placeholder-opacity-50 bg-gray-50"
                                                component="input"
                                                name="NumberOfCopies"
                                                type="text"
                                                initialValue={updatePubBookID.copvol}
                                                disabled
                                            />
                                        </label>
                                         


                                    </div>
                                    <div className="row-start-3 gap-y-2">


                                        <label htmlFor="selectDosition" className="block">
                                            <span className="block  text-xs  text-gray-500 p">Status</span>
                                            <Field
                                                name="status"
                                                component="select"
                                                className=" text-gray-500 rounded-md  w-4/6
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700  placeholder-opacity-50 bg-gray-50"
                                                required
                                            >

                                                <option value=""> Select Status </option>
                                                <option className=" text-xs text-gray-500" value="0">Processing</option>
                                                <option className=" text-xs text-gray-500" value="4">Post</option>
                                                

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
                                                initialValue={new Date(updatePubBookID.pubdate).toDateString()}
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
                                        initialValue={updatePubBookID.requestID}
                                    />
                                </div>

                                <div className="block text-right mt-5 p-8 ">
                                    <button
                                        type="submit"
                                        className=" cursor-pointer  mx-auto text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-secondary hover:bg-indigo-700
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Update

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
