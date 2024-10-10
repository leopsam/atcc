import { PrismaClient } from '@prisma/client'
import bcrypt from 'bcrypt'
const prisma = new PrismaClient()

async function main() {
    const joao = await prisma.user.upsert({
        where: { username: 'joaosilva' },
        update: {},
        create: {
            matriculation: '20230001',
            name: 'João Silva',
            role: 'STUDENT',
            status: 'ACTIVE',
            birthDate: new Date('2000-01-15'),
            cpf: '12345678901',
            rg: '12345678',
            address: 'Rua A, 123',
            phone: '1122334455',
            email: 'joao.silva@example.com',
            username: 'joaosilva',
            password: await bcrypt.hash('password456', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728531466/atcc/s9x1zveq4zaepmvr6x1t.jpg',
        },
    })
    const maria = await prisma.user.upsert({
        where: { username: 'mariasouza' },
        update: {},
        create: {
            matriculation: '20230002',
            name: 'Maria Souza',
            role: 'TEACHER',
            status: 'ACTIVE',
            birthDate: new Date('1985-05-25'),
            cpf: '98765432100',
            rg: '87654321',
            address: 'Rua B, 456',
            phone: '11999887766',
            email: 'maria.souza@example.com',
            username: 'mariasouza',
            password: await bcrypt.hash('password456', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728531466/atcc/s9x1zveq4zaepmvr6x1t.jpg',
        },
    })
    const admin = await prisma.user.upsert({
        where: { username: 'admin' },
        update: {},
        create: {
            matriculation: '20230003',
            name: 'Leonardo Sampaio',
            role: 'ADMIN',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233344',
            rg: '11223344',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'leonardo.sampaio@example.com',
            username: 'admin',
            password: await bcrypt.hash('admin123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728531466/atcc/s9x1zveq4zaepmvr6x1t.jpg',
        },
    })
    const themeOne = await prisma.theme.upsert({
        where: { name: 'A Transformação Digital nas Microempresas: Desafios e Oportunidades no Brasil' },
        update: {},
        create: {
            name: 'A Transformação Digital nas Microempresas: Desafios e Oportunidades no Brasil',
            description:
                'Este trabalho tem como objetivo investigar os impactos da transformação digital nas microempresas brasileiras, analisando como a adoção de novas tecnologias pode influenciar a competitividade, produtividade e inovação desses pequenos negócios. A pesquisa buscará identificar os principais desafios enfrentados por microempresários para implementar soluções digitais, como e-commerce, marketing digital e ferramentas de gestão, além de explorar as oportunidades que a digitalização pode trazer para a expansão e sustentabilidade dessas empresas em um mercado cada vez mais digital e conectado.',
        },
    })
    const themeTwo = await prisma.theme.upsert({
        where: { name: 'Sustentabilidade e Inovação: O Uso de Materiais Recicláveis na Indústria da Construção Civil' },
        update: {},
        create: {
            name: 'Sustentabilidade e Inovação: O Uso de Materiais Recicláveis na Indústria da Construção Civil',
            description:
                'Este trabalho visa explorar o papel dos materiais recicláveis na inovação e sustentabilidade da construção civil, um dos setores que mais impactam o meio ambiente. O estudo tem como objetivo analisar os benefícios e desafios da adoção de materiais recicláveis na construção de edifícios, investigando seu impacto em termos de redução de resíduos, eficiência energética e custo-benefício para empresas e consumidores.',
        },
    })
    // eslint-disable-next-line
    console.log('seed completed successfully!')
    // eslint-disable-next-line
    console.log({ joao, maria, admin, themeOne, themeTwo })
}
main()
    .then(async () => {
        await prisma.$disconnect()
    })
    .catch(async e => {
        // eslint-disable-next-line
        console.error(e)
        await prisma.$disconnect()
        process.exit(1)
    })
