CREATE DATABASE desafio_api;
USE desafio_api;

CREATE TABLE `empresa` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` varchar(200) NOT NULL,

    PRIMARY KEY (`id`)
);

CREATE TABLE `contato`(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `nome` varchar(100) NOT NULL,
    `sobrenome` varchar(100) NOT NULL,
    `datanasc` varchar(100) NOT NULL,
    `telefone` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `id_empresa`  int(10) unsigned,

    PRIMARY KEY (`id`),
    CONSTRAINT `FK_id`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `empresa` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
