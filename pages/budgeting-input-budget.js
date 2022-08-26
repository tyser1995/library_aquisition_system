import Head from 'next/head';
import { Form, Field } from 'react-final-form';
import React, { useMemo } from 'react';
import axios from 'axios';
import ReactTable from '../components/table';
import BudgetForm from './budget-form';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { Fragment, useEffect, useState } from 'react';
import mysql from '../providers/mysql';
import api from '../lib/api';


export const getServerSideProps = async () => {
  const { data: cost } = await api.get('/api/totalCost');
  const { data: budget } = await api.get('/api/postTotalBudget');
  const { data: refFil } = await api.get('/api/getReferenceFilipiniana');

  const totalAddedBudget = await mysql.query('SELECT sum(budget) FROM add_budget WHERE selectDepartment NOT IN ("Filipiniana","Reference") and YEAR(dateAdded) = YEAR(CURDATE())');
  const totalAddedRefFil = await mysql.query('SELECT sum(budget) FROM add_budget WHERE selectDepartment  IN ("Filipiniana","Reference") and YEAR(dateAdded) = YEAR(CURDATE())');


  const totalPostAddedBud = JSON.stringify(totalAddedBudget);
  const totalPostAddedRefFil = JSON.stringify(totalAddedRefFil);


  return {
    props: {
      totalCost: cost,
      totalBudget: budget,
      data: refFil,
      totalAddedBud: totalPostAddedBud,
      totalPostAddedRefFil: totalPostAddedRefFil,

    },
  }

};




