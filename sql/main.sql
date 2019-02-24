CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `desc` text NOT NULL,
  `priority` int(11) NOT NULL,
  `value` int(3) NOT NULL, DEFAULT '10',
  `repeat` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` date NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `value` int(3) NOT NULL, DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `pin` smallint UNSIGNED NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(48) NOT NULL,
  `prev_week_diff` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
