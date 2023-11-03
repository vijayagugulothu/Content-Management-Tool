DROP TABLE IF EXISTS `posts`;
-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2023 at 12:14 AM
-- Server version: 5.6.51-log
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
use cms_project;
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `PID` varchar(20) NOT NULL,
  `email` varchar(256) NOT NULL,
  `user` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `date` varchar(32) NOT NULL,
  `time` varchar(10) NOT NULL,
  `thumbnail` varchar(64) DEFAULT NULL,
  `file` varchar(64) DEFAULT NULL,
  `content` varchar(2048) NOT NULL,
  `status` varchar(6) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

DROP TABLE IF EXISTS `posts`;
INSERT INTO `posts` (`PID`, `email`, `user`, `category`, `date`, `time`, `thumbnail`, `file`, `content`, `status`) VALUES
('PID20230510005930739', 'admin@gmail.com', 'G.Vijaya', 'Artificial Intelligence', 'Tuesday, May 9, 2023', '00:59', './thumbnail/PID20230510005930739.jpg', ' ./files/PID20230510005930739.jpeg', 'Artificial Intelligence, or AI, is like the wizard of the digital realm. Its the brainpower behind machines, allowing them to think, learn, and make decisions. Picture it as the closest thing we have to creating digital life forms.\r\n\r\nAI mimics human intelligence, but its not just about processing information faster. Its about understanding, adapting, and evolving based on patterns and experiences. There are two main types of AI: Narrow AI, which is designed for specific, and General AI, the hypothetical all-knowing intelligence that can understand, learn, and apply knowledge across diverse domains—something were still working on.\r\n\r\nMachine Learning is the backbone of AI. Instead of being explicitly programmed, machines learn from data. Its like teaching a computer to recognize cats by showing it thousands of cat pictures—eventually, it learns the patterns and can identify cats on its own.\r\n\r\nAI is everywhere. From the chatbots that help with customer service to recommendation systems that suggest movies, AI is woven into our daily lives.Its in healthcare, finance, education, and even art, creating paintings or composing music.\r\n\r\nBut with great power comes great responsibility. Ethical concerns surround AI, such as bias in algorithms and the potential for job displacement. Striking the right balance between innovation and ethics is crucial as we step into this era of artificial intelligence.\r\n\r\n', 'Posted'),
('PID20230510010531727', 'admin@gmail.com', 'G.Vijaya', 'Cyber Security', 'Tuesday, May 9, 2023', '01:05', './thumbnail/Cyber-Security-Icon-Concept-2-1.jpeg', ' ./files/PID20230510010531727.jpg', 'Cybersecurity is a critical aspect of our digital lives. It involves protecting our online world from a wide range of threats. \r\n\r\n

In an age where our personal data, financial transactions, and communications are all digital, the importance of cybersecurity cannot be overstated. \r\n\r\n

Its about safeguarding our information, networks, and systems from cybercriminals who seek to exploit vulnerabilities. \r\n\r\n

By staying informed, using strong passwords, and practicing safe online behavior, we can all contribute to a safer digital environment. \r\n\r\n

Remember, cybersecurity is everyones responsibility. Stay vigilant, stay secure.
', 'Posted');
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(13) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `name`, `phone`) VALUES
('shravankumarssk01@gmail.com', '0000', 'G.Vijaya', '8688065234'),
('vijayagugulothu22@gmail.com', '0000', 'Vijaya', '7652416731'),
('prasantpoddar27@gmail.com', '2507', 'Ankit Kumar', '7845123657');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
