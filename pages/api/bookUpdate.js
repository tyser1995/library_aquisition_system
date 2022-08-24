import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      entryDate, requestID, status, price,
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalAcqui=('${status}'), entryDate=('${entryDate}'), price=('${price}')  WHERE requestID=('${requestID}')`);
    console.log();

    await mysql.end();
    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    console.log(error);
  }
};
