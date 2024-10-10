'use client'
import Image from 'next/image'
import { useState } from 'react'

export default function InputImageBase64({ onImageChange }) {
    const [previewUrl, setPreviewUrl] = useState('')

    const handleFileChange = e => {
        const file = e.target.files[0]
        if (file) {
            const reader = new FileReader()

            reader.onload = e => {
                const img = new window.Image()
                img.src = e.target.result

                img.onload = () => {
                    const canvas = document.createElement('canvas')
                    const ctx = canvas.getContext('2d')
                    const MAX_WIDTH = 800
                    const MAX_HEIGHT = 600
                    let width = img.width
                    let height = img.height

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width
                            width = MAX_WIDTH
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height
                            height = MAX_HEIGHT
                        }
                    }

                    canvas.width = width
                    canvas.height = height
                    ctx.drawImage(img, 0, 0, width, height)
                    const base64String = canvas.toDataURL('image/jpeg', 0.7)
                    setPreviewUrl(base64String)
                    onImageChange(base64String)
                }
            }

            reader.readAsDataURL(file)
        }
    }

    return (
        <div className="col-12 d-flex flex-column">
            <hr />
            <label htmlFor="formFile" className="form-label m-0 p-0 fs-6">
                Foto:
            </label>
            <input className="form-control mx-2 form-control-sm mb-4" type="file" accept="image/*" onChange={handleFileChange} />

            {previewUrl && (
                <>
                    <div className="col-12 align-items-center mt-3">
                        <label htmlFor="formFile" className="form-label m-0 p-0 fs-6">
                            Pré-visualização da imagem:
                        </label>
                    </div>
                    <Image className="mx-2 border border-white border-4 object-fit-cover rounded" src={previewUrl} alt="Preview" width={200} height={200} />
                </>
            )}
            <hr />
        </div>
    )
}
