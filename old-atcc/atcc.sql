-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jun 05, 2016 as 02:57 PM
-- Versão do Servidor: 5.0.45
-- Versão do PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `atcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL auto_increment,
  `orientador` varchar(70) character set utf8 collate utf8_unicode_ci NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `percetual` decimal(3,0) NOT NULL,
  `resposta` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_avaliacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_avaliacao`, `orientador`, `data_inicio`, `data_termino`, `percetual`, `resposta`) VALUES
(1, 'Vinicius Marques', '2016-05-01', '2016-05-10', 0, ''),
(2, 'Rafael Phacheco', '0000-00-00', '0000-00-00', 0, ''),
(3, 'daddadasdasd', '0000-00-00', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int(11) NOT NULL auto_increment,
  `id_tcc` int(11) NOT NULL,
  `nome` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_componentes`),
  KEY `componentes_ibfk_1` (`id_tcc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `id_tcc`, `nome`) VALUES
(1, 1, 'kkkkkkkkkk'),
(2, 1, 'kkkkkkkkkkkgggggggg'),
(3, 2, 'sdsdsadss'),
(4, 2, 'leo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapas`
--

CREATE TABLE `etapas` (
  `id_etapas` int(11) NOT NULL auto_increment,
  `descricao` varchar(1000) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `situacao` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_etapas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `etapas`
--

INSERT INTO `etapas` (`id_etapas`, `descricao`, `data_inicio`, `data_termino`, `situacao`) VALUES
(1, 'Introdução', '2016-04-01', '2016-04-08', 'Atrasado'),
(2, 'Motivação', '2016-05-02', '2016-05-24', 'Atrasado'),
(3, 'Objetivo', '2016-06-02', '2016-06-22', 'No Prazo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `informativos`
--

CREATE TABLE `informativos` (
  `id_informativos` int(11) NOT NULL,
  `tipo` varchar(70) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_informativos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `informativos`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id_pergunta` int(11) NOT NULL auto_increment,
  `descricao` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_pergunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id_pergunta`, `descricao`) VALUES
(14, 'Ã‰ foda!!!! haaaaaaaaaaaaaaaaaaaaaaaaa!'),
(15, 'TCC Ã‰ FODA!!!!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sugestoes_temas`
--

CREATE TABLE `sugestoes_temas` (
  `id_sugestao` int(11) NOT NULL auto_increment,
  `nome` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `descricao` varchar(1000) character set utf8 collate utf8_unicode_ci NOT NULL,
  `situacao` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_sugestao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `sugestoes_temas`
--

INSERT INTO `sugestoes_temas` (`id_sugestao`, `nome`, `descricao`, `situacao`) VALUES
(1, 'qqqqqqqqqqqqqqqqqqqq', 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 'aaaaaaaaaaaaaaaa'),
(2, 'sdasdasdasdasd', 'asdasdasdasds', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tcc`
--

CREATE TABLE `tcc` (
  `id_tcc` int(11) NOT NULL auto_increment,
  `tema` varchar(50) NOT NULL,
  `orientador` varchar(70) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY  (`id_tcc`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tcc`
--

INSERT INTO `tcc` (`id_tcc`, `tema`, `orientador`, `id_usuario`) VALUES
(1, 'Contribuindo para o GNU-Health', 'Vinicius Marques', 7),
(2, 'Projeto de integraÃ§Ã£o e divulgaÃ§Ã£o tecnolÃ³gic', 'Vinicius Marques', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `temas`
--

CREATE TABLE `temas` (
  `id_tema` int(11) NOT NULL auto_increment,
  `nome` varchar(300) character set utf8 collate utf8_unicode_ci NOT NULL,
  `descricao` varchar(2000) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id_tema`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `temas`
--

INSERT INTO `temas` (`id_tema`, `nome`, `descricao`) VALUES
(1, 'Sistemas E.R.P.', 'Nas ultimas duas decadas os sistemas ERP surgiram com a proposta de integrar dados e otimizar processos. Durante essa jornada, muitos sistemas foram propostos e implementados. Agora precisamos compor um trabalho que apresente as licoes aprendidas, os erros, as melhores praticas e os dados estatisticos que possam nos orientar para os proximos vinte anos. Esse trabalho consiste em pesquisa exploratoria junto a empresas de software, seus clientes e mercado atendido (Pequenas, medias e grandes empresas).'),
(2, 'Smart Cities', 'Gastar menos e oferecer melhores servicos: esse eh o objetivo das cidades do futuro. Como conseguir isso? Implementando hardware e softwares de baixo nivel, propondo novas arquiteturas de servico, manipulando grandes bases de dados e integrando solucoes tecnologicas a outras areas de conhecimento.'),
(3, 'Bancos de Dados Publicos (big data e open data)', 'Trabalhar com bancos de dados oferece a oportunidade de propor solucoes inovadoras como analisar e recuperar informacao de enormes bases de dados (big data) ou prever comportamento de usuarios e sistemas (predective analytic). Atualmente as bases de dados publicas possuem informacoes demais e poucas ferramentas para isso.'),
(4, 'Ontologia e Web Semantica', 'A CAPES fornece a cada trienio o Qualis, para indicar o extrato de qualidade dos eventos e publicacoes cientificas. Atualmente enfrentamos um problema que requer simples solucao: desenvolver um sistema que cruze as palavras chave de um trabalho academico com os eventos e publicacoes disponibilizados pela CAPES. Dessa forma, o autor pode saber quais sao os eventos indicados para seu trabalho, a data de envio, local, valor de inscricao... Este trabalho utiliza Ontologia para criar a estrutura da base de conhecimentos e web semantica para filtras as informacoes da web e montar a interface para o usuario.'),
(5, 'Contribuindo para o GNU-Health', 'ContribuiÃ§Ãµes de implementaÃ§Ã£o ou implantaÃ§Ã£o+treinamento do GNU-Health (http://health.gnu.org/)'),
(6, 'AplicaÃ§Ã£o de TÃ©cnicas de InteligÃªncia Computacional para AutomatizaÃ§Ã£o de OperaÃ§Ãµes no Mercado Financeiro', 'O mercado financeiro apresenta grande importÃ¢ncia na organizaÃ§Ã£o socio-economica da sociedade moderna. O comportamento dos preÃ§os de uma aÃ§Ã£o pode ser caracterizado atravÃ©s de sÃ©ries temporais (sÃ©rie que mostra a variaÃ§Ã£o do valor da aÃ§Ã£o em perÃ­dos regulares, como dias, semanas, meses). Diversas tÃ©cnicas tÃªm sido propostas na literatura para a previsÃ£o de sÃ©ries temporais, como Redes Neurais de MÃºltiplas Camadas (MLP), Redes Neurais ProbabilÃ­sticas (PNN), MÃ¡quinas de Vetor de Suporte (SVM), entre outras. O objetivo deste trabalho Ã© investigar tÃ©cnicas de inteligÃªncia computacional para construir um agente capaz realizar previsÃµes sobre os preÃ§os futuros de uma sÃ©rie temporal e operar no mercado financeiro de forma a maximar os lucros'),
(7, 'Agente para recuperaÃ§Ã£o de informaÃ§Ãµes financeiras na Web', 'Diversas tÃ©cnicas de InteligÃªncia Computacional tÃªm sido propostas na literatura com o objetivo de prever o movimento dos preÃ§os de aÃ§Ãµes no mercado financeiro. No entanto, tais mecanismos lidam apenas com dados quantitativos referentes a indicadores tÃ©cnicos. Por outro lado, alguns pesquisad'),
(8, 'Sistema para propor rotas para uma frota', 'Um sistema que recebe: uma agenda de compromissos, com suas restriÃ§Ãµes e; uma lista de veÃ­culos com suas caracterÃ­sticas; PropÃµe ao usuÃ¡rio os cronogramas diÃ¡rios para uma frota, considerando economia de viagens, combustÃ­vel, distÃ¢ncia etc. (Com Sistemas Especialistas ou Algoritmos GenÃ©tic'),
(9, 'Sistema para simular a evasÃ£o de pessoas de ambientes fechados', 'Um sistema que recebe uma planta CAD ou permite a ediÃ§Ã£o de um esboÃ§o de um ambiente fechado (com suas saÃ­das, rotas e obstÃ¡culos) para fazer a simulaÃ§Ã£o visual do comportamento dos indivÃ­duos numa situaÃ§Ã£o de emergÃªncia. O sistema farÃ¡ a simulaÃ§Ã£o da situaÃ§Ã£o de pÃ¢nico fornecendo o'),
(10, 'Sistema tutor para o aprendizado de lÃ³gica proposicional', 'Sistema Web que propÃµe e acompanha exercÃ­cios do assunto para os alunos cadastrados. O sistema usarÃ¡ Sistemas Especialistas ou RBC para dar orientaÃ§Ãµes apropriadas a cada momento.'),
(11, 'Sistema para provas on-line', 'Um sistema que cadastra questÃµes de prova, professores, alunos, disciplinas e turmas. Gera provas diferentes automaticamente para os alunos, conforme o nÃ­vel de dificuldade desejado pelo professor. Libera e Fecha a prova para os alunos em momentos determinados (para todos ao mesmo tempo, ou de um '),
(12, 'Projeto de integraÃ§Ã£o e divulgaÃ§Ã£o tecnolÃ³gica', 'Desenvolver uma biblioteca com o cadastro de instituiÃ§Ãµes, projetos, cursos ou Ã¡reas, pesquisadores, dotado de buscas especiais e um subsistema para propor parcerias e troca de interesses (Usar IA). Visitar as principais instituiÃ§Ãµes de ensino superior para divulgar a ferramenta. Apresentar nÃº'),
(13, 'ATCC', 'Auxiliador de Trabalho de ConclusÃ£o de Curso.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL auto_increment,
  `matricula` int(20) NOT NULL,
  `nome` varchar(70) character set utf8 collate utf8_unicode_ci NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `situacao` varchar(10) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` int(11) NOT NULL,
  `rg` int(9) NOT NULL,
  `endereco` varchar(70) character set utf8 collate utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(70) character set utf8 collate utf8_unicode_ci NOT NULL,
  `login` varchar(70) character set utf8 collate utf8_unicode_ci NOT NULL,
  `senha` varchar(8) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY  (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `matricula`, `nome`, `perfil`, `situacao`, `data_nascimento`, `cpf`, `rg`, `endereco`, `telefone`, `email`, `login`, `senha`, `foto`) VALUES
(1, 171310065, 'Leonardo Pereira Sampaio', 'Aluno', 'Ativo', '1995-05-24', 2147483647, 123456789, 'Rua colorado', '979272015', 'leo@email.com', 'leoaluno', '2882', 'b2f393e16b34d7319c0086e238d69f51.jpg'),
(2, 171310069, 'Vinicius Marques', 'Professor', 'Ativo', '1983-06-20', 2147483647, 789693852, 'Rua Do Professor', '21896589658', 'professorv@gmail.com', 'vinicius.marques', '123', ''),
(3, 171310068, 'Raphael Pacheco', 'Professor', 'Ativo', '1965-06-14', 2147483647, 78945618, 'Rua Do Prof Pacheco', '21895856985', 'pachecoocehcpa@gmail.com', 'rafael', '123', ''),
(4, 1, 'Leonardo Sampaio Admin', 'Administrador', 'Ativo', '1995-05-24', 2147483647, 789658214, 'Rua colorado', '2178272015', 'leo@email.com', 'leoadm', '2882', ''),
(7, 171310061, 'Marieni Cristina', 'Aluno', 'Ativo', '1994-06-06', 2147483647, 564654864, 'Rua Araiba', '218779754564', 'marieni@gmail.com', 'marieni', '123', '159f7b3041cb5ada47c3caff11153b5e.jpg');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`id_tcc`) REFERENCES `tcc` (`id_tcc`);

--
-- Restrições para a tabela `tcc`
--
ALTER TABLE `tcc`
  ADD CONSTRAINT `tcc_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
