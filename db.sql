SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+5:30";

CREATE TABLE IF NOT EXISTS `algorithmcategory` (
  `sr` int(3) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) NOT NULL,
  PRIMARY KEY (`sr`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `algorithmstore` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `algoName` varchar(100) DEFAULT NULL,
  `algoTags` varchar(255) DEFAULT NULL,
  `WLink` varchar(80) DEFAULT NULL,
  `sDesc` varchar(150) DEFAULT NULL,
  `algoDesc` varchar(10000) DEFAULT NULL,
  `algoCode` varchar(50000) DEFAULT NULL,
  `algoNote` varchar(1000) DEFAULT NULL,
  `algoL` varchar(32) DEFAULT NULL,
  `algoT` varchar(32) DEFAULT NULL,
  `algoU` varchar(32) DEFAULT NULL,
  `authID` varchar(6) DEFAULT NULL,
  `listedCat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `algoName` (`algoName`,`algoTags`,`algoDesc`),
  FULLTEXT KEY `algoName_2` (`algoName`,`algoTags`,`algoDesc`),
  FULLTEXT KEY `algoName_3` (`algoName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `livestore` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `algoName` varchar(100) DEFAULT NULL,
  `algoTags` varchar(255) DEFAULT NULL,
  `aLink` varchar(32) DEFAULT NULL,
  `WLink` varchar(80) DEFAULT NULL,
  `sDesc` varchar(150) DEFAULT NULL,
  `algoDesc` varchar(10000) DEFAULT NULL,
  `algoCode` varchar(50000) DEFAULT NULL,
  `algoNote` varchar(1000) DEFAULT NULL,
  `algoL` varchar(32) DEFAULT NULL,
  `algoT` varchar(32) DEFAULT NULL,
  `algoU` varchar(32) DEFAULT NULL,
  `authID` varchar(6) DEFAULT NULL,
  `listedCat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `algoName` (`algoName`,`algoTags`,`algoDesc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `trashlist` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `algoName` varchar(100) DEFAULT NULL,
  `algoTags` varchar(255) DEFAULT NULL,
  `WLink` varchar(80) DEFAULT NULL,
  `sDesc` varchar(150) DEFAULT NULL,
  `algoDesc` varchar(10000) DEFAULT NULL,
  `algoCode` varchar(50000) DEFAULT NULL,
  `algoNote` varchar(1000) DEFAULT NULL,
  `algoL` varchar(32) DEFAULT NULL,
  `algoT` varchar(32) DEFAULT NULL,
  `algoU` varchar(32) DEFAULT NULL,
  `authID` varchar(6) DEFAULT NULL,
  `listedCat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `algoName` (`algoName`,`algoTags`,`algoDesc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `userdata` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `gpID` varchar(32) DEFAULT NULL,
  `gpName` varchar(64) DEFAULT NULL,
  `gpGender` varchar(10) DEFAULT NULL,
  `gpImage` varchar(255) DEFAULT NULL,
  `utype` int(2) DEFAULT NULL,
  `lastGused` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
