import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      requestID, apporvalVpaaDatePayment, imageURL, vpaaName,
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalVpaaPayment = 1, apporvalVpaaDatePayment=('${apporvalVpaaDatePayment}'), signatureVPAA=('${imageURL}'), vpaaName=('${vpaaName}')   WHERE requestID=('${requestID}')`);

    await mysql.end();
    console.log();

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    return res.status(400).json({ message: 'Error' });
  }
};
