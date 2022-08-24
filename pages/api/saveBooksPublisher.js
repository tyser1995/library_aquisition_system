import mysql from '../../providers/mysql';

export default async function (req, res) {
  try {
    const {
        saveDate,  authorName, title, edition, copvol, pubdate, pubName,  pubAddress, savePub, pubID,
    } = req.body;

    await mysql.query(`INSERT INTO requestform(saveDate, authorName, title ,edition, copvol, pubdate, pubName , pubAddress, savePub, pubID  )
     VALUES('${saveDate}', '${authorName}','${title}','${edition}','${copvol}','${pubdate}','${pubName}','${pubAddress}','${savePub}','${pubID}')`);

    await mysql.end();

    res.status(200).json({ message: 'Succesfully Created' });
    console.log();
  } catch (error) {
    res.status(400).json({ message: 'Error' });
    console.log(error);
  }
}
