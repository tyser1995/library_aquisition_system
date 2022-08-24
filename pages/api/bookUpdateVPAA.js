import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      approvalDateVPAA, requestID, approvalVpaa, 
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalVpaa=('${approvalVpaa}'), approvalDateVPAA=('${approvalDateVPAA}')  WHERE requestID=('${requestID}')`);

    await mysql.end();
    console.log();
    return res.status(200).json();
  } catch (error) {
    console.log(error);

    return res.status(400).json({ message: 'Error' });
  }
};
