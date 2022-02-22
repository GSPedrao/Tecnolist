-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Fev-2022 às 19:01
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tecnolist`
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
(7, ' adfvgbw', 1, 1, 1, 3425),
(9, ' OI', 1, 13, 1, 123487),
(10, ' tr5h', 1, 1, 1, 34251324),
(11, ' Notbook intel i3 da hp', 1, 2, 1, 2147483647),
(12, ' pdo', 1, 2, 1, 123123123),
(13, ' PDO1', 1, 2, 1, 34515125),
(14, ' dsaasf', 1, 2, 1, 12441),
(15, '1231231', 1, 1, 1, 0),
(16, 'dasasdasdasfcadsfasdcvasfasdf', 1, 1, 1, 13248790);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE `chamado` (
  `id_chamado` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `data_abertura` datetime NOT NULL,
  `data_fechamento` datetime NOT NULL,
  `status` binary(1) DEFAULT '1',
  `id_ativo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chamado`
--

INSERT INTO `chamado` (`id_chamado`, `descricao`, `data_abertura`, `data_fechamento`, `status`, `id_ativo`, `id_usuario`) VALUES
(22, 'dasfsgcvdgadsf', '2022-02-08 09:49:48', '0000-00-00 00:00:00', 0x32, 4, 1),
(23, 'dsfadsgqabshdgfss', '2022-02-08 09:49:52', '0000-00-00 00:00:00', 0x32, 4, 1),
(24, 'dsgtiylukythgrsethu', '2022-02-08 09:49:56', '0000-00-00 00:00:00', 0x32, 1, 1),
(25, 'edferwgt5hy6ju7kiolpÃ§lokijuhgtfdcs', '2022-02-08 09:50:01', '0000-00-00 00:00:00', 0x32, 4, 1),
(40, 'dfsagghfjshdgklkjçh', '2022-02-18 14:22:49', '0000-00-00 00:00:00', 0x31, 9, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_de_usuario`
--

CREATE TABLE `grupo_de_usuario` (
  `id_grupo` int(11) NOT NULL,
  `nome_grupo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo_de_usuario`
--

INSERT INTO `grupo_de_usuario` (`id_grupo`, `nome_grupo`) VALUES
(2, 'tecnico'),
(3, 'colaborador');

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
(1, 'impressora'),
(2, 'Notbook');

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
(2, 'Pedro Paulo e Alex em forma de pegador oooh oooh', '202cb962ac59075b964b07152d234b70', 0x32, 3),
(12, 'robertinhos', '202cb962ac59075b964b07152d234b70', 0x32, 3),
(13, '', '95dd1694c7aee356e93c9525cf3005d9', 0x31, 2),
(14, 'picolo', '202cb962ac59075b964b07152d234b70', 0x32, 3),
(15, 'pedro', '202cb962ac59075b964b07152d234b70', 0x31, 3),
(16, 'Relampago Kevoso', '202cb962ac59075b964b07152d234b70', 0x31, 3),
(17, 'joel', '202cb962ac59075b964b07152d234b70', 0x32, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ativo`
--
ALTER TABLE `ativo`
  ADD PRIMARY KEY (`id_ativo`,`id_usuario`),
  ADD KEY `fk_ativo_tipo1` (`id_tipo`),
  ADD KEY `fk_ativo_usuario1` (`id_usuario`),
  ADD KEY `fk_ativo_localizacao1` (`id_localizacao`);

--
-- Índices para tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`id_chamado`,`id_ativo`,`id_usuario`),
  ADD KEY `fk_chamado_ativo1` (`id_ativo`),
  ADD KEY `fk_chamado_usuario1` (`id_usuario`);

--
-- Índices para tabela `grupo_de_usuario`
--
ALTER TABLE `grupo_de_usuario`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Índices para tabela `localizacao`
--
ALTER TABLE `localizacao`
  ADD PRIMARY KEY (`id_localizacao`);

--
-- Índices para tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ativo`
--
ALTER TABLE `ativo`
  MODIFY `id_ativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `id_chamado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `grupo_de_usuario`
--
ALTER TABLE `grupo_de_usuario`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `localizacao`
--
ALTER TABLE `localizacao`
  MODIFY `id_localizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
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
