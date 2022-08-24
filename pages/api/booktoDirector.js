import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      requestID, sendDatetoDirector, imageURL,acquisitionName
    } = req.body;

    await mysql.query(`UPDATE requestform SET  sendtoDirector = 1 , sendDatetoDirector=('${sendDatetoDirector}'), signatureAcquisition=('${imageURL}'), acquisitionName=('${acquisitionName}')   WHERE requestID=('${requestID}')`);

    await mysql.end();

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    // return res.status(400).json({ message: 'Error' });
    console.log(error);
  }
};
