import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:3000',
});

export const fetcher = (url) => axiosInstance.get(url).then((res) => res.data);

export default axiosInstance;
