import { PrismaClient } from '@prisma/client'
import bcrypt from 'bcrypt'
const prisma = new PrismaClient()

/* eslint-disable */

async function main() {
    //Seed de usuario admin
    const adminDefault = await prisma.user.upsert({
        where: { username: 'admin' },
        update: {},
        create: {
            matriculation: '20230001',
            name: 'Leonardo Sampaio',
            role: 'ADMIN',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233311',
            rg: '11223311',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'leonardo.sampaio@example.com',
            username: 'admin',
            password: await bcrypt.hash('admin123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728531466/atcc/s9x1zveq4zaepmvr6x1t.jpg',
        },
    })

    //Seed de usuario alunos
    const studentDefault = await prisma.user.upsert({
        where: { username: 'aluno' },
        update: {},
        create: {
            matriculation: '20230002',
            name: 'Leonardo P. Sampaio',
            role: 'STUDENT',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233322',
            rg: '11223322',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'leonardo.aluno@example.com',
            username: 'aluno',
            password: await bcrypt.hash('aluno123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728583169/atcc/z5fggmmbzflbuwwvwkho.webp',
        },
    })
    const studentHenrique = await prisma.user.upsert({
        where: { username: 'henrique' },
        update: {},
        create: {
            matriculation: '20230003',
            name: 'Henrique do Nascimento Sampaio',
            role: 'STUDENT',
            status: 'ACTIVE',
            birthDate: new Date('2000-01-15'),
            cpf: '11122233333',
            rg: '11223333',
            address: 'Rua A, 123',
            phone: '1122334455',
            email: 'henrique@example.com',
            username: 'henrique',
            password: await bcrypt.hash('henrique123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728531466/atcc/s9x1zveq4zaepmvr6x1t.jpg',
        },
    })
    const studentAirton = await prisma.user.upsert({
        where: { username: 'airton' },
        update: {},
        create: {
            matriculation: '20230004',
            name: 'Airtinho Sampaio da Silva',
            role: 'STUDENT',
            status: 'ACTIVE',
            birthDate: new Date('1985-05-25'),
            cpf: '11122233344',
            rg: '11223344',
            address: 'Rua B, 456',
            phone: '11999887766',
            email: 'airton.senna@example.com',
            username: 'airton',
            password: await bcrypt.hash('airton123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728531466/atcc/s9x1zveq4zaepmvr6x1t.jpg',
        },
    })

    //Seed de usuario professors
    const teacherDefault = await prisma.user.upsert({
        where: { username: 'professor' },
        update: {},
        create: {
            matriculation: '20230005',
            name: 'Leonardo P. Sampaio',
            role: 'TEACHER',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233355',
            rg: '11223355',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'leonardo.professor@example.com',
            username: 'professor',
            password: await bcrypt.hash('professor123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728583797/atcc/qchfsbjlzdrajs77l7cm.jpg',
        },
    })
    const teacherMarieni = await prisma.user.upsert({
        where: { username: 'marieni' },
        update: {},
        create: {
            matriculation: '20230006',
            name: 'Marieni Cristina Sampaio',
            role: 'TEACHER',
            status: 'ACTIVE',
            birthDate: new Date('1994-06-06'),
            cpf: '11122233366',
            rg: '11223366',
            address: 'Rua D, 789',
            phone: '1177665544',
            email: 'marieni.professor@example.com',
            username: 'marieni',
            password: await bcrypt.hash('marieni123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728583797/atcc/qchfsbjlzdrajs77l7cm.jpg',
        },
    })
    const teacherCamilla = await prisma.user.upsert({
        where: { username: 'camilla' },
        update: {},
        create: {
            matriculation: '20230007',
            name: 'Camilla Pereira Sampaio',
            role: 'TEACHER',
            status: 'ACTIVE',
            birthDate: new Date('1995-09-12'),
            cpf: '11122233377',
            rg: '11223377',
            address: 'Rua C, 789',
            phone: '1177665544',
            email: 'camilla.professor@example.com',
            username: 'camilla',
            password: await bcrypt.hash('camilla123', 10),
            photo: 'https://res.cloudinary.com/dqgjhgn3s/image/upload/v1728583797/atcc/qchfsbjlzdrajs77l7cm.jpg',
        },
    })

    //Seed de temas
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
    const themeThree = await prisma.theme.upsert({
        where: { name: 'A Influência das Redes Sociais na Formação da Opinião Pública' },
        update: {},
        create: {
            name: 'A Influência das Redes Sociais na Formação da Opinião Pública',
            description:
                'Este trabalho tem como objetivo investigar o papel das redes sociais na formação da opinião pública contemporânea, analisando como plataformas digitais como Facebook, Twitter e Instagram influenciam a percepção e o comportamento dos usuários em relação a questões sociais, políticas e culturais. A pesquisa buscará compreender os mecanismos de disseminação de informações e desinformações nas redes sociais, bem como seu impacto na formação de narrativas coletivas e na mobilização social.',
        },
    })
    const themeFour = await prisma.theme.upsert({
        where: { name: 'A Importância da Educação Financeira nas Escolas: Desafios e Oportunidades' },
        update: {},
        create: {
            name: 'A Importância da Educação Financeira nas Escolas: Desafios e Oportunidades',
            description:
                'Este trabalho tem como objetivo discutir a importância da educação financeira nas escolas, analisando os desafios e oportunidades para a implementação de programas de ensino sobre finanças pessoais no currículo escolar. A pesquisa buscará investigar como a educação financeira pode contribuir para o desenvolvimento de habilidades financeiras nos jovens, promovendo uma maior conscientização sobre consumo, poupança e investimento.',
        },
    })
    const themeFive = await prisma.theme.upsert({
        where: { name: 'A Revolução dos Carros Elétricos: Desafios e Oportunidades para a Indústria Automotiva' },
        update: {},
        create: {
            name: 'A Revolução dos Carros Elétricos: Desafios e Oportunidades para a Indústria Automotiva',
            description:
                'Este trabalho tem como objetivo analisar a revolução dos carros elétricos na indústria automotiva, investigando os desafios e oportunidades que essa nova tecnologia representa para fabricantes, consumidores e o meio ambiente. A pesquisa buscará explorar as inovações tecnológicas, políticas públicas e tendências de mercado que estão impulsionando a adoção de veículos elétricos, além de discutir os impactos sociais e econômicos dessa transição para a sustentabilidade.',
        },
    })
    const themeSix = await prisma.theme.upsert({
        where: { name: 'A Importância da Inteligência Artificial na Saúde' },
        update: {},
        create: {
            name: 'A Importância da Inteligência Artificial na Saúde',
            description:
                'Este trabalho tem como objetivo investigar a importância da inteligência artificial (IA) na área da saúde, analisando como essa tecnologia pode melhorar diagnósticos, tratamentos e a gestão de serviços de saúde. A pesquisa buscará explorar as aplicações da IA em diferentes áreas, como radiologia, telemedicina e análise de dados clínicos, além de discutir os desafios éticos e legais associados ao uso da IA na saúde.',
        },
    })
    const themeSeven = await prisma.theme.upsert({
        where: { name: 'A Evolução do Ensino a Distância no Brasil' },
        update: {},
        create: {
            name: 'A Evolução do Ensino a Distância no Brasil',
            description:
                'Este trabalho tem como objetivo analisar a evolução do ensino a distância (EAD) no Brasil, investigando as mudanças tecnológicas, pedagógicas e sociais que impactaram essa modalidade de ensino ao longo dos anos. A pesquisa buscará explorar os desafios e oportunidades do EAD, bem como seu papel na democratização do acesso à educação e na formação profissional.',
        },
    })
    const themeEight = await prisma.theme.upsert({
        where: { name: 'A Importância da Cibersegurança na Era Digital' },
        update: {},
        create: {
            name: 'A Importância da Cibersegurança na Era Digital',
            description:
                'Este trabalho tem como objetivo discutir a importância da cibersegurança na era digital, analisando os desafios e oportunidades para proteger dados e informações em um mundo cada vez mais conectado. A pesquisa buscará investigar as principais ameaças cibernéticas, como ataques de ransomware e phishing, além de explorar as melhores práticas e tecnologias para garantir a segurança da informação.',
        },
    })
    const themeNine = await prisma.theme.upsert({
        where: { name: 'A Importância da Sustentabilidade na Indústria da Moda' },
        update: {},
        create: {
            name: 'A Importância da Sustentabilidade na Indústria da Moda',
            description:
                'Este trabalho tem como objetivo investigar a importância da sustentabilidade na indústria da moda, analisando os desafios e oportunidades para promover práticas sustentáveis em toda a cadeia produtiva. A pesquisa buscará explorar as inovações tecnológicas, políticas públicas e tendências de mercado que estão impulsionando a moda sustentável, além de discutir os impactos sociais e ambientais dessa transformação.',
        },
    })
    const themeTen = await prisma.theme.upsert({
        where: { name: 'A Importância da Diversidade e Inclusão nas Empresas' },
        update: {},
        create: {
            name: 'A Importância da Diversidade e Inclusão nas Empresas',
            description:
                'Este trabalho tem como objetivo discutir a importância da diversidade e inclusão nas empresas, analisando os desafios e oportunidades para promover um ambiente de trabalho mais inclusivo e diverso. A pesquisa buscará investigar os benefícios da diversidade para a inovação, criatividade e desempenho organizacional, além de explorar as melhores práticas para implementar políticas de diversidade e inclusão nas empresas.',
        },
    })
    const themeEleven = await prisma.theme.upsert({
        where: { name: 'A Importância da Ética na Inteligência Artificial' },
        update: {},
        create: {
            name: 'A Importância da Ética na Inteligência Artificial',
            description:
                'Este trabalho tem como objetivo discutir a importância da ética na inteligência artificial (IA), analisando os desafios e oportunidades para garantir que as tecnologias de IA sejam desenvolvidas e utilizadas de forma responsável e ética. A pesquisa buscará investigar os principais dilemas éticos associados à IA, como viés algorítmico, privacidade e transparência, além de explorar as melhores práticas e diretrizes para promover uma IA ética e responsável.',
        },
    })
    const themeTwelve = await prisma.theme.upsert({
        where: { name: 'A Importância da Educação Ambiental nas Escolas' },
        update: {},
        create: {
            name: 'A Importância da Educação Ambiental nas Escolas',
            description:
                'Este trabalho tem como objetivo discutir a importância da educação ambiental nas escolas, analisando os desafios e oportunidades para promover a conscientização ambiental entre os jovens. A pesquisa buscará investigar as melhores práticas e metodologias para implementar programas de educação ambiental nas escolas, além de explorar o papel da educação ambiental na formação de cidadãos mais conscientes e responsáveis em relação ao meio ambiente.',
        },
    })
    const themeThirteen = await prisma.theme.upsert({
        where: { name: 'A Importância da Saúde Mental no Trabalho' },
        update: {},
        create: {
            name: 'A Importância da Saúde Mental no Trabalho',
            description:
                'Este trabalho tem como objetivo discutir a importância da saúde mental no ambiente de trabalho, analisando os desafios e oportunidades para promover o bem-estar psicológico dos colaboradores. A pesquisa buscará investigar os principais fatores que afetam a saúde mental no trabalho, como estresse, burnout e assédio moral, além de explorar as melhores práticas e políticas para promover um ambiente de trabalho saudável e inclusivo.',
        },
    })
    const themeFourteen = await prisma.theme.upsert({
        where: { name: 'A Importância da Educação Financeira para os Jovens' },
        update: {},
        create: {
            name: 'A Importância da Educação Financeira para os Jovens',
            description:
                'Este trabalho tem como objetivo discutir a importância da educação financeira para os jovens, analisando os desafios e oportunidades para promover o conhecimento sobre finanças pessoais entre essa faixa etária. A pesquisa buscará investigar as melhores práticas e metodologias para implementar programas de educação financeira nas escolas e comunidades, além de explorar o papel da educação financeira na formação de cidadãos mais conscientes e responsáveis em relação ao dinheiro.',
        },
    })
    const themeFifteen = await prisma.theme.upsert({
        where: { name: 'A Importância da Tecnologia na Educação' },
        update: {},
        create: {
            name: 'A Importância da Tecnologia na Educação',
            description:
                'Este trabalho tem como objetivo discutir a importância da tecnologia na educação, analisando os desafios e oportunidades para promover o uso de ferramentas tecnológicas no ensino e aprendizagem. A pesquisa buscará investigar as melhores práticas e metodologias para implementar tecnologias educacionais nas escolas, além de explorar o papel da tecnologia na formação de cidadãos mais críticos e preparados para o futuro.',
        },
    })
    const themeSixteen = await prisma.theme.upsert({
        where: { name: 'A Importância da Empatia na Comunicação' },
        update: {},
        create: {
            name: 'A Importância da Empatia na Comunicação',
            description:
                'Este trabalho tem como objetivo discutir a importância da empatia na comunicação, analisando os desafios e oportunidades para promover uma comunicação mais empática e eficaz. A pesquisa buscará investigar as melhores práticas e metodologias para desenvolver habilidades de empatia na comunicação interpessoal, além de explorar o papel da empatia na construção de relacionamentos saudáveis e produtivos.',
        },
    })
    const themeSeventeen = await prisma.theme.upsert({
        where: { name: 'A Importância da Criatividade na Inovação' },
        update: {},
        create: {
            name: 'A Importância da Criatividade na Inovação',
            description:
                'Este trabalho tem como objetivo discutir a importância da criatividade na inovação, analisando os desafios e oportunidades para promover um ambiente criativo e inovador nas empresas. A pesquisa buscará investigar as melhores práticas e metodologias para estimular a criatividade e a inovação, além de explorar o papel da criatividade na solução de problemas e na geração de novas ideias.',
        },
    })

    //Seed de biblioteca
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

    console.log('seed completed successfully!')
}
main()
    .then(async () => {
        await prisma.$disconnect()
    })
    .catch(async e => {
        console.error(e)
        await prisma.$disconnect()
        process.exit(1)
    })
