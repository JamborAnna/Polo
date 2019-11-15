-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3307
-- Létrehozás ideje: 2019. Nov 15. 10:08
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `polok`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `polo`
--

CREATE TABLE `polo` (
  `id` int(11) NOT NULL,
  `meret` int(11) NOT NULL,
  `raktaron` tinyint(1) NOT NULL,
  `minta` text COLLATE utf8_hungarian_ci NOT NULL,
  `gyartas` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `polo`
--

INSERT INTO `polo` (`id`, `meret`, `raktaron`, `minta`, `gyartas`) VALUES
(4, 8, 1, 'hercegnős', '2019-08-22');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `polo`
--
ALTER TABLE `polo`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `polo`
--
ALTER TABLE `polo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
