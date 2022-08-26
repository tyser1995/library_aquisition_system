import { Fragment, useEffect, useState } from "react";
import { Field, Form } from "react-final-form";
import api from "../lib/api";
import ReactTable from "../components/table";
import React, { useMemo } from "react";
import axios from "axios";

const BudgetForm = ({ selectDepartment }) => {
  const [isModalOpen, setIsModelOpen] = useState(false);
  const [data, setData] = useState({});

  const [showDept, setShowDept] = useState(false);
  const [currDept, setCurrDept] = useState(selectDepartment);

  const toggleDept = () => {
    showDept ? setShowDept(false) : setShowDept(true);
  };
  // Fetching of data
  const [dataAccounts, setDataAccounts] = useState({});
  const fetchData = async () => {
    try {
      // Query to database
      const { data: result } = await api.get(
        `/api/subtract/${selectDepartment}`
      );

      // debugger;
      //console.log(result);
      const post = JSON.parse(JSON.stringify(result.borrowedAccountbudget));

      setDataAccounts(post);
      //   Object.keys(result.borrowedAccountbudget).map(function(index){
      //     setDataAccounts(result.borrowedAccountbudget[index].selectDepartment);
      // })
      setData(result);
    } catch (error) {
      console.error(error);
    }
  };

  const handleSelectBudget = async (values) => {
    const { budget, selectDepartment } = values;
    const deduct_budget =
      parseInt(document.getElementById("totalSubtracted").value) +
      values.budget;
    const budget_subtracted = document
      .getElementById("totalSubtracted")
      .value.replace("-", "");
    const updateBudget = await axios.post(
      "/api/borrowedbudget/updateDepartmentBudget",
      {
        budget: deduct_budget,
        selectDepartment: values.selectDepartment,
        previousBudget: values.budget,
      }
    );

    const insertBudget = await axios.post(
      "/api/borrowedbudget/insertDepartment",
      {
        budget:
          parseInt(budget_subtracted) +
          parseInt(document.getElementById("totalBudget").value),
        remarks:
          "Borrowed from " +
          values.selectDepartment +
          " amounting of " +
          budget_subtracted,
        selectDepartment: currDept,
        previousBudget: parseInt(document.getElementById("totalBudget").value),
      }
    );

    //console.log([updateBudget, insertBudget]);

    //console.log(deduct_budget,parseInt(document.getElementById('totalBudget').value),);
    //console.table(values);
    //console.log(data.totalBudget + "  " + data.totalCost + " = " + (data.totalBudget - data.subtracted.toString().replace('-', '')));
    //console.log(data.subtracted + " + " + values.budget + " = " + (data.subtracted + values.budget));
  };
  // Trigger fetch on first load
  useEffect(() => {
    fetchData();
  }, []);

  const borrowAccounts = useMemo(
    () => [
      {
        Header: "Department",
        accessor: "selectDepartment", // accessor is the "key" in the data
      },
      {
        Header: "Budget",
        accessor: "budget", // accessor is the "key" in the data
      },
      {
        Header: () => "Action",
        accessor: "action",
        Cell: ({ row: { values } }) => (
          <button
            type="submit"
            className="mx-auto mt-3  text-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            onClick={() => handleSelectBudget(values)}
          >
            Select
            {/* {data.subtracted} */}
          </button>
        ),
      },
    ],
    []
  );

  // Handle form submission
  const handleOnSubmit = async () => {
    const { data: result } = await api.post("/api/saveBudget", {
      subtracted: data.subtracted,
      selectDepartment,
    });

    alert(result.message); // eslint-disable-line no-alert
  };

  // Form
  const renderForm = (
    <Form
      onSubmit={handleOnSubmit}
      render={({ handleSubmit }) => (
        <form onSubmit={handleSubmit}>
          <div className="justify-end items-center flex overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none">
            <div className=" my-6 mx-auto w-auto">
              {/* content */}
              <div className="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                {/* header */}
                <div className="flex items-start justify-between p-6 border-b border-solid border-blueGray-200 rounded-t">
                  <h3 className="text-sm text-gray-500">Update Total Cost</h3>
                </div>
                {/* body */}
                <section className=" mx-auto  md:flex bg-base min-h-full  ">
                  <form
                    onSubmit={handleSubmit}
                    className="p-12 bg-white rounded-md my-16 w- mx-auto  w-full shadow-sm min-h-full  "
                  >
                    <div className="grid grid-cols-3 gap-2">
                      <label htmlFor="selectDepartment" className="block p">
                        <span className="block  text-xs  text-gray-500 p">
                          Total Budget
                        </span>
                        <Field
                          className="text-xs mt-2 w-auto text-gray-500  placeholder-gray-400 focus:placeholder-gray-500
              placeholder-opacity-100 rounded-md border-gray-300   shadow-lg   "
                          name="totalBudget"
                          id="totalBudget"
                          component="input"
                          type="number"
                          placeholder="₱"
                          disabled
                          initialValue={data.totalBudget || 0}
                        />
                      </label>
                      <label htmlFor="selectDepartment" className="block p">
                        <span className="block  text-xs  text-gray-500 p">
                          Total Cost
                        </span>
                        <Field
                          className="text-xs mt-2 w-auto text-gray-500  placeholder-gray-400 focus:placeholder-gray-500
              placeholder-opacity-100 rounded-md border-gray-300   shadow-lg   "
                          name="totalCost"
                          id="totalCost"
                          component="input"
                          type="number"
                          placeholder="₱"
                          disabled
                          initialValue={data.totalCost || 0}
                        />
                        <span className="  text-2xl  text-gray-500 p">=</span>
                      </label>

                      <label htmlFor="selectDepartment" className="block p">
                        <span className="block  text-   text-gray-500 p">
                          Remaining Budget
                        </span>
                        <Field
                          className="text-sm mt-2 w-auto text-gray-500  font-semibold  border-0
               rounded-md bg-gray-100"
                          id="totalSubtracted"
                          name="totalSubtracted"
                          component="input"
                          type="number"
                          placeholder="₱"
                          disabled
                          initialValue={data.subtracted || 0}
                        />
                      </label>
                    </div>
                    {data.subtracted < 1 || data.subtracted == 0 ? (
                      <>
                        <div className="">
                          <button
                            className="bg-secondary float-right items-end mt-4 w-auto text-white text-xs active:bg-emerald-600
                         px-6 py-3 rounded shadow-md "
                            type="button"
                            onClick={toggleDept}
                            style={{
                              display: data.subtracted < 1 ? "none" : "",
                            }}
                          >
                            <div className="text-xs shadow-md w-auto">
                              <label
                                htmlFor="selectDepartment"
                                className="block "
                              >
                                <span className="block  text-xs  text-gray-500 ">
                                  {showDept ? "Hide" : "Show"}
                                </span>
                              </label>
                            </div>
                          </button>
                        </div>
                      </>
                    ) : (
                      <></>
                    )}

                    <div
                      style={{
                        display: showDept ? "block" : "none",
                      }}
                    >
                      <ReactTable
                        data={dataAccounts}
                        columns={borrowAccounts}
                        className="w-auto"
                      />
                    </div>
                    {/* <ReactTable data={time} columns={dateAdded} /> */}
                  </form>
                </section>
                {/* footer */}
                <div className="flex items-center justify-end p-2 border-t border-solid border-blueGray-200 rounded-b">
                  <button
                    className="bg-secondary text-white text-xs active:bg-emerald-600
                         px-6 py-3 rounded shadow-md "
                    type="button"
                    onClick={() => setIsModelOpen(false)}
                  >
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div className="opacity-25 fixed inset-0 z-40 bg-black" />
        </form>
      )}
    />
  );

  return (
    <>
      {isModalOpen && renderForm}
      <button
        className=" bg-secondary text-white  text-xs p-1 px-6 rounded"
        type="button"
        onClick={() => setIsModelOpen(true)}
      >
        View Summary
      </button>
    </>
  );
};

export default BudgetForm;
