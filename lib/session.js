/* eslint-disable comma-dangle */
/* eslint-disable quotes */
/* eslint-disable no-trailing-spaces */
import { getSession } from "next-auth/client";

export default async ({ req, res }) => {
  const session = await getSession({
    req,
    res,
  });

  if (!session) {
    res.writeHead(302, {
      Location: "/",
    });
    res.end();
  }

  return session;
};
