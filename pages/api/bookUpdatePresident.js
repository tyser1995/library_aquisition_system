import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      approvalPresident, requestID, approvalDatePresident,
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalPresident=('${approvalPresident}'), approvalDatePresident=('${approvalDatePresident}') WHERE requestID=('${requestID}')`);

    await mysql.end();

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    return res.status(400).json({ message: 'Error' });
  }
};
