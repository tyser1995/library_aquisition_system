import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { selectDepartment } = req.query;

    const [cost] = await mysql.query(`SELECT sum(price) as totalCost FROM requestform where selectDepartment="${selectDepartment}" `);
    const [budget] = await mysql.query(`SELECT sum(budget) as totalBudget FROM add_budget where selectDepartment="${selectDepartment}" and YEAR(dateAdded) = YEAR(CURDATE())`); 
  
  
    const borrowedAccountbudget = await mysql.query(`SELECT sum(budget) as budget,selectDepartment FROM add_budget
    WHERE YEAR(dateAdded) = YEAR(CURDATE()) and selectDepartment NOT IN ("Filipiniana","Reference","${selectDepartment}") and  budget >= ( SELECT ((sum(budget) - 
     (SELECT sum(price) FROM requestform WHERE selectDepartment = "${selectDepartment}")) * -1)
     FROM add_budget WHERE selectDepartment = "${selectDepartment}")
    GROUP  BY selectDepartment `);


    const totalBudget = budget.totalBudget || 0;
    const totalCost = cost.totalCost || 0;


    const subtracted =  totalBudget - totalCost   ;
    console.log(selectDepartment, totalBudget, totalCost, borrowedAccountbudget );


    return res.json({
      subtracted,
      totalBudget,
      totalCost,
      borrowedAccountbudget,      
    });
  } catch (error) {
    console.error(error);
    return res.status(400).json({ message: 'Error' });
  }
};