export default function SignIn({ totalCost, totalBudget, data, totalAddedBud, totalPostAddedRefFil }) {

  // console.log( Object.keys(totalAddedBud).forEach(function(total){
  //   return totalAddedBud[total];
  // })); 
  // console.log(totalAddedBud);
  // console.log(totalPostAddedRefFil);



  const [total, setTotalBud] = useState(null);

  const [txtBudget, setTextBudget] = useState(null);
  const [txtEnrol, setTxtEnrol] = useState(null);

  const [txtTotalAddedBud, setTotalAddedBud] = useState(totalAddedBud.split(':')[1].toString().replace('}]', ''));
  const [txtTotalAddedRefFil, setTotalAddedBudRefFil] = useState(totalPostAddedRefFil.split(':')[1].toString().replace('}]', ''));



  const overallBudget = Number(txtTotalAddedBud) + Number(txtTotalAddedRefFil);




  const handleKeyPressEnrollees = (event) => {
    var inputTxtBoxLibFee = document.getElementById('textboxLibFee').value;
    var inputTxtBoxEnrollees = document.getElementById('textboxEnrollees').value;
    var totalBud = document.getElementById('budget').value;

    if (inputTxtBoxLibFee != "NaN" || inputTxtBoxLibFee != "") {
      totalBud = document.getElementById('textboxEnrollees').value * document.getElementById('textboxLibFee').value;
      setTotalBud(totalBud);
      setTxtEnrol(document.getElementById('textboxEnrollees').value);

    }

  }

  const handleKeyPress = (event) => {
    var inputTxtBoxLibFee = document.getElementById('textboxLibFee').value;
    var inputTxtBoxEnrollees = document.getElementById('textboxEnrollees').value;
    var totalBud = document.getElementById('budget').value;
    if (document.getElementById('textboxEnrollees').value == "NaN" || document.getElementById('textboxLibFee').value == "NaN") {

    }
    totalBud = document.getElementById('textboxEnrollees').value * document.getElementById('textboxLibFee').value;
    setTotalBud(totalBud);
    setTextBudget(document.getElementById('textboxLibFee').value);

  }

  Date.prototype.toDateInputValue = (function () {
    const local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
  });

  const postBudget = useMemo(
    () => [
      {
        Header: 'Department',
        accessor: 'selectDepartment', // accessor is the "key" in the data
      },
      {
        Header: 'Total Budget',
        accessor: 'sum(budget)', //
        Cell: ({ row: { values } }) => `₱${values['sum(budget)']}`, // accessor is the "key" in the data
      },

    ],
    [],
  );

  // console.log(totalCost);
  const postCost = useMemo(
    () => [
      {
        Header: 'Department',
        accessor: 'selectDepartment', // accessor is the "key" in the data
      },
      {
        Header: 'Total Cost',
        accessor: 'sum(price)', // accessor is the "key" in the data
        Cell: ({ row: { values } }) => `₱${values['sum(price)']}`,
      },
      {
        Header: () => 'Action',
        accessor: 'action',
        Cell: ({ row: { values } }) => <BudgetForm selectDepartment={values.selectDepartment} />,
      },
    ],
    [],
  );

  const cjok = useMemo(
    () => [
      {
        Header: 'Library Section',
        accessor: 'selectDepartment', // accessor is the "key" in the data

      },

      {
        Header: 'Total Budget',
        accessor: 'budget', //
        Cell: ({ row: { values } }) => `₱${values['budget']}`,// accessor is the "key" in the data
        // Footer:()=>{
        //   const totalAdded = 0
        //   return totalAdded;
        // for(let i = 0; i<=){}
      },


    ],
    [],
  );

  const handleOnSubmit = async (payload) => {
    const { data } = await axios.post('/api/saveBudget', payload);


    toast.success('Added Successfuly!', {
      position: 'bottom-right',
      autoClose: 5000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: false,
      draggable: true,
      progress: undefined,
    }, data);
    location.reload();

  };


  return (
    <>
      <Head>
        <title>Library Acquisition | Input Budget </title>
        <meta name="keywords" content="someting" />
        <link rel="icon" href="/icon.ico" />
      </Head>

      <section className=" mx-auto  md:flex bg-base  min-h-screen ">

        <Form
          onSubmit={handleOnSubmit}
          render={({ handleSubmit }) => (

            <form onSubmit={handleSubmit} className=" px-8 pt-8 pb-8 bg-white rounded-md my- mx-auto h-auto w-full shadow-lg  ">
              {/* MODAL ENDS HERE */}
              <Field
                className="text-gray-500 rounded-md  border-gray-300  w-auto
                    focus:placeholder-gray-700 focus:border-gray-500 placeholder-gray-700 placeholder-opacity-50 bg-gray-50"
                name="dateAdded"
                component="input"
                type="hidden"
                initialValue={new Date().toDateInputValue()}
                required
              />
              <div className="flex-shrink-0 flex content-around items-center">

                <img className="hidden lg:block h-14 w-auto  mr-3" src="/cpulogo.png" alt="okay" />
                <img className="block lg:hidden h-14 w-auto  mr-3" src="/cpulogo.png" alt="cpu logo" />
                <h1 className="text-xl  text-gray-600 ">Budget From Departments</h1>
              </div>

              <div className="grid grid-cols-3  gap-4 mt-4">

                <div className="">
                  <label htmlFor="selectDepartment" className="block p">
                    <span className="block  text-xs  text-gray-500 p">Select Department</span>
                    <Field name="selectDepartment" component="select" className="rounded-md  text-xs divide-y divide-dashed text-gray-500 border-gray-300 space -space-y-1 w-full mt-1" required>
                      <option value="">Select Department</option>
                      <option className="text-xs  text-gray-500" value="College of Agriculture">College of Agriculture</option>
                      <option className="text-xs  text-gray-500" value="College of Arts & Sciences">College of Arts & Sciences</option>
                      <option className="text-xs  text-gray-500" value="College of Business & Accountancy">College of Business & Accountancy</option>
                      <option className="text-xs  text-gray-500" value="College of Computer Studies">College of Computer Studies</option>
                      <option className="text-xs  text-gray-500" value="College of Education">College of Education</option>
                      <option className="text-xs  text-gray-500" value="College of Engineering">College of Engineering</option>
                      <option className="text-x text-gray-500" value="College of Hospitality Management">College of Hospitality Management</option>
                      <option className="text-xs  text-gray-500" value="College of Medical Laboratory Science">College of Medical Laboratory Science</option>
                      <option className="text-xs text-gray-500" value="College of Nursing">College of Nursing</option>
                      <option className="text-xs  text-gray-500" value="College of Pharmacy">College of Pharmacy</option>
                      <option className="text-xs  text-gray-500" value="College of Law">College of Law</option>
                      <option className="text-xs text-gray-500" value="College of Medicine">College of Medicine</option>
                      <option className="text-xs text-gray-500" value="College of Theology">College of Theology</option>
                      <option className="text-xs text-gray-500" value="Kinder">Kinder</option>
                      <option className="text-xs text-gray-500" value="Elementary">Elementary</option>
                      <option className="text-xs text-gray-500" value="High School">High School</option>
                      <option className="text-xs text-gray-500" value="Senior High School">Senior High School</option>
                      <option className="text-xs text-gray-500" value="Filipiniana">Filipiniana</option>
                      <option className="text-xs text-gray-500" value="Reference">Reference</option>
                    </Field>
                  </label>

                  {/* <label htmlFor="budget" className="block pb-2">
                    <span className="block text-xs   text-gray-500 ">Number of Enrollees</span>
                    <Field
                        className="text-xs  text-gray-500  placeholder-gray-400 focus:placeholder-gray-500
                        placeholder-opacity-100 rounded-md border-gray-300 w-full shadow-sm  "
                      name="numOfEnrollees"
                      component="input"
                      type="text  "
                      id = "textboxNumOfEnrollees"
                    />
                  </label> */}
                  <label htmlFor="budget" className="block pb-2">
                    <span className="block text-xs   text-gray-500 ">Number of Enrollees</span>
                    <Field
                      className="text-xs  text-gray-500  placeholder-gray-400 focus:placeholder-gray-500
                      placeholder-opacity-100 rounded-md border-gray-300 w-full shadow-sm  "
                      name="numOfEnrollees"
                      component="input"
                      type="number"
                      placeholder="# of Enrolless"
                      id="textboxEnrollees"
                      onChange={handleKeyPressEnrollees}
                      initialValue={txtEnrol}

                    />
                  </label>
                  <label htmlFor="budget" className="block pb-2">
                    <span className="block text-xs   text-gray-500 ">Library Fee</span>
                    <Field
                      className="text-xs  text-gray-500  placeholder-gray-400 focus:placeholder-gray-500
                      placeholder-opacity-100 rounded-md border-gray-300 w-full shadow-sm  "
                      name="libFee"
                      component="input"
                      type="number"
                      placeholder="Library Fee"
                      id="textboxLibFee"
                      onChange={handleKeyPress}
                      initialValue={txtBudget}
                    />
                  </label>

                  <label htmlFor="budget" className="block pb-2">
                    <span className="block text-xs   text-gray-500 ">Budget</span>
                    <Field
                      className="text-xs  text-gray-500  placeholder-gray-400 focus:placeholder-gray-500
                  placeholder-opacity-100 rounded-md border-gray-300 w-full shadow-sm  "
                      name="budget"
                      component="input"
                      type="number"
                      required
                      id="budget"
                      initialValue={total}
                    />
                  </label>
                  <button
                    type="submit"
                    className="  mx-auto text-center  cursor-pointer py-2 px-10 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-secondary hover:bg-indigo-700
                 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
                  >
                    Add
                  </button>
                </div>
                <div className="text-xs shadow-md ">
                  <label htmlFor="Budget" className="block ">
                    <span className="block text-xs text-gray-500 "> Budget</span>
                    <ReactTable data={totalBudget} columns={postBudget} />
                  </label>
                </div>
                <div className="text-xs shadow-md ">
                  <label htmlFor="Remaining" className="block ">
                    <span className="block text-xs text-gray-500 "> Remaining</span>
                    <ReactTable data={totalCost} columns={postCost} />
                  </label>
                </div>
                <div className="col-start-2">
                  <label htmlFor="budget" className="block pb-2">
                    <span className="block text-xs  pt-2 text-gray-500 ">Total Budget</span>
                    <Field
                      className="text-xs  text-gray-500 text-right border-0 placeholder-gray-400 focus:placeholder-gray-500
                  placeholder-opacity-100 rounded-md border-gray-300 w-full shadow-sm  "
                      name="totalbudget"
                      component="input"
                      type="number"
                      required
                      id="idTotalBudget"
                      initialValue={txtTotalAddedBud}
                      disabled
                    />
                  </label>
                </div>

                <div className="col-start-2">

                  <div className="text-xs shadow-md w-auto">
                    <label htmlFor="selectDepartment" className="block ">
                      <span className="block  text-xs  text-gray-500 "> Library Section</span>
                      <ReactTable data={data} columns={cjok} className="w-auto" />
                    </label>
                  </div>
                  <label htmlFor="budget" className="block pb-2">
                    <span className="block text-xs  pt-2 text-gray-500 ">Total Budget</span>
                    <Field
                      className="text-xs  text-gray-500 border-0 text-right   placeholder-gray-400 focus:placeholder-gray-500
                  placeholder-opacity-100 rounded-md border-gray-300 w-full shadow-sm  "
                      name="totaladdedFilRef"
                      component="input"
                      type="number"
                      required
                      id="budget"
                      initialValue={txtTotalAddedRefFil}
                      disabled
                    />
                  </label>
                  <div className="col-end-4">

                    <label htmlFor="budget" className="block pb-2">
                      <span className="block text-xs   pt-2 text-gray-500 "> Total Budget Academic Year</span>
                      <Field
                        className="text-xs text-right w-100  text-gray-500 border-0 shadow-sm  placeholder-gray-400 focus:placeholder-gray-500
                  placeholder-opacity-100 rounded-md border-gray-300 w-full   "
                        name="totalBudAcademicYear"
                        component="input"
                        type="number"
                        required
                        initialValue={overallBudget}
                        disabled
                      />
                    </label>
                  </div>
                </div>
              </div>
            </form>
          )}
        />

      </section>
    </>
  );
}
