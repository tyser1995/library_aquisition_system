import mysql from '../../providers/mysql';

export default async (req, res) => {
    try {
        const {
            uname, password, email,
            pnumber, pubName, pubAddress, selectPosition
        } = req.body;

        await mysql.query(`INSERT INTO users(uname, password, email, pnumber, pubName, pubAddress, selectPosition) VALUES('${uname}', '${password}', '${email}', '${pnumber}', '${pubName}','${pubAddress}','${selectPosition}')`);

        await mysql.end();

        res.status(200).json({ message: 'Succesfully Created' });
    } catch (error) {
        console.log(error)
        res.status(400).json({ message: 'Error' });
    }
};
