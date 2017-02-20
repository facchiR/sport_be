-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `atleti`;
CREATE TABLE `atleti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `datanascita` timestamp NULL DEFAULT NULL,
  `sesso` char(1) DEFAULT NULL,
  `cf` char(16) DEFAULT NULL,
  `telefono` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cf` (`cf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `classifiche`;
CREATE TABLE `classifiche` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iscrizioni_id` int(10) NOT NULL,
  `tempo` time(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iscrizioni_id` (`iscrizioni_id`),
  CONSTRAINT `classifiche_ibfk_1` FOREIGN KEY (`iscrizioni_id`) REFERENCES `iscrizioni` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `gare`;
CREATE TABLE `gare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gara` varchar(100) NOT NULL,
  `km` int(11) DEFAULT NULL,
  `orapartenza` timestamp NULL DEFAULT NULL,
  `luogopartenza` varchar(100) DEFAULT NULL,
  `luogoarrivo` varchar(100) DEFAULT NULL,
  `categorie_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gara` (`gara`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `gare_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `iscrizioni`;
CREATE TABLE `iscrizioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `atleti_id` int(11) NOT NULL,
  `gare_id` int(11) NOT NULL,
  `pettorale` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pettorale` (`pettorale`),
  KEY `atleti_id` (`atleti_id`),
  KEY `gare_id` (`gare_id`),
  CONSTRAINT `iscrizioni_ibfk_1` FOREIGN KEY (`atleti_id`) REFERENCES `atleti` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `iscrizioni_ibfk_2` FOREIGN KEY (`gare_id`) REFERENCES `gare` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP VIEW IF EXISTS `podio`;
CREATE TABLE `podio` (`id` int(10) unsigned, `nome` varchar(50), `cf` char(16), `pettorale` int(11), `gara` varchar(100), `km` int(11), `categoria` varchar(50), `tempo` time(6));


DROP TABLE IF EXISTS `podio`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `podio` AS select `c`.`id` AS `id`,`a`.`nome` AS `nome`,`a`.`cf` AS `cf`,`i`.`pettorale` AS `pettorale`,`g`.`gara` AS `gara`,`g`.`km` AS `km`,`ca`.`categoria` AS `categoria`,`c`.`tempo` AS `tempo` from ((((`classifiche` `c` join `iscrizioni` `i` on((`c`.`iscrizioni_id` = `i`.`id`))) join `atleti` `a` on((`i`.`atleti_id` = `a`.`id`))) join `gare` `g` on((`i`.`gare_id` = `g`.`id`))) left join `categorie` `ca` on((`g`.`categorie_id` = `ca`.`id`)));

-- 2017-02-14 15:29:48/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  facchi
 * Created: 14-feb-2017
 */

