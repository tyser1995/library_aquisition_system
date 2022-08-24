import NextAuth from 'next-auth';
import Providers from 'next-auth/providers';
import mysql from '../../../providers/mysql';

const options = {

  providers: [
    Providers.Credentials({
      name: 'Credentials',
      credentials: {
        username: { label: 'Username', type: 'text' },
        password: { label: 'Password', type: 'password' },
      },
      async authorize(credentials) {
        try {
          const { uname, password } = credentials;

          const [data] = await mysql.query(`SELECT * FROM users WHERE uname ='${uname}' && password ='${password}'`);
          console.log(data);
          const user = { name: uname, email: data.email };

          if (data) {
            return user;
          }
          return null;
        } catch (error) {
          // document.write(message('User not Found'));
          console.log(error);
        }
        return this.authorize;
      },
    }),
  ],
  callbacks: {
    async session(session, user) {
      const [data] = await mysql.query(`SELECT * FROM users WHERE email ='${user.email}'`);

      // eslint-disable-next-line no-param-reassign
      session.account = data;

      return session;
    },
  },
};

export default (req, res) => NextAuth(req, res, options);
