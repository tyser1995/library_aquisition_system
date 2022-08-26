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
import path from "path";
import nextConnect from "next-connect";
import multer from "multer";
import { v4 } from "uuid";

const upload = multer({
  storage: multer.diskStorage({
    destination: "./public/uploads",
    filename: (_req, file, cb) =>
      cb(null, `${v4()}.${file.originalname.split(".").pop()}`),
  }),
});

const apiRoute = nextConnect({
  onError(error, req, res) {
    res
      .status(501)
      .json({ error: `Sorry something Happened! ${error.message}` });
  },
  onNoMatch(req, res) {
    res.status(405).json({ error: `Method '${req.method}' Not Allowed` });
  },
});

apiRoute.use(upload.single("file"));

apiRoute.post((req, res) => {
  if (!req.file) {
    return res.status(404).json({ message: "File payload not found" });
  }

  const { filename } = req.file;

  res.status(200).json({ filePath: `/uploads/${filename}` });
});

export default apiRoute;

export const config = {
  api: {
    bodyParser: false,
  },
};
