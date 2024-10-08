'use client';
import { useState } from 'react';

export default function InputImageBase64() {
    const [imageBase64, setImageBase64] = useState('');

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onloadend = () => {
                setImageBase64(reader.result);
            };
            reader.readAsDataURL(file);
        }
    };
    return (
        <>
            <div className="col-12 align-items-center">
                <hr />
                <label htmlFor="formFile" className="form-label m-0 p-0 fs-6">
                    Foto:
                </label>
                <input className="form-control mx-2 form-control-sm mb-4" type="file" accept="image/*" onChange={handleFileChange} />

                {imageBase64 && (
                    <div className="col-12 align-items-center">
                        <label className="form-label m-0 p-0 fs-6">Foto em base64:</label>

                        <textarea defaultValue={imageBase64} className="form-control mx-2 form-control-sm" rows="5" id="photo" name="photo"></textarea>
                    </div>
                )}
                <hr />
            </div>
        </>
    );
}
