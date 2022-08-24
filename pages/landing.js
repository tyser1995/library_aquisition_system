import Link from 'next/link';
import Head from 'next/head';

export default function Landing() {
  return (
    <section className=" mx-auto md:flex bg-gray-200min-h-screen ">

      <div className=" md:w-auto bg-black md:bg-gray-600 px-2  fixed   h-16 md:h-screen md:border-r-4 md:border-grey-dark">

        <Head>
          <title>Library Acquisition | Welcome! </title>
          <meta name="keywords" content="someting" />
        </Head>

        <div className="md:relaive mx-8 lg:float-right lg:px-6">

          <ul className="list-reset flex flex-row md:flex-col text-center md:text-left">
            <li className="mr-3 flex-1">
              <a href="#" className="block py-1 md:py-3 pl-1 align-middle text-grey-darkest no-underline hover:text-pink border-b-2 border-grey-darkest md:border-black hover:border-pink">
                <i className="fas fa-link pr-0 md:pr-3" />
                <span className="pb-1 md:pb-0 text-xs md:text-base text-grey-dark md:text-grey-light block md:inline-block">Link</span>
              </a>
            </li>
            <li className="mr-3 flex-1">
              <Link href="/requestform"><span className=" hover:bg-gray-900 hover:text-white text-gray-300 px-3 py-2 border-0 border-b-2 text-sm font-medium">About Us</span></Link>

            </li>
            <li className="mr-3 flex-1">
              <a href="#" className="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-pink-dark">
                <i className="fas fa-link pr-0 md:pr-3 text-pink" />
                <span className="pb-1 md:pb-0 text-xs md:text-base text-white md:font-bold block md:inline-block">Active Link</span>
              </a>
            </li>
            <li className="mr-3 flex-1">
              <a href="#" className="block py-1 md:py-3 pl-1 align-middle text-grey-darkest no-underline hover:text-pink border-b-2 border-grey-darkest md:border-black hover:border-pink">
                <i className="fas fa-link pr-0 md:pr-3" />
                <span className="pb-1 md:pb-0 text-xs md:text-base text-grey-dark md:text-grey-light block md:inline-block">Link</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </section>
  );
}
