
import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { requestbookID} = req.query;

    const [ result ]  = await mysql.query(` SELECT * FROM requestform WHERE 
    savePub = 1 AND status = 4   AND requestID='${requestbookID}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
