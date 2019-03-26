-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/03/2019 às 11:58
-- Versão do servidor: 5.7.25-0ubuntu0.18.04.2
-- Versão do PHP: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crimemappingweb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `crime`
--

CREATE TABLE `crime` (
  `id_crime` int(11) NOT NULL,
  `gravidade` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `grvd` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `registro`
--

INSERT INTO `registro` (`id_registro`, `data`, `lat`, `lng`, `grvd`) VALUES
(1, '2019-03-14 10:52:02', '-12.194959475695427', '-53.62890733101885', '3'),
(2, '2019-03-14 10:58:37', '-11.729526902192987', '-42.35351562501802', '3'),
(3, '2019-03-14 11:00:46', '-5.069888579785811', '-41.34229761950223', '5'),
(4, '2019-03-14 11:03:07', '-13.530486817199858', '-38.90380859376134', '2'),
(5, '2019-03-14 11:04:01', '-14.10657508985291', '-43.89160156251296', '3'),
(6, '2019-03-14 11:06:02', '-13.10285085375547', '-38.96972656251731', '4'),
(7, '2019-03-14 11:06:27', '-12.417094818090092', '-53.691406250017224', '1'),
(8, '2019-03-14 11:09:04', '-5.283655697092996', '-37.532197727567365', '2'),
(9, '2019-03-14 11:10:11', '-14.149191202523497', '-47.62695312501154', '4'),
(10, '2019-03-14 11:11:27', '-12.245369033864165', '-53.405761718766854', '4'),
(11, '2019-03-14 11:13:49', '-13.145648311540128', '-43.64990234376654', '4'),
(12, '2019-03-14 11:16:49', '-11.061806799489432', '-42.77099609376336', '3'),
(13, '2019-03-14 11:17:43', '-13.145648311540128', '-42.57324218751245', '4'),
(14, '2019-03-14 11:18:11', '-13.145648311540128', '-42.57324218751245', '4'),
(15, '2019-03-14 11:18:34', '-13.145648311540128', '-42.57324218751245', '4'),
(16, '2019-03-14 11:19:47', '-12.180942967469505', '-55.75683593751745', '3'),
(17, '2019-03-14 11:21:16', '-11.04024158517882', '-62.59033203126637', '2'),
(18, '2019-03-14 11:22:05', '-15.105899981854648', '-40.90332031251407', '2'),
(19, '2019-03-14 11:22:28', '-9.114942576111233', '-52.81250000001407', '4'),
(20, '2019-03-14 11:23:10', '-4.8162694276354046', '-38.52106300377443', '3'),
(21, '2019-03-14 11:24:18', '-5.70305718041007', '-47.508743610353264', '3'),
(22, '2019-03-14 11:25:30', '-10.587010766485392', '-45.14404296876597', '2'),
(23, '2019-03-14 11:26:03', '-11.191164661535012', '-44.41894531251822', '4'),
(24, '2019-03-14 11:27:39', '-4.275530573224117', '-38.83113195805106', '5'),
(25, '2019-03-14 11:32:27', '-13.615922723960026', '-43.342285156264154', '5'),
(26, '2019-03-14 11:33:49', '-12.07353146973378', '-53.82324218751219', '1'),
(27, '2019-03-14 11:36:34', '-11.100744041656881', '-37.27356371844732', '2'),
(28, '2019-03-14 11:40:13', '-3.9429993516134516', '-38.6621093748702', '3'),
(29, '2019-03-14 11:41:24', '-14.276991516409765', '-40.20019531255622', '3'),
(30, '2019-03-14 11:42:19', '-14.66632998334714', '-40.58359634466976', '3');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `senha` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `nickname`, `senha`) VALUES
(1, 'crimemapping', 'crimemapping@map.com', 'crimemapping', '777524F0CF9C792596EB2B3C57801DBD37B6999910D7E693922AB25C9193FAA9');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`id_crime`);

--
-- Índices de tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD UNIQUE KEY `id_registro` (`id_registro`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `crime`
--
ALTER TABLE `crime`
  MODIFY `id_crime` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
