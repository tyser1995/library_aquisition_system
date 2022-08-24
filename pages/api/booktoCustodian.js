import { getSession } from 'next-auth/client';
import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      requestID, sendToCustodianDate,
    } = req.body;

    const session = await getSession({ req });

    await mysql.query(`UPDATE requestform SET verifytocustodian = 1, sendToCustodianDate=('${sendToCustodianDate}') WHERE requestID=('${requestID}')`);

    await mysql.query(`INSERT INTO activities(identifier, user_id) VALUES("books-to-verify", ${session.account.id})`);

    await mysql.end();
    console.log();

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    console.error(error);
    return res.status(400).json({ message: 'Error' });
  }
};
