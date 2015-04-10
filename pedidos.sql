-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Abr-2015 às 00:24
-- Versão do servidor: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pedidos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(400) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`, `descricao`) VALUES
(1, 'Barracas', 'Barracas são legais'),
(2, 'Saco de Dormir', 'Para seu conforto e felicidade'),
(3, 'Cutelaria', 'Corte as coisas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`id` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `transportadora_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`id`, `data`, `transportadora_id`) VALUES
(5, '2015-04-09 00:00:00', 3),
(6, '2015-04-09 00:00:00', 2),
(7, '2015-04-09 00:00:00', 2),
(8, '2015-04-09 00:00:00', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_produto`
--

CREATE TABLE IF NOT EXISTS `pedido_produto` (
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedido_produto`
--

INSERT INTO `pedido_produto` (`pedido_id`, `produto_id`) VALUES
(5, 1),
(5, 2),
(6, 2),
(7, 2),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(8, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
`id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(400) DEFAULT NULL,
  `valor` float NOT NULL,
  `qt_estoque` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `peso` int(11) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `largura` int(11) DEFAULT NULL,
  `comprimento` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `valor`, `qt_estoque`, `categoria_id`, `peso`, `altura`, `largura`, `comprimento`) VALUES
(1, 'Barraca Super Camping 205/RT', 'Super barraca para qualquer clima', 380.99, 32, 1, 3, 25, 25, 30),
(2, 'Saco de Dormir Proteção Total', 'Leve, confortável e macio!', 89.99, 31, 2, 4, 15, 25, 30),
(3, 'Faca Tramontina R430', 'Faca bem Afiada', 29.99, 4, 3, 5, 15, 25, 20),
(4, 'Barraca Casal Jumbo V8', 'Barraca para casais GGG', 899.99, 27, 1, 8, 50, 50, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `aberto` tinyint(1) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `nome`, `aberto`, `codigo`) VALUES
(1, 'Aguardando Pagamento', 1, 'abrir'),
(2, 'Pagamento Confirmado', 1, 'aprovarPgto'),
(3, 'Enviado', 1, 'enviar'),
(4, 'Entregue', 0, 'entregar'),
(5, 'Cancelado', 0, 'cancelar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_pedido`
--

CREATE TABLE IF NOT EXISTS `status_pedido` (
  `status_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `dt_ref` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status_pedido`
--

INSERT INTO `status_pedido` (`status_id`, `pedido_id`, `dt_ref`) VALUES
(2, 5, '2015-04-09 00:00:00'),
(3, 6, '2015-04-09 00:00:00'),
(4, 7, '2015-04-09 00:00:00'),
(5, 8, '2015-04-09 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadora`
--

CREATE TABLE IF NOT EXISTS `transportadora` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `codigo` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transportadora`
--

INSERT INTO `transportadora` (`id`, `nome`, `codigo`) VALUES
(1, 'Pac', 'Pac'),
(2, 'Sedex', 'Sedex'),
(3, 'JadLog', 'JadLog');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`id`,`transportadora_id`), ADD KEY `fk_pedido_transportadora1_idx` (`transportadora_id`);

--
-- Indexes for table `pedido_produto`
--
ALTER TABLE `pedido_produto`
 ADD PRIMARY KEY (`pedido_id`,`produto_id`), ADD KEY `fk_table1_has_produto_produto1_idx` (`produto_id`), ADD KEY `fk_table1_has_produto_table11_idx` (`pedido_id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_produto_categoria_idx` (`categoria_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pedido`
--
ALTER TABLE `status_pedido`
 ADD PRIMARY KEY (`status_id`,`pedido_id`), ADD KEY `fk_status_has_pedido_pedido1_idx` (`pedido_id`), ADD KEY `fk_status_has_pedido_status1_idx` (`status_id`);

--
-- Indexes for table `transportadora`
--
ALTER TABLE `transportadora`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `fk_pedido_transportadora1` FOREIGN KEY (`transportadora_id`) REFERENCES `transportadora` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `pedido_produto`
--
ALTER TABLE `pedido_produto`
ADD CONSTRAINT `fk_table1_has_produto_produto1` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_table1_has_produto_table11` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `status_pedido`
--
ALTER TABLE `status_pedido`
ADD CONSTRAINT `fk_status_has_pedido_pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_status_has_pedido_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
