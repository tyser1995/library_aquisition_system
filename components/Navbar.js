import Image from 'next/image';

const Navbar = () => (

  <nav className="sidenav">
    <div className="cpulogo">
      <Image src="/cpulogo.png" width={50} height={50} />
    </div>

  </nav>

);

export default Navbar;
