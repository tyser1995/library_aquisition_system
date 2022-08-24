import mysql from '../../providers/mysql';
import validateSession from '../../lib/session';

export default async (req, res) => {
  try {
    const { account } = await validateSession({ req, res });

    const result = await mysql.query(`SELECT * FROM requestform WHERE approvalDean = 0 AND
    selectDepartment = ('${account.selectDepartment}') `);

    return res.json(result);
  } catch (error) {
    return res.status(400).json({ message: 'Error' });
  }
};
