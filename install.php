<?
include(".setup.php");

Database::query("
CREATE TABLE IF NOT EXISTS `myexcel` (
  `sheet` varchar(255) NOT NULL,
  `x` varchar(10) NOT NULL,
  `y` varchar(10) NOT NULL,
  `src` text,
  PRIMARY KEY  (`sheet`,`x`,`y`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251
");


header("Location: ".Root::i()->getVar('wroot'));
?>