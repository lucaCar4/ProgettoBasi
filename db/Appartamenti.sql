-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Feb 11, 2024 alle 19:12
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Appartamenti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ADDETTI`
--

CREATE TABLE `ADDETTI` (
  `Partita_Iva` int(11) NOT NULL,
  `Nome` char(10) NOT NULL,
  `Cognome` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `APPARTAMENTI`
--

CREATE TABLE `APPARTAMENTI` (
  `tipo` char(10) NOT NULL,
  `id_appartamento` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_condominio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `APPARTAMENTI`
--

INSERT INTO `APPARTAMENTI` (`tipo`, `id_appartamento`, `numero`, `id_condominio`) VALUES
('Normal', 0, 1, 0),
('Economy', 1, 7, 0),
('Lusso', 2, 8, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `BICICLETTE`
--

CREATE TABLE `BICICLETTE` (
  `prezzo` float NOT NULL,
  `id_bicicletta` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `CLIENTI`
--

CREATE TABLE `CLIENTI` (
  `Nome` char(20) NOT NULL,
  `Cognome` char(20) NOT NULL,
  `Codice_Documento` bigint(20) NOT NULL,
  `Data_rilascio` date NOT NULL,
  `Da_chi` char(30) NOT NULL,
  `LuogoNascita` char(30) NOT NULL,
  `Provincia` char(2) NOT NULL,
  `DataNascita` date NOT NULL,
  `Comune_residenza` char(30) NOT NULL,
  `CAP` char(5) NOT NULL,
  `Via` char(10) NOT NULL,
  `Numero_civico` bigint(20) NOT NULL,
  `Mail` char(40) NOT NULL,
  `Numero` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `CLIENTI`
--

INSERT INTO `CLIENTI` (`Nome`, `Cognome`, `Codice_Documento`, `Data_rilascio`, `Da_chi`, `LuogoNascita`, `Provincia`, `DataNascita`, `Comune_residenza`, `CAP`, `Via`, `Numero_civico`, `Mail`, `Numero`) VALUES
('Luca', 'Carabini', 12312321, '0202-05-06', 'Comune', 'Cesena', 'F', '2002-05-06', 'Bellaria Igea Marina', '47814', 'Milazzo', 9, 'luca02c2@gmail.co', 3703112047);

-- --------------------------------------------------------

--
-- Struttura della tabella `CONDOMINI`
--

CREATE TABLE `CONDOMINI` (
  `Nome` char(20) NOT NULL,
  `id_condominio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `CONDOMINI`
--

