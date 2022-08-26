/* eslint-disable react/jsx-props-no-spreading */
/* eslint-disable react/jsx-filename-extension */
import 'tailwindcss/tailwind.css';
import { Provider } from 'next-auth/client';
import { ToastContainer } from 'react-toastify';
import { SWRConfig } from 'swr';
import { fetcher } from '../lib/api';
import '../styles/globals.css';
import Layout from '../components/Layout';

function MyApp({ Component, pageProps }) {
  return (
    <Provider session={pageProps.session}>
      <SWRConfig
        value={{
          refreshInterval: 60000,
          fetcher,
        }}
      >
        <Layout />
        <Component {...pageProps} />
        <ToastContainer />
      </SWRConfig>
    </Provider>
  );
}

export default MyApp;
