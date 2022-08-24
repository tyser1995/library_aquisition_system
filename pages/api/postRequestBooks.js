import mysql from '../../providers/mysql';

export default async (_, res) => {
  try {
    const result = await mysql.query('SELECT * FROM requestform WHERE approvalVpaa = 1 AND approvalDean = 1 AND approvalAcqui = 0 ');

    return res.json(result);
  } catch (error) {
    return res.status(400).json({ message: 'Error' });
  }
};
