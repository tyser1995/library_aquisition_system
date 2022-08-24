import Popup from 'reactjs-popup';
import { useRef, useState } from 'react';
import SignaturePad from 'react-signature-canvas';

export default function SingnatureTest() {
  const [imageURL, setImageURL] = useState(null);
  const sigCanvas = useRef({});
  const clear = () => sigCanvas.current.clear();

  const save = () => setImageURL(sigCanvas.current.getTrimmedCanvas().toDataURL('image/png'));

  return (
    <>
      <section className="max-w-screen  from-blue-900 to-yellow-600 bg-gradient-to-br  min-h-screen mx-auto ">

        {imageURL ? (
          <img
            name="signatureImage"
            src={imageURL}
            alt="signature"
            style={{
              display: 'block',
              margin: '0 auto',
              border: '1px solid black',
              width: '150px',
              backgroundColor: 'white',
            }}
          />
        ) : save}
        <Popup
          modal
          trigger={(
            <button
              className=" mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              a
              type="button"
            >
              {' '}
              Sign Here
            </button>
          )}
          closeOnDocumentClick={false}
        >
          {(close) => (
            <>
              <SignaturePad ref={sigCanvas} canvasProps={{ className: 'signatureCanvas' }} />
              <div className="space-x-2  justify-items-center ">
                <button
                  className="mx-auto mt-3 pr-4 text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
               text-white bg-indigo-600 hover:bg-indigo-700
              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  type="button"
                  onClick={clear}
                >
                  clear
                </button>
                <button
                  className=" mx-auto mt-3 pr-2  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  type="button"
                  onClick={close}
                >
                  Close
                </button>
                <button
                  className=" mx-auto mt-3  text-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md
                text-white bg-indigo-600 hover:bg-indigo-700
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  type="button"
                  onClick={save}
                >
                  Save
                </button>
              </div>
            </>
          )}
        </Popup>
      </section>
    </>
  );
}
