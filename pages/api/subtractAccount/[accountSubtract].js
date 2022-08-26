/* eslint-disable react/no-unescaped-entities */
/* eslint-disable implicit-arrow-linebreak */
/* eslint-disable consistent-return */
/* eslint-disable eqeqeq */
/* eslint-disable no-unused-expressions */
/* eslint-disable radix */
/* eslint-disable operator-linebreak */
/* eslint-disable camelcase */
/* eslint-disable no-restricted-globals */
/* eslint-disable jsx-a11y/anchor-is-valid */
/* eslint-disable react/jsx-wrap-multilines */
/* eslint-disable no-empty */
/* eslint-disable no-shadow */
/* eslint-disable react/jsx-one-expression-per-line */
/* eslint-disable max-len */
/* eslint-disable comma-dangle */
/* eslint-disable object-curly-newline */
/* eslint-disable global-require */
/* eslint-disable quotes */
/* eslint-disable jsx-a11y/heading-has-content */
/* eslint-disable react/jsx-indent */
/* eslint-disable react/self-closing-comp */
/* eslint-disable react/no-this-in-sfc */
/* eslint-disable react/jsx-filename-extension */
/* eslint-disable no-restricted-syntax */
/* eslint-disable no-extend-native */
/* eslint-disable no-unused-vars */
/* eslint-disable indent */
import mysql from '../../../providers/mysql';

export default async (req, res) => {
  try {
    const { budget, selectDepartment } = req.query;

    const [result] = await mysql.query(
      `INSERT INTO add_budget( budget,selectDepartment, dateAdded, libFee ) VALUES('${budget}','${selectDepartment}')`,
    );

    return res.json(result);
  } catch (error) {
    return res.status(500).json({
      message: 'Error'
    });
  }
};
