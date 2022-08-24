import serverlessMysql from 'serverless-mysql';

const {
    DATABASE_HOST,
    DATABASE_USERNAME,
    DATABASE_PASSWORD,
    DATABASE_NAME,
} = process.env;

export default serverlessMysql({
    config: {
        host: DATABASE_HOST,
        database: DATABASE_NAME,
        user: DATABASE_USERNAME,
        password: DATABASE_PASSWORD,
    }
})