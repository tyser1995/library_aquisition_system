import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookIdFinance } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE approvalDean = 1 AND approvalVpaa = 0  AND requestID='${bookIdFinance}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
