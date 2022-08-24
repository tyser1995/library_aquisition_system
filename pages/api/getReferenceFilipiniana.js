import mysql from '../../providers/mysql';

export default async (_, res) => {
  try {
    const result = await mysql.query('SELECT selectDepartment, sum(budget) as budget FROM add_budget WHERE selectDepartment IN  ("Reference","Filipiniana") group by selectDepartment');

    return res.json(result);
  } catch (error) {
    return res.status(400).json({ message: 'Error' });
  }
};