INSERT INTO `CONDOMINI` (`Nome`, `id_condominio`) VALUES
('Condominio-Garden', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `FATTURE`
--

CREATE TABLE `FATTURE` (
  `Importo` bigint(20) NOT NULL,
  `Data` date NOT NULL,
  `Numero` bigint(20) NOT NULL,
  `Codice_Documento` bigint(20) DEFAULT NULL,
  `Partita_Iva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `formato`
--

CREATE TABLE `formato` (
  `Codice_Documento` bigint(20) NOT NULL,
  `id_gruppo` bigint(20) NOT NULL,
  `ruolo` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `formato`
--

INSERT INTO `formato` (`Codice_Documento`, `id_gruppo`, `ruolo`) VALUES
(12312321, 0, 'Capo');

-- --------------------------------------------------------

--
-- Struttura della tabella `GRUPPI`
--

CREATE TABLE `GRUPPI` (
  `Cognome` char(20) NOT NULL,
  `id_gruppo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `GRUPPI`
--

INSERT INTO `GRUPPI` (`Cognome`, `id_gruppo`) VALUES
('mm', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `LISTINI`
--

CREATE TABLE `LISTINI` (
  `id_appartamento` int(11) NOT NULL,
  `Anno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Noleggiare`
--

CREATE TABLE `Noleggiare` (
  `id_bicicletta` bigint(20) NOT NULL,
  `numero` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `PERIODI`
--

CREATE TABLE `PERIODI` (
  `id_appartamento` int(11) NOT NULL,
  `Anno` int(11) NOT NULL,
  `Prezzo` float NOT NULL,
  `Data_fine` date NOT NULL,
  `Data_Inizio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `PRENOTAZIONI`
--

CREATE TABLE `PRENOTAZIONI` (
  `sconto` int(11) DEFAULT NULL,
  `dataInizio` date NOT NULL,
  `dataFine` date NOT NULL,
  `Importo` int(11) NOT NULL,
  `numero` bigint(20) NOT NULL,
  `id_appartamento` int(11) NOT NULL,
  `Codice_Documento` bigint(20) DEFAULT NULL,
  `id_famiglia` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `PULIZIE`
--

CREATE TABLE `PULIZIE` (
  `id_appartamento` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Ora` char(5) NOT NULL,
  `Partita_Iva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ADDETTI`
--
ALTER TABLE `ADDETTI`
  ADD PRIMARY KEY (`Partita_Iva`),
  ADD UNIQUE KEY `ID_ADDETTI_IND` (`Partita_Iva`);

--
-- Indici per le tabelle `APPARTAMENTI`
--
ALTER TABLE `APPARTAMENTI`
  ADD PRIMARY KEY (`id_appartamento`),
  ADD UNIQUE KEY `ID_APPARTAMENTI_IND` (`id_appartamento`),
  ADD KEY `FKpossiede_IND` (`id_condominio`);

--
-- Indici per le tabelle `BICICLETTE`
--
ALTER TABLE `BICICLETTE`
  ADD PRIMARY KEY (`id_bicicletta`),
  ADD UNIQUE KEY `ID_BICICLETTE_IND` (`id_bicicletta`);

--
-- Indici per le tabelle `CLIENTI`
--
ALTER TABLE `CLIENTI`
  ADD PRIMARY KEY (`Codice_Documento`),
  ADD UNIQUE KEY `ID_CLIENTI_IND` (`Codice_Documento`);

--
-- Indici per le tabelle `CONDOMINI`
--
ALTER TABLE `CONDOMINI`
  ADD PRIMARY KEY (`id_condominio`),
  ADD UNIQUE KEY `ID_CONDOMINI_IND` (`id_condominio`);

--
-- Indici per le tabelle `FATTURE`
--
ALTER TABLE `FATTURE`
  ADD PRIMARY KEY (`Numero`),
  ADD UNIQUE KEY `ID_FATTURE_IND` (`Numero`),
  ADD KEY `FKintestazione_cliente_IND` (`Codice_Documento`),
  ADD KEY `FKintestazione_addetto_IND` (`Partita_Iva`);

--
-- Indici per le tabelle `formato`
--
ALTER TABLE `formato`
  ADD PRIMARY KEY (`Codice_Documento`,`id_gruppo`) USING BTREE,
  ADD UNIQUE KEY `ID_formato_IND` (`Codice_Documento`,`id_gruppo`),
  ADD KEY `FKfor_GRU_IND` (`id_gruppo`);

--
-- Indici per le tabelle `GRUPPI`
--
ALTER TABLE `GRUPPI`
  ADD PRIMARY KEY (`id_gruppo`),
  ADD UNIQUE KEY `ID_GRUPPI_IND` (`id_gruppo`);

--
-- Indici per le tabelle `LISTINI`
--
ALTER TABLE `LISTINI`
  ADD PRIMARY KEY (`id_appartamento`,`Anno`),
  ADD UNIQUE KEY `ID_LISTINI_IND` (`id_appartamento`,`Anno`);

--
-- Indici per le tabelle `Noleggiare`
--
ALTER TABLE `Noleggiare`
  ADD PRIMARY KEY (`numero`,`id_bicicletta`),
  ADD UNIQUE KEY `ID_Noleggiare_IND` (`numero`,`id_bicicletta`),
  ADD KEY `FKNol_BIC_IND` (`id_bicicletta`);

--
-- Indici per le tabelle `PERIODI`
--
ALTER TABLE `PERIODI`
  ADD PRIMARY KEY (`id_appartamento`,`Anno`,`Data_Inizio`),
  ADD UNIQUE KEY `ID_PERIODI_IND` (`id_appartamento`,`Anno`,`Data_Inizio`);

--
-- Indici per le tabelle `PRENOTAZIONI`
--
ALTER TABLE `PRENOTAZIONI`
  ADD PRIMARY KEY (`numero`),
  ADD UNIQUE KEY `ID_PRENOTAZIONI_IND` (`numero`),
  ADD KEY `FKriferire_IND` (`id_appartamento`),
  ADD KEY `FKeffettua_sing_IND` (`Codice_Documento`),
  ADD KEY `FKeffettua_gruppo_IND` (`id_famiglia`);

--
-- Indici per le tabelle `PULIZIE`
--
ALTER TABLE `PULIZIE`
  ADD PRIMARY KEY (`id_appartamento`,`Data`),
  ADD UNIQUE KEY `ID_PULIZIE_IND` (`id_appartamento`,`Data`),
  ADD KEY `FKesegue_IND` (`Partita_Iva`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `APPARTAMENTI`
--
ALTER TABLE `APPARTAMENTI`
  ADD CONSTRAINT `FKpossiede_FK` FOREIGN KEY (`id_condominio`) REFERENCES `CONDOMINI` (`id_condominio`) ON DELETE CASCADE;

--
-- Limiti per la tabella `FATTURE`
--
ALTER TABLE `FATTURE`
  ADD CONSTRAINT `FKintestazione_addetto_FK` FOREIGN KEY (`Partita_Iva`) REFERENCES `ADDETTI` (`Partita_Iva`),
  ADD CONSTRAINT `FKintestazione_cliente_FK` FOREIGN KEY (`Codice_Documento`) REFERENCES `CLIENTI` (`Codice_Documento`) ON DELETE CASCADE;

--
-- Limiti per la tabella `formato`
--
ALTER TABLE `formato`
  ADD CONSTRAINT `FKfor_CLI` FOREIGN KEY (`Codice_Documento`) REFERENCES `CLIENTI` (`Codice_Documento`),
  ADD CONSTRAINT `FKfor_GRU_FK` FOREIGN KEY (`id_gruppo`) REFERENCES `GRUPPI` (`id_gruppo`) ON DELETE CASCADE;

--
-- Limiti per la tabella `LISTINI`
--
ALTER TABLE `LISTINI`
  ADD CONSTRAINT `FKha` FOREIGN KEY (`id_appartamento`) REFERENCES `APPARTAMENTI` (`id_appartamento`) ON DELETE CASCADE;

--
-- Limiti per la tabella `Noleggiare`
--
ALTER TABLE `Noleggiare`
  ADD CONSTRAINT `FKNol_BIC_FK` FOREIGN KEY (`id_bicicletta`) REFERENCES `BICICLETTE` (`id_bicicletta`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKNol_PRE` FOREIGN KEY (`numero`) REFERENCES `PRENOTAZIONI` (`numero`) ON DELETE CASCADE;

--
-- Limiti per la tabella `PERIODI`
--
ALTER TABLE `PERIODI`
  ADD CONSTRAINT `FKcomposto` FOREIGN KEY (`id_appartamento`,`Anno`) REFERENCES `LISTINI` (`id_appartamento`, `Anno`) ON DELETE CASCADE;

--
-- Limiti per la tabella `PRENOTAZIONI`
--
ALTER TABLE `PRENOTAZIONI`
  ADD CONSTRAINT `FKeffettua_gruppo_FK` FOREIGN KEY (`id_famiglia`) REFERENCES `GRUPPI` (`id_gruppo`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKeffettua_sing_FK` FOREIGN KEY (`Codice_Documento`) REFERENCES `CLIENTI` (`Codice_Documento`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKriferire_FK` FOREIGN KEY (`id_appartamento`) REFERENCES `APPARTAMENTI` (`id_appartamento`) ON DELETE CASCADE;

--
-- Limiti per la tabella `PULIZIE`
--
ALTER TABLE `PULIZIE`
  ADD CONSTRAINT `FKesegue_FK` FOREIGN KEY (`Partita_Iva`) REFERENCES `ADDETTI` (`Partita_Iva`) ON DELETE CASCADE,
  ADD CONSTRAINT `FKpulito` FOREIGN KEY (`id_appartamento`) REFERENCES `APPARTAMENTI` (`id_appartamento`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
