-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 16/05/2012 às 08h57min
-- Versão do Servidor: 5.5.22
-- Versão do PHP: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `s_almoxarifado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aquisicoes`
--

CREATE TABLE IF NOT EXISTS `aquisicoes` (
  `id_aquisicao` int(11) NOT NULL,
  `fase_aquisicao` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  PRIMARY KEY (`id_aquisicao`),
  KEY `fk_aquisicoes_Professores1` (`professor_id`),
  KEY `fk_aquisicoes_semestres1` (`semestre_id`),
  KEY `fk_aquisicoes_disciplinas1` (`disciplina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ctrl_chaves`
--

CREATE TABLE IF NOT EXISTS `ctrl_chaves` (
  `id_controle` int(11) NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) NOT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `observacao_controle` varchar(255) DEFAULT NULL,
  `dt_inicial_controle` datetime NOT NULL,
  `dt_final_controle` datetime DEFAULT NULL,
  PRIMARY KEY (`id_controle`),
  KEY `fk_Controle_laboratorios` (`laboratorio_id`),
  KEY `fk_Controle_Professores1` (`professor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `ctrl_chaves`
--

INSERT INTO `ctrl_chaves` (`id_controle`, `professor_id`, `laboratorio_id`, `observacao_controle`, `dt_inicial_controle`, `dt_final_controle`) VALUES
(1, 9, 2, NULL, '2012-05-05 17:33:44', '2012-05-08 18:06:39'),
(2, 4, 4, NULL, '2012-05-05 17:41:51', '2012-05-06 18:27:24'),
(3, 9, 3, NULL, '2012-06-05 15:24:57', '2012-05-08 18:16:57'),
(4, 9, 10, NULL, '2012-08-05 10:36:14', '2012-05-08 18:55:25'),
(5, 6, 22, NULL, '2012-08-05 18:55:38', '2012-05-14 20:29:49'),
(6, 9, 1, NULL, '2012-11-05 19:45:27', NULL),
(7, 8, 19, NULL, '2012-11-05 20:26:23', '2012-05-11 20:39:35'),
(8, 8, 19, NULL, '0201-11-05 20:35:46', '2012-05-11 20:39:35'),
(9, 8, 19, NULL, '2012-11-05 20:39:26', '2012-05-11 20:39:35'),
(10, 9, 16, NULL, '2012-11-05 20:40:48', '2012-05-11 20:41:04'),
(11, 7, 11, NULL, '2012-11-05 21:23:16', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(45) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE IF NOT EXISTS `disciplinas` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `nome_disciplina` varchar(45) NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `fk_disciplinas_cursos1` (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas_usuarios`
--

CREATE TABLE IF NOT EXISTS `disciplinas_usuarios` (
  `disciplina_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`disciplina_id`,`usuario_id`),
  KEY `fk_disciplinas_usuarios_usuarios1` (`usuario_id`),
  KEY `fk_disciplinas_usuarios_disciplinas1` (`disciplina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE IF NOT EXISTS `emprestimos` (
  `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT,
  `dt_inicial_emprestimo` datetime NOT NULL,
  `requisitante_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id_emprestimo`),
  KEY `fk_emprestimos_usuarios1` (`requisitante_id`),
  KEY `fk_emprestimos_usuarios2` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id_emprestimo`, `dt_inicial_emprestimo`, `requisitante_id`, `usuario_id`) VALUES
(2, '2012-06-05 14:05:46', 9, 3),
(4, '2012-06-05 14:05:32', 8, 3),
(5, '2012-06-05 14:05:37', 5, 3),
(6, '2012-06-05 18:05:22', 5, 2),
(7, '2012-06-05 18:05:03', 8, 2),
(8, '2012-08-05 10:05:37', 9, 3),
(9, '2012-08-05 10:05:53', 9, 3),
(10, '2012-10-05 21:05:52', 5, 3),
(11, '2012-10-05 21:05:08', 1, 3),
(12, '2012-10-05 21:05:51', 8, 3),
(13, '2012-10-05 21:05:09', 6, 3),
(14, '2012-11-05 19:05:40', 7, 3),
(15, '2012-11-05 19:05:32', 6, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_requisicoes`
--

CREATE TABLE IF NOT EXISTS `estados_requisicoes` (
  `id_estado_requisicao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_estado_requisicao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado_requisicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `estados_requisicoes`
--

INSERT INTO `estados_requisicoes` (`id_estado_requisicao`, `nome_estado_requisicao`) VALUES
(1, 'Aguardando aprovação'),
(2, 'Aprovada'),
(3, 'Em andamento'),
(4, 'Concluída'),
(5, 'Negada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_aquisicao`
--

CREATE TABLE IF NOT EXISTS `item_aquisicao` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_item` varchar(150) NOT NULL,
  `quantidade_item` int(11) NOT NULL,
  `dt_requisicao_item` date NOT NULL,
  `dt_recebimento_item` date DEFAULT NULL,
  `aquisicao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_item_aquisicao_aquisicoes1` (`aquisicao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_emprestimos`
--

CREATE TABLE IF NOT EXISTS `itens_emprestimos` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_item` varchar(100) NOT NULL,
  `quantidade_item` int(11) NOT NULL,
  `dt_final` datetime NOT NULL,
  `emprestimos_id` int(11) NOT NULL,
  `entregue` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_item`),
  KEY `fk_itens_emprestimos_emprestimos1` (`emprestimos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `itens_emprestimos`
--

INSERT INTO `itens_emprestimos` (`id_item`, `descricao_item`, `quantidade_item`, `dt_final`, `emprestimos_id`, `entregue`) VALUES
(3, 'Alicate', 1, '2012-06-05 10:00:00', 2, 1),
(4, 'Lapis', 5, '2012-06-05 10:00:00', 2, 0),
(5, 'Alicate', 1, '2012-01-05 16:00:00', 4, 1),
(6, 'Fio', 1, '0000-00-00 00:00:00', 4, 1),
(7, 'Alicate', 1, '2012-06-05 12:00:00', 5, 0),
(8, 'Corda 100m', 1, '0000-00-00 00:00:00', 5, 1),
(9, 'Chave de Fenda', 1, '2012-07-05 10:30:00', 6, 1),
(10, 'Fio 5 metros', 1, '0000-00-00 00:00:00', 7, 1),
(11, 'Alicate', 1, '2012-11-05 10:00:00', 8, 1),
(12, 'Alicate', 1, '0000-00-00 00:00:00', 9, 1),
(13, 'Corda 100m', 5, '2012-02-05 14:00:00', 9, 1),
(14, 'Fio', 10, '0000-00-00 00:00:00', 9, 1),
(15, '123123', 1, '0000-00-00 00:00:00', 10, 1),
(16, '12312', 1, '0000-00-00 00:00:00', 10, 1),
(17, 'asdasd', 1, '2012-01-05 00:00:00', 10, 1),
(18, '1', 1, '2012-01-05 00:00:00', 11, 1),
(19, '123123', 1, '2012-07-05 15:00:00', 12, 0),
(20, '12312', 1, '2012-07-05 16:00:00', 13, 1),
(21, 'Lapis', 1, '2012-01-05 15:00:00', 14, 0),
(22, 'Caneta', 1, '0000-00-00 00:00:00', 15, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `laboratorios`
--

CREATE TABLE IF NOT EXISTS `laboratorios` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nome_laboratorio` varchar(100) NOT NULL,
  `numero_laboratorio` int(11) DEFAULT NULL,
  `chave_laboratorio` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 -> chave disponivel\n1 -> chave indisponivel',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `laboratorios`
--

INSERT INTO `laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`, `deleted`) VALUES
(1, 'Automação', 46, 1, 0),
(2, 'Hidraulica', 47, 0, 0),
(3, 'Pneumática', 48, 0, 0),
(4, 'Ajustagem', 49, 0, 0),
(5, 'Fresagem', 50, 0, 0),
(6, 'Desenho', 51, 0, 0),
(7, 'Medidas Elétricas', 52, 0, 0),
(8, 'Ensaios Eléricos', 53, 0, 0),
(9, 'Metalografia', 54, 0, 0),
(10, 'Marcenaria', 55, 0, 0),
(11, 'Soldar', 56, 1, 0),
(12, 'Máquinas Elétricas', 58, 0, 0),
(13, 'Manutenção Mecânica', 59, 0, 0),
(14, 'Comandos Elétricos II', 60, 0, 0),
(15, 'Instalações Prediais II', 61, 0, 0),
(16, 'Comandos Elétricos I', 62, 0, 0),
(17, 'Tornearia', 63, 0, 0),
(18, 'CNC', 64, 0, 1),
(19, 'Eletrônica', 19, 0, 0),
(20, 'Eletrônica II', 20, 0, 0),
(21, 'Eletrônica III', 45, 0, 0),
(22, 'Marcenaria II', 0, 0, 0),
(23, 'Informática II', 70, 0, 1),
(24, 'CNC', 67, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencoes`
--

CREATE TABLE IF NOT EXISTS `manutencoes` (
  `id_manutencao` int(11) NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) NOT NULL,
  `data_manutencao` date NOT NULL,
  `providencia_manutencao` text NOT NULL,
  `definitivo_manutencao` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 -> o problema não foi resolvido\n1 -> o problema foi resolvido',
  `req_manutencao_id` int(11) NOT NULL,
  `comentario_manutencao` text,
  PRIMARY KEY (`id_manutencao`),
  KEY `fk_manutencoes_professores1` (`professor_id`),
  KEY `fk_manutencoes_req_manutencao1` (`req_manutencao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `manutencoes`
--

INSERT INTO `manutencoes` (`id_manutencao`, `professor_id`, `data_manutencao`, `providencia_manutencao`, `definitivo_manutencao`, `req_manutencao_id`, `comentario_manutencao`) VALUES
(2, 3, '2012-04-26', 'Verificar rede.', 0, 14, 'Internet voltou ao estado normal.'),
(3, 3, '2012-04-26', 'Verificar computador.', 1, 10, 'Consertado.'),
(4, 1, '2012-04-26', 'Verificação', 0, 15, NULL),
(5, 3, '2012-05-05', 'Verificação', 0, 13, NULL),
(6, 2, '2012-05-06', 'Não sei', 1, 20, 'Consertado'),
(7, 3, '2012-05-08', 'Verificação', 0, 6, NULL),
(8, 2, '2012-05-08', 'Verificação\r\n', 1, 24, 'Concluída'),
(9, 3, '2012-05-11', 'Verificar.', 0, 10, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_modulo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nome_modulo`) VALUES
(1, 'manutencoes'),
(2, 'chaves'),
(3, 'solicitacoes'),
(4, 'emprestimos'),
(5, 'permissoes'),
(6, 'usuarios');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos_permissoes`
--

CREATE TABLE IF NOT EXISTS `modulos_permissoes` (
  `id_modulo_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `modulo_id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_modulo_permissao`),
  KEY `fk_modulos_permissoes_modulos1` (`modulo_id`),
  KEY `fk_modulos_permissoes_permissoes1` (`permissao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `modulos_permissoes`
--

INSERT INTO `modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 1, 5),
(5, 2, 1),
(6, 2, 2),
(7, 3, 1),
(8, 3, 2),
(9, 3, 7),
(10, 4, 1),
(11, 4, 2),
(12, 4, 7),
(13, 5, 2),
(14, 6, 1),
(15, 6, 2),
(16, 6, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos_permissoes_usuarios`
--

CREATE TABLE IF NOT EXISTS `modulos_permissoes_usuarios` (
  `modulo_permissao_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`modulo_permissao_id`,`usuario_id`),
  KEY `fk_modulos_permissoes_usuarios_usuarios1` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos_permissoes_usuarios`
--

INSERT INTO `modulos_permissoes_usuarios` (`modulo_permissao_id`, `usuario_id`) VALUES
(1, 1),
(11, 1),
(13, 1),
(1, 2),
(2, 2),
(5, 2),
(11, 2),
(13, 2),
(14, 2),
(15, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(18, 3),
(1, 4),
(4, 4),
(13, 4),
(7, 5),
(8, 5),
(7, 6),
(4, 7),
(3, 8),
(4, 8),
(1, 9),
(2, 9),
(3, 9),
(4, 9),
(5, 9),
(6, 9),
(7, 9),
(8, 9),
(9, 9),
(10, 9),
(11, 9),
(12, 9),
(13, 9),
(14, 9),
(15, 9),
(16, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE IF NOT EXISTS `permissoes` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_permissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_permissao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id_permissao`, `nome_permissao`) VALUES
(1, 'visualizar'),
(2, 'gerenciar'),
(3, 'requerir'),
(4, 'aprovar'),
(5, 'realizar'),
(7, 'gerar'),
(8, 'Imprimir');

-- --------------------------------------------------------

--
-- Estrutura da tabela `req_manutencao`
--

CREATE TABLE IF NOT EXISTS `req_manutencao` (
  `id_requisicao` int(11) NOT NULL AUTO_INCREMENT,
  `dt_requisicao` date DEFAULT NULL,
  `equipamento_requisicao` varchar(200) DEFAULT NULL,
  `local_equipamento` varchar(255) DEFAULT NULL,
  `defeito_requisicao` varchar(255) DEFAULT NULL,
  `requisitante_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_requisicao`),
  KEY `fk_Manutencao_Professores1` (`requisitante_id`),
  KEY `fk_req_manutencao_estado_requisicoes1` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='tabela pra armazenar as requisições de manutenção' AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `req_manutencao`
--

INSERT INTO `req_manutencao` (`id_requisicao`, `dt_requisicao`, `equipamento_requisicao`, `local_equipamento`, `defeito_requisicao`, `requisitante_id`, `estado_id`, `deleted`) VALUES
(6, '2012-04-19', 'Computador 05', 'Laboratório 11', 'Não liga o mouse.', 3, 3, 0),
(9, '2012-04-20', 'Computador 10', 'Laboratório 20', 'Tela não liga.', 3, 1, 0),
(10, '2012-04-20', 'Computador 08', 'Laboratório 20', 'Lerdo :D', 2, 3, 0),
(11, '2012-04-21', 'Computador 01, 03, 10.', 'Laboratório 25', 'Computador 01 não liga e 03 e 04 estão lentos.', 3, 2, 0),
(12, '2012-04-21', 'Máquina do Café', 'Secretaria', 'Não sai café pow.', 3, 2, 0),
(13, '2012-04-21', 'Computador 1', 'Direção', 'Não liga.', 3, 2, 0),
(14, '2012-04-22', 'Internet', 'Laboratório 15', 'Sem Internet', 1, 2, 0),
(15, '2012-04-22', 'Data Show 3', 'Secretaria', 'Não liga', 5, 3, 0),
(16, '2012-04-24', 'Computador 11', 'Laboratório 13', 'Não liga', 3, 2, 0),
(17, '2012-04-25', 'Computador 10', 'Laboratório 40', 'Teclado estragado.', 2, 2, 0),
(18, '2012-05-06', 'TEST', 'TEST', 'TEST', 3, 5, 0),
(19, '2012-05-06', 'test2', 'test2', 'test2', 3, 2, 0),
(20, '2012-05-06', 'haha', 'haha', 'ahah', 3, 2, 0),
(21, '2012-05-06', 'Seila', 'Seila', 'Seila', 2, 5, 0),
(22, '2012-05-06', 'auhauha', 'uhauhau', 'uhauhau', 2, 5, 0),
(23, '2012-05-06', 'hjauhau', 'uhauahau', 'uhauahha', 2, 5, 0),
(24, '2012-05-06', 'auhau', 'huahauh', 'huahua', 2, 3, 0),
(25, '2012-05-08', 'Computador', 'Lab 30', 'Não liga', 2, 5, 0),
(26, '2012-05-11', 'Computador 30', 'Laboratório 20', 'Não liga.', 3, 2, 0),
(27, '2012-05-11', 'a', 'a', 'a', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `semestres`
--

CREATE TABLE IF NOT EXISTS `semestres` (
  `id_semestre` int(11) NOT NULL,
  `ano_semestre` varchar(45) NOT NULL,
  `discriminacao_semestre` char(1) NOT NULL,
  PRIMARY KEY (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_usuarios`
--

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id_tipo`, `nome_tipo`) VALUES
(1, 'Professor'),
(2, 'Operador'),
(3, 'Secretario'),
(4, 'Coopertec'),
(5, 'Resp manutencao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) NOT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  `email_usuario` varchar(60) NOT NULL,
  `telefone_usuario` int(11) NOT NULL,
  `celular_usuario` int(11) DEFAULT NULL,
  `dt_nascimento_usuario` date NOT NULL,
  `login_usuario` varchar(20) NOT NULL,
  `senha_usuario` varchar(25) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_tipos_usuarios1` (`tipo_usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `tipo_usuario_id`, `email_usuario`, `telefone_usuario`, `celular_usuario`, `dt_nascimento_usuario`, `login_usuario`, `senha_usuario`) VALUES
(1, 'Maria de Souza', 2, 'test@hotmail.com', 12312312, 21232133, '1992-10-10', 'teste', 'teste'),
(2, 'Luan Luiz Corrêa', 5, 'testando@gmail.com', 22222222, 12345324, '1991-10-11', 'bondcs', 'bond123'),
(3, 'Administrador', 2, 'admin@gmail.com', 33333323, 11222222, '1986-10-10', 'admin', 'admin'),
(4, 'João da Rosa Pereira', 3, 'joao@gmail.com', 12312344, 31233333, '1981-10-20', 'joaocs', '123'),
(5, 'Joana da Silva Pereira', 3, 'joana@gmail.com', 22222223, 33423423, '1987-10-10', 'joana', '123'),
(6, 'Roberto Vieira de Souza', 4, 'roberto@gmail.com', 32333232, 31231233, '1992-10-20', 'roberto', '123'),
(7, 'Lucas da Silva Santos', 1, 'lucas@gmail.com', 12312312, 12312312, '1977-10-10', 'lucas', 'lucas123'),
(8, 'Roberta Martins Corrêa', 1, 'roberta@gmail.com', 23123123, 12312312, '1982-10-20', 'roberta', 'roberta123'),
(9, 'Jarkko Ahola', 2, 'j.ahola@gmail.com', 36328877, 0, '1991-03-27', 'jahola', '1234');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `aquisicoes`
--
ALTER TABLE `aquisicoes`
  ADD CONSTRAINT `fk_aquisicoes_disciplinas1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aquisicoes_Professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aquisicoes_semestres1` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id_semestre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ctrl_chaves`
--
ALTER TABLE `ctrl_chaves`
  ADD CONSTRAINT `fk_Controle_laboratorios` FOREIGN KEY (`laboratorio_id`) REFERENCES `laboratorios` (`id_laboratorio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Controle_Professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `fk_disciplinas_cursos1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `disciplinas_usuarios`
--
ALTER TABLE `disciplinas_usuarios`
  ADD CONSTRAINT `fk_disciplinas_usuarios_disciplinas1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_disciplinas_usuarios_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `fk_emprestimos_usuarios1` FOREIGN KEY (`requisitante_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emprestimos_usuarios2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `item_aquisicao`
--
ALTER TABLE `item_aquisicao`
  ADD CONSTRAINT `fk_item_aquisicao_aquisicoes1` FOREIGN KEY (`aquisicao_id`) REFERENCES `aquisicoes` (`id_aquisicao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `itens_emprestimos`
--
ALTER TABLE `itens_emprestimos`
  ADD CONSTRAINT `fk_itens_emprestimos_emprestimos1` FOREIGN KEY (`emprestimos_id`) REFERENCES `emprestimos` (`id_emprestimo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD CONSTRAINT `fk_manutencoes_professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_manutencoes_req_manutencao1` FOREIGN KEY (`req_manutencao_id`) REFERENCES `req_manutencao` (`id_requisicao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `modulos_permissoes`
--
ALTER TABLE `modulos_permissoes`
  ADD CONSTRAINT `fk_modulos_permissoes_modulos1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modulos_permissoes_permissoes1` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id_permissao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `modulos_permissoes_usuarios`
--
ALTER TABLE `modulos_permissoes_usuarios`
  ADD CONSTRAINT `fk_modulos_permissoes_usuarios_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para a tabela `req_manutencao`
--
ALTER TABLE `req_manutencao`
  ADD CONSTRAINT `fk_Manutencao_Professores1` FOREIGN KEY (`requisitante_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_req_manutencao_estado_requisicoes1` FOREIGN KEY (`estado_id`) REFERENCES `estados_requisicoes` (`id_estado_requisicao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tipos_usuarios1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuarios` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
