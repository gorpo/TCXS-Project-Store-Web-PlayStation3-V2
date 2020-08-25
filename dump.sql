--     ████████╗ ██████╗██╗  ██╗███████╗    ██████╗ ██████╗  ██████╗      ██╗███████╗ ██████╗████████╗
--     ╚══██╔══╝██╔════╝╚██╗██╔╝██╔════╝    ██╔══██╗██╔══██╗██╔═══██╗     ██║██╔════╝██╔════╝╚══██╔══╝
--        ██║   ██║      ╚███╔╝ ███████╗    ██████╔╝██████╔╝██║   ██║     ██║█████╗  ██║        ██║   
--        ██║   ██║      ██╔██╗ ╚════██║    ██╔═══╝ ██╔══██╗██║   ██║██   ██║██╔══╝  ██║        ██║   
--        ██║   ╚██████╗██╔╝ ██╗███████║    ██║     ██║  ██║╚██████╔╝╚█████╔╝███████╗╚██████╗   ██║   
--        ╚═╝    ╚═════╝╚═╝  ╚═╝╚══════╝    ╚═╝     ╚═╝  ╚═╝ ╚═════╝  ╚════╝ ╚══════╝ ╚═════╝   ╚═╝   
-- @Gorpo Orko - 2020 

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `nome`, `data_cadastro`) VALUES
(1, 'gorpo', 'corpo', 'Gorpo', '2500-01-11 19:42:12'),
(2,'mitsuki', 'tcxsproject2020web', 'Mitsuki', '2500-09-07 15:06:19'),
(3,'mste3dz', 'tcxsproject2020web', 'MsTe3dz', '2500-09-07 15:06:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
