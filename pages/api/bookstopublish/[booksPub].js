import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { booksPub } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE status = 2 AND requestID='${booksPub}'`);

    return res.json(result);
  } catch (error) {
    // return res.status(500).json({ message: 'Error' });
    console.log(error);
  }
};
