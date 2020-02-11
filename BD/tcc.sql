-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Fev-2020 às 18:49
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao`
--

CREATE TABLE `cartao` (
  `id` int(11) NOT NULL,
  `nomeCartao` varchar(150) NOT NULL,
  `mes` char(2) NOT NULL,
  `ano` char(4) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `codigo` char(5) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `texto` text NOT NULL,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id`, `titulo`, `texto`, `nome`, `foto`, `login_id`) VALUES
(1, 'Titulo do texto', 'If you are using the  element to specify multiple  elements for a specific , make sure to add the .img-* classes to the  and not to the  tag.', 'Marcos Murilo', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2669783786469744&height=200&width=200&ext=1583779134&hash=AeSPai-ZpM3nbRVN', 1),
(2, 'Titulo do texto 2', 'If you are using the  element to specify multiple  elements for a specific , make sure to add the .img-* classes to the  and not to the  tag.', 'Marcos Murilo', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2669783786469744&height=200&width=200&ext=1583779134&hash=AeSPai-ZpM3nbRVN', 1),
(4, 'Titulo do texto 3', 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual.', 'Marcos', 'https://gclaw.com.br/wp-content/themes/tema-gclaw-2017/assets/images/sem-foto.jpg', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `celular` varchar(15) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documento`
--

INSERT INTO `documento` (`id`, `cpf`, `rg`, `date`, `celular`, `login_id`) VALUES
(8, '098.775.139-51', '10.518.198-0', '1997-04-18', '(44)99917-6602', 3),
(9, '098.775.139-51', '22', '1997-04-18', '(44)99917-6602', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `complemento` varchar(40) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(70) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `rua`, `complemento`, `bairro`, `cidade`, `estado`, `numero`, `login_id`) VALUES
(9, '87501-130', 'Avenida Rio Branco', 'casa', 'Zona I', 'Umuarama', 'PR', '12', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `facebook_id` varchar(30) DEFAULT NULL,
  `google_id` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `forget` varchar(254) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id`, `nome`, `sobrenome`, `email`, `senha`, `facebook_id`, `google_id`, `foto`, `forget`, `created_at`, `updated_at`) VALUES
(1, 'Marcos Murilo', 'Meschial', 'marcosmurilo41@hotmail.com', '$2y$10$h/o4yJ.uLlHV1NfR6NxxcOj6Uwt1ZpJZsXUXGssS68bv1wUYnG7ce', '2669783786469744', NULL, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2669783786469744&height=200&width=200&ext=1583779134&hash=AeSPai-ZpM3nbRVN', NULL, '2020-02-08 22:39:26', '2020-02-08 22:39:27'),
(2, 'Marcos Murilo', 'Meschial', 'formatacaoumuarama@gmail.com', '$2y$10$e8kkeg90etpzga2WwvnqsuLQORKwrMOLIPp1Yh7veFLqouI6pxLv6', NULL, '113694760897549684052', 'https://lh3.googleusercontent.com/a-/AAuE7mCeRsfNt0lhtqpqukFPg2zGzT6cqCTSNesUDh69kv4', NULL, '2020-02-08 22:56:38', '2020-02-08 22:56:38'),
(3, 'Marcos', 'Meschial', 'marcosmeschial@gmail.com', '$2y$10$7u/M0qH2Ua2pcLjQe4Hm0uOtjQDtPOlFUKiOSzc0obDFuI9dtScSW', NULL, '105375340011604853342', 'https://lh5.googleusercontent.com/--BaA8L5oZtA/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rejkLL1WyiB4Uzc0uOF-_K-etTHZA/photo.jpg', NULL, '2020-02-10 06:02:25', '2020-02-10 06:02:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE `motorista` (
  `id` int(11) NOT NULL,
  `tipo_cnh` char(23) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `foto` varchar(244) NOT NULL,
  `ativo` char(2) DEFAULT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motorista`
--

INSERT INTO `motorista` (`id`, `tipo_cnh`, `cnh`, `foto`, `ativo`, `login_id`) VALUES
(14, 'A/B', '222.222.222-22', 'img/motorista/2020/02/1.jpg', 'N', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `valor` double NOT NULL,
  `data` date NOT NULL,
  `venda_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tamanho` char(2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rota`
--

CREATE TABLE `rota` (
  `id` int(11) NOT NULL,
  `quantidade` int(3) NOT NULL,
  `valor` double NOT NULL,
  `cep_inicio` varchar(15) NOT NULL,
  `cep_fim` varchar(15) NOT NULL,
  `data_inicio` date NOT NULL,
  `cidade_inicio` varchar(60) NOT NULL,
  `cidade_fim` varchar(60) NOT NULL,
  `tamahno` char(2) NOT NULL,
  `motorista_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `tipo` char(2) NOT NULL,
  `venda_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `date` date NOT NULL,
  `rota_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cartao`
--
ALTER TABLE `cartao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `motorista`
--
ALTER TABLE `motorista`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rota`
--
ALTER TABLE `rota`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cartao`
--
ALTER TABLE `cartao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `motorista`
--
ALTER TABLE `motorista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rota`
--
ALTER TABLE `rota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
