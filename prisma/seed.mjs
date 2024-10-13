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
    const adminDefault = await prisma.user.upsert({
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
    const studentDefault = await prisma.user.upsert({
        where: { username: 'aluno' },
        update: {},
        create: {
            matriculation: '20230004',
            name: 'Leonardo P. Sampaio',
            role: 'STUDENT',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233355',
            rg: '11223355',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'leonardo.aluno@example.com',
            username: 'aluno',
            password: await bcrypt.hash('aluno123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728583169/atcc/z5fggmmbzflbuwwvwkho.webp',
        },
    })
    const teacherDefault = await prisma.user.upsert({
        where: { username: 'professor' },
        update: {},
        create: {
            matriculation: '20230005',
            name: 'Leonardo P. Sampaio',
            role: 'TEACHER',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233366',
            rg: '11223366',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'leonardo.professor@example.com',
            username: 'professor',
            password: await bcrypt.hash('professor123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728583797/atcc/qchfsbjlzdrajs77l7cm.jpg',
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
    const libraryBook = await prisma.library.upsert({
        where: { title: 'Apostila HTML UFF' },
        update: {},
        create: {
            title: 'Apostila HTML UFF',
            description: 'Apostila de HTML da UFF: guia prático para iniciantes sobre criação de sites e estrutura web.',
            type: 'BOOK',
            image: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728675236/atcc/dl7flhwnxpsr9q47jfth.jpg',
            file: 'https://www.telecom.uff.br/pet/petws/downloads/apostilas/HTML.pdf',
        },
    })
    const library1 = await prisma.library.upsert({
        where: { title: 'Curso Python #01' },
        update: {},
        create: {
            title: 'Curso Python #01',
            description: 'Aulas introdutórias de Python com Gustavo Guanabara: lógica, variáveis e funções.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/S9uPNppGsGo/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=S9uPNppGsGo',
        },
    })
    const library2 = await prisma.library.upsert({
        where: { title: 'Curso em Vídeo HTML5 + CSS3' },
        update: {},
        create: {
            title: 'Curso em Vídeo HTML5 + CSS3',
            description: 'Aprenda a criar páginas web com HTML5 e CSS3 de forma prática e eficiente.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/rqvn_c2n9Eg/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=rqvn_c2n9Eg',
        },
    })
    const library3 = await prisma.library.upsert({
        where: { title: 'Primeiros passos com Flexbox CSS' },
        update: {},
        create: {
            title: 'Primeiros passos com Flexbox CSS',
            description: 'Descubra como utilizar o Flexbox para alinhar elementos de forma eficiente.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/YeGn9nGies0/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=YeGn9nGies0',
        },
    })
    const library4 = await prisma.library.upsert({
        where: { title: 'Direções e Eixos Flexbox CSS' },
        update: {},
        create: {
            title: 'Direções e Eixos Flexbox CSS',
            description: 'Aprenda a trabalhar com direções e eixos no Flexbox para organizar layouts.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/qtGI16QcV1U/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=qtGI16QcV1U',
        },
    })
    const library5 = await prisma.library.upsert({
        where: { title: 'Empacotamento e fluxo no Flexbox CSS' },
        update: {},
        create: {
            title: 'Empacotamento e fluxo no Flexbox CSS',
            description: 'Entenda como o Flexbox gerencia o empacotamento e o fluxo de elementos.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/KRk3tjIZeFI/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=KRk3tjIZeFI',
        },
    })
    const library6 = await prisma.library.upsert({
        where: { title: 'Alinhamento nos eixos Flexbox' },
        update: {},
        create: {
            title: 'Alinhamento nos eixos Flexbox',
            description: 'Veja como alinhar elementos nos eixos do Flexbox para layouts mais flexíveis.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/KKdr1KZeFqk/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=KKdr1KZeFqk',
        },
    })
    const library7 = await prisma.library.upsert({
        where: { title: 'Centralização absoluta com Flexbox' },
        update: {},
        create: {
            title: 'Centralização absoluta com Flexbox',
            description: 'Saiba como centralizar elementos de forma absoluta usando o Flexbox.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/gfimpySRhUI/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=gfimpySRhUI',
        },
    })
    const library8 = await prisma.library.upsert({
        where: { title: 'Alinhamento de elementos empacotados no Flexbox' },
        update: {},
        create: {
            title: 'Alinhamento de elementos empacotados no Flexbox',
            description: 'Aprenda a alinhar elementos empacotados usando as propriedades do Flexbox.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/qMTX98pCwXA/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=qMTX98pCwXA',
        },
    })
    const library9 = await prisma.library.upsert({
        where: { title: 'Anatomia dos itens Flexbox' },
        update: {},
        create: {
            title: 'Anatomia dos itens Flexbox',
            description: 'Explore a anatomia dos itens Flexbox e como eles se comportam no layout.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/D7jeyyfigBM/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=D7jeyyfigBM',
        },
    })
    const library10 = await prisma.library.upsert({
        where: { title: 'Propriedade flex-basis em Flexbox' },
        update: {},
        create: {
            title: 'Propriedade flex-basis em Flexbox',
            description: 'Compreenda a função da propriedade flex-basis no Flexbox para dimensionar itens.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/J8iyHpOoLSU/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=J8iyHpOoLSU',
        },
    })
    const library11 = await prisma.library.upsert({
        where: { title: 'Curso Hardware' },
        update: {},
        create: {
            title: 'Curso Hardware',
            description: 'Curso introdutório sobre hardware e seus principais componentes.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/zpK_MqEMgu4/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=zpK_MqEMgu4',
        },
    })
    const library12 = await prisma.library.upsert({
        where: { title: 'Definindo requisitos do PC' },
        update: {},
        create: {
            title: 'Definindo requisitos do PC',
            description: 'Saiba como definir os requisitos de hardware para montar um PC adequado.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/kYkOwbzzzxk/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=kYkOwbzzzxk',
        },
    })
    const library13 = await prisma.library.upsert({
        where: { title: 'Como será nosso PC?' },
        update: {},
        create: {
            title: 'Como será nosso PC?',
            description: 'Descubra como será o PC que você vai construir com este curso.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/vs95I5KqBGE/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=vs95I5KqBGE',
        },
    })
    const library14 = await prisma.library.upsert({
        where: { title: 'Unidade Central de Processamento (CPU)' },
        update: {},
        create: {
            title: 'Unidade Central de Processamento (CPU)',
            description: 'Entenda a função da CPU como o cérebro do seu computador.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/J0adFq97U_s/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=J0adFq97U_s',
        },
    })
    const library15 = await prisma.library.upsert({
        where: { title: 'Fonte de Alimentação' },
        update: {},
        create: {
            title: 'Fonte de Alimentação',
            description: 'A importância da fonte de alimentação para a estabilidade do seu PC.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/m9iBEwaMenU/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=m9iBEwaMenU',
        },
    })
    const library16 = await prisma.library.upsert({
        where: { title: 'Placa Mãe' },
        update: {},
        create: {
            title: 'Placa Mãe',
            description: 'Conheça a placa mãe, o componente que conecta todos os outros do seu PC.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/E-n0A4txXf4/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=E-n0A4txXf4',
        },
    })
    const library17 = await prisma.library.upsert({
        where: { title: 'Memória Principal' },
        update: {},
        create: {
            title: 'Memória Principal',
            description: 'Aprenda sobre a função da memória RAM no desempenho do seu computador.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/dxI_z2h42B8/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=dxI_z2h42B8',
        },
    })
    const library18 = await prisma.library.upsert({
        where: { title: 'HDD e SSD' },
        update: {},
        create: {
            title: 'HDD e SSD',
            description: 'Entenda as diferenças entre HDD e SSD e como escolher o melhor para seu PC.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/sa4ei7m1ASg/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=sa4ei7m1ASg',
        },
    })
    const library19 = await prisma.library.upsert({
        where: { title: 'Periféricos' },
        update: {},
        create: {
            title: 'Periféricos',
            description: 'Descubra os principais periféricos e como eles melhoram a experiência no PC.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/pmoZnq9QGns/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=pmoZnq9QGns',
        },
    })
    const library20 = await prisma.library.upsert({
        where: { title: 'Softwares' },
        update: {},
        create: {
            title: 'Softwares',
            description: 'Uma visão geral dos softwares essenciais para o funcionamento do seu PC.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/pTF13mbVrR4/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=pTF13mbVrR4',
        },
    })
    const library21 = await prisma.library.upsert({
        where: { title: 'Curso JavaScript #01' },
        update: {},
        create: {
            title: 'Curso JavaScript #01',
            description: 'Aulas básicas sobre JavaScript: comece a entender a linguagem mais popular da web.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/Ptbk2af68e8/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=Ptbk2af68e8',
        },
    })
    const library22 = await prisma.library.upsert({
        where: { title: 'Curso JavaScript #02' },
        update: {},
        create: {
            title: 'Curso JavaScript #02',
            description: 'Segunda parte do curso JavaScript: funções, variáveis e manipulação do DOM.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/rUTKomc2gG8/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=rUTKomc2gG8',
        },
    })
    const library23 = await prisma.library.upsert({
        where: { title: 'Curso JavaScript #03' },
        update: {},
        create: {
            title: 'Curso JavaScript #03',
            description: 'Terceira parte do curso de JavaScript: eventos e manipulação avançada do DOM.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/FdePtO5JSd0/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=FdePtO5JSd0',
        },
    })
    const library24 = await prisma.library.upsert({
        where: { title: 'Curso JavaScript #04' },
        update: {},
        create: {
            title: 'Curso JavaScript #04',
            description: 'Quarta parte do curso: aprenda mais sobre arrays e objetos em JavaScript.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/OmmJBfcMJA8/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=OmmJBfcMJA8',
        },
    })
    const library25 = await prisma.library.upsert({
        where: { title: 'Curso JavaScript #05' },
        update: {},
        create: {
            title: 'Curso JavaScript #05',
            description: 'Última parte do curso: explore as funcionalidades avançadas do JavaScript.',
            type: 'VIDEO',
            image: 'https://img.youtube.com/vi/Vbabsye7mWo/maxresdefault.jpg',
            file: 'https://www.youtube.com/watch?v=Vbabsye7mWo',
        },
    })

    // eslint-disable-next-line
    console.log('seed completed successfully!')
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
