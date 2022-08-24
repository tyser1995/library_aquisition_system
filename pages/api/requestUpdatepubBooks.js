import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
        subject,copvol, userID, requestee, status, notereqform, chargeto, date, requestID, selectDepartment, selectPosition
    } = req.body;

    await mysql.query(`UPDATE requestform SET subject=('${subject}'), copvol=('${copvol}'), userID=('${userID}'), requestee=('${requestee}'), status=('${status}'), 
    notereqform=('${notereqform}'), chargeto=('${chargeto}'), date=('${date}'), selectDepartment=('${selectDepartment}'), selectPosition=('${selectPosition}')  WHERE requestID=('${requestID}')`);
   
    await mysql.end();
    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {

    return res.status(400).json({ message: 'Error' });

  }
};
