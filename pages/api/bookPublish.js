/* eslint-disable consistent-return */
/* eslint-disable comma-dangle */
/* eslint-disable object-curly-newline */
/* eslint-disable quotes */
import mysql from "../../providers/mysql";

export default async (req, res) => {
  try {
    const { updateDate, requestID, status } = req.body;

    await mysql.query(
      `UPDATE requestform SET status=('${status}'), updateDate=('${updateDate}')  WHERE requestID=('${requestID}')`
    );
    console.log();

    await mysql.end();
    return res.status(200).json({ message: "Succesfully Updated" });
  } catch (error) {
    console.log(error);
  }
};
