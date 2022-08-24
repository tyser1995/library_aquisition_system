import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookIdPresident } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE approvalFinance = 1 AND statusPass = 1  AND requestID='${bookIdPresident}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
