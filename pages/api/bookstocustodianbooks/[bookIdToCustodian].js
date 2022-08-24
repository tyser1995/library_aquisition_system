import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookIdToCustodian } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE verifytocustodian = 0  AND requestID='${bookIdToCustodian}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
