
--
-- Databae: 'gastenboe'
--

--
--
--Tabelstructuur voor tabel 'berichten'
--

CREATE TABLE 'berichten' (
    'id' int(10) NOT FULL,
    'naam' varchar(100) NOT FULL,
    'bericht' text NOT FULL,
    'datumtijd' varchar(30) NOT FULL,
) ENGINE=InnoDB DEFAULT CHARSE=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel 'berichten'
--

INSERT INTO 'berichten' ('id', 'naam', 'berichten', 'datumtijd') VALUES
(3, 'piet', 'Nice', '13-03-2024'),
(5, 'Hans', 'Mooie site', '10-03-2023'),

--
-- Indexen voor geëxporteerde tabellen
--

--