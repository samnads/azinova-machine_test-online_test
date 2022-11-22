-- Adminer 4.8.1 MySQL 5.5.5-10.4.21-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `answer` (`id`, `answer`) VALUES
(1,	'Mahatma Gandhi'),
(2,	'Dr. Rajendra Prasad'),
(3,	'Demo 3'),
(4,	'Demo 4'),
(5,	'Dr. B. R. Ambedkar'),
(6,	'Skin'),
(7,	'Punjab'),
(8,	'Demo 8'),
(9,	'Jawaharlal Nehru'),
(10,	'Gold'),
(11,	'Demo 234'),
(12,	'Charles Babbage'),
(13,	'Demo 4574'),
(14,	'1 Megabyte (MB)'),
(15,	'CPU');

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answer` (`answer`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`answer`) REFERENCES `answer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `question` (`id`, `question`, `answer`) VALUES
(1,	'Who is the Father of our Nation?',	1),
(2,	'Who was the first President of India?',	2),
(3,	'Who is known as Father of Indian Constitution?',	5),
(4,	'Which is the most sensitive organ in our body?',	6),
(5,	'Giddha is the folk dance of?',	7),
(6,	'Who was the first Prime Minister of India?',	9),
(7,	'Which is the heavier metal of these two? Gold or Silver?',	10),
(8,	'Who invented Computer?',	12),
(9,	'1024 Kilobytes is equal to?',	14),
(10,	' Brain of computer is?',	15);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`) VALUES
(14,	'Admin',	'test',	'root',	'$2y$10$PnX3QAhQQ2bz.yx.tHiqx.dwZkeHbozvaZKMFu.5E8epLkr6dxFTi'),
(15,	'fggfg',	'gfdg',	'root',	'$2y$10$WnHb93vxzTBbyZWQWw7SlOdi/dxHXW43tP3iyMbMzjjvSkpl2Cx/e'),
(16,	'hgfh',	'gfhgfh',	'root',	'$2y$10$e7A1oTJ8AArO1jL720LgTuW6FBIw5tpAbzH4dIogGDTr9LF7UzFzS'),
(17,	'gfdgdfg',	'fgfdg',	'root',	'$2y$10$sGoALo6Rc1ZyxtcvNG0njuS/FvhvtkTJotaH01vcLej5rxEIBpLES'),
(18,	'gfdgdfg',	'fgfdg',	'root',	'$2y$10$A4mQvpaaRABlpkm5YJ6.FeNfcWg5X8GWMxPNgCXaB2JTo.AxyZoGW'),
(19,	'Samnad',	'ffsdf',	'root',	'$2y$10$Mcg1Pj3C8YjuWiToHV/nDeszun8iIjz5BSGh9ogwhLKz84u3sqcJu'),
(20,	'ghchghgh',	'ghgf@fsd.gg',	'root',	'$2y$10$7SJpDsLXq2hfM.d0nKJSue.ZKNjOBTgdWem0vEo29UIcsdGBacFOK'),
(21,	'ssd',	'sdsd',	'root',	'$2y$10$SZRflf51ltCJC8/RSO32..si4fD7VY.jK9NNJn7kIJoEBcAJOLAey'),
(22,	'Samnad',	'ssdsd@f.fdfsdfsdf',	'samnads',	'$2y$10$nuipVQ.1LLM40CdbJyjfCudLzLr4APOouo4WoVKjQrteG9SKqRJha');

-- 2022-11-21 15:31:17
