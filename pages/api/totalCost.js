import mysql from '../../providers/mysql';

export default async (_, res) => {
  try {
    const result = await mysql.query('SELECT sum(price), selectDepartment FROM requestform GROUP BY selectDepartment');
    
    const result1 = await mysql.query('SELECT selectDepartment FROM add_budget WHERE selectDepartment IN("Filipiniana","Reference")');

    return res.json(result);
    return res.json(result1);
  } catch (error) {
    console.log(error)
  }
};
