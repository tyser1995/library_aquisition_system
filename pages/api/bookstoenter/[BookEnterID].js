import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { BookEnterID } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE approvalFinancePayment = 1 AND approvalDirector = 1 AND approvalVpaaPayment = 1 AND approvalVpaa = 1 AND status = 0  AND requestID='${BookEnterID}'`);

    return res.json(result);
  } catch (error) {
    // return res.status(500).json({ message: 'Error' });
    console.log(error);
  }
};
