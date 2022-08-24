import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      approvalDateDean, requestID, approvalDean, imageURL, deanName, 
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalDean=('${approvalDean}'), approvalDateDean=('${approvalDateDean}'), signatureDean=('${imageURL}'), deanName = ('${deanName}') WHERE requestID=('${requestID}')`);

    await mysql.end();
    console.log();

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    console.log(error);
  }
};
