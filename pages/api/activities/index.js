import { getSession } from 'next-auth/client';
import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const session = await getSession({ req });
    const activities = await mysql.query(`SELECT * FROM activities where user_id = ${session.account.id} AND is_read = false`);

    await mysql.end();
    return res.status(200).json(activities);
  } catch (error) {
    return console.log(error);
  }
};
