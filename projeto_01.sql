-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/02/2025 às 23:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_01`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.categorias`
--

CREATE TABLE `tb_admin.categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.categorias`
--

INSERT INTO `tb_admin.categorias` (`id`, `nome`, `slug`, `order_id`) VALUES
(4, 'Fogo', 'fogo', 4),
(5, 'Água', 'agua', 5),
(6, 'Grama', 'grama', 6),
(7, 'Elétrico', 'eletrico', 7),
(8, 'Voador', 'voador', 8),
(9, 'Pedra', 'pedra', 9),
(10, 'Folha', 'folha', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.config`
--

CREATE TABLE `tb_admin.config` (
  `titulo` varchar(255) NOT NULL,
  `nome_autor` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `icone1` varchar(255) NOT NULL,
  `descricao1` text NOT NULL,
  `icone2` varchar(255) NOT NULL,
  `descricao2` text NOT NULL,
  `icone3` varchar(255) NOT NULL,
  `descricao3` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.config`
--

INSERT INTO `tb_admin.config` (`titulo`, `nome_autor`, `descricao`, `icone1`, `descricao1`, `icone2`, `descricao2`, `icone3`, `descricao3`) VALUES
('Pokédex', 'Luan Treuke', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'fa-brandsfa-html5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'fa-brandsfa-css3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'fa-brandsfa-js', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.depoimentos`
--

CREATE TABLE `tb_admin.depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.depoimentos`
--

INSERT INTO `tb_admin.depoimentos` (`id`, `nome`, `depoimento`, `data`, `order_id`) VALUES
(3, 'Luan Eduardo Treuke', 'teste2', '02/13/123', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.noticias`
--

CREATE TABLE `tb_admin.noticias` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `capa` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.noticias`
--

INSERT INTO `tb_admin.noticias` (`id`, `categoria_id`, `titulo`, `conteudo`, `capa`, `slug`, `order_id`) VALUES
(10, 10, 'bulbassauro', '<p>asda</p>', '67bceb6e0ac2b.png', '0', 10),
(11, 10, 'caterpie', '<p>asdasdasf</p>', '67bceb7842b56.png', '0', 11),
(12, 10, 'teste', '<p>hgfjkf</p>', '67bcec9d97222.png', '0', 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.online`
--

CREATE TABLE `tb_admin.online` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(12, '::1', '2025-02-24 19:07:34', '67bce110b28ab');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.servicos`
--

CREATE TABLE `tb_admin.servicos` (
  `id` int(11) NOT NULL,
  `servico` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.slides`
--

CREATE TABLE `tb_admin.slides` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `slide` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.slides`
--

INSERT INTO `tb_admin.slides` (`id`, `nome`, `slide`, `order_id`) VALUES
(2, 'Grupo pokemón 1', '67bccb1a42e74.jpg', 2),
(3, 'Grupo pokemón 2', '67bccbabf04c1.jpg', 3),
(4, 'Grupo pokemón 3', '67bccbbdc1622.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.usuarios`
--

CREATE TABLE `tb_admin.usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`) VALUES
(1, 'admin', 'admin', '67a22a0d00393.jpg', 'Luan', 2),
(2, 'LuanTreuke', 'admin', '', 'Luan', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.visitas`
--

CREATE TABLE `tb_admin.visitas` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_admin.categorias`
--
ALTER TABLE `tb_admin.categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.depoimentos`
--
ALTER TABLE `tb_admin.depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.noticias`
--
ALTER TABLE `tb_admin.noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.slides`
--
ALTER TABLE `tb_admin.slides`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin.categorias`
--
ALTER TABLE `tb_admin.categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_admin.depoimentos`
--
ALTER TABLE `tb_admin.depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_admin.noticias`
--
ALTER TABLE `tb_admin.noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_admin.online`
--
ALTER TABLE `tb_admin.online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_admin.slides`
--
ALTER TABLE `tb_admin.slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_admin.usuarios`
--
ALTER TABLE `tb_admin.usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_admin.noticias`
--
ALTER TABLE `tb_admin.noticias`
  ADD CONSTRAINT `tb_admin.noticias_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `tb_admin.categorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
