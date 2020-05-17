
CREATE TABLE IF NOT EXISTS `samochody` (
  `id` int NOT NULL auto_increment,
  `marka` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `rok` int NOT NULL,
  `cena` int NOT NULL,
  `silnik` float(11,2) NOT NULL,
  `waga` int NOT NULL,
  PRIMARY KEY  (`id`)
);