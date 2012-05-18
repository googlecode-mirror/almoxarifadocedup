SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `s_almoxarifado` DEFAULT CHARACTER SET latin1 ;
USE `s_almoxarifado` ;

-- -----------------------------------------------------
-- Table `s_almoxarifado`.`cursos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`cursos` (
  `id_curso` INT(11) NOT NULL ,
  `nome_curso` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_curso`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`disciplinas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`disciplinas` (
  `id_disciplina` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_disciplina` VARCHAR(45) NOT NULL ,
  `curso_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_disciplina`) ,
  INDEX `fk_disciplinas_cursos1` (`curso_id` ASC) ,
  CONSTRAINT `fk_disciplinas_cursos1`
    FOREIGN KEY (`curso_id` )
    REFERENCES `s_almoxarifado`.`cursos` (`id_curso` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`tipos_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`tipos_usuarios` (
  `id_tipo` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_tipo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_tipo`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_usuario` VARCHAR(100) NOT NULL ,
  `tipo_usuario_id` INT(11) NOT NULL ,
  `email_usuario` VARCHAR(60) NOT NULL ,
  `telefone_usuario` INT(11) NOT NULL ,
  `celular_usuario` VARCHAR(11) NULL DEFAULT NULL ,
  `dt_nascimento_usuario` DATE NOT NULL ,
  `login_usuario` VARCHAR(20) NOT NULL ,
  `senha_usuario` VARCHAR(25) NOT NULL ,
  PRIMARY KEY (`id_usuario`) ,
  INDEX `fk_usuarios_tipos_usuarios1` (`tipo_usuario_id` ASC) ,
  CONSTRAINT `fk_usuarios_tipos_usuarios1`
    FOREIGN KEY (`tipo_usuario_id` )
    REFERENCES `s_almoxarifado`.`tipos_usuarios` (`id_tipo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`semestres`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`semestres` (
  `id_semestre` INT(11) NOT NULL ,
  `ano_semestre` VARCHAR(45) NOT NULL ,
  `discriminacao_semestre` CHAR(1) NOT NULL ,
  PRIMARY KEY (`id_semestre`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`aquisicoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`aquisicoes` (
  `id_aquisicao` INT(11) NOT NULL ,
  `fase_aquisicao` INT(11) NOT NULL ,
  `semestre_id` INT(11) NOT NULL ,
  `professor_id` INT(11) NOT NULL ,
  `disciplina_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_aquisicao`) ,
  INDEX `fk_aquisicoes_Professores1` (`professor_id` ASC) ,
  INDEX `fk_aquisicoes_semestres1` (`semestre_id` ASC) ,
  INDEX `fk_aquisicoes_disciplinas1` (`disciplina_id` ASC) ,
  CONSTRAINT `fk_aquisicoes_disciplinas1`
    FOREIGN KEY (`disciplina_id` )
    REFERENCES `s_almoxarifado`.`disciplinas` (`id_disciplina` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_aquisicoes_Professores1`
    FOREIGN KEY (`professor_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aquisicoes_semestres1`
    FOREIGN KEY (`semestre_id` )
    REFERENCES `s_almoxarifado`.`semestres` (`id_semestre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`laboratorios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`laboratorios` (
  `id_laboratorio` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_laboratorio` VARCHAR(100) NOT NULL ,
  `numero_laboratorio` INT(11) NULL DEFAULT NULL ,
  `chave_laboratorio` TINYINT(1)  NOT NULL DEFAULT 0 COMMENT '0 -> chave disponivel\n1 -> chave indisponivel' ,
  `deleted` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_laboratorio`) )
ENGINE = InnoDB
AUTO_INCREMENT = 25
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`ctrl_chaves`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`ctrl_chaves` (
  `id_controle` INT(11) NOT NULL AUTO_INCREMENT ,
  `professor_id` INT(11) NOT NULL ,
  `laboratorio_id` INT(11) NOT NULL ,
  `observacao_controle` VARCHAR(255) NULL DEFAULT NULL ,
  `dt_inicial_controle` DATETIME NOT NULL ,
  `dt_final_controle` DATETIME NULL DEFAULT NULL ,
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
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`disciplinas_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`disciplinas_usuarios` (
  `disciplina_id` INT(11) NOT NULL ,
  `usuario_id` INT(11) NOT NULL ,
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
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`emprestimos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`emprestimos` (
  `id_emprestimo` INT(11) NOT NULL AUTO_INCREMENT ,
  `dt_inicial_emprestimo` DATETIME NOT NULL ,
  `requisitante_id` INT(11) NOT NULL ,
  `usuario_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_emprestimo`) ,
  INDEX `fk_emprestimos_usuarios1` (`requisitante_id` ASC) ,
  INDEX `fk_emprestimos_usuarios2` (`usuario_id` ASC) ,
  CONSTRAINT `fk_emprestimos_usuarios1`
    FOREIGN KEY (`requisitante_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_emprestimos_usuarios2`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`estados_requisicoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`estados_requisicoes` (
  `id_estado_requisicao` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_estado_requisicao` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_estado_requisicao`) )
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`item_aquisicao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`item_aquisicao` (
  `id_item` INT(11) NOT NULL AUTO_INCREMENT ,
  `descricao_item` VARCHAR(150) NOT NULL ,
  `quantidade_item` INT(11) NOT NULL ,
  `dt_requisicao_item` DATE NOT NULL ,
  `dt_recebimento_item` DATE NULL DEFAULT NULL ,
  `aquisicao_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_item`) ,
  INDEX `fk_item_aquisicao_aquisicoes1` (`aquisicao_id` ASC) ,
  CONSTRAINT `fk_item_aquisicao_aquisicoes1`
    FOREIGN KEY (`aquisicao_id` )
    REFERENCES `s_almoxarifado`.`aquisicoes` (`id_aquisicao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`itens_emprestimos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`itens_emprestimos` (
  `id_item` INT(11) NOT NULL AUTO_INCREMENT ,
  `descricao_item` VARCHAR(100) NOT NULL ,
  `quantidade_item` INT(11) NOT NULL ,
  `dt_final` DATETIME NOT NULL ,
  `emprestimos_id` INT(11) NOT NULL ,
  `entregue` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_item`) ,
  INDEX `fk_itens_emprestimos_emprestimos1` (`emprestimos_id` ASC) ,
  CONSTRAINT `fk_itens_emprestimos_emprestimos1`
    FOREIGN KEY (`emprestimos_id` )
    REFERENCES `s_almoxarifado`.`emprestimos` (`id_emprestimo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`req_manutencao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`req_manutencao` (
  `id_requisicao` INT(11) NOT NULL AUTO_INCREMENT ,
  `dt_requisicao` DATE NOT NULL ,
  `equipamento_requisicao` VARCHAR(200) NOT NULL ,
  `local_equipamento` VARCHAR(255) NOT NULL ,
  `defeito_requisicao` VARCHAR(255) NOT NULL ,
  `requisitante_id` INT(11) NOT NULL ,
  `estado_id` INT(11) NOT NULL ,
  `deleted` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_requisicao`) ,
  INDEX `fk_Manutencao_Professores1` (`requisitante_id` ASC) ,
  INDEX `fk_req_manutencao_estado_requisicoes1` (`estado_id` ASC) ,
  CONSTRAINT `fk_Manutencao_Professores1`
    FOREIGN KEY (`requisitante_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_req_manutencao_estado_requisicoes1`
    FOREIGN KEY (`estado_id` )
    REFERENCES `s_almoxarifado`.`estados_requisicoes` (`id_estado_requisicao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 30
DEFAULT CHARACTER SET = utf8, 
COMMENT = 'tabela pra armazenar as requisições de manutenção' ;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`manutencoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`manutencoes` (
  `id_manutencao` INT(11) NOT NULL AUTO_INCREMENT ,
  `data_manutencao` DATE NOT NULL ,
  `definitivo_manutencao` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0 -> o problema não foi resolvido\n1 -> o problema foi resolvido' ,
  `req_manutencao_id` INT(11) NOT NULL ,
  `responsavel_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_manutencao`) ,
  INDEX `fk_manutencoes_req_manutencao1` (`req_manutencao_id` ASC) ,
  INDEX `fk_manutencoes_usuarios1` (`responsavel_id` ASC) ,
  CONSTRAINT `fk_manutencoes_req_manutencao1`
    FOREIGN KEY (`req_manutencao_id` )
    REFERENCES `s_almoxarifado`.`req_manutencao` (`id_requisicao` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_manutencoes_usuarios1`
    FOREIGN KEY (`responsavel_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`modulos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`modulos` (
  `id_modulo` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_modulo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_modulo`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`permissoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`permissoes` (
  `id_permissao` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome_permissao` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_permissao`) )
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`modulos_permissoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`modulos_permissoes` (
  `id_modulo_permissao` INT(11) NOT NULL AUTO_INCREMENT ,
  `modulo_id` INT(11) NOT NULL ,
  `permissao_id` INT(11) NOT NULL ,
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
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`modulos_permissoes_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`modulos_permissoes_usuarios` (
  `modulo_permissao_id` INT(11) NOT NULL ,
  `usuario_id` INT(11) NOT NULL ,
  PRIMARY KEY (`modulo_permissao_id`, `usuario_id`) ,
  INDEX `fk_modulos_permissoes_usuarios_usuarios1` (`usuario_id` ASC) ,
  CONSTRAINT `fk_modulos_permissoes_usuarios_usuarios1`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `s_almoxarifado`.`usuarios` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `s_almoxarifado`.`providencia_manu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `s_almoxarifado`.`providencia_manu` (
  `id_providencia` INT(11) NOT NULL AUTO_INCREMENT ,
  `descricao_providencia` VARCHAR(255) NOT NULL ,
  `manutencao_id` INT(11) NOT NULL ,
  `data_providencia` DATETIME NOT NULL ,
  `responsavel_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_providencia`) )
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
