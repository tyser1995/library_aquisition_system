import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { bookId } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE status = 0 AND requestID='${bookId}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
