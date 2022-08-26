/* eslint-disable implicit-arrow-linebreak */
/* eslint-disable consistent-return */
/* eslint-disable eqeqeq */
/* eslint-disable no-unused-expressions */
/* eslint-disable radix */
/* eslint-disable operator-linebreak */
/* eslint-disable camelcase */
/* eslint-disable no-restricted-globals */
/* eslint-disable jsx-a11y/anchor-is-valid */
/* eslint-disable react/jsx-wrap-multilines */
/* eslint-disable no-empty */
/* eslint-disable no-shadow */
/* eslint-disable react/jsx-one-expression-per-line */
/* eslint-disable max-len */
/* eslint-disable comma-dangle */
/* eslint-disable object-curly-newline */
/* eslint-disable global-require */
/* eslint-disable quotes */
/* eslint-disable jsx-a11y/heading-has-content */
/* eslint-disable react/jsx-indent */
/* eslint-disable react/self-closing-comp */
/* eslint-disable react/no-this-in-sfc */
/* eslint-disable react/jsx-filename-extension */
/* eslint-disable no-restricted-syntax */
/* eslint-disable no-extend-native */
/* eslint-disable no-unused-vars */
/* eslint-disable indent */

import mysql from "../../../providers/mysql";

export default async (req, res) => {
  try {
    const { selectDepartment } = req.query;

    const [cost] = await mysql.query(
      `SELECT sum(price) as totalCost FROM requestform where selectDepartment="${selectDepartment}" `
    );
    const [budget] = await mysql.query(
      `SELECT sum(budget) as totalBudget FROM add_budget where selectDepartment="${selectDepartment}" and YEAR(dateAdded) = YEAR(CURDATE())`
    );

    const borrowedAccountbudget =
      await mysql.query(`SELECT sum(budget) as budget,selectDepartment FROM add_budget
    WHERE YEAR(dateAdded) = YEAR(CURDATE()) and selectDepartment NOT IN ("Filipiniana","Reference","${selectDepartment}") and  budget >= ( SELECT ((sum(budget) - 
     (SELECT sum(price) FROM requestform WHERE selectDepartment = "${selectDepartment}")) * -1)
     FROM add_budget WHERE selectDepartment = "${selectDepartment}")
    GROUP  BY selectDepartment `);

    const totalBudget = budget.totalBudget || 0;
    const totalCost = cost.totalCost || 0;

    const subtracted = totalBudget - totalCost;
    console.log(
      selectDepartment,
      totalBudget,
      totalCost,
      borrowedAccountbudget
    );

    return res.json({
      subtracted,
      totalBudget,
      totalCost,
      borrowedAccountbudget,
    });
  } catch (error) {
    console.error(error);
    return res.status(400).json({ message: "Error" });
  }
};
