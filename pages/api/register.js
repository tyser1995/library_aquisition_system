import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      uname, fname, mname, lname, password, email,
      pnumber, selectDepartment, selectPosition,
    } = req.body;

    await mysql.query(`INSERT INTO users(uname, fname, mname, lname, password, email, pnumber, selectDepartment, selectPosition) VALUES('${uname}','${fname}', '${mname}', '${lname}', '${password}', '${email}', '${pnumber}', '${selectDepartment}','${selectPosition}')`);

    await mysql.end();

    res.status(200).json({ message: 'Succesfully Created' });
  } catch (error) {
    console.log(error);
    res.status(400).json({ message: 'Error' });
  }
};
