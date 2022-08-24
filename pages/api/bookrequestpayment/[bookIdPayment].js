import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookIdPayment } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE sendtoDirector = 1  AND requestID='${bookIdPayment}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
