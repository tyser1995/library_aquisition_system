import mysql from '../../providers/mysql';

export default async function (req, res) {
  try {
    const {
      date, rushornrush, authorName, title, edition, copvol, pubdate, pubName,
      pubAddress, chargeto, subject, enumtitle,
      notereqform, dealer, price, dated, sinumb, addedAs, userID,
      requestee, selectDepartment, selectPosition,
    } = req.body;

    await mysql.query(`INSERT INTO requestform( date, rushornrush, authorName, title, edition, copvol,
       pubdate, pubName, pubAddress, chargeto, subject, enumtitle, notereqform, dealer, 
       price, dated, sinumb, addedAs, requestee, selectPosition, selectDepartment, userID) VALUES('${date}','${rushornrush}',
         '${authorName}','${title}','${edition}','${copvol}','${pubdate}','${pubName}','${pubAddress}','${chargeto}','${subject}' ,'${enumtitle}' ,'${notereqform}','${dealer}',
         '${price}','${dated}','${sinumb}','${addedAs}', '${requestee}' , '${selectPosition}', '${selectDepartment}','${userID}')`);

    await mysql.end();

    res.status(200).json({ message: 'Succesfully Created' });
    console.log();
  } catch (error) {
    res.status(400).json({ message: 'Error' });
    console.log(error);
  }
}
