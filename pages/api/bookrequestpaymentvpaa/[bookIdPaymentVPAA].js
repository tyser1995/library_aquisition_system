import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookIdPaymentVPAA } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE approvalDirector = 1  AND requestID='${bookIdPaymentVPAA}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
