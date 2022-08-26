import mysql from '../../providers/mysql';

export default async function (req, res) {
  try {
    const { budget, selectDepartment, dateAdded, libFee } = req.body;

    await mysql.query(
      `INSERT INTO add_budget( budget,selectDepartment, dateAdded, libFee ) VALUES('${budget}','${selectDepartment}','${dateAdded}','${libFee}')`,
    );

    await mysql.end();

    // eslint-disable-next-line object-curly-newline
    res.status(200).json({ message: 'Succesfully Created' });
    console.log();
  } catch (error) {
    // eslint-disable-next-line quotes
    res.status(400).json({
      message: 'Error',
    });
    console.log(error);
  }
}
