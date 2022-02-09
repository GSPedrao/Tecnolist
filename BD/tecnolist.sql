-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jan-2022 às 23:34
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tecnolist`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ativo`
--

CREATE TABLE `ativo` (
  `id_ativo` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_localizacao` int(11) NOT NULL,
  `patrimonio` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ativo`
--

INSERT INTO `ativo` (`id_ativo`, `descricao`, `id_tipo`, `id_usuario`, `id_localizacao`, `patrimonio`) VALUES
(1, '1', 1, 1, 1, 1),
(4, 'efsda', 1, 1, 1, 1),
(7, ' adfvgbw', 1, 1, 1, 3425);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE `chamado` (
  `id_chamada` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `data_abertura` datetime NOT NULL,
  `data_fechamento` datetime NOT NULL,
  `status` varchar(45) NOT NULL,
  `id_ativo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_de_usuario`
--

CREATE TABLE `grupo_de_usuario` (
  `id_grupo` int(11) NOT NULL,
  `nome_grupo` varchar(45) NOT NULL,
  `nivel` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo_de_usuario`
--

INSERT INTO `grupo_de_usuario` (`id_grupo`, `nome_grupo`, `nivel`) VALUES
(2, 'tecnico', 2),
(3, 'colaborador', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

CREATE TABLE `localizacao` (
  `id_localizacao` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`id_localizacao`, `descricao`) VALUES
(1, 'LAB01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id_tipo`, `descricao`) VALUES
(1, 'impressora');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `ativo` binary(1) DEFAULT '1',
  `id_grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `ativo`, `id_grupo`) VALUES
(1, 'joao', '202cb962ac59075b964b07152d234b70', 0x31, 2),
(2, 'pedro', '202cb962ac59075b964b07152d234b70', 0x31, 3),
(12, 'kaka', '202cb962ac59075b964b07152d234b70', 0x31, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ativo`
--
ALTER TABLE `ativo`
  ADD PRIMARY KEY (`id_ativo`,`id_usuario`),
  ADD KEY `fk_ativo_tipo1` (`id_tipo`),
  ADD KEY `fk_ativo_usuario1` (`id_usuario`),
  ADD KEY `fk_ativo_localizacao1` (`id_localizacao`);

--
-- Indexes for table `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`id_chamada`,`id_ativo`,`id_usuario`),
  ADD KEY `fk_chamado_ativo1` (`id_ativo`),
  ADD KEY `fk_chamado_usuario1` (`id_usuario`);

--
-- Indexes for table `grupo_de_usuario`
--
ALTER TABLE `grupo_de_usuario`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `localizacao`
--
ALTER TABLE `localizacao`
  ADD PRIMARY KEY (`id_localizacao`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ativo`
--
ALTER TABLE `ativo`
  MODIFY `id_ativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chamado`
--
ALTER TABLE `chamado`
  MODIFY `id_chamada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grupo_de_usuario`
--
ALTER TABLE `grupo_de_usuario`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `localizacao`
--
ALTER TABLE `localizacao`
  MODIFY `id_localizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ativo`
--
ALTER TABLE `ativo`
  ADD CONSTRAINT `fk_ativo_localizacao1` FOREIGN KEY (`id_localizacao`) REFERENCES `localizacao` (`id_localizacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ativo_tipo1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ativo_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `chamado`
--
ALTER TABLE `chamado`
  ADD CONSTRAINT `chamado_ibfk_1` FOREIGN KEY (`id_ativo`) REFERENCES `ativo` (`id_ativo`),
  ADD CONSTRAINT `fk_chamado_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_de_usuario` (`id_grupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
