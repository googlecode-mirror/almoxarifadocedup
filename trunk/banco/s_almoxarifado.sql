SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `s_almoxarifado` ;
CREATE SCHEMA IF NOT EXISTS `s_almoxarifado` ;
USE `s_almoxarifado` ;

-- -----------------------------------------------------
-- Table `s_almoxarifado`.`laboratorios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`laboratorios` (
  `id_laboratorio` INT NOT NULL AUTO_INCREMENT ,
  `nome_laboratorio` VARCHAR(100) NOT NULL ,
  `numero_laboratorio` INT NULL ,
  `chave_laboratorio` TINYINT(1)  NOT NULL DEFAULT 0 COMMENT '0 -> chave disponivel\n1 -> chave indisponivel' ,
  PRIMARY KEY (`id_laboratorio`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`tipos_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`tipos_usuarios` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT ,
  `nome_tipo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_tipo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `nome_usuario` VARCHAR(100) NOT NULL ,
  `tipo_usuario_id` INT NOT NULL ,
  `login_usuario` VARCHAR(20) NOT NULL ,
  `senha_usuario` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`id_usuario`) ,
  INDEX `fk_usuarios_tipos_usuarios1` (`tipo_usuario_id` ASC) ,
  CONSTRAINT `fk_usuarios_tipos_usuarios1`
    FOREIGN KEY (`tipo_usuario_id` )
    REFERENCES `s_almoxarifado`.`tipos_usuarios` (`id_tipo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`ctrl_chaves`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`ctrl_chaves` (
  `id_controle` INT NOT NULL AUTO_INCREMENT ,
  `professor_id` INT NOT NULL ,
  `laboratorio_id` INT NOT NULL ,
  `observacao_controle` VARCHAR(255) NULL ,
  `dt_inicial_controle` DATETIME NOT NULL ,
  `dt_final_controle` DATETIME NULL ,
  PRIMARY KEY (`id_controle`) ,
  INDEX `fk_Controle_laboratorios` (`laboratorio_id` ASC) ,
  INDEX `fk_Controle_Professores1` (`professor_id` ASC) ,
  CONSTRAINT `fk_Controle_laboratorios`
    FOREIGN KEY (`laboratorio_id` )
    REFERENCES `s_almoxarifado`.`laboratorios` (`id_laboratorio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Controle_Professores1`
    FOREIGN KEY (`professor_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`estados_requisicoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`estados_requisicoes` (
  `id_estado_requisicao` INT NOT NULL AUTO_INCREMENT ,
  `nome_estado_requisicao` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_estado_requisicao`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`req_manutencao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`req_manutencao` (
  `id_requisicao` INT NOT NULL AUTO_INCREMENT ,
  `dt_requisicao` DATE NULL ,
  `equipamento_requisicao` VARCHAR(200) NULL ,
  `defeito_requisicao` VARCHAR(255) NULL ,
  `professor_id` INT NOT NULL ,
  `estado_id` INT NOT NULL ,
  PRIMARY KEY (`id_requisicao`) ,
  INDEX `fk_Manutencao_Professores1` (`professor_id` ASC) ,
  INDEX `fk_req_manutencao_estado_requisicoes1` (`estado_id` ASC) ,
  CONSTRAINT `fk_Manutencao_Professores1`
    FOREIGN KEY (`professor_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_req_manutencao_estado_requisicoes1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `s_almoxarifado`.`estados_requisicoes` (`id_estado_requisicao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'tabela pra armazenar as requisições de manutenção' ;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`semestres`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`semestres` (
  `id_semestre` INT NOT NULL ,
  `ano_semestre` VARCHAR(45) NOT NULL ,
  `discriminacao_semestre` CHAR(1) NOT NULL ,
  PRIMARY KEY (`id_semestre`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`cursos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`cursos` (
  `id_curso` INT NOT NULL ,
  `nome_curso` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_curso`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`disciplinas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`disciplinas` (
  `id_disciplina` INT NOT NULL AUTO_INCREMENT ,
  `nome_disciplina` VARCHAR(45) NOT NULL ,
  `curso_id` INT NOT NULL ,
  PRIMARY KEY (`id_disciplina`) ,
  INDEX `fk_disciplinas_cursos1` (`curso_id` ASC) ,
  CONSTRAINT `fk_disciplinas_cursos1`
    FOREIGN KEY (`curso_id` )
    REFERENCES `s_almoxarifado`.`cursos` (`id_curso` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`aquisicoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`aquisicoes` (
  `id_aquisicao` INT NOT NULL ,
  `fase_aquisicao` INT NOT NULL ,
  `semestre_id` INT NOT NULL ,
  `professor_id` INT NOT NULL ,
  `disciplina_id` INT NOT NULL ,
  PRIMARY KEY (`id_aquisicao`) ,
  INDEX `fk_aquisicoes_Professores1` (`professor_id` ASC) ,
  INDEX `fk_aquisicoes_semestres1` (`semestre_id` ASC) ,
  INDEX `fk_aquisicoes_disciplinas1` (`disciplina_id` ASC) ,
  CONSTRAINT `fk_aquisicoes_Professores1`
    FOREIGN KEY (`professor_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aquisicoes_semestres1`
    FOREIGN KEY (`semestre_id` )
    REFERENCES `s_almoxarifado`.`semestres` (`id_semestre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aquisicoes_disciplinas1`
    FOREIGN KEY (`disciplina_id` )
    REFERENCES `s_almoxarifado`.`disciplinas` (`id_disciplina` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`item_aquisicao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`item_aquisicao` (
  `id_item` INT NOT NULL AUTO_INCREMENT ,
  `descricao_item` VARCHAR(150) NOT NULL ,
  `quantidade_item` INT NOT NULL ,
  `dt_requisicao_item` DATE NOT NULL ,
  `dt_recebimento_item` DATE NULL ,
  `aquisicao_id` INT NOT NULL ,
  PRIMARY KEY (`id_item`) ,
  INDEX `fk_item_aquisicao_aquisicoes1` (`aquisicao_id` ASC) ,
  CONSTRAINT `fk_item_aquisicao_aquisicoes1`
    FOREIGN KEY (`aquisicao_id` )
    REFERENCES `s_almoxarifado`.`aquisicoes` (`id_aquisicao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`emprestimos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`emprestimos` (
  `id_emprestimo` INT NOT NULL ,
  `dt_inicial_emprestimo` DATETIME NOT NULL ,
  `requisitante_id` INT NOT NULL ,
  `usuario_id_usuario` INT NOT NULL ,
  PRIMARY KEY (`id_emprestimo`) ,
  INDEX `fk_emprestimos_usuarios1` (`requisitante_id` ASC) ,
  INDEX `fk_emprestimos_usuarios2` (`usuario_id_usuario` ASC) ,
  CONSTRAINT `fk_emprestimos_usuarios1`
    FOREIGN KEY (`requisitante_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_emprestimos_usuarios2`
    FOREIGN KEY (`usuario_id_usuario` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`manutencoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`manutencoes` (
  `id_manutencao` INT NOT NULL AUTO_INCREMENT ,
  `professor_id` INT NOT NULL ,
  `data_manutencao` DATE NOT NULL ,
  `providencia_manutencao` TEXT NOT NULL ,
  `definitivo_manutencao` TINYINT(1)  NOT NULL DEFAULT 0 COMMENT '0 -> o problema não foi resolvido\n1 -> o problema foi resolvido' ,
  `req_manutencao_id` INT NOT NULL ,
  PRIMARY KEY (`id_manutencao`) ,
  INDEX `fk_manutencoes_professores1` (`professor_id` ASC) ,
  INDEX `fk_manutencoes_req_manutencao1` (`req_manutencao_id` ASC) ,
  CONSTRAINT `fk_manutencoes_professores1`
    FOREIGN KEY (`professor_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_manutencoes_req_manutencao1`
    FOREIGN KEY (`req_manutencao_id` )
    REFERENCES `s_almoxarifado`.`req_manutencao` (`id_requisicao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`disciplinas_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`disciplinas_usuarios` (
  `disciplina_id` INT NOT NULL ,
  `usuario_id` INT NOT NULL ,
  PRIMARY KEY (`disciplina_id`, `usuario_id`) ,
  INDEX `fk_disciplinas_usuarios_usuarios1` (`usuario_id` ASC) ,
  INDEX `fk_disciplinas_usuarios_disciplinas1` (`disciplina_id` ASC) ,
  CONSTRAINT `fk_disciplinas_usuarios_disciplinas1`
    FOREIGN KEY (`disciplina_id` )
    REFERENCES `s_almoxarifado`.`disciplinas` (`id_disciplina` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_disciplinas_usuarios_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`itens_emprestimos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`itens_emprestimos` (
  `id_item` INT NOT NULL AUTO_INCREMENT ,
  `descricao_item` VARCHAR(100) NOT NULL ,
  `quantidade_item` INT NOT NULL ,
  `dt_final` DATETIME NOT NULL ,
  `emprestimos_id` INT NOT NULL ,
  PRIMARY KEY (`id_item`) ,
  INDEX `fk_itens_emprestimos_emprestimos1` (`emprestimos_id` ASC) ,
  CONSTRAINT `fk_itens_emprestimos_emprestimos1`
    FOREIGN KEY (`emprestimos_id` )
    REFERENCES `s_almoxarifado`.`emprestimos` (`id_emprestimo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`modulos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`modulos` (
  `id_modulo` INT NOT NULL AUTO_INCREMENT ,
  `nome_modulo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_modulo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`permissoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`permissoes` (
  `id_permissao` INT NOT NULL AUTO_INCREMENT ,
  `nome_permissao` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_permissao`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`modulos_permissoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`modulos_permissoes` (
  `id_modulo_permissao` INT NOT NULL AUTO_INCREMENT ,
  `modulo_id` INT NOT NULL ,
  `permissao_id` INT NOT NULL ,
  PRIMARY KEY (`id_modulo_permissao`) ,
  INDEX `fk_modulos_permissoes_modulos1` (`modulo_id` ASC) ,
  INDEX `fk_modulos_permissoes_permissoes1` (`permissao_id` ASC) ,
  CONSTRAINT `fk_modulos_permissoes_modulos1`
    FOREIGN KEY (`modulo_id` )
    REFERENCES `s_almoxarifado`.`modulos` (`id_modulo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_modulos_permissoes_permissoes1`
    FOREIGN KEY (`permissao_id` )
    REFERENCES `s_almoxarifado`.`permissoes` (`id_permissao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`modulos_permissoes_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`modulos_permissoes_usuarios` (
  `modulo_permissao_id` INT NOT NULL ,
  `usuario_id` INT NOT NULL ,
  PRIMARY KEY (`modulo_permissao_id`, `usuario_id`) ,
  INDEX `fk_modulos_permissoes_usuarios_usuarios1` (`usuario_id` ASC) ,
  INDEX `fk_modulos_permissoes_usuarios_modulos_permissoes1` (`modulo_permissao_id` ASC) ,
  CONSTRAINT `fk_modulos_permissoes_usuarios_modulos_permissoes1`
    FOREIGN KEY (`modulo_permissao_id` )
    REFERENCES `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_modulos_permissoes_usuarios_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`laboratorios`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Automação', 46, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Hidraulica', 47, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Pneumática', 48, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Ajustagem', 49, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Fresagem', 50, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Desenho', 51, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Medidas Elétricas', 52, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Ensaios Eléricos', 53, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Metalografia', 54, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Marcenaria', 55, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Soldar', 56, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Máquinas Elétricas', 58, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Manutenção Mecânica', 59, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Comandos Elétricos II', 60, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Instalações Prediais II', 61, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Comandos Elétricos I', 62, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Tornearia', 63, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'CNC', 64, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Eletrônica', 19, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Eletrônica II', 20, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Eletrônica III', 45, NULL);
INSERT INTO `s_almoxarifado`.`laboratorios` (`id_laboratorio`, `nome_laboratorio`, `numero_laboratorio`, `chave_laboratorio`) VALUES (NULL, 'Marcenaria II', NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`tipos_usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`tipos_usuarios` (`id_tipo`, `nome_tipo`) VALUES (NULL, 'professor');
INSERT INTO `s_almoxarifado`.`tipos_usuarios` (`id_tipo`, `nome_tipo`) VALUES (NULL, 'operador');
INSERT INTO `s_almoxarifado`.`tipos_usuarios` (`id_tipo`, `nome_tipo`) VALUES (NULL, 'secretaria');
INSERT INTO `s_almoxarifado`.`tipos_usuarios` (`id_tipo`, `nome_tipo`) VALUES (NULL, 'coopertec');
INSERT INTO `s_almoxarifado`.`tipos_usuarios` (`id_tipo`, `nome_tipo`) VALUES (NULL, 'resp manutencao');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`usuarios`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`usuarios` (`id_usuario`, `nome_usuario`, `tipo_usuario_id`, `login_usuario`, `senha_usuario`) VALUES (NULL, 'teste', 1, 'teste', 'teste');
INSERT INTO `s_almoxarifado`.`usuarios` (`id_usuario`, `nome_usuario`, `tipo_usuario_id`, `login_usuario`, `senha_usuario`) VALUES (NULL, 'testando', 2, 'testando', 'testando');
INSERT INTO `s_almoxarifado`.`usuarios` (`id_usuario`, `nome_usuario`, `tipo_usuario_id`, `login_usuario`, `senha_usuario`) VALUES (NULL, 'admin', 3, 'admin', 'admin');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`estados_requisicoes`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`estados_requisicoes` (`id_estado_requisicao`, `nome_estado_requisicao`) VALUES (NULL, 'Aguardando aprovação');
INSERT INTO `s_almoxarifado`.`estados_requisicoes` (`id_estado_requisicao`, `nome_estado_requisicao`) VALUES (NULL, 'Negada');
INSERT INTO `s_almoxarifado`.`estados_requisicoes` (`id_estado_requisicao`, `nome_estado_requisicao`) VALUES (NULL, 'Aprovada');
INSERT INTO `s_almoxarifado`.`estados_requisicoes` (`id_estado_requisicao`, `nome_estado_requisicao`) VALUES (NULL, 'Concluída');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`modulos`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`modulos` (`id_modulo`, `nome_modulo`) VALUES (NULL, 'manutencoes');
INSERT INTO `s_almoxarifado`.`modulos` (`id_modulo`, `nome_modulo`) VALUES (NULL, 'chaves');
INSERT INTO `s_almoxarifado`.`modulos` (`id_modulo`, `nome_modulo`) VALUES (NULL, 'solicitacoes');
INSERT INTO `s_almoxarifado`.`modulos` (`id_modulo`, `nome_modulo`) VALUES (NULL, 'emprestimos');
INSERT INTO `s_almoxarifado`.`modulos` (`id_modulo`, `nome_modulo`) VALUES (NULL, 'permissoes');
INSERT INTO `s_almoxarifado`.`modulos` (`id_modulo`, `nome_modulo`) VALUES (NULL, 'membros');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`permissoes`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'visualizar');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'gerenciar');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'requisitar');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'aprovar');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'realizar');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'visualizarHistorico');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'gerar');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'imprimir');
INSERT INTO `s_almoxarifado`.`permissoes` (`id_permissao`, `nome_permissao`) VALUES (NULL, 'modificarSe');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s_almoxarifado`.`modulos_permissoes`
-- -----------------------------------------------------
START TRANSACTION;
USE `s_almoxarifado`;
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 1, 1);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 1, 3);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 1, 4);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 1, 5);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 1, 6);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 2, 1);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 2, 2);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 3, 1);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 3, 2);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 3, 7);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 3, 8);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 4, 1);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 4, 2);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 5, 1);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 5, 2);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 6, 1);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 6, 2);
INSERT INTO `s_almoxarifado`.`modulos_permissoes` (`id_modulo_permissao`, `modulo_id`, `permissao_id`) VALUES (NULL, 6, 9);

COMMIT;
