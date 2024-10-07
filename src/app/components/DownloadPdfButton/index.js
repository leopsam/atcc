"use client"

export default function DownloadPdfButton({ userId }) {
    const downloadPdf = async () => {
        console.log(userId)
        const response = await fetch(`/api/user-pdf?userId=${userId}`);
        const blob = await response.blob();
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = `user_${userId}.pdf`;
        link.click();
    };

    return <button onClick={() => downloadPdf()}>Download PDF</button>;
}
