import mysql from '../../providers/mysql';

export default async (req, res) => {
  try {
    const {
      approvalFinanceDate, requestID, approvalFinance, price,
    } = req.body;

    await mysql.query(`UPDATE requestform SET approvalFinance=('${approvalFinance}'), approvalFinanceDate=('${approvalFinanceDate}') WHERE requestID=('${requestID}')`);

    if (price >= 50000) {
      // sent to president
      await mysql.query(`UPDATE requestform SET statusPass= 1 WHERE requestID=('${requestID}')`);
    }

    await mysql.end();
    console.log();

    return res.status(200).json({ message: 'Succesfully Updated' });
  } catch (error) {
    return res.status(400).json({ message: 'Error' });
  }
};
