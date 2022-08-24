

import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { requestedDetailsID } = req.query;

    const [result] = await mysql.query(`SELECT * FROM requestform WHERE status= 5 AND requestID='${requestedDetailsID}'`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
