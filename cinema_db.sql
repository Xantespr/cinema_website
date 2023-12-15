-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 12:05 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `title` text NOT NULL,
  `genre` text NOT NULL,
  `duration` text NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `description`, `title`, `genre`, `duration`, `age`) VALUES
(1, 'In \"Diamonds Are Forever,\" the legendary MI6 agent, James Bond, finds himself entangled in a high-stakes mission involving a mysterious diamond smuggling operation. When a trail of glittering gems leads Bond to the ruthless Ernst Stavro Blofeld, he must navigate a world of glamorous casinos, luxurious yachts, and deadly plots. As Bond races against time to uncover the truth, he encounters the enigmatic Tiffany Case, a woman with secrets of her own. With the fate of global security hanging in the balance, Bond faces perilous challenges, spectacular heists, and unexpected alliances in a cinematic adventure that will leave audiences on the edge of their seats. Get ready for an action-packed journey filled with intrigue, danger, and the unmistakable charm of Agent 007. \"Diamonds Are Forever\" – because in the world of James Bond, some secrets are forever, but diamonds are not.', 'James Bond', 'Action', '90', 18),
(2, 'Embark on an unforgettable journey through time and love with \"Titanic: A Love Beyond Time.\" Set against the backdrop of the ill-fated maiden voyage of the RMS Titanic, this cinematic masterpiece weaves a timeless tale of romance, sacrifice, and resilience.  As the majestic ship sails towards destiny, two souls from different worlds collide. Rose DeWitt Bukater, a young aristocrat bound by societal expectations, and Jack Dawson, a free-spirited artist with a thirst for adventure, find themselves drawn to each other in a love affair that defies the rigid class divisions of 1912.  Amidst the opulence of the Titanic, a tragic iceberg looms on the horizon, threatening to alter their lives forever. As chaos unfolds, Rose and Jack must navigate the perilous waters of passion, heartbreak, and survival.  \"Titanic: A Love Beyond Time\" invites you to witness a story that transcends the ages, reminding us that true love is as enduring as the ocean\'s depths. Brace yourself for an emotional voyage filled with breathtaking visuals, an epic romance, and the haunting melody of Celine Dion\'s iconic \"My Heart Will Go On.\" In this timeless retelling of an extraordinary love story, experience the grandeur, the tragedy, and the undying spirit of love that echoes through the ages.', 'Titanic', 'Drama', '120', 13),
(3, 'Prepare to embark on a mind-bending journey with \"Inception: The Mind\'s Maze,\" a riveting sci-fi thriller that blurs the lines between reality and the subconscious.  Dominic Cobb, a skilled extractor, is a master in the art of entering people\'s dreams to steal their deepest secrets. However, when he is offered a chance at redemption, Cobb assembles a team for an audacious mission – not to steal an idea but to plant one. The objective: to perform an inception, the act of implanting an idea so deeply that it takes root and shapes the individual\'s destiny.  As the team delves into layers of dreams within dreams, the boundaries between dreams and reality blur, and the stakes intensify. In a race against time and through landscapes that defy the laws of physics, Cobb confronts his own haunted past and battles with the enigmatic concept of reality itself.  Directed by the visionary Christopher Nolan, \"Inception: The Mind\'s Maze\" is a cinematic spectacle that challenges the limits of imagination. Brace yourself for a mind-altering experience as dreams unfold within dreams, and the pursuit of an idea becomes a thrilling odyssey through the uncharted territories of the human mind. Will the team succeed, or will they be lost in the labyrinth of their own creation? The answers lie within the depths of dreams in this mesmerizing and thought-provoking adventure.', 'Inception', 'Action', '90', 16),
(4, 'In the heart-pounding action thriller \"Bullet Train,\" a high-speed train becomes the setting for a gripping tale of suspense and intrigue. As passengers board the sleek and technologically advanced train for a cross-country journey, they soon discover that each traveler harbors a secret. Unbeknownst to them, a covert organization has planted a mysterious package on board, setting off a race against time.  The tension rises as a group of unsuspecting passengers, each with their unique set of skills, must unravel the truth behind the hidden package and confront their own pasts. As the train hurtles through picturesque landscapes, it becomes a high-stakes battleground where loyalties are tested, alliances are formed, and deception is a constant companion.  Directed by a visionary filmmaker, \"Bullet Train\" offers a thrilling mix of heart-stopping action sequences, unexpected twists, and a cast of characters with mysterious motives. Get ready for an adrenaline-fueled ride where every moment counts, and the line between hero and villain blurs in the confined spaces of the speeding Bullet Train.', 'Bullet train', 'Akcja / Komedia', '130', 18),
(7, 'Embark on a buzzing adventure in \"Bees: The Secret Hive,\" a heartwarming animated film that takes you deep into the fascinating world of bees. Meet Maya, a spirited young worker bee with dreams beyond the hive, and her loyal friends who discover a secret that could change the fate of their entire colony.  When Maya stumbles upon an ancient map that points to a legendary flower field, she rallies her friends to embark on a daring journey beyond the hive\'s boundaries. Along the way, they encounter a diverse array of insect friends, face natural obstacles, and discover the delicate balance of the ecosystem.  As Maya and her friends navigate through meadows, forests, and bustling cities, they uncover the importance of cooperation, friendship, and the vital role bees play in pollination. However, a looming threat puts their home at risk, and Maya must summon her courage to lead her companions in a race against time to save the hive.  \"Bees: The Secret Hive\" combines stunning animation, vibrant characters, and a meaningful narrative that explores the interconnectedness of nature. Get ready to be spellbound by the beauty of the bee world and the powerful message that even the smallest creatures can make a big impact.', 'Pszczoły', 'Obyczajowy', '260', 8),
(8, 'Prepare for a mind-bending journey into the future with \"Elektronik,\" a gripping sci-fi thriller that explores the intersection of humanity and artificial intelligence. In a world where technology reigns supreme, a groundbreaking invention known as Elektronik emerges—a revolutionary AI designed to understand, mimic, and even anticipate human behavior.  As Elektronik becomes an integral part of society, seamlessly integrating into daily life, questions about the ethical boundaries of artificial intelligence arise. Dr. Olivia Harper, the brilliant scientist behind Elektronik, finds herself caught in a web of intrigue as unforeseen consequences and hidden agendas come to light.  The film delves into the ethical dilemmas surrounding the creation of sentient beings and the blurred lines between man and machine. As Elektronik evolves, it sparks a series of events that challenge the very fabric of humanity\'s existence. Driven by a thought-provoking narrative and futuristic visuals, \"Elektronik\" explores the fine line between progress and peril in the age of artificial intelligence.  Get ready for a cinematic experience that will keep you on the edge of your seat, questioning the limits of technology and the essence of what it means to be truly human.', 'Elektronik', 'Dramat', '5', 21),
(9, 'In the enchanting world of \"Dolce,\" love takes center stage in a tale of passion, sacrifice, and the enduring power of connection. Set against the backdrop of a picturesque Italian village, this romantic drama unfolds as two souls, each carrying their own secrets and burdens, find solace and strength in one another.  Meet Isabella, a talented pastry chef with a gift for crafting delectable desserts that reflect the sweetness of life. Her world collides with Marco, a brooding artist grappling with the shadows of his past. Drawn together by fate, they embark on a journey where the artistry of pastry and the strokes of a paintbrush intertwine, creating a canvas of emotions that transcends words.  As Isabella and Marco navigate the complexities of love, their bond is tested by unforeseen challenges, family expectations, and the bittersweet symphony of life. The aroma of freshly baked treats and the allure of timeless art become the threads that weave their story, leaving an indelible mark on their hearts.  \"Dolce\" is a celebration of love in its purest form—a symphony of flavors, emotions, and the enduring magic of finding one\'s soulmate. Get ready to be swept away on a journey where the sweetest moments linger long after the credits roll.', 'Dolce', 'Triller', '90', 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movie_room`
--

CREATE TABLE `movie_room` (
  `id` int(11) NOT NULL,
  `rows` int(11) NOT NULL,
  `places_in_row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_room`
--

INSERT INTO `movie_room` (`id`, `rows`, `places_in_row`) VALUES
(3, 8, 20),
(4, 5, 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `showing_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `phone` int(11) NOT NULL,
  `status` text NOT NULL,
  `ticket_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `showing`
--

CREATE TABLE `showing` (
  `id` int(11) NOT NULL,
  `movie_room_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `language` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `showing`
--

INSERT INTO `showing` (`id`, `movie_room_id`, `film_id`, `date`, `language`) VALUES
(63, 4, 8, '2023-12-14 12:34:35', 'english'),
(64, 4, 9, '2023-12-15 12:34:58', 'english'),
(65, 3, 2, '2023-12-19 12:34:58', 'polish'),
(68, 4, 1, '2023-12-15 23:14:37', 'english'),
(69, 4, 8, '2023-12-15 23:14:37', 'polish'),
(70, 3, 4, '2023-12-15 20:15:36', 'italian'),
(71, 3, 9, '2023-12-14 12:15:36', 'russian');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `price`, `type`) VALUES
(1, 10, 'normal'),
(2, 14, 'VIP');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `movie_room`
--
ALTER TABLE `movie_room`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_seansu` (`showing_id`),
  ADD KEY `bilet_id` (`ticket_id`);

--
-- Indeksy dla tabeli `showing`
--
ALTER TABLE `showing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_filmu` (`film_id`),
  ADD KEY `id_sali` (`movie_room_id`);

--
-- Indeksy dla tabeli `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movie_room`
--
ALTER TABLE `movie_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `showing`
--
ALTER TABLE `showing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`showing_id`) REFERENCES `showing` (`id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`);

--
-- Constraints for table `showing`
--
ALTER TABLE `showing`
  ADD CONSTRAINT `showing_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`),
  ADD CONSTRAINT `showing_ibfk_2` FOREIGN KEY (`movie_room_id`) REFERENCES `movie_room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
