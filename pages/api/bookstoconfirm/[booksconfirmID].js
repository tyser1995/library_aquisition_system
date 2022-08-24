import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { booksconfirmID } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE status = 1  AND requestID='${booksconfirmID}'`);

    return res.json(result);
  } catch (error) {
    // return res.status(500).json({ message: 'Error' });
    console.log(error);
  }
};
