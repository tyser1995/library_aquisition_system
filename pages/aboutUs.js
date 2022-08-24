import Head from 'next/head';

const AboutUs = () => (
  <>
    <Head>
      <title>Library Acquisition | About Us </title>
      <meta name="keywords" content="someting" />
      <link rel="icon" href="/icon.ico" />
    </Head>
    <section className="px-8 pt-8 pb-32 bg-base rounded-md my-16   mx-auto h-max w-full  ">
      <br />

      <div className="">
        <h1 className="font-bold text-2xl ml-7 pb-3">
          MISSION/VISION & OBJECTIVES
        </h1>
        <p className="ml-11 bg-gray-200 border-2 bg-auto p-8 rounded-xl italic  text-lg" >
          "A modern University Library committed to the achievement of the Institution’s vision  of Exemplary Christian Education
          for Life (EXCEL) through its user-oriented service and  state-of-the-art library technologies."
          <br />

          <br />

          <cite className="font-extralight text-sm flex items-center justify-center">
            LIBRARY MISSION/VISION
          </cite>
        </p>

      </div>
      <br />

      {/* <div className="">

        <div className=" font-semibold text-xl ml-7 ">
          ABOUT US
        </div>
        <p className="ml-11 font-normal  text-lg p-8" >
          A modern University Library committed to the achievement of the Institution’s vision of Exemplary Christian Education for Life<br />
          (EXCEL) through its user-oriented service and state-of-the-art library technologies.
          LIBRARY MISSION/VISION
        </p>

      </div> */}
      <br />



      <div>

        <div className=" font-semibold text-xl ml-7 ">
          LIBRARY OBJECTIVES
        </div>
        <p className="ml-11 font-normal text-lg p-8" >
          <cite className="font-semibold">
            Statement of Purpose
          </cite>

          <br />
          <br />
          The aim of the library is to provide materials and other reading aids in consonance with the aim of the University which is to provide well-rounded education by
          developing students spiritually intellectually, and physically, to the end that they may become free and creative citizens in an open society.   <br />To accomplish this purpose, the
          University seeks to provide the students with a stimulating atmosphere permeated by the Spirit of the Great Teacher and expressed in an educational program and encourages intensive search for truth and knowledge and unhampered by fear or prejudice.

          <br />
          <br />

          <cite className="font-semibold">
            Specific Library Objectives
          </cite>
          <br />
          <br />
          <ul className="list-disc space-y-1 ml-11" >
            The University Library in order to carry on the above Statement of Purpose and General Objectives of the University hereby states its 
            specific objectives which are:

            <br />
            <br />
            <li className="font">  
          To assemble, preserve and administer an organized collection, etc. in order to produce through the collection and the communication of
           ideas in order to enlighten the studentry.
            </li>
            <li>
              To serve the information need of the University – and if possible beyond – to the fullest extent possible.
              </li>
              <li>
              To serve the University as well as the community as a center of reliable information.
              </li>
              <li>
              To provide a place where inquiring minds may encounter the original, sometimes the unorthodox and critical ideas to necessitate correctiveness
               and stimulant in an academic community that depends on its survival competition in ideas.
              </li>
              <li>
              To support education, social, civic, and cultural activities as an individual or as a group through the use of library resources.
              </li>
              <li>
              To provide opportunity and encourage educational advancement continuously through research.
              </li>
              <li>
              To seek continually, to identify academic needs and for service to meet such needs.
              </li>
          </ul>




          
        </p>


      </div>

     

    </section>
  </>
);

export default AboutUs;
