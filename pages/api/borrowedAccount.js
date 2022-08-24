

import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const { selectDepartment } = req.query;


    const result = await mysql.query(`SELECT sum(budget),selectDepartment FROM add_budget
    WHERE selectDepartment NOT IN ("Filipiniana","Reference") and  budget >= ( SELECT ((sum(budget) - 
     (SELECT sum(price) FROM requestform WHERE selectDepartment = "${selectDepartment}")) * -1)
     FROM add_budget WHERE selectDepartment = "${selectDepartment}")
    GROUP  BY selectDepartment 
    `);


    return res.json(result);
  } catch (error) {
    console.log(error)
  }
};
