/* eslint-disable consistent-return */
/* eslint-disable comma-dangle */
/* eslint-disable object-curly-newline */
/* eslint-disable quotes */
import mysql from "../../../providers/mysql";

export default async (req, res) => {
  try {
    const { bookIdTrack } = req.query;

    const [result] = await mysql.query(
      `SELECT * FROM requestform WHERE requestID='${bookIdTrack}'`
    );

    return res.json(result);
  } catch (error) {
    return res.status(500).json({ message: "Error" });
  }
};
