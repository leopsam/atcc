import { PDFDocument, StandardFonts, rgb } from 'pdf-lib';
import db from '@/utils/db'; // assumindo que você já configurou o prisma

export default async function handler(req, res) {
    console.log("passou aqui 1")
    const { userId } = req.query;


    // Consulta o usuário no banco de dados
    const user = await db.user.findUnique({
        where: {
            id: parseInt(1),
        },
    });

    console.log(user)

    if (!user) {
        return res.status(404).json({ error: 'Usuário não encontrado' });
    }

    // Cria um novo documento PDF
    const pdfDoc = await PDFDocument.create();
    const page = pdfDoc.addPage([600, 400]);

    // Configurações do PDF (fonte e cores)
    const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRoman);
    page.setFont(timesRomanFont);
    page.setFontSize(12);
    page.drawText('Informações do Usuário:', { x: 50, y: 350, size: 18, color: rgb(0, 0, 0) });

    // Preenche as informações do usuário no PDF
    page.drawText(`ID: ${user.id}`, { x: 50, y: 320 });
    page.drawText(`Nome: ${user.name}`, { x: 50, y: 300 });
    page.drawText(`Email: ${user.email}`, { x: 50, y: 280 });
    // Adicione mais informações conforme necessário

    // Gera o buffer do PDF
    const pdfBytes = await pdfDoc.save();

    // Define o tipo de resposta para abrir no navegador
    res.setHeader('Content-Type', 'application/pdf');
    res.setHeader('Content-Disposition', 'inline; filename=user_profile.pdf');
    res.send(pdfBytes);
}
