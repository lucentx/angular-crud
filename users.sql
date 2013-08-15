CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sample Data
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `address`) VALUES
(1, 'lucentx', 'Aron', 'Barbosa', 'Manila, Philippines'),
(2, 'ozzy', 'Ozzy', 'Osbourne', 'England'),
(3, 'tony', 'Tony', 'Iommi', 'England');