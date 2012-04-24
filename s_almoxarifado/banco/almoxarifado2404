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
-- Create schema almo
--

CREATE DATABASE IF NOT EXISTS almo;
USE almo;

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
  `dt_final_emprestimo` datetime DEFAULT NULL,
  `descricao_emprestimo` varchar(100) NOT NULL,
  `quant_emprestimo` int(11) NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados_requisicoes`
--

/*!40000 ALTER TABLE `estados_requisicoes` DISABLE KEYS */;
INSERT INTO `estados_requisicoes` (`id_estado_requisicao`,`nome_estado_requisicao`) VALUES 
 (1,'Aguardando aprovação'),
 (2,'Negada'),
 (3,'Aprovada'),
 (4,'Concluída'),
 (5,'Aguardando aprovação'),
 (6,'Negada'),
 (7,'Aprovada'),
 (8,'Concluída');
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
-- Definition of table `laboratorios`
--

DROP TABLE IF EXISTS `laboratorios`;
CREATE TABLE `laboratorios` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nome_laboratorio` varchar(100) NOT NULL,
  `numero_laboratorio` int(11) DEFAULT NULL,
  `chave_laboratorio` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 -> chave disponivel\n1 -> chave indisponivel',
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

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
 (22,'Automação',46,0),
 (23,'Hidraulica',47,0),
 (24,'Pneumática',48,0),
 (25,'Ajustagem',49,0),
 (26,'Fresagem',50,0),
 (27,'Desenho',51,0),
 (28,'Medidas Elétricas',52,0),
 (29,'Ensaios Eléricos',53,0),
 (30,'Metalografia',54,0),
 (31,'Marcenaria',55,0),
 (32,'Soldar',56,0),
 (33,'Máquinas Elétricas',58,0),
 (34,'Manutenção Mecânica',59,0),
 (35,'Comandos Elétricos II',60,0),
 (36,'Instalações Prediais II',61,0),
 (37,'Comandos Elétricos I',62,0),
 (38,'Tornearia',63,0),
 (39,'CNC',64,0),
 (40,'Eletrônica',19,0),
 (41,'Eletrônica II',20,0),
 (42,'Eletrônica III',45,0);
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
-- Definition of table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE `permissoes` (
  `id_permissao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_permissao` varchar(45) NOT NULL,
  `descricao_permissao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissoes`
--

/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` (`id_permissao`,`nome_permissao`,`descricao_permissao`) VALUES 
 (1,'requisitarManutencao',NULL),
 (2,'aprovarManutencao',NULL),
 (3,'realizarManutencao',NULL),
 (4,'visualizarpendentesManutencao',NULL),
 (5,'visualizarhistoricoManutencao',NULL),
 (6,'visualizarChaves',NULL),
 (7,'gerenciarChaves',NULL),
 (8,'vizualizarSolicitacoes',NULL),
 (9,'gerarSolicitacoes',NULL),
 (10,'imprimirSolicitacoes',NULL),
 (11,'gerenciarSolicitacoes',NULL),
 (12,'visualizarEmprestimos',NULL),
 (13,'gerenciarEmprestimos',NULL),
 (14,'visualizarPermissoes',NULL),
 (15,'gerenciarPermissoes',NULL),
 (16,'visualizarMembros',NULL),
 (17,'gerenciarMembros',NULL),
 (18,'modificarMembros',NULL);
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;


--
-- Definition of table `req_manutencao`
--

DROP TABLE IF EXISTS `req_manutencao`;
CREATE TABLE `req_manutencao` (
  `id_requisicao` int(11) NOT NULL AUTO_INCREMENT,
  `dt_requisicao` date DEFAULT NULL,
  `equipamento_requisicao` varchar(200) DEFAULT NULL,
  `defeito_requisicao` varchar(255) DEFAULT NULL,
  `professor_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  PRIMARY KEY (`id_requisicao`),
  KEY `fk_Manutencao_Professores1` (`professor_id`),
  KEY `fk_req_manutencao_estado_requisicoes1` (`estado_id`),
  CONSTRAINT `fk_Manutencao_Professores1` FOREIGN KEY (`professor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_req_manutencao_estado_requisicoes1` FOREIGN KEY (`estado_id`) REFERENCES `estados_requisicoes` (`id_estado_requisicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tabela pra armazenar as requisições de manutenção';

--
-- Dumping data for table `req_manutencao`
--

/*!40000 ALTER TABLE `req_manutencao` DISABLE KEYS */;
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
 (5,'Resp Manutencao');
/*!40000 ALTER TABLE `tipos_usuarios` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(100) NOT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  `email_usuario` varchar(70) NOT NULL,
  `telefone_usuario` int(11) NOT NULL,
  `celular_usuario` int(11) DEFAULT NULL,
  `dt_nascimento_usuario` date NOT NULL,
  `login_usuario` varchar(20) NOT NULL,
  `senha_usuario` varchar(25) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_tipos_usuarios1` (`tipo_usuario_id`),
  CONSTRAINT `fk_usuarios_tipos_usuarios1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipos_usuarios` (`id_tipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`,`nome_usuario`,`tipo_usuario_id`,`email_usuario`,`telefone_usuario`,`celular_usuario`,`dt_nascimento_usuario`,`login_usuario`,`senha_usuario`) VALUES 
 (1,'Administrador',2,'admin@gmail.com',33333335,12321312,'0000-00-00','admin','admin'),
 (2,'testando',5,'testando@gmail.com',22222222,11111111,'0000-00-00','testando','testando'),
 (3,'test',1,'test@gmail.com',33333333,21312312,'0000-00-00','test','test'),
 (4,'user',2,'user@gmail.com',44444444,12312333,'0000-00-00','user','user'),
 (7,'Luan Luiz Corrêa',1,'luanlc@hotmail.com',36322848,91073165,'1993-01-01','luan','luan123'),
 (8,'Maria de Souza',3,'maria@gmail.com',11111111,22222222,'1992-01-01','maria','maria'),
 (9,'Lucas Vieira',2,'lucas@gmail.com',55555555,44444444,'1992-02-02','lucascs','lucas123'),
 (10,'test02',1,'test01@hotmail.com',13123123,31231231,'1990-10-20','test01','test123'),
 (11,'Maria da Silva',2,'maria@hotmail.com',12312312,12312123,'1983-10-20','mariacs','maria123'),
 (12,'João',1,'joao@gmail.com',12312312,31231312,'1950-10-20','joao1','123'),
 (14,'Juca',1,'juca@hotmail.com',12312312,12312312,'1960-10-20','juca','123');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;


--
-- Definition of table `usuarios_permissoes`
--

DROP TABLE IF EXISTS `usuarios_permissoes`;
CREATE TABLE `usuarios_permissoes` (
  `usuario_id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`permissao_id`),
  KEY `fk_usuarios_permissoes_permissoes1` (`permissao_id`),
  KEY `fk_usuarios_permissoes_usuarios1` (`usuario_id`),
  CONSTRAINT `fk_usuarios_permissoes_permissoes1` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id_permissao`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_permissoes_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios_permissoes`
--

/*!40000 ALTER TABLE `usuarios_permissoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios_permissoes` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
