/* eslint-disable consistent-return */
/* eslint-disable comma-dangle */
/* eslint-disable object-curly-newline */
/* eslint-disable quotes */
import mysql from "../../../providers/mysql";

export default async function (req, res) {
  try {
    const { budget, remarks, selectDepartment, previousBudget } = req.body;

    // await mysql.query(`INSERT INTO add_budget
    // (budget,selectDepartment,dateAdded,Remarks)
    // VALUES
    // ('${budget}','${selectDepartment}',CURDATE(),'${remarks}')`);
    await mysql.query(`UPDATE add_budget 
    SET budget = '${budget}', remarks = '${remarks}' 
    WHERE selectDepartment = '${selectDepartment}' and budget = '${previousBudget}' and YEAR(dateAdded) = YEAR(curdate())`);

    await mysql.end();

    res.status(200).json({ message: "Succesfully Created" });
    console.log();
  } catch (error) {
    res.status(400).json({ message: "Error" });
    console.log(error);
  }
}
