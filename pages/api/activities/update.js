import { getSession } from 'next-auth/client';
import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const session = await getSession({ req });
    const {
      identifier,
    } = req.body;

    await mysql.query(`UPDATE activities set is_read = 1 where user_id = ${session.account.id} AND identifier = '${identifier}'`);

    await mysql.end();
    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    return console.log(error);
  }
};
