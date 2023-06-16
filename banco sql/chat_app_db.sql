-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Maio-2023 às 01:18
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `chat_app_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `usuario_id` int(11) NOT NULL,
  `NomeCompleto` varchar(255) NOT NULL,
  `NomeUsuario` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NumeroTelefone` varchar(35) NOT NULL,
  `Senha` varchar(15) NOT NULL,
  `ConfirmarSenha` varchar(15) NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
  `p_p` varchar(255) NOT NULL DEFAULT 'User-default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`usuario_id`, `NomeCompleto`, `NomeUsuario`, `Email`, `NumeroTelefone`, `Senha`, `ConfirmarSenha`, `last_seen`, `p_p`) VALUES
(24, 'alex', 'Sandro', 'teste@gmail.com', '564514351435', '123', '123', '2023-05-30 16:14:22', 'User-default.png'),
(25, 'felipe', 'jogadoor', 'ajdiljkldjlk@gmail.com', '6848146886', '123', '123', '2023-05-30 16:15:30', 'User-default.png'),
(26, 'camila', 'cami', 'cami@gmail.com', '1241455254435', '123', '123', '2023-05-30 16:19:25', 'User-default.png'),
(27, 'vitor', 'ronaldo', 'teste@teste.com', '326554867', '123', '123', '2023-05-30 19:56:04', 'User-default.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `opened`, `created_at`) VALUES
(1, 5, 1, 'salve\n', 0, '2023-05-04 15:12:46'),
(2, 2, 3, 'salve', 1, '2023-05-04 15:13:50'),
(3, 2, 4, 'sadsd', 1, '2023-05-04 15:13:57'),
(4, 2, 4, 'asdasd', 1, '2023-05-04 15:14:04'),
(5, 4, 2, 'opa', 0, '2023-05-04 15:26:37'),
(6, 3, 2, 'eai mano', 0, '2023-05-04 15:27:25'),
(7, 3, 2, 'tudo tranquilo ', 0, '2023-05-04 15:27:46'),
(8, 3, 2, 'tudo suave meu mano ', 0, '2023-05-04 15:27:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user_1`, `user_2`) VALUES
(1, 5, 1),
(2, 2, 3),
(3, 2, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `depoimento`
--

CREATE TABLE `depoimento` (
  `depoimento_id` int(11) NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `historia` text NOT NULL,
  `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `depoimento`
--

INSERT INTO `depoimento` (`depoimento_id`, `titulo`, `historia`, `last_seen`, `usuario_id`) VALUES
(29, 'testess', '        \r\n           mais um teste     ', '2023-05-30 16:14:40', 24),
(30, 'testando', '        \r\n                testando para o jogador', '2023-05-30 16:15:50', 25),
(31, 'texto cami', '        \r\n           agora o teste é para a camila     ', '2023-05-30 16:21:06', 26),
(33, 'ronaldo', '        \r\n           minha primeira historia     ', '2023-05-30 19:56:22', 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `p_p` varchar(255) DEFAULT 'user-default.png',
  `last_seen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `p_p`, `last_seen`) VALUES
(1, 'alex', 'junior', '$2y$10$hMK2LjkdqwhBRTh57Cj/NeIEKZ5BDlKo3PI5.PmH9BN2R7FhfdmAi', 'junior.jpg', '2023-05-04 15:28:54'),
(2, 'gustavo ', 'jogador', '$2y$10$xzmv9WIFJ/oBh8PHDZgrDOGHZQtEQfXj9ApjF7s9nsE25fx6N0RJK', 'user-default.png', '2023-05-10 14:01:10'),
(3, 'gustavo ', 'ff', '$2y$10$G//obhg6gItvOXKOl1lReOxSGXr1r/2Rd.1kXGDlpxBsoA6QAsPRO', 'user-default.png', '2023-05-04 15:28:33'),
(4, 'alex', 'ffs', '$2y$10$dm6Nkmhn7L2tfBod6PbVJ.nRfZVKngVWMoKlmIe8RNYgZly5F2vo2', 'user-default.png', '2023-05-04 15:29:14'),
(5, 'felipe', 'jogo', '$2y$10$YVRYtrwPHClPGv9EJiJfk.e7B.ii6.gQkA3YNRoquc63BMvJ0r1aS', 'user-default.png', '2023-05-04 15:13:23'),
(6, 'gustavo', 'ronaldo', '$2y$10$C2mHbORypCMok1SbXoC2PeTlMLjlTYiRAR7kpJ5HkDKigdLoBjkj.', 'user-default.png', '2023-05-10 13:56:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Índices para tabela `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Índices para tabela `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Índices para tabela `depoimento`
--
ALTER TABLE `depoimento`
  ADD PRIMARY KEY (`depoimento_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `depoimento`
--
ALTER TABLE `depoimento`
  MODIFY `depoimento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `depoimento`
--
ALTER TABLE `depoimento`
  ADD CONSTRAINT `fk_cadastro` FOREIGN KEY (`usuario_id`) REFERENCES `cadastro` (`usuario_id`),
  ADD CONSTRAINT `fk_depoimento` FOREIGN KEY (`usuario_id`) REFERENCES `cadastro` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
