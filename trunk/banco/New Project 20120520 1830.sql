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
  `id_aquisicao` int(11) NOT NULL AUTO_INCREMENT,
  `fase_id` int(11) NOT NULL,
  `semestre` varchar(10) NOT NULL,
  `requisitante_id` int(11) NOT NULL,
  `disciplina_id` int(11) NOT NULL,
  `dt_aquisicao_inicial` datetime NOT NULL,
  PRIMARY KEY (`id_aquisicao`),
  KEY `fk_aquisicoes_Professores1` (`requisitante_id`),
  KEY `fk_aquisicoes_semestres1` (`semestre`),
  KEY `fk_aquisicoes_disciplinas1` (`disciplina_id`),
  CONSTRAINT `fk_aquisicoes_disciplinas1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplinas` (`id_disciplina`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_aquisicoes_Professores1` FOREIGN KEY (`requisitante_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aquisicoes`
--

/*!40000 ALTER TABLE `aquisicoes` DISABLE KEYS */;
INSERT INTO `aquisicoes` (`id_aquisicao`,`fase_id`,`semestre`,`requisitante_id`,`disciplina_id`,`dt_aquisicao_inicial`) VALUES 
 (17,5,'2012 A',3,4,'2012-05-20 11:41:58'),
 (20,4,'2012 A',3,6,'2012-05-20 17:34:24'),
 (21,5,'2012 A',3,1,'2012-05-20 18:01:20'),
 (22,4,'2012 A',3,4,'2012-05-20 18:21:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ctrl_chaves`
--

/*!40000 ALTER TABLE `ctrl_chaves` DISABLE KEYS */;
INSERT INTO `ctrl_chaves` (`id_controle`,`professor_id`,`laboratorio_id`,`observacao_controle`,`dt_inicial_controle`,`dt_final_controle`) VALUES 
 (1,9,2,NULL,'2012-05-05 17:33:44','2012-05-08 18:06:39'),
 (2,4,4,NULL,'2012-05-05 17:41:51','2012-05-06 18:27:24'),
 (3,9,3,NULL,'2012-06-05 15:24:57','2012-05-08 18:16:57'),
 (4,9,10,NULL,'2012-08-05 10:36:14','2012-05-18 19:38:21'),
 (5,6,22,NULL,'2012-08-05 18:55:38','2012-05-14 20:29:49'),
 (6,9,1,NULL,'2012-11-05 19:45:27',NULL),
 (7,8,19,NULL,'2012-11-05 20:26:23','2012-05-11 20:39:35'),
 (8,8,19,NULL,'0201-11-05 20:35:46','2012-05-11 20:39:35'),
 (9,8,19,NULL,'2012-11-05 20:39:26','2012-05-11 20:39:35'),
 (10,9,16,NULL,'2012-11-05 20:40:48','2012-05-11 20:41:04'),
 (11,7,11,NULL,'2012-11-05 21:23:16','2012-05-18 08:53:42'),
 (12,7,22,NULL,'2012-05-16 21:24:32',NULL),
 (13,5,19,'test2','2012-05-16 21:31:50',NULL),
 (14,7,10,'test3','2012-05-16 21:32:04','2012-05-18 19:38:21'),
 (15,5,5,'test4','2012-05-16 21:32:16',NULL),
 (16,7,11,NULL,'2012-05-18 18:52:26',NULL),
 (17,8,15,NULL,'2012-05-19 10:44:23',NULL),
 (18,8,26,NULL,'2012-05-20 09:36:37','2012-05-20 09:36:59');
/*!40000 ALTER TABLE `ctrl_chaves` ENABLE KEYS */;


--
-- Definition of table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(45) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cursos`
--

/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`id_curso`,`nome_curso`) VALUES 
 (1,'Informática'),
 (2,'Eletrônica'),
 (3,'Mecânica');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;


--
-- Definition of table `cursos_fases`
--

DROP TABLE IF EXISTS `cursos_fases`;
CREATE TABLE `cursos_fases` (
  `curso_id` int(11) NOT NULL,
  `fase_id` int(11) NOT NULL,
  PRIMARY KEY (`curso_id`,`fase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cursos_fases`
--

/*!40000 ALTER TABLE `cursos_fases` DISABLE KEYS */;
INSERT INTO `cursos_fases` (`curso_id`,`fase_id`) VALUES 
 (1,1),
 (1,2),
 (1,4),
 (1,5),
 (1,7),
 (1,8),
 (1,10),
 (1,11),
 (2,1),
 (2,2),
 (2,3),
 (2,4),
 (2,5),
 (2,6),
 (3,1),
 (3,2),
 (3,4),
 (3,5),
 (4,7),
 (5,8);
/*!40000 ALTER TABLE `cursos_fases` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disciplinas`
--

/*!40000 ALTER TABLE `disciplinas` DISABLE KEYS */;
INSERT INTO `disciplinas` (`id_disciplina`,`nome_disciplina`,`curso_id`) VALUES 
 (1,'Programação',1),
 (2,'Soldagem',3),
 (3,'Matemática',2),
 (4,'HTML',1),
 (5,'Física',3),
 (6,'Projetos',2);
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
  `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT,
  `dt_inicial_emprestimo` datetime NOT NULL,
  `requisitante_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id_emprestimo`),
  KEY `fk_emprestimos_usuarios1` (`requisitante_id`),
  KEY `fk_emprestimos_usuarios2` (`usuario_id`),
  CONSTRAINT `fk_emprestimos_usuarios1` FOREIGN KEY (`requisitante_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_emprestimos_usuarios2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emprestimos`
--

/*!40000 ALTER TABLE `emprestimos` DISABLE KEYS */;
INSERT INTO `emprestimos` (`id_emprestimo`,`dt_inicial_emprestimo`,`requisitante_id`,`usuario_id`) VALUES 
 (2,'2012-06-05 14:05:46',9,3),
 (4,'2012-06-05 14:05:32',8,3),
 (5,'2012-06-05 14:05:37',5,3),
 (6,'2012-06-05 18:05:22',5,2),
 (7,'2012-06-05 18:05:03',8,2),
 (8,'2012-08-05 10:05:37',9,3),
 (9,'2012-08-05 10:05:53',9,3),
 (10,'2012-10-05 21:05:52',5,3),
 (11,'2012-10-05 21:05:08',1,3),
 (12,'2012-10-05 21:05:51',8,3),
 (13,'2012-10-05 21:05:09',6,3),
 (14,'2012-11-05 19:05:40',7,3),
 (15,'2012-11-05 19:05:32',6,3),
 (23,'2012-05-18 19:05:53',7,3),
 (28,'2012-05-18 19:05:39',7,3),
 (29,'2012-05-19 18:05:41',8,3),
 (30,'2012-05-19 19:05:21',11,3);
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
-- Definition of table `fases`
--

DROP TABLE IF EXISTS `fases`;
CREATE TABLE `fases` (
  `id_fase` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_fase`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fases`
--

/*!40000 ALTER TABLE `fases` DISABLE KEYS */;
INSERT INTO `fases` (`id_fase`,`nome`) VALUES 
 (1,'101'),
 (2,'102'),
 (3,'103'),
 (4,'201'),
 (5,'202'),
 (6,'203'),
 (7,'301'),
 (8,'302'),
 (9,'303'),
 (10,'401'),
 (11,'402'),
 (12,'403');
/*!40000 ALTER TABLE `fases` ENABLE KEYS */;


--
-- Definition of table `item_aquisicao`
--

DROP TABLE IF EXISTS `item_aquisicao`;
CREATE TABLE `item_aquisicao` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_item` varchar(150) NOT NULL,
  `quantidade_item` int(11) NOT NULL,
  `dt_recebimento_item` date DEFAULT NULL,
  `aquisicao_id` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_item_aquisicao_aquisicoes1` (`aquisicao_id`),
  CONSTRAINT `fk_item_aquisicao_aquisicoes1` FOREIGN KEY (`aquisicao_id`) REFERENCES `aquisicoes` (`id_aquisicao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_aquisicao`
--

/*!40000 ALTER TABLE `item_aquisicao` DISABLE KEYS */;
INSERT INTO `item_aquisicao` (`id_item`,`descricao_item`,`quantidade_item`,`dt_recebimento_item`,`aquisicao_id`) VALUES 
 (17,'Lapis',10,NULL,17),
 (21,'Borracha',50,NULL,20),
 (22,'Placa mãe',1,NULL,21),
 (23,'Processador',1,NULL,21),
 (24,'Gabinete',1,NULL,21),
 (25,'Placa mãe',1,NULL,22),
 (26,'Borracha',1,NULL,22);
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
  `entregue` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_item`),
  KEY `fk_itens_emprestimos_emprestimos1` (`emprestimos_id`),
  CONSTRAINT `fk_itens_emprestimos_emprestimos1` FOREIGN KEY (`emprestimos_id`) REFERENCES `emprestimos` (`id_emprestimo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itens_emprestimos`
--

/*!40000 ALTER TABLE `itens_emprestimos` DISABLE KEYS */;
INSERT INTO `itens_emprestimos` (`id_item`,`descricao_item`,`quantidade_item`,`dt_final`,`emprestimos_id`,`entregue`) VALUES 
 (3,'Alicate',1,'2012-06-05 10:00:00',2,1),
 (4,'Lapis',5,'2012-06-05 10:00:00',2,0),
 (5,'Alicate',1,'2012-01-05 16:00:00',4,1),
 (6,'Fio',1,'0000-00-00 00:00:00',4,1),
 (7,'Alicate',1,'2012-06-05 12:00:00',5,0),
 (8,'Corda 100m',1,'0000-00-00 00:00:00',5,1),
 (9,'Chave de Fenda',1,'2012-07-05 10:30:00',6,1),
 (10,'Fio 5 metros',1,'0000-00-00 00:00:00',7,1),
 (11,'Alicate',1,'2012-11-05 10:00:00',8,1),
 (12,'Alicate',1,'0000-00-00 00:00:00',9,1),
 (13,'Corda 100m',5,'2012-02-05 14:00:00',9,1),
 (14,'Fio',10,'0000-00-00 00:00:00',9,1),
 (15,'123123',1,'0000-00-00 00:00:00',10,1),
 (16,'12312',1,'0000-00-00 00:00:00',10,1),
 (17,'asdasd',1,'2012-01-05 00:00:00',10,1),
 (18,'1',1,'2012-01-05 00:00:00',11,1),
 (19,'123123',1,'2012-07-05 15:00:00',12,0),
 (20,'12312',1,'2012-07-05 16:00:00',13,1),
 (21,'Lapis',1,'2012-01-05 15:00:00',14,1),
 (22,'Caneta',1,'0000-00-00 00:00:00',15,1),
 (23,'Chave Fenda',5,'2012-05-18 00:00:00',23,1),
 (24,'Chave Fenda',5,'2012-05-18 10:00:00',28,1),
 (25,'Lapis',10,'2012-07-12 16:15:00',29,0),
 (26,'Chave Fenda',5,'2012-05-19 01:15:00',30,0);
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
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `laboratorios`
--

/*!40000 ALTER TABLE `laboratorios` DISABLE KEYS */;
INSERT INTO `laboratorios` (`id_laboratorio`,`nome_laboratorio`,`numero_laboratorio`,`chave_laboratorio`,`deleted`) VALUES 
 (1,'Automação',46,1,0),
 (2,'Hidraulica',47,0,0),
 (3,'Pneumática',48,0,0),
 (4,'Ajustagem',49,0,0),
 (5,'Fresagem',50,1,0),
 (6,'Desenho',51,0,0),
 (7,'Medidas Elétricas',52,0,0),
 (8,'Ensaios Eléricos',53,0,0),
 (9,'Metalografia',54,0,0),
 (10,'Marcenaria',55,0,0),
 (11,'Soldar',56,1,0),
 (12,'Máquinas Elétricas',58,0,0),
 (13,'Manutenção Mecânica',59,0,0),
 (14,'Comandos Elétricos II',60,0,0),
 (15,'Instalações Prediais II',61,1,0),
 (16,'Comandos Elétricos I',62,0,0),
 (17,'Tornearia',63,0,0),
 (18,'CNC',64,0,1),
 (19,'Eletrônica',19,1,0),
 (20,'Eletrônica II',20,0,0),
 (21,'Eletrônica III',45,0,0),
 (22,'Marcenaria II',0,1,1),
 (23,'Informática II',70,0,1),
 (24,'CNC',67,0,0),
 (25,'a',70,0,1),
 (26,'Marcenaria',0,0,0);
/*!40000 ALTER TABLE `laboratorios` ENABLE KEYS */;


--
-- Definition of table `manutencoes`
--

DROP TABLE IF EXISTS `manutencoes`;
CREATE TABLE `manutencoes` (
  `id_manutencao` int(11) NOT NULL AUTO_INCREMENT,
  `data_manutencao` datetime NOT NULL,
  `definitivo_manutencao` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 -> o problema não foi resolvido\n1 -> o problema foi resolvido',
  `req_manutencao_id` int(11) NOT NULL,
  `providencia_manutencao` varchar(255) NOT NULL,
  `responsavel_id` int(11) NOT NULL,
  PRIMARY KEY (`id_manutencao`),
  KEY `fk_manutencoes_req_manutencao1` (`req_manutencao_id`),
  CONSTRAINT `fk_manutencoes_req_manutencao1` FOREIGN KEY (`req_manutencao_id`) REFERENCES `req_manutencao` (`id_requisicao`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manutencoes`
--

/*!40000 ALTER TABLE `manutencoes` DISABLE KEYS */;
INSERT INTO `manutencoes` (`id_manutencao`,`data_manutencao`,`definitivo_manutencao`,`req_manutencao_id`,`providencia_manutencao`,`responsavel_id`) VALUES 
 (15,'2012-05-16 00:00:00',1,28,'',0),
 (16,'2012-05-16 00:00:00',1,29,'',0),
 (17,'2012-05-17 00:00:00',1,30,'',0),
 (18,'2012-05-17 00:00:00',1,30,'É preciso formatar',3),
 (19,'2012-05-17 00:00:00',1,30,'Funcionando',3),
 (20,'2012-05-17 00:00:00',1,31,'Arrumado',3),
 (21,'2012-05-17 00:00:00',1,32,'Será formatado',3),
 (22,'2012-05-17 00:00:00',1,32,'Trocar memória',3),
 (23,'2012-05-17 00:00:00',1,32,'Concluido',3),
 (24,'2012-05-17 00:00:00',1,33,'Test',3),
 (25,'2012-05-17 00:00:00',1,33,'Test2',3),
 (26,'2012-05-17 00:00:00',1,33,'lalla',3),
 (27,'2012-05-17 00:00:00',0,34,'Computador será formatado.',3),
 (28,'2012-05-17 22:31:36',1,33,'test3',3),
 (29,'2012-05-17 22:39:15',0,34,'Verifiquei que o computador necessita de uma nova memória.',2),
 (30,'2012-05-18 08:01:02',1,33,'ha',3),
 (31,'2012-05-18 08:52:21',0,35,'ha pegadinha do malandroo',3),
 (32,'2012-05-18 19:34:35',1,36,'Tentei consertar mais não deu certo',3),
 (33,'2012-05-18 19:35:24',1,36,'Tive que formatar a máquina.',3),
 (34,'2012-05-20 18:15:50',1,33,'Consertado',3),
 (35,'2012-05-20 18:20:41',1,37,'Sei la',3);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
 (12,4,7),
 (13,5,2),
 (14,6,1),
 (15,6,2),
 (16,6,8);
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
 (1,2),
 (2,2),
 (4,2),
 (5,2),
 (7,2),
 (11,2),
 (13,2),
 (16,2),
 (1,3),
 (2,3),
 (3,3),
 (4,3),
 (5,3),
 (6,3),
 (7,3),
 (8,3),
 (9,3),
 (10,3),
 (11,3),
 (12,3),
 (13,3),
 (14,3),
 (15,3),
 (16,3),
 (18,3),
 (1,4),
 (4,4),
 (13,4),
 (7,5),
 (8,5),
 (7,6),
 (4,7),
 (3,8),
 (4,8),
 (1,9),
 (2,9),
 (3,9),
 (4,9),
 (5,9),
 (6,9),
 (7,9),
 (8,9),
 (9,9),
 (10,9),
 (11,9),
 (12,9),
 (13,9),
 (14,9),
 (15,9),
 (16,9),
 (10,11);
/*!40000 ALTER TABLE `modulos_permissoes_usuarios` ENABLE KEYS */;


--
-- Definition of table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE `permissoes` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_permissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissoes`
--

/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` (`id_permissao`,`nome_permissao`) VALUES 
 (1,'visualizar'),
 (2,'gerenciar'),
 (3,'requerir'),
 (4,'aprovar'),
 (5,'realizar'),
 (7,'gerar'),
 (8,'Imprimir');
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;


--
-- Definition of table `providencia_manu`
--

DROP TABLE IF EXISTS `providencia_manu`;
CREATE TABLE `providencia_manu` (
  `id_providencia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_providencia` varchar(255) NOT NULL,
  `manutencao_id` int(11) NOT NULL,
  `data_providencia` datetime NOT NULL,
  `responsavel_id` int(11) NOT NULL,
  PRIMARY KEY (`id_providencia`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `providencia_manu`
--

/*!40000 ALTER TABLE `providencia_manu` DISABLE KEYS */;
INSERT INTO `providencia_manu` (`id_providencia`,`descricao_providencia`,`manutencao_id`,`data_providencia`,`responsavel_id`) VALUES 
 (3,'O computador será formatado amanhã',28,'2012-05-16 20:46:17',9),
 (4,'Computador Formatado',28,'2012-05-16 20:51:13',9),
 (5,'aaaa',29,'2012-05-16 20:59:13',9),
 (6,'hehe',29,'2012-05-16 21:00:57',9),
 (7,'aaaa',29,'2012-05-16 21:03:37',9),
 (8,'aaaa',29,'2012-05-16 21:05:11',9),
 (9,'aaaa',29,'2012-05-16 21:05:14',9),
 (10,'a',29,'2012-05-16 21:08:01',9),
 (11,'Necessário fazer formatação',30,'2012-05-17 07:56:07',3),
 (12,'Troca de memória',30,'2012-05-17 08:02:47',3),
 (13,'Sei la',30,'2012-05-17 08:03:32',3),
 (14,'Agora eu sei',30,'2012-05-17 08:03:54',3),
 (15,'Agora vai',30,'2012-05-17 09:02:23',3);
/*!40000 ALTER TABLE `providencia_manu` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='tabela pra armazenar as requisições de manutenção';

--
-- Dumping data for table `req_manutencao`
--

/*!40000 ALTER TABLE `req_manutencao` DISABLE KEYS */;
INSERT INTO `req_manutencao` (`id_requisicao`,`dt_requisicao`,`equipamento_requisicao`,`local_equipamento`,`defeito_requisicao`,`requisitante_id`,`estado_id`,`deleted`) VALUES 
 (28,'2012-05-16','Computador 01','Laboratório 10','Não liga',9,4,0),
 (29,'2012-05-16','test','test','test',9,4,0),
 (30,'2012-05-17','Computador 07','Laboratório 40','Não liga',3,4,0),
 (31,'2012-05-17','test1','test1','test1',3,4,0),
 (32,'2012-05-17','test2','test2','test2',3,4,0),
 (33,'2012-05-17','Computador 03','Laboratório 15','Não liga',3,4,0),
 (34,'2012-05-17','Test2','Test2','Test2',3,3,0),
 (35,'2012-05-18','Computador 03','Laboratório 15','Nao liga porque um pertubado estava comendo em cima do pc na hora dor ecreio daii FUUUUUUDEUUUUUUUU',3,3,0),
 (36,'2012-05-18','Computador 15','Laboratório 30','O computador apresenta um erro na tela e não inicia.',3,4,0),
 (37,'2012-05-18','Test','test','test',3,4,0);
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
  `celular_usuario` varchar(11) DEFAULT NULL,
  `dt_nascimento_usuario` date NOT NULL,
  `login_usuario` varchar(20) NOT NULL,
  `senha_usuario` varchar(25) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_tipos_usuarios1` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuarios_tipos_usuarios1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuarios` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`,`nome_usuario`,`tipo_usuario_id`,`email_usuario`,`telefone_usuario`,`celular_usuario`,`dt_nascimento_usuario`,`login_usuario`,`senha_usuario`) VALUES 
 (1,'Maria de Souza',2,'test@hotmail.com',12312312,'21232133','1992-10-10','teste','teste'),
 (2,'Luan Luiz Corrêa',5,'testando@gmail.com',22222222,'12345324','1991-10-11','bondcs','bond123'),
 (3,'Administrador',4,'admin@gmail.com',33333324,'','1986-10-10','admin','admin'),
 (4,'João da Rosa Pereira',3,'joao@gmail.com',12312344,'31233333','1981-10-20','joaocs','123'),
 (5,'Joana da Silva Pereira',3,'joana@gmail.com',22222223,'33423423','1987-10-10','joana','123'),
 (6,'Roberto Vieira de Souza',4,'roberto@gmail.com',32333232,'31231233','1992-10-20','roberto','123'),
 (7,'Lucas da Silva Santos',1,'lucas@gmail.com',36322848,'12312312','1977-10-10','lucas','lucas123'),
 (8,'Roberta Martins Corrêa',1,'roberta@gmail.com',23123123,'12312312','1982-10-20','roberta','roberta123'),
 (9,'Jarkko Ahola',4,'j.ahola@gmail.com',36328876,'','1991-03-27','jahola','1234'),
 (10,'Maria Nascimento',1,'mariatb@hotmail.com',23232132,'','1992-10-10','mariacs','maria123'),
 (11,'test',1,'testando@globo.com',22222222,'','1992-10-10','abc123','123');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;