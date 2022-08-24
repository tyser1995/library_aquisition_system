import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { booksIdtoVerify } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE verifytocustodian = 1  AND requestID='${booksIdtoVerify}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
