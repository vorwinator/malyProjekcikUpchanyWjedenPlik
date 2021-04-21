-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Lut 2021, 22:03
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `vorwi_vorwi`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt`
--

CREATE TABLE `produkt` (
  `ID_produktu` int(11) NOT NULL,
  `nazwa_produktu` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `cena` float NOT NULL,
  `jednostka_ceny` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `jednostka_towaru` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `typ` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `sklep` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `komentarz` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `produkt`
--

INSERT INTO `produkt` (`ID_produktu`, `nazwa_produktu`, `cena`, `jednostka_ceny`, `jednostka_towaru`, `typ`, `sklep`, `komentarz`) VALUES
(26, 'kajzerka', 0.5, 'zł', 'szt.', 'pieczywo', 'Piekarnia Tyrolska', ''),
(27, 'kajzerka', 0.25, 'zł', 'szt.', 'pieczywo', 'Auchan', '50g/szt'),
(28, 'chipsy pomidorowe', 2.69, 'zł', '100g', 'przekąski', 'Kaufland', 'marka:Kaufland'),
(29, 'rożek waniliowo-truskawkowy', 0.99, 'zł', '120ml', 'lody', 'Kaufland', 'marka:Kaufland'),
(31, 'chipsy paprykowe', 2.69, 'zł', '100g', 'przekąski', 'Kaufland', 'marka:Kaufland'),
(32, 'knorr bulion warzywny', 2.59, 'zł', 'opak.', 'przyprawy', 'Kaufland', ''),
(33, 'kajzerka z makiem', 0.39, 'zł', 'szt.', 'pieczywo', 'Kaufland', ''),
(34, 'sonko ryż biały karton', 2.99, 'zł', '400g', 'ryż', 'Kaufland', ''),
(35, 'sonko ryż jaśminowy', 4.99, 'zł', '400g', 'ryż', 'Kaufland', ''),
(36, 'kujawski olej', 7.49, 'zł', '1l', 'olej', 'Kaufland', ''),
(37, 'prażynki bekonowe', 2.89, 'zł', '?', 'przekąski', 'Carrefour', ''),
(38, 'kajzerka', 0.26, 'zł', 'szt.', 'pieczywo', 'Carrefour', '50g/szt'),
(39, 'arizona', 5.39, 'zł', '400ml', 'napój', 'Carrefour', ''),
(40, 'primavera woda niegaz.', 3.99, 'zł', '6l', 'napój', 'Kaufland', '0.67zł/litr'),
(41, 'velvet papier toaletowy 8szt', 9.99, 'zł', 'opak.', 'papier toaletowy', 'Kaufland', '?ilu warstwowy?'),
(42, 'berlinki', 3.99, 'zł', '250g.', 'parówki', 'Kaufland', '4sztuki CENA PROMOCYJNA'),
(43, 'almette ziołowy', 4.19, 'zł', '150g', 'serek', 'Kaufland', ''),
(44, 'almette śmietankowy', 4.19, 'zł', '150g', 'serek', 'Kaufland', ''),
(45, 'kotlin łagodny', 6.99, 'zł', '950g', 'ketchup', 'Kaufland', ''),
(46, 'pasztet podlaski', 1.99, 'zł', '195g', 'pasztet', 'Kaufland', ''),
(47, 'bevola', 2.25, 'zł', '160szt.', 'patyczki do uszu', 'Kaufland', 'opakowanie zawiera 160patyczków'),
(48, 'lipton zielona cytryna', 6.99, 'zł', '40szt.', 'herbata', 'Kaufland', 'opakowanie zawiera 40torebek'),
(49, 'cream cheese herbs', 2.99, 'zł', '200g', 'serek', 'Kaufland', 'marka:Kaufland'),
(50, 'kinder maxi king', 2.19, 'zł', '35g', 'przekąski', 'Kaufland', ''),
(51, 'lipton mango-brzoskwinia', 5.99, 'zł', '20szt.', 'herbata', 'Kaufland', 'opakowanie zawiera 20piramidek'),
(52, 'lays fromage', 5.59, 'zł', '215g', 'przekąski', 'Kaufland', ''),
(53, 'filet z piersi kurczaka', 16.99, 'zł', 'kg', 'mięso', 'Kaufland', ''),
(54, 'dawtona pikantny', 7.89, 'zł', '900g', 'ketchup', 'Auchan', ''),
(55, 'piątnica 18%', 2.59, 'zł', '330g', 'śmietana', 'Biedronka', ''),
(56, 'Vitanella', 2.99, 'zł', '500g', 'płatki', 'Biedronka', ''),
(57, 'cheetos pizzerini', 2.49, 'zł', '95g', 'przekąski', 'Biedronka', ''),
(58, 'amino zupa pomidorowa', 1.39, 'zł', 'szt.', 'zupki chińskie', 'Kaufland', ''),
(59, 'drink gate kamikaze', 2.99, 'zł', '275ml', 'alkohol', 'Kaufland', 'alk.:4,4%'),
(60, 'kajzerka', 0.29, 'zł', 'szt.', 'pieczywo', 'Biedronka', '55g/szt'),
(61, 'zielona Milton', 1.99, 'zł', '40szt.', 'herbata', 'Biedronka', 'opakowanie zawiera 40torebek'),
(62, 'papryka słodka kamis', 1.59, 'zł', '55g', 'przyprawy', 'Biedronka', ''),
(63, 'chleb pszen-żyt', 1.99, 'zł', '550g', 'pieczywo', 'Biedronka', ''),
(64, 'milka bubbly white', 3.99, 'zł', '95g', 'czekolada', 'Biedronka', ''),
(66, 'berlinki', 18.3, 'zł', 'kg', 'parówki', 'Carrefour', 'na wagę'),
(67, 'polaris woda niegazowana', 0.66, 'zł', '1l', 'napój', 'Biedronka', ''),
(68, 'śmietanowy korma do curry', 4.99, 'zł', '350g', 'sosy', 'Biedronka', ''),
(69, 'pasztet podlaski', 1.75, 'zł', '155g', 'pasztet', 'Kaufland', ''),
(70, 'marchew', 2.28, 'zł', 'kg', 'warzywa', 'Kaufland', '(nie jestem pewny ceny) '),
(71, 'pietruszka', 4.99, 'zł', 'kg', 'warzywa', 'Carrefour', ''),
(72, 'chipsletten', 4.09, 'zł', '100g', 'przekąski', 'Carrefour', ''),
(73, 'filet z piersi kurczaka', 15.99, 'zł', 'kg', 'mięso', 'Carrefour', ''),
(74, 'marchew', 2.69, 'zł', 'kg', 'warzywa', 'Carrefour', ''),
(75, 'kujawski', 7.49, 'zł', '1l', 'olej', 'Carrefour', ''),
(76, 'kapitańskie paluszki rybne', 11.89, 'zł', '12szt.', 'mięso', 'Carrefour', ''),
(77, 'amino pomidorowa', 1.45, 'zł', 'opak.', 'zupki chińskie', 'Carrefour', ''),
(78, 'cukier biały', 2.49, 'zł', 'kg', 'cukier', 'Carrefour', ''),
(79, 'mąka basia', 3.4, 'zł', 'kg', 'mąka', 'Carrefour', ''),
(80, 'almette śmietankowy', 3.98, 'zł', '150g', 'serek', 'Auchan', ''),
(81, 'edamski', 16.98, 'zł', 'kg', 'ser', 'Auchan', ''),
(82, 'colgate total', 7.79, 'zł', '75ml', 'pasta do zębów', 'Auchan', ''),
(83, 'regina', 8.96, 'zł', '2szt.', 'ręcznik papierowy', 'Auchan', '3-warstwowy||19,5m dłg.'),
(84, 'ocet spirytusowy 10%', 2.85, 'zł', '1l', 'ocet', 'Auchan', ''),
(85, 'berlinki', 8.98, 'zł', '500g', 'parówki', 'Auchan', '17.96/kg'),
(86, 'basia tortowa extra', 3.1, 'zł', 'kg', 'mąka', 'Auchan', ''),
(87, 'bułka tarta', 2.99, 'zł', '500g', 'bułka tarta', 'Auchan', ''),
(88, 'diamant cukier biały', 5.19, 'zł', '2kg', 'cukier', 'Auchan', ''),
(89, 'fromage', 3.84, 'zł', '100g', 'przekąski', 'Auchan', 'jakiej firmy?'),
(90, 'pasztet podlaski', 1.88, 'zł', '155g', 'pasztet', 'Auchan', ''),
(91, 'qeen', 12.99, 'zł', '10szt.', 'papier toaletowy', 'Biedronka', ''),
(92, 'jaśminowy', 2.99, 'zł', '400g', 'ryż', 'Biedronka', '4x100g'),
(93, 'pasztet podlaski', 1.99, 'zł', '195g', 'pasztet', 'Biedronka', ''),
(94, 'mlekovita 3,2%', 2.89, 'zł', '1l', 'mleko', 'Kaufland', ''),
(95, 'hortex bukiet jarzyn', 5.49, 'zł', '450g', 'mrożonka', 'Kaufland', ''),
(96, 'kajzerka', 0.29, 'zł', '55g', 'pieczywo', 'Kaufland', ''),
(97, 'pryzmat curry orientalna', 1.19, 'zł', '20g', 'przyprawy', 'Kaufland', ''),
(98, 'kamis kurkuma', 1.19, 'zł', '20g', 'przyprawy', 'Kaufland', ''),
(99, 'oreo markizy', 4.25, 'zł', '176g', 'przekąski', 'Kaufland', ''),
(100, 'bigmilk śmietankowe', 12.99, 'zł', '1l', 'lody', 'Kaufland', ''),
(101, 'gripex control', 6.99, 'zł', '12szt.', 'lekarstwo', 'Carrefour market', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`ID_produktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `produkt`
--
ALTER TABLE `produkt`
  MODIFY `ID_produktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
