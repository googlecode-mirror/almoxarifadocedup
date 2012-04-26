-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.20


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema s_almoxarifado
--

CREATE DATABASE IF NOT EXISTS s_almoxarifado;
USE s_almoxarifado;

--
-- Definition of table `aquisicoes`
--

DROP TABLE IF EXISTS `aquisicoes`;
CREATE TABLE `aquisicoes` (
  `id_aquisicao` int(11) NOT NULL,
  `fase_aquisicao` int(11) NOT NULL,
  `semestre_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  PRIMARY KEY (`id_aquisicao`),
  KEY `fk_aquisicoes_Professores1` (`professor_id`),
  KEY `fk_aquisicoes_semestres1` (`semestre_id`),
  KEY `fk_aquisicoes_disciplinas1` (`disciplina_id`),
  CONSTRAINT `fk_aquisicoes_disciplinas1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_aquisicoes_Professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aquisicoes_semestres1` FOREIGN KEY (`semestre_id`) REFERENCES `semestres` (`id_semestre`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aquisicoes`
--

/*!40000 ALTER TABLE `aquisicoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `aquisicoes` ENABLE KEYS */;


--
-- Definition of table `ctrl_chaves`
--

DROP TABLE IF EXISTS `ctrl_chaves`;
CREATE TABLE `ctrl_chaves` (
  `id_controle` int(11) NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) NOT NULL,
  `laboratorio_id` int(11) NOT NULL,
  `observacao_controle` varchar(255) DEFAULT NULL,
  `dt_inicial_controle` datetime NOT NULL,
  `dt_final_controle` datetime DEFAULT NULL,
  PRIMARY KEY (`id_controle`),
  KEY `fk_Controle_laboratorios` (`laboratorio_id`),
  KEY `fk_Controle_Professores1` (`professor_id`),
  CONSTRAINT `fk_Controle_laboratorios` FOREIGN KEY (`laboratorio_id`) REFERENCES `laboratorios` (`id_laboratorio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Controle_Professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ctrl_chaves`
--

/*!40000 ALTER TABLE `ctrl_chaves` DISABLE KEYS */;
/*!40000 ALTER TABLE `ctrl_chaves` ENABLE KEYS */;


--
-- Definition of table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(45) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cursos`
--

/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


--
-- Definition of table `disciplinas`
--

DROP TABLE IF EXISTS `disciplinas`;
CREATE TABLE `disciplinas` (
  `id_disciplina` int(11) NOT NULL AUTO_INCREMENT,
  `nome_disciplina` varchar(45) NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`id_disciplina`),
  KEY `fk_disciplinas_cursos1` (`curso_id`),
  CONSTRAINT `fk_disciplinas_cursos1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disciplinas`
--

/*!40000 ALTER TABLE `disciplinas` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplinas` ENABLE KEYS */;


--
-- Definition of table `disciplinas_usuarios`
--

DROP TABLE IF EXISTS `disciplinas_usuarios`;
CREATE TABLE `disciplinas_usuarios` (
  `disciplina_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`disciplina_id`,`usuario_id`),
  KEY `fk_disciplinas_usuarios_usuarios1` (`usuario_id`),
  KEY `fk_disciplinas_usuarios_disciplinas1` (`disciplina_id`),
  CONSTRAINT `fk_disciplinas_usuarios_disciplinas1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplinas_usuarios_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disciplinas_usuarios`
--

/*!40000 ALTER TABLE `disciplinas_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `disciplinas_usuarios` ENABLE KEYS */;


--
-- Definition of table `emprestimos`
--

DROP TABLE IF EXISTS `emprestimos`;
CREATE TABLE `emprestimos` (
  `id_emprestimo` int(11) NOT NULL,
  `dt_inicial_emprestimo` datetime NOT NULL,
  `requisitante_id` int(11) NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_emprestimo`),
  KEY `fk_emprestimos_usuarios1` (`requisitante_id`),
  KEY `fk_emprestimos_usuarios2` (`usuario_id_usuario`),
  CONSTRAINT `fk_emprestimos_usuarios1` FOREIGN KEY (`requisitante_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_emprestimos_usuarios2` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emprestimos`
--

/*!40000 ALTER TABLE `emprestimos` DISABLE KEYS */;
/*!40000 ALTER TABLE `emprestimos` ENABLE KEYS */;


--
-- Definition of table `estados_requisicoes`
--

DROP TABLE IF EXISTS `estados_requisicoes`;
CREATE TABLE `estados_requisicoes` (
  `id_estado_requisicao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_estado_requisicao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado_requisicao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados_requisicoes`
--

/*!40000 ALTER TABLE `estados_requisicoes` DISABLE KEYS */;
INSERT INTO `estados_requisicoes` (`id_estado_requisicao`,`nome_estado_requisicao`) VALUES 
 (1,'Aguardando aprovação'),
 (2,'Aprovada'),
 (3,'Em andamento'),
 (4,'Concluída'),
 (5,'Negada');
/*!40000 ALTER TABLE `estados_requisicoes` ENABLE KEYS */;


--
-- Definition of table `item_aquisicao`
--

DROP TABLE IF EXISTS `item_aquisicao`;
CREATE TABLE `item_aquisicao` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_item` varchar(150) NOT NULL,
  `quantidade_item` int(11) NOT NULL,
  `dt_requisicao_item` date NOT NULL,
  `dt_recebimento_item` date DEFAULT NULL,
  `aquisicao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_item_aquisicao_aquisicoes1` (`aquisicao_id`),
  CONSTRAINT `fk_item_aquisicao_aquisicoes1` FOREIGN KEY (`aquisicao_id`) REFERENCES `aquisicoes` (`id_aquisicao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_aquisicao`
--

/*!40000 ALTER TABLE `item_aquisicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_aquisicao` ENABLE KEYS */;


--
-- Definition of table `itens_emprestimos`
--

DROP TABLE IF EXISTS `itens_emprestimos`;
CREATE TABLE `itens_emprestimos` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_item` varchar(100) NOT NULL,
  `quantidade_item` int(11) NOT NULL,
  `dt_final` datetime NOT NULL,
  `emprestimos_id` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_itens_emprestimos_emprestimos1` (`emprestimos_id`),
  CONSTRAINT `fk_itens_emprestimos_emprestimos1` FOREIGN KEY (`emprestimos_id`) REFERENCES `emprestimos` (`id_emprestimo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itens_emprestimos`
--

/*!40000 ALTER TABLE `itens_emprestimos` DISABLE KEYS */;
/*!40000 ALTER TABLE `itens_emprestimos` ENABLE KEYS */;


--
-- Definition of table `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
CREATE TABLE `laboratorios` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nome_laboratorio` varchar(100) NOT NULL,
  `numero_laboratorio` int(11) DEFAULT NULL,
  `chave_laboratorio` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 -> chave disponivel\n1 -> chave indisponivel',
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laboratorios`
--

/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` (`id_laboratorio`,`nome_laboratorio`,`numero_laboratorio`,`chave_laboratorio`) VALUES 
 (1,'Automação',46,0),
 (2,'Hidraulica',47,0),
 (3,'Pneumática',48,0),
 (4,'Ajustagem',49,0),
 (5,'Fresagem',50,0),
 (6,'Desenho',51,0),
 (7,'Medidas Elétricas',52,0),
 (8,'Ensaios Eléricos',53,0),
 (9,'Metalografia',54,0),
 (10,'Marcenaria',55,0),
 (11,'Soldar',56,0),
 (12,'Máquinas Elétricas',58,0),
 (13,'Manutenção Mecânica',59,0),
 (14,'Comandos Elétricos II',60,0),
 (15,'Instalações Prediais II',61,0),
 (16,'Comandos Elétricos I',62,0),
 (17,'Tornearia',63,0),
 (18,'CNC',64,0),
 (19,'Eletrônica',19,0),
 (20,'Eletrônica II',20,0),
 (21,'Eletrônica III',45,0),
 (22,'Marcenaria II',0,0);
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;


--
-- Definition of table `manutencoes`
--

DROP TABLE IF EXISTS `manutencoes`;
CREATE TABLE `manutencoes` (
  `id_manutencao` int(11) NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) NOT NULL,
  `data_manutencao` date NOT NULL,
  `providencia_manutencao` text NOT NULL,
  `definitivo_manutencao` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 -> o problema não foi resolvido\n1 -> o problema foi resolvido',
  `req_manutencao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_manutencao`),
  KEY `fk_manutencoes_professores1` (`professor_id`),
  KEY `fk_manutencoes_req_manutencao1` (`req_manutencao_id`),
  CONSTRAINT `fk_manutencoes_professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_manutencoes_req_manutencao1` FOREIGN KEY (`req_manutencao_id`) REFERENCES `req_manutencao` (`id_requisicao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manutencoes`
--

/*!40000 ALTER TABLE `manutencoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `manutencoes` ENABLE KEYS */;


--
-- Definition of table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_modulo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modulos`
--

/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` (`id_modulo`,`nome_modulo`) VALUES 
 (1,'manutencoes'),
 (2,'chaves'),
 (3,'solicitacoes'),
 (4,'emprestimos'),
 (5,'permissoes'),
 (6,'usuarios');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;


--
-- Definition of table `modulos_permissoes`
--

DROP TABLE IF EXISTS `modulos_permissoes`;
CREATE TABLE `modulos_permissoes` (
  `id_modulo_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `modulo_id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_modulo_permissao`),
  KEY `fk_modulos_permissoes_modulos1` (`modulo_id`),
  KEY `fk_modulos_permissoes_permissoes1` (`permissao_id`),
  CONSTRAINT `fk_modulos_permissoes_modulos1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_modulos_permissoes_permissoes1` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id_permissao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modulos_permissoes`
--

/*!40000 ALTER TABLE `modulos_permissoes` DISABLE KEYS */;
INSERT INTO `modulos_permissoes` (`id_modulo_permissao`,`modulo_id`,`permissao_id`) VALUES 
 (1,1,1),
 (2,1,3),
 (3,1,4),
 (4,1,5),
 (5,2,1),
 (6,2,2),
 (7,3,1),
 (8,3,2),
 (9,3,7),
 (10,4,1),
 (11,4,2),
 (12,5,2),
 (13,6,1),
 (14,6,2),
 (15,6,8),
 (16,1,8),
 (17,2,9),
 (18,1,2);
/*!40000 ALTER TABLE `modulos_permissoes` ENABLE KEYS */;


--
-- Definition of table `modulos_permissoes_usuarios`
--

DROP TABLE IF EXISTS `modulos_permissoes_usuarios`;
CREATE TABLE `modulos_permissoes_usuarios` (
  `modulo_permissao_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`modulo_permissao_id`,`usuario_id`),
  KEY `fk_modulos_permissoes_usuarios_usuarios1` (`usuario_id`),
  CONSTRAINT `fk_modulos_permissoes_usuarios_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modulos_permissoes_usuarios`
--

/*!40000 ALTER TABLE `modulos_permissoes_usuarios` DISABLE KEYS */;
INSERT INTO `modulos_permissoes_usuarios` (`modulo_permissao_id`,`usuario_id`) VALUES 
 (1,1),
 (11,1),
 (13,1),
 (17,1),
 (1,2),
 (14,2),
 (16,2),
 (1,3),
 (2,3),
 (3,3),
 (4,3),
 (8,3),
 (13,3),
 (17,3),
 (1,4),
 (2,4),
 (3,4),
 (4,4),
 (5,4),
 (9,4),
 (1,5),
 (11,5),
 (13,5),
 (15,5),
 (17,5),
 (18,5),
 (13,6),
 (1,7),
 (2,7),
 (4,7),
 (5,7),
 (9,7),
 (1,8),
 (2,8),
 (3,8),
 (4,8),
 (6,8),
 (13,8),
 (15,8);
/*!40000 ALTER TABLE `modulos_permissoes_usuarios` ENABLE KEYS */;


--
-- Definition of table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE `permissoes` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_permissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissoes`
--

/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` (`id_permissao`,`nome_permissao`) VALUES 
 (1,'visualizar'),
 (2,'gerenciar'),
 (3,'requisitar'),
 (4,'aprovar'),
 (5,'realizar'),
 (7,'gerar'),
 (8,'Imprimir'),
 (9,'histórico');
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;


--
-- Definition of table `req_manutencao`
--

DROP TABLE IF EXISTS `req_manutencao`;
CREATE TABLE `req_manutencao` (
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
  KEY `fk_req_manutencao_estado_requisicoes1` (`estado_id`),
  CONSTRAINT `fk_Manutencao_Professores1` FOREIGN KEY (`requisitante_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_req_manutencao_estado_requisicoes1` FOREIGN KEY (`estado_id`) REFERENCES `estados_requisicoes` (`id_estado_requisicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='tabela pra armazenar as requisições de manutenção';

--
-- Dumping data for table `req_manutencao`
--

/*!40000 ALTER TABLE `req_manutencao` DISABLE KEYS */;
INSERT INTO `req_manutencao` (`id_requisicao`,`dt_requisicao`,`equipamento_requisicao`,`local_equipamento`,`defeito_requisicao`,`requisitante_id`,`estado_id`,`deleted`) VALUES 
 (6,'2012-04-19','Computador 05','Laboratório 11','Não liga o mouse.',3,1,0),
 (9,'2012-04-20','Computador 10','Laboratório 20','Tela não liga.',3,1,1),
 (10,'2012-04-20','Computador 08','Laboratório 20','Lerdo :D',2,3,0),
 (11,'2012-04-21','Computador 01, 03, 10.','Laboratório 25','Computador 01 não liga e 03 e 04 estão lentos.',3,1,1),
 (12,'2012-04-21','Máquina do Café','Secretaria','Não sai café pow.',3,1,1),
 (13,'2012-04-21','Computador 1','Direção','Não liga.',3,2,0),
 (14,'2012-04-22','Internet','Laboratório 15','Sem Internet',1,1,0),
 (15,'2012-04-22','Data Show 3','Secretaria','Não liga',5,1,0),
 (16,'2012-04-24','Computador 11','Laboratório 13','Não liga',3,1,0);
/*!40000 ALTER TABLE `req_manutencao` ENABLE KEYS */;


--
-- Definition of table `semestres`
--

DROP TABLE IF EXISTS `semestres`;
CREATE TABLE `semestres` (
  `id_semestre` int(11) NOT NULL,
  `ano_semestre` varchar(45) NOT NULL,
  `discriminacao_semestre` char(1) NOT NULL,
  PRIMARY KEY (`id_semestre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semestres`
--

/*!40000 ALTER TABLE `semestres` DISABLE KEYS */;
/*!40000 ALTER TABLE `semestres` ENABLE KEYS */;


--
-- Definition of table `tipos_usuarios`
--

DROP TABLE IF EXISTS `tipos_usuarios`;
CREATE TABLE `tipos_usuarios` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_usuarios`
--

/*!40000 ALTER TABLE `tipos_usuarios` DISABLE KEYS */;
INSERT INTO `tipos_usuarios` (`id_tipo`,`nome_tipo`) VALUES 
 (1,'Professor'),
 (2,'Operador'),
 (3,'Secretario'),
 (4,'Coopertec'),
 (5,'Resp manutencao');
/*!40000 ALTER TABLE `tipos_usuarios` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
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
  KEY `fk_usuarios_tipos_usuarios1` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuarios_tipos_usuarios1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuarios` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`,`nome_usuario`,`tipo_usuario_id`,`email_usuario`,`telefone_usuario`,`celular_usuario`,`dt_nascimento_usuario`,`login_usuario`,`senha_usuario`) VALUES 
 (1,'Maria de Souza',4,'test@hotmail.com',11111112,21232133,'1992-10-10','teste','teste'),
 (2,'Luan Luiz Corrêa',5,'testando@gmail.com',22222222,12345324,'1991-10-11','bondcs','bond123'),
 (3,'Santos de Souza ',3,'admin@gmail.com',33333323,11222222,'1986-10-10','admin','admin'),
 (4,'João da Rosa Pereira',3,'joao@gmail.com',12312344,31233333,'1981-10-20','joaocs','123'),
 (5,'Joana da Silva Pereira',3,'joana@gmail.com',22222223,33423423,'1987-10-10','joana','123'),
 (6,'Roberto Vieira de Souza',4,'roberto@gmail.com',12312333,31231233,'1992-10-20','roberto','123'),
 (7,'Lucas da Silva Santos',1,'lucas@gmail.com',12312312,12312312,'1977-10-10','lucas','lucas123'),
 (8,'Roberta Martins Corrêa',1,'roberta@gmail.com',23123123,12312312,'1982-10-20','roberta','roberta123');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;