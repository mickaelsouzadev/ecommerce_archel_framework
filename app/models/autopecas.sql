-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Dez-2018 às 01:49
-- Versão do servidor: 5.7.19
-- versão do PHP: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autopecas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(60) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `deletado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `endereco`, `telefone`, `email`, `senha`, `deletado`) VALUES
(1, 'DIEGO DE LOS SANTOS', '123456789', 'qrwrqrqrqrqrqrqrqr', '123456789', 'diegodelossantos497@gmail.com', '$2y$10$HYNHYTfFoDSE9bI8aw8jL.uOsCw/F/k0NGS4h0MJ9.ADmpSHXcHiG', 0),
(4, 'Mickael Braz de Souza', '123456789', 'Rua sei la', '(55)84041268', 'mickael.souza.if@gmail.com', '$2y$10$xcnEt0zux2c8/.dFbkK6DugYC4kzMuu6d.h6YQ/o7XkzFtSJWZeQm', 0),
(5, 'Mitsubishi', '14474747474747', 'fdfadfafa', '5555545454', 'juaodacosta@mmm.com', '$2y$10$Fz6kAk1yXRcWBEeopkQKCexYvuloGLPgyOuo68xm4/Nvufn4xEGbS', 0),
(6, 'Mitsubishi', '2115255454544545', '545454545454', '5454554545', 'uio@faiomail.com', '$2y$10$vfRfGGOsQOuvh2PXwvg1SeV3wLowIY.7S9XFV/5n7d1RFDwcRGIhO', 0),
(7, 'Mitsubishi', '123', '123', '123', 'mitu@mitu.com', '$2y$10$ojFyJjHbfPpj7ZmPcpr0dO.1VtJ1k6prof/oWeIszAbTUntIc3Y/C', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_subtotal` float NOT NULL,
  `valor_frete` float NOT NULL,
  `deletado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_peca`
--

CREATE TABLE `compra_peca` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `deletado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envios`
--

CREATE TABLE `envios` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `data` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(200) NOT NULL,
  `cnpj` varchar(60) NOT NULL,
  `telefone` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pagina_web` varchar(255) NOT NULL,
  `deletado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor_peca`
--

CREATE TABLE `fornecedor_peca` (
  `id` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `codigo_peca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_peca`
--

CREATE TABLE `imagem_peca` (
  `id` int(11) NOT NULL,
  `id_peca` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `valor` float NOT NULL,
  `data_pagamento` date NOT NULL,
  `aprovado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `peca`
--

CREATE TABLE `peca` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `valor_compra` float NOT NULL,
  `valor_venda` float NOT NULL,
  `marca` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `compatibilidade` varchar(255) NOT NULL,
  `dimensoes_pacote` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `deletado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `valor_total` float NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_compra` int(11) NOT NULL,
  `valor_frete` float NOT NULL,
  `cep` varchar(80) NOT NULL,
  `id_envio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compra_peca`
--
ALTER TABLE `compra_peca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fornecedor_peca`
--
ALTER TABLE `fornecedor_peca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagem_peca`
--
ALTER TABLE `imagem_peca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peca`
--
ALTER TABLE `peca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compra_peca`
--
ALTER TABLE `compra_peca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fornecedor_peca`
--
ALTER TABLE `fornecedor_peca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagem_peca`
--
ALTER TABLE `imagem_peca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peca`
--
ALTER TABLE `peca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
