import path from 'path';
import nextConnect from 'next-connect';
import multer from 'multer';
import { v4 } from 'uuid';

const upload = multer({
  storage: multer.diskStorage({
    destination: './public/uploads',
    filename: (_req, file, cb) => cb(null, `${v4()}.${file.originalname.split('.').pop()}`),
  }),
});

const apiRoute = nextConnect({
  onError(error, req, res) {
    res.status(501).json({ error: `Sorry something Happened! ${error.message}` });
  },
  onNoMatch(req, res) {
    res.status(405).json({ error: `Method '${req.method}' Not Allowed` });
  },
});

apiRoute.use(upload.single('file'));

apiRoute.post((req, res) => {
  if (!req.file) {
    return res.status(404).json({ message: 'File payload not found' });
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
