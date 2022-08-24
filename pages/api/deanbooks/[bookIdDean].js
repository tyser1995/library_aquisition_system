import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookIdDean } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE approvalDean = 0  AND requestID='${bookIdDean}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
