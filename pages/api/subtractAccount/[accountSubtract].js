import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { selectDepartment } = req.query;

    const [result] = await mysql.query(`INSERT INTO add_budget( budget,selectDepartment, dateAdded, libFee ) VALUES('${budget}','${selectDepartment}')`);

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: 'Error' });
  }
};
