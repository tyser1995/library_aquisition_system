import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
        verified,verifiedDate, enumtitle, requestID
    } = req.body;

    await mysql.query(`UPDATE requestform SET verified=('${verified}'), verifiedDate=('${verifiedDate}'), enumtitle=('${enumtitle}') WHERE requestID=('${requestID}')`);
   
    await mysql.end();
    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {

    return res.status(400).json({ message: 'Error' });

  }
};
