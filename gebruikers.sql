--
-- Database: 'fietsenmaker'
--

--
-- Tabelstructuur voor tabel 'kolom'
--

CREATE TABLE 'kolom' (
    'id' int(5) NOT FULL,
    'username' varchar(255) NOT FULL,
    'password' varchar(255) NOT FULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

--
-- Gegevens worden geÃ«xporteerd voor tabel 'kolom'
-- admin . admin

INSERT INTO 'kolom' ('id', 'username', 'password') VALUES
(11, 'admin', '$2y$10$DRNxvxqFC7m22YoNx4HAC.KXKh76nCohIh4vZ9IMtUEnZxfVGyFIO');