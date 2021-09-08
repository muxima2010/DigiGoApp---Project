-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 09-Jul-2021 às 21:40
-- Versão do servidor: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbo.digigoapp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_insert_new_team` (IN `team_name` VARCHAR(100), IN `email` VARCHAR(100), IN `description` VARCHAR(200), IN `idType` INT(11), IN `idUser` INT(11), IN `token` VARCHAR(100))  NO SQL
BEGIN

# REGISTER TEAM
INSERT INTO team (team_name, email, description, idType, idStatus_Email)
VALUES (team_name, email, description, idType, 1);

# REGISTER TEAM LOG
SET @idTeam = LAST_INSERT_ID();
INSERT INTO team_logs (idteam, operation, idUser)
values (@idTeam, 'CREATED', idUser);

# REGISTER USER AS ADMIN IN TEAM
INSERT INTO team_user_level (idUser, idTeam, idLevel)
values (idUser, @idTeam, 1);

# REGISTER TEAM EMAIL TOKEN
INSERT INTO team_email_token (idTeam, token)
VALUES (@idTeam, token);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_insert_new_ticket` (IN `idUser` INT, IN `idTeam` INT, IN `idCategory` INT, IN `idPriority` INT, IN `oldTicket` INT, IN `subject` VARCHAR(100), IN `message` VARCHAR(255), IN `fileAttached` MEDIUMBLOB)  NO SQL
BEGIN


INSERT INTO ticket (idUSer, idTeam, idCategory, idPriority, old_idTicket, subject, message, fileAttached)
VALUES (idUSer, idTeam, idCategory, idPriority, oldTicket, subject, message, fileAttached);


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_insert_new_user` (IN `first_name` VARCHAR(50), IN `last_name` VARCHAR(50), IN `email` VARCHAR(100), IN `password` VARCHAR(100), IN `token` VARCHAR(100))  NO SQL
BEGIN

#CRYPT USER PASSWORD
SET @pswEncrypted = sha1(password);

#INSERT USER DATA
INSERT INTO user (first_name, last_name, email, password, idStatus)
VALUES (first_name, last_name, email, @pswEncrypted, 1);

#INSERT TOKEN FOR USER
SET @idUser = LAST_INSERT_ID();
INSERT INTO user_token (idUser, token)
VALUES (@idUser, token);

#INSERT USER SETTINGS
INSERT INTO user_settings (idUser, idAvatar, idDisplay_status, idNotifications_type) 
VALUES (@idUser, 1, 1, 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_logout_user` (IN `idUser` INT)  NO SQL
BEGIN

INSERT INTO user_logs_session (idUser, operation)
VALUES (idUser, "LOGOUT");

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_reset_password` (IN `newPsw` VARCHAR(100), IN `idUser` INT, IN `newtoken` VARCHAR(100))  NO SQL
BEGIN

#UPDATE USER PASSWORD
UPDATE user SET password = newPsw WHERE id = idUser;

#DELETE TOKEN
DELETE FROM user_token WHERE token = newtoken and idUser = idUser LIMIT 1;

#INSERT LOG RESET
INSERT INTO user_logs_request_psw_reset (idUser, operation) VALUES (idUser, 'RESET PSW');

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_udpate_user_settings` (IN `idUser` INT, IN `first_name` VARCHAR(50), IN `last_name` VARCHAR(50), IN `email` VARCHAR(100), IN `username` VARCHAR(50), IN `description` VARCHAR(255), IN `idAvatar` VARCHAR(25), IN `idDisplay_status` INT, IN `idNotifications_type` INT)  NO SQL
BEGIN

SET @idAvatar ='';
SELECT avatar.id INTO @idAvatar
FROM avatar
WHERE avatar = idAvatar;

UPDATE user SET first_name = first_name, last_name = last_name, email = email WHERE user.id = idUser;

UPDATE user_settings SET username = username, description = description,
idAvatar = @idAvatar, idDisplay_status = idDisplay_status, idNotifications_type = idNotifications_type WHERE user_settings.idUser = idUser;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_update_closed_ticket` (IN `id` INT)  NO SQL
BEGIN

UPDATE ticket_info_status SET idStatus = 3, date_closed = now() WHERE idTicket = id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_validate_team_email` (IN `idTeam` INT(1), IN `idToken` INT(1), IN `idUser` INT(1))  NO SQL
BEGIN

DELETE FROM team_email_token 
WHERE id = idToken LIMIT 1;

UPDATE team SET idStatus_Email = 2
WHERE id = idTeam;

# REGISTER TEAM LOG
INSERT INTO team_logs (idTeam, operation, idUser)
VALUES (idTeam, "UPDATED", idUser);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_validate_user` (IN `idUser` INT, IN `idToken` INT)  NO SQL
BEGIN

DELETE FROM user_token 
WHERE id = idToken LIMIT 1;

UPDATE user SET idStatus = 2
WHERE id = idUser;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `avatar_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avatar`
--

INSERT INTO `avatar` (`id`, `avatar`, `avatar_name`) VALUES
(1, 'avatar6.jpeg', 'That Guy'),
(2, 'avatar7.jpeg', 'Just Me'),
(3, 'avatar8.jpeg', 'Cool CEO'),
(4, 'avatar9.jpeg', 'Senior Dev'),
(5, 'avatar10.jpeg', 'Web Ded Picasso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email_status`
--

CREATE TABLE `email_status` (
  `id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `email_status`
--

INSERT INTO `email_status` (`id`, `status`) VALUES
(1, 'inactive'),
(2, 'active');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `idType` int(11) NOT NULL,
  `idStatus_Email` int(11) NOT NULL,
  `dataReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `team`
--

INSERT INTO `team` (`id`, `team_name`, `email`, `description`, `idType`, `idStatus_Email`, `dataReg`) VALUES
(1, 'DIGIGO SUPPORT', 'freewebdev2021@gmail.com', 'Support team by DigiGo. This team was created to support all our clients.', 3, 2, '2021-07-07 12:58:23'),
(2, 'RH - DIGIGO TEAM', 'andregomestgr@gmail.com', 'Team dedicated to HR of DigiGo.', 4, 2, '2021-07-07 17:29:05'),
(3, 'MAXQUAL IT SUPPORT TEAM', 'afgomes1983@gmail.com', 'Team support for operational warehouse team', 1, 2, '2021-07-08 16:21:15'),
(4, 'DEMONTRACAO', 'agrockmusic@gmail.com', 'HR da DemonstraÃ§Ã£o', 4, 2, '2021-07-09 18:49:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_email_token`
--

CREATE TABLE `team_email_token` (
  `id` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `dataReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_logs`
--

CREATE TABLE `team_logs` (
  `id` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `operation` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL,
  `dataReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `team_logs`
--

INSERT INTO `team_logs` (`id`, `idTeam`, `operation`, `idUser`, `dataReg`) VALUES
(1, 1, 'CREATED', 1, '2021-07-07 12:58:23'),
(2, 1, 'UPDATED', 1, '2021-07-07 12:58:32'),
(3, 2, 'CREATED', 4, '2021-07-07 17:29:05'),
(4, 2, 'UPDATED', 4, '2021-07-07 17:29:25'),
(5, 3, 'CREATED', 2, '2021-07-08 16:21:15'),
(6, 3, 'UPDATED', 2, '2021-07-08 16:23:45'),
(7, 4, 'CREATED', 5, '2021-07-09 18:49:34'),
(8, 4, 'UPDATED', 5, '2021-07-09 18:49:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_request_status`
--

CREATE TABLE `team_request_status` (
  `id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `team_request_status`
--

INSERT INTO `team_request_status` (`id`, `status`) VALUES
(1, 'Request'),
(2, 'Accept'),
(3, 'Deny');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_type`
--

CREATE TABLE `team_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `team_type`
--

INSERT INTO `team_type` (`id`, `type`) VALUES
(1, 'IT - Operations Team'),
(2, 'QA - Testing Team'),
(3, 'SP - Support Team'),
(4, 'HR - Human Resources'),
(5, 'OC - Other');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_user_level`
--

CREATE TABLE `team_user_level` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `idLevel` int(11) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `team_user_level`
--

INSERT INTO `team_user_level` (`id`, `idUser`, `idTeam`, `idLevel`, `date_reg`) VALUES
(1, 1, 1, 1, '2021-07-07 12:59:52'),
(2, 2, 1, 1, '2021-07-07 13:05:20'),
(3, 3, 1, 2, '2021-07-07 13:16:48'),
(4, 4, 1, 3, '2021-07-07 13:59:49'),
(5, 4, 2, 1, '2021-07-07 17:29:05'),
(6, 2, 3, 1, '2021-07-08 16:21:15'),
(7, 5, 4, 1, '2021-07-09 18:49:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `team_user_request`
--

CREATE TABLE `team_user_request` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `idRequestSatus` int(11) NOT NULL,
  `dataReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `team_user_request`
--

INSERT INTO `team_user_request` (`id`, `idUser`, `idTeam`, `idRequestSatus`, `dataReg`) VALUES
(1, 2, 1, 2, '2021-07-07 13:05:04'),
(2, 3, 1, 2, '2021-07-07 13:15:30'),
(3, 4, 1, 2, '2021-07-07 13:59:20'),
(4, 2, 4, 1, '2021-07-09 18:59:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `idPriority` int(11) NOT NULL,
  `old_idTicket` int(11) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `fileAttached` varchar(255) DEFAULT NULL,
  `dateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ticket`
--

INSERT INTO `ticket` (`id`, `idUser`, `idTeam`, `idCategory`, `idPriority`, `old_idTicket`, `subject`, `message`, `fileAttached`, `dateReg`) VALUES
(1, 3, 1, 3, 3, 0, 'SEVERAL BUGS ON THE APP', 'I just start to use this application, but i descovery several bugs that can be easly fixed.  You need a error 404 page for example.', '', '2021-07-07 13:19:02'),
(2, 4, 1, 3, 3, 0, 'CHANGE CSS FOR DIGIGO APP', 'Try to make more modern the css for this App.', '', '2021-07-07 14:01:33'),
(3, 4, 1, 1, 2, 0, 'RITA FIRST TICKET', 'Try to make client side more detailed.', '', '2021-07-07 14:56:51'),
(4, 4, 1, 1, 2, 0, 'TICKET LIST FOR MY TICKETS', 'Please make a detail view button to all info that I submit on the ticket', '', '2021-07-07 15:31:47'),
(5, 2, 3, 2, 3, 0, 'BAD CONNECTION TO NET', 'Sometimes the connection is band and the applications goes down.', '', '2021-07-08 22:02:30'),
(6, 5, 4, 1, 3, 0, 'DOI UM DEDO', 'Tenho dores num dedo.', '', '2021-07-09 18:52:40');

--
-- Acionadores `ticket`
--
DELIMITER $$
CREATE TRIGGER `t_insert_new_ticket` AFTER INSERT ON `ticket` FOR EACH ROW BEGIN

INSERT INTO ticket_info_status (idTicket, idStatus)
VALUES(new.id, 1);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_category`
--

CREATE TABLE `ticket_category` (
  `id` int(11) NOT NULL,
  `category` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ticket_category`
--

INSERT INTO `ticket_category` (`id`, `category`) VALUES
(1, 'General'),
(2, 'Technical'),
(3, 'Application');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_info_status`
--

CREATE TABLE `ticket_info_status` (
  `id` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `idOwner` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `date_forecast` timestamp NULL DEFAULT NULL,
  `date_closed` timestamp NULL DEFAULT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ticket_info_status`
--

INSERT INTO `ticket_info_status` (`id`, `idTicket`, `idOwner`, `idStatus`, `date_forecast`, `date_closed`, `comment`) VALUES
(1, 1, 2, 3, NULL, '2021-07-09 19:08:47', 'NÃ£o consigo resolver.'),
(2, 2, 2, 3, NULL, '2021-07-09 19:06:27', 'Enganei-me no ticket.'),
(3, 3, 3, 2, NULL, NULL, ''),
(4, 4, 3, 1, NULL, NULL, ''),
(5, 5, 2, 2, NULL, NULL, ''),
(6, 6, 5, 3, NULL, '2021-07-09 18:55:57', 'NÃ£o tenho nada que possa fazer.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_priority`
--

CREATE TABLE `ticket_priority` (
  `id` int(11) NOT NULL,
  `priority` varchar(25) NOT NULL,
  `class` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ticket_priority`
--

INSERT INTO `ticket_priority` (`id`, `priority`, `class`) VALUES
(1, 'Low', 'bg-info'),
(2, 'Normal', 'bg-warning'),
(3, 'High', 'bg-danger');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ticket_status`
--

CREATE TABLE `ticket_status` (
  `id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `class` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ticket_status`
--

INSERT INTO `ticket_status` (`id`, `status`, `class`) VALUES
(1, 'Open', ''),
(2, 'Working Progress', ''),
(3, 'Closed', 'bg-success');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `idStatus`, `date_reg`) VALUES
(1, 'DigiGo', 'Web Solutions', 'freewebdev2021@gmail.com', '212ea9f68128d87d477e2d73e5b22abc768345de', 2, '2021-07-07 12:56:40'),
(2, 'AndrÃ©', 'Gomes', 'afgomes1983@gmail.com', '212ea9f68128d87d477e2d73e5b22abc768345de', 2, '2021-07-07 13:04:25'),
(3, 'TomÃ¡s', 'Lima', 'muxima2010@gmail.com', '212ea9f68128d87d477e2d73e5b22abc768345de', 2, '2021-07-07 13:14:10'),
(4, 'Rita', 'Gomes', 'andregomestgr@gmail.com', '212ea9f68128d87d477e2d73e5b22abc768345de', 2, '2021-07-07 13:22:17'),
(5, 'Roberto', 'Carlos', 'agrockmusic@gmail.com', '212ea9f68128d87d477e2d73e5b22abc768345de', 2, '2021-07-09 18:44:05');

--
-- Acionadores `user`
--
DELIMITER $$
CREATE TRIGGER `t_insert_user` AFTER INSERT ON `user` FOR EACH ROW BEGIN
#SET ID USER
SET @idUser = new.id;
#SELECT LAST STATUS
SET @idStatus = '';
SELECT idStatus INTO @idStatus
FROM user
WHERE id = @idUser;
#INSERT INTO
INSERT INTO user_logs (idUser, idStatus, operation)
VALUES (@idUser, @idStatus, "INSERTED" );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `t_update_user` AFTER UPDATE ON `user` FOR EACH ROW BEGIN

SET @idStatus = '';
SELECT idStatus INTO @idStatus
FROM user
WHERE id = old.id;

INSERT INTO user_logs (idUser, idStatus, operation)
VALUES (old.id, @idStatus, "UPDATED");



END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_display_status`
--

CREATE TABLE `user_display_status` (
  `id` int(11) NOT NULL,
  `display_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_display_status`
--

INSERT INTO `user_display_status` (`id`, `display_status`) VALUES
(1, 'Available'),
(2, 'Sick'),
(3, 'Work Remotely'),
(4, 'In a meeting'),
(5, 'Unavailable'),
(6, 'On Vacation');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_level`
--

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_level`
--

INSERT INTO `user_level` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'Tech'),
(3, 'Client');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_logs`
--

INSERT INTO `user_logs` (`id`, `idUser`, `idStatus`, `operation`, `date_reg`) VALUES
(1, 1, 1, 'INSERTED', '2021-07-07 12:56:40'),
(2, 1, 2, 'UPDATED', '2021-07-07 12:56:46'),
(3, 2, 1, 'INSERTED', '2021-07-07 13:04:25'),
(4, 2, 2, 'UPDATED', '2021-07-07 13:04:42'),
(5, 2, 2, 'UPDATED', '2021-07-07 13:06:07'),
(6, 1, 2, 'UPDATED', '2021-07-07 13:07:20'),
(7, 2, 2, 'UPDATED', '2021-07-07 13:11:28'),
(8, 1, 2, 'UPDATED', '2021-07-07 13:12:42'),
(9, 1, 2, 'UPDATED', '2021-07-07 13:12:53'),
(10, 1, 2, 'UPDATED', '2021-07-07 13:13:02'),
(11, 1, 2, 'UPDATED', '2021-07-07 13:13:16'),
(12, 3, 1, 'INSERTED', '2021-07-07 13:14:10'),
(13, 3, 2, 'UPDATED', '2021-07-07 13:14:24'),
(14, 3, 2, 'UPDATED', '2021-07-07 13:15:21'),
(15, 4, 1, 'INSERTED', '2021-07-07 13:22:17'),
(16, 4, 2, 'UPDATED', '2021-07-07 13:22:31'),
(17, 4, 2, 'UPDATED', '2021-07-07 13:57:26'),
(18, 4, 2, 'UPDATED', '2021-07-07 13:58:35'),
(19, 5, 1, 'INSERTED', '2021-07-09 18:44:05'),
(20, 5, 2, 'UPDATED', '2021-07-09 18:44:49'),
(21, 2, 2, 'UPDATED', '2021-07-09 19:02:27'),
(22, 2, 2, 'UPDATED', '2021-07-09 19:02:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_logs_request_psw_reset`
--

CREATE TABLE `user_logs_request_psw_reset` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_logs_request_psw_reset`
--

INSERT INTO `user_logs_request_psw_reset` (`id`, `idUser`, `operation`, `date_reg`) VALUES
(1, 4, 'REQUEST', '2021-07-07 13:23:01'),
(2, 4, 'RESET PSW', '2021-07-07 13:57:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_logs_session`
--

CREATE TABLE `user_logs_session` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `data_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_logs_session`
--

INSERT INTO `user_logs_session` (`id`, `idUser`, `operation`, `data_reg`) VALUES
(1, 1, 'LOGIN', '2021-07-07 12:56:55'),
(2, 1, 'LOGOUT', '2021-07-07 12:58:48'),
(3, 1, 'LOGIN', '2021-07-07 12:59:01'),
(4, 2, 'LOGIN', '2021-07-07 13:04:54'),
(5, 2, 'LOGOUT', '2021-07-07 13:06:40'),
(6, 1, 'LOGIN', '2021-07-07 13:06:47'),
(7, 1, 'LOGOUT', '2021-07-07 13:07:32'),
(8, 2, 'LOGIN', '2021-07-07 13:10:53'),
(9, 2, 'LOGOUT', '2021-07-07 13:11:34'),
(10, 1, 'LOGIN', '2021-07-07 13:12:09'),
(11, 1, 'LOGOUT', '2021-07-07 13:13:32'),
(12, 3, 'LOGIN', '2021-07-07 13:14:38'),
(13, 3, 'LOGOUT', '2021-07-07 13:16:13'),
(14, 2, 'LOGIN', '2021-07-07 13:16:34'),
(15, 2, 'LOGOUT', '2021-07-07 13:17:07'),
(16, 3, 'LOGIN', '2021-07-07 13:17:19'),
(17, 3, 'LOGOUT', '2021-07-07 13:19:21'),
(18, 2, 'LOGIN', '2021-07-07 13:19:45'),
(19, 2, 'LOGOUT', '2021-07-07 13:20:54'),
(20, 1, 'LOGIN', '2021-07-07 13:21:03'),
(21, 4, 'LOGIN', '2021-07-07 13:57:50'),
(22, 4, 'LOGOUT', '2021-07-07 13:59:26'),
(23, 2, 'LOGIN', '2021-07-07 13:59:38'),
(24, 2, 'LOGOUT', '2021-07-07 14:00:00'),
(25, 4, 'LOGIN', '2021-07-07 14:00:13'),
(26, 4, 'LOGOUT', '2021-07-07 14:01:50'),
(27, 2, 'LOGIN', '2021-07-07 14:02:02'),
(28, 2, 'LOGOUT', '2021-07-07 14:17:08'),
(29, 3, 'LOGIN', '2021-07-07 14:18:05'),
(30, 3, 'LOGOUT', '2021-07-07 14:21:48'),
(31, 4, 'LOGIN', '2021-07-07 14:22:00'),
(32, 4, 'LOGOUT', '2021-07-07 14:22:39'),
(33, 3, 'LOGIN', '2021-07-07 14:22:51'),
(34, 3, 'LOGOUT', '2021-07-07 14:36:16'),
(35, 2, 'LOGIN', '2021-07-07 14:36:27'),
(36, 2, 'LOGOUT', '2021-07-07 14:36:53'),
(37, 3, 'LOGIN', '2021-07-07 14:37:05'),
(38, 3, 'LOGOUT', '2021-07-07 14:38:57'),
(39, 4, 'LOGIN', '2021-07-07 14:39:10'),
(40, 4, 'LOGOUT', '2021-07-07 15:58:50'),
(41, 4, 'LOGIN', '2021-07-07 17:07:05'),
(42, 4, 'LOGOUT', '2021-07-07 17:33:08'),
(43, 2, 'LOGIN', '2021-07-07 17:33:22'),
(44, 2, 'LOGOUT', '2021-07-07 18:00:00'),
(45, 2, 'LOGIN', '2021-07-07 18:00:14'),
(46, 2, 'LOGOUT', '2021-07-07 18:18:19'),
(47, 2, 'LOGIN', '2021-07-07 18:20:35'),
(48, 2, 'LOGOUT', '2021-07-07 18:23:49'),
(49, 3, 'LOGIN', '2021-07-07 18:24:01'),
(50, 3, 'LOGOUT', '2021-07-07 18:24:53'),
(51, 4, 'LOGIN', '2021-07-07 18:25:05'),
(52, 4, 'LOGOUT', '2021-07-07 18:26:09'),
(53, 2, 'LOGIN', '2021-07-07 18:36:24'),
(54, 2, 'LOGOUT', '2021-07-07 19:03:29'),
(55, 4, 'LOGIN', '2021-07-07 19:03:45'),
(56, 4, 'LOGOUT', '2021-07-07 19:04:51'),
(57, 2, 'LOGIN', '2021-07-07 19:37:56'),
(58, 3, 'LOGIN', '2021-07-07 21:21:08'),
(59, 3, 'LOGOUT', '2021-07-07 21:21:34'),
(60, 4, 'LOGIN', '2021-07-07 21:22:41'),
(61, 4, 'LOGOUT', '2021-07-07 21:23:30'),
(62, 2, 'LOGIN', '2021-07-08 13:14:11'),
(63, 2, 'LOGOUT', '2021-07-08 13:18:52'),
(64, 2, 'LOGIN', '2021-07-08 13:21:35'),
(65, 2, 'LOGOUT', '2021-07-08 14:27:11'),
(66, 4, 'LOGIN', '2021-07-08 14:28:28'),
(67, 4, 'LOGOUT', '2021-07-08 14:43:27'),
(68, 2, 'LOGIN', '2021-07-08 14:43:39'),
(69, 2, 'LOGOUT', '2021-07-08 15:02:32'),
(70, 4, 'LOGIN', '2021-07-08 15:02:50'),
(71, 4, 'LOGOUT', '2021-07-08 16:19:54'),
(72, 2, 'LOGIN', '2021-07-08 16:20:07'),
(73, 2, 'LOGOUT', '2021-07-08 16:29:09'),
(74, 2, 'LOGIN', '2021-07-08 21:44:55'),
(75, 2, 'LOGOUT', '2021-07-08 22:26:39'),
(76, 4, 'LOGIN', '2021-07-08 22:27:04'),
(77, 4, 'LOGOUT', '2021-07-09 00:12:44'),
(78, 2, 'LOGIN', '2021-07-09 12:50:44'),
(79, 2, 'LOGOUT', '2021-07-09 13:06:34'),
(80, 4, 'LOGIN', '2021-07-09 13:06:47'),
(81, 4, 'LOGOUT', '2021-07-09 13:16:32'),
(82, 2, 'LOGIN', '2021-07-09 13:16:43'),
(83, 2, 'LOGOUT', '2021-07-09 14:17:07'),
(84, 2, 'LOGIN', '2021-07-09 18:21:13'),
(85, 2, 'LOGOUT', '2021-07-09 18:21:19'),
(86, 5, 'LOGIN', '2021-07-09 18:45:35'),
(87, 5, 'LOGOUT', '2021-07-09 18:57:21'),
(88, 2, 'LOGIN', '2021-07-09 18:57:58'),
(89, 2, 'LOGOUT', '2021-07-09 19:04:22'),
(90, 4, 'LOGIN', '2021-07-09 19:04:55'),
(91, 4, 'LOGOUT', '2021-07-09 19:06:48'),
(92, 3, 'LOGIN', '2021-07-09 19:07:14'),
(93, 3, 'LOGOUT', '2021-07-09 19:09:46'),
(94, 2, 'LOGIN', '2021-07-09 19:17:26'),
(95, 2, 'LOGOUT', '2021-07-09 19:17:38'),
(96, 3, 'LOGIN', '2021-07-09 19:17:48'),
(97, 2, 'LOGIN', '2021-07-09 19:22:46'),
(98, 2, 'LOGOUT', '2021-07-09 19:23:04'),
(99, 3, 'LOGIN', '2021-07-09 19:23:17'),
(100, 3, 'LOGOUT', '2021-07-09 19:23:54'),
(101, 2, 'LOGIN', '2021-07-09 19:24:13'),
(102, 2, 'LOGOUT', '2021-07-09 19:24:32'),
(103, 3, 'LOGIN', '2021-07-09 19:24:43'),
(104, 3, 'LOGOUT', '2021-07-09 19:30:48'),
(105, 2, 'LOGIN', '2021-07-09 19:30:59'),
(106, 2, 'LOGOUT', '2021-07-09 19:48:32');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `notification_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_notification`
--

INSERT INTO `user_notification` (`id`, `notification_type`) VALUES
(1, 'All'),
(2, 'Nothing'),
(3, 'Closed Ticket');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `idAvatar` int(11) NOT NULL,
  `idDisplay_status` int(11) NOT NULL,
  `idNotifications_type` int(11) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_settings`
--

INSERT INTO `user_settings` (`id`, `idUser`, `username`, `description`, `idAvatar`, `idDisplay_status`, `idNotifications_type`, `date_reg`) VALUES
(1, 1, 'The Great Doc', 'DigiGo App Admin', 2, 1, 1, '2021-07-07 13:13:02'),
(2, 2, 'Master Boss', 'CEO - DigiGo Web', 5, 6, 1, '2021-07-09 19:02:27'),
(3, 3, 'The worker', 'Junior Web Dev', 1, 3, 2, '2021-07-07 13:15:21'),
(4, 4, 'On Fire', 'Senior Web Dev', 2, 6, 2, '2021-07-07 13:58:35'),
(5, 5, '', '', 1, 1, 1, '2021-07-09 18:44:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user_status`
--

INSERT INTO `user_status` (`id`, `status`) VALUES
(1, 'inactive'),
(2, 'active');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_members_request`
-- (See below for the actual view)
--
CREATE TABLE `v_members_request` (
`idRequest` int(11)
,`idUser` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(100)
,`userStatus` varchar(50)
,`avatar` varchar(50)
,`idTeam` int(11)
,`team_name` varchar(100)
,`idRequestStatus` int(11)
,`Request` varchar(25)
,`dataReg` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_teams`
-- (See below for the actual view)
--
CREATE TABLE `v_teams` (
`id` int(11)
,`team_name` varchar(100)
,`email` varchar(100)
,`description` varchar(200)
,`type` varchar(50)
,`email_status` varchar(25)
,`dataReg` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_team_members`
-- (See below for the actual view)
--
CREATE TABLE `v_team_members` (
`id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(100)
,`status` varchar(50)
,`avatar` varchar(50)
,`idTeam` int(11)
,`team_name` varchar(100)
,`level` varchar(20)
,`date_reg` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ticket_card`
-- (See below for the actual view)
--
CREATE TABLE `v_ticket_card` (
`idTicket` int(11)
,`idTeam` int(11)
,`idOwner` int(11)
,`email` varchar(100)
,`category` varchar(25)
,`priority` varchar(25)
,`priorityClass` varchar(25)
,`old_idTicket` int(11)
,`subject` varchar(100)
,`message` varchar(255)
,`fileAttached` varchar(255)
,`dateReg` timestamp
,`status` varchar(25)
,`statusClass` varchar(25)
,`date_forecast` timestamp
,`date_closed` timestamp
,`comment` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user`
-- (See below for the actual view)
--
CREATE TABLE `v_user` (
`id` int(11)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`email` varchar(100)
,`status` varchar(50)
,`username` varchar(100)
,`description` varchar(255)
,`avatar` varchar(50)
,`display_status` varchar(25)
,`notification_type` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `v_members_request`
--
DROP TABLE IF EXISTS `v_members_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_members_request`  AS  select `team_user_request`.`id` AS `idRequest`,`user`.`id` AS `idUser`,`user`.`first_name` AS `first_name`,`user`.`last_name` AS `last_name`,`user`.`email` AS `email`,`user_status`.`status` AS `userStatus`,`avatar`.`avatar` AS `avatar`,`team`.`id` AS `idTeam`,`team`.`team_name` AS `team_name`,`team_user_request`.`idRequestSatus` AS `idRequestStatus`,`team_request_status`.`status` AS `Request`,`team_user_request`.`dataReg` AS `dataReg` from ((((((`user` join `user_status`) join `avatar`) join `user_settings`) join `team`) join `team_user_request`) join `team_request_status`) where ((`user`.`idStatus` = `user_status`.`id`) and (`user_settings`.`idUser` = `user`.`id`) and (`user_settings`.`idAvatar` = `avatar`.`id`) and (`team_user_request`.`idUser` = `user`.`id`) and (`team_user_request`.`idTeam` = `team`.`id`) and (`team_user_request`.`idRequestSatus` = `team_request_status`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_teams`
--
DROP TABLE IF EXISTS `v_teams`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_teams`  AS  select `team`.`id` AS `id`,`team`.`team_name` AS `team_name`,`team`.`email` AS `email`,`team`.`description` AS `description`,`team_type`.`type` AS `type`,`email_status`.`status` AS `email_status`,`team`.`dataReg` AS `dataReg` from ((`team` join `team_type`) join `email_status`) where ((`team`.`idType` = `team_type`.`id`) and (`team`.`idStatus_Email` = `email_status`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_team_members`
--
DROP TABLE IF EXISTS `v_team_members`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_team_members`  AS  select `user`.`id` AS `id`,`user`.`first_name` AS `first_name`,`user`.`last_name` AS `last_name`,`user`.`email` AS `email`,`user_status`.`status` AS `status`,`avatar`.`avatar` AS `avatar`,`team`.`id` AS `idTeam`,`team`.`team_name` AS `team_name`,`user_level`.`level` AS `level`,`user`.`date_reg` AS `date_reg` from ((((((`user` join `user_status`) join `user_level`) join `user_settings`) join `avatar`) join `team_user_level`) join `team`) where ((`user`.`idStatus` = `user_status`.`id`) and (`user_settings`.`idAvatar` = `avatar`.`id`) and (`user_settings`.`idUser` = `user`.`id`) and (`team_user_level`.`idUser` = `user`.`id`) and (`team_user_level`.`idTeam` = `team`.`id`) and (`team_user_level`.`idLevel` = `user_level`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_ticket_card`
--
DROP TABLE IF EXISTS `v_ticket_card`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticket_card`  AS  select `ticket`.`id` AS `idTicket`,`team`.`id` AS `idTeam`,`ticket_info_status`.`idOwner` AS `idOwner`,`user`.`email` AS `email`,`ticket_category`.`category` AS `category`,`ticket_priority`.`priority` AS `priority`,`ticket_priority`.`class` AS `priorityClass`,`ticket`.`old_idTicket` AS `old_idTicket`,`ticket`.`subject` AS `subject`,`ticket`.`message` AS `message`,`ticket`.`fileAttached` AS `fileAttached`,`ticket`.`dateReg` AS `dateReg`,`ticket_status`.`status` AS `status`,`ticket_status`.`class` AS `statusClass`,`ticket_info_status`.`date_forecast` AS `date_forecast`,`ticket_info_status`.`date_closed` AS `date_closed`,`ticket_info_status`.`comment` AS `comment` from ((((((`user` join `ticket`) join `ticket_status`) join `ticket_priority`) join `ticket_info_status`) join `ticket_category`) join `team`) where ((`ticket`.`idUser` = `user`.`id`) and (`ticket`.`idTeam` = `team`.`id`) and (`ticket`.`idCategory` = `ticket_category`.`id`) and (`ticket`.`idPriority` = `ticket_priority`.`id`) and (`ticket_info_status`.`idTicket` = `ticket`.`id`) and (`ticket_info_status`.`idStatus` = `ticket_status`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_user`
--
DROP TABLE IF EXISTS `v_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_user`  AS  select `user`.`id` AS `id`,`user`.`first_name` AS `first_name`,`user`.`last_name` AS `last_name`,`user`.`email` AS `email`,`user_status`.`status` AS `status`,`user_settings`.`username` AS `username`,`user_settings`.`description` AS `description`,`avatar`.`avatar` AS `avatar`,`user_display_status`.`display_status` AS `display_status`,`user_notification`.`notification_type` AS `notification_type` from (((((`user` join `user_status`) join `user_settings`) join `avatar`) join `user_notification`) join `user_display_status`) where ((`user`.`idStatus` = `user_status`.`id`) and (`user_settings`.`idUser` = `user`.`id`) and (`user_settings`.`idAvatar` = `avatar`.`id`) and (`user_settings`.`idDisplay_status` = `user_display_status`.`id`) and (`user_settings`.`idNotifications_type` = `user_notification`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_status`
--
ALTER TABLE `email_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idType` (`idType`),
  ADD KEY `team_ibfk_2` (`idStatus_Email`);

--
-- Indexes for table `team_email_token`
--
ALTER TABLE `team_email_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_email_token_ibfk_1` (`idTeam`);

--
-- Indexes for table `team_logs`
--
ALTER TABLE `team_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idTeam` (`idTeam`);

--
-- Indexes for table `team_request_status`
--
ALTER TABLE `team_request_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_type`
--
ALTER TABLE `team_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_user_level`
--
ALTER TABLE `team_user_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idLevel` (`idLevel`),
  ADD KEY `idTeam` (`idTeam`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `team_user_request`
--
ALTER TABLE `team_user_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idTeam` (`idTeam`),
  ADD KEY `idRequestSatus` (`idRequestSatus`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCategory` (`idCategory`),
  ADD KEY `idPriority` (`idPriority`),
  ADD KEY `idTeam` (`idTeam`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `ticket_category`
--
ALTER TABLE `ticket_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_info_status`
--
ALTER TABLE `ticket_info_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTicket` (`idTicket`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Indexes for table `ticket_priority`
--
ALTER TABLE `ticket_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Indexes for table `user_display_status`
--
ALTER TABLE `user_display_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idStatus` (`idStatus`);

--
-- Indexes for table `user_logs_request_psw_reset`
--
ALTER TABLE `user_logs_request_psw_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `user_logs_session`
--
ALTER TABLE `user_logs_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDisplay_status` (`idDisplay_status`),
  ADD KEY `idNotifications_type` (`idNotifications_type`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idAvatar` (`idAvatar`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `email_status`
--
ALTER TABLE `email_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `team_email_token`
--
ALTER TABLE `team_email_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_logs`
--
ALTER TABLE `team_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_request_status`
--
ALTER TABLE `team_request_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team_type`
--
ALTER TABLE `team_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team_user_level`
--
ALTER TABLE `team_user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `team_user_request`
--
ALTER TABLE `team_user_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_category`
--
ALTER TABLE `ticket_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_info_status`
--
ALTER TABLE `ticket_info_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticket_priority`
--
ALTER TABLE `ticket_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_display_status`
--
ALTER TABLE `user_display_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_logs_request_psw_reset`
--
ALTER TABLE `user_logs_request_psw_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_logs_session`
--
ALTER TABLE `user_logs_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`idType`) REFERENCES `team_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`idStatus_Email`) REFERENCES `email_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `team_email_token`
--
ALTER TABLE `team_email_token`
  ADD CONSTRAINT `team_email_token_ibfk_1` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `team_logs`
--
ALTER TABLE `team_logs`
  ADD CONSTRAINT `team_logs_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_logs_ibfk_2` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `team_user_level`
--
ALTER TABLE `team_user_level`
  ADD CONSTRAINT `team_user_level_ibfk_1` FOREIGN KEY (`idLevel`) REFERENCES `user_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_user_level_ibfk_2` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_user_level_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `team_user_request`
--
ALTER TABLE `team_user_request`
  ADD CONSTRAINT `team_user_request_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_user_request_ibfk_2` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_user_request_ibfk_3` FOREIGN KEY (`idRequestSatus`) REFERENCES `team_request_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `ticket_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`idPriority`) REFERENCES `ticket_priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`idTeam`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `ticket_info_status`
--
ALTER TABLE `ticket_info_status`
  ADD CONSTRAINT `ticket_info_status_ibfk_2` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_info_status_ibfk_3` FOREIGN KEY (`idStatus`) REFERENCES `ticket_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idStatus`) REFERENCES `user_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user_logs_request_psw_reset`
--
ALTER TABLE `user_logs_request_psw_reset`
  ADD CONSTRAINT `user_logs_request_psw_reset_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user_settings`
--
ALTER TABLE `user_settings`
  ADD CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`idDisplay_status`) REFERENCES `user_display_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_settings_ibfk_2` FOREIGN KEY (`idNotifications_type`) REFERENCES `user_notification` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_settings_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_settings_ibfk_4` FOREIGN KEY (`idAvatar`) REFERENCES `avatar` (`id`);

--
-- Limitadores para a tabela `user_token`
--
ALTER TABLE `user_token`
  ADD CONSTRAINT `user_token_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
