import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      requestID, approvalDateDirector, imageURL,directorName, 
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalDirector = 1, approvalDateDirector=('${approvalDateDirector}'), signtureDirector=('${imageURL}'), directorName=('${directorName}')  WHERE requestID=('${requestID}')`);

    await mysql.end();
   

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    console.log(error);
    return res.status(400).json({ message: 'Error' });
  }
};
