import mysql from '../../providers/mysql';

export default async (_, res) => {
  try {

    const result = await mysql.query('SELECT sum(budget),selectDepartment FROM add_budget WHERE selectDepartment NOT IN ("Filipiniana","Reference") GROUP BY selectDepartment ');


    return res.json(result);
  } catch (error) {
    console.log(error)
  }
};
