SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `usuarios` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` VARCHAR(20) NOT NULL,
  `sobrenome` VARCHAR(20) NOT NULL,
  `cpf` VARCHAR(20) NOT NULL,
  `editavel` BIT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` (`nome` , `sobrenome`, `cpf`, `editavel`) VALUES
('Ada', 'Lovelace', '21561665010', 1),
('Tim', 'Berners-Lee', '31833205090', 1),
('Linus', 'Torvalds', '70979931037', 1),
('Odin', 'Borson', '12068593009', 0);