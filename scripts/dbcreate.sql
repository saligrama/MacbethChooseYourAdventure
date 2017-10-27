-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 27, 2017 at 05:05 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MacbethChooseYourAdventure`
--

-- --------------------------------------------------------

--
-- Table structure for table `final_scores`
--

CREATE TABLE `final_scores` (
  `id` int(10) NOT NULL,
  `power` int(10) NOT NULL,
  `morality` int(10) NOT NULL,
  `turnover` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `q_response`
--

CREATE TABLE `q_response` (
  `id` int(100) NOT NULL,
  `q1` tinyint(1) NOT NULL,
  `q2` tinyint(1) NOT NULL,
  `q3` tinyint(1) NOT NULL,
  `q4` tinyint(1) NOT NULL,
  `q5` tinyint(1) NOT NULL,
  `q6` tinyint(1) NOT NULL,
  `q7` tinyint(1) NOT NULL,
  `q8` tinyint(1) NOT NULL,
  `q9` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `response_indices`
--

CREATE TABLE `response_indices` (
  `id` int(10) NOT NULL,
  `qid` int(10) NOT NULL,
  `answer_yes` tinyint(1) NOT NULL,
  `power` int(10) NOT NULL,
  `turnover` int(10) NOT NULL,
  `morality` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `response_indices`
--

INSERT INTO `response_indices` (`id`, `qid`, `answer_yes`, `power`, `turnover`, `morality`) VALUES
(1, 1, 0, -1, -1, -1),
(2, 1, 1, 1, 0, 1),
(3, 2, 0, 0, 0, 1),
(4, 2, 1, 1, -1, -1),
(5, 3, 0, -1, -1, 1),
(6, 3, 1, 0, 0, -1),
(7, 4, 0, -1, 0, 1),
(9, 4, 1, 1, 0, -1),
(10, 5, 1, 0, 0, 0),
(11, 6, 0, -1, -1, 1),
(12, 6, 1, 1, 0, -1),
(13, 7, 0, -1, -1, 1),
(14, 7, 1, -1, -1, -1),
(15, 5, 0, -1, -1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `scenarios`
--

CREATE TABLE `scenarios` (
  `id` int(10) NOT NULL,
  `question` int(10) NOT NULL,
  `type` enum('display','end_mes','next_mes','') NOT NULL,
  `text` varchar(1000) NOT NULL,
  `quote` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scenarios`
--

INSERT INTO `scenarios` (`id`, `question`, `type`, `text`, `quote`) VALUES
(1, 1, 'display', 'Scotland is under attack by Macdonwald’s forces. You are a general of the army, tasked with defending Scotland. Your life is in danger. Do you run away and try to save your life (no), or fight twice as hard (yes)?', '“As cannons overcharged with double cracks, so they/ Doubly redoubled strokes upon the foe.” (1.2.41-42)'),
(2, 2, 'display', 'You see a dagger in front of you, pointing towards King Duncan’s bedroom in your castle. You know it’s a hallucination, and your actual dagger is in your scabbard, but you think it’s compelling you to take action. Do you assassinate King Duncan?', '"Is this a dagger which I see before me,/ The handle toward my hand? Come, let me clutch/ thee./ I have thee not, and yet I see thee still...I go and it is done. The bell invites me." (2.1.44-47, 75)'),
(3, 3, 'display', 'Duncan is dead, and you are already feeling the guilt even as you will be crowned king. Do you frame Duncan’s body guards by smearing them with blood and laying your dagger next to them?', '"I\'ll go no more./ I am afraid to think what I have done [killed Duncan]./ Look on \'t [the daggers] again I dare not." (2.2.65-67)'),
(4, 4, 'display', 'Banquo is suspicious of Duncan’s death, and is concerned that his son Fleance won’t be king as the witches predicted. Having seen the witches’ prophesies that you would be Thane of Cawdor and King come true, however, you are not so sure; maybe Fleance will rise to the throne after all, and this psychologically affects you. Do you send murderers after Banquo and Fleance to try to subvert fate?', NULL),
(5, 5, 'display', 'You do not fully trust the murderers you have sent to kill Banquo and Fleance. Do you send another murderer after him to make sure that they are killed?', NULL),
(6, 6, 'display', 'Now that Banquo is dead, the other nobles including Macduff do not trust you, especially after your perceived hallucinations when the Ghost of Banquo visits in the middle of a dinner. Macduff flees to his castle at Fife, and you are afraid that he is plotting to overthrow you. Do you try to have him and his family murdered to ensure the safety of your position as king?', NULL),
(7, 7, 'display', 'Though he has escaped, Macduff’s family is murdered and has heard the news. He plans to take revenge on you for the brutal murders of his wife and sons, having aligned with Malcolm and Siward. As the rebel army proceeds towards Dunsinane castle, you see sights that appear impossible - such as the entirety of Birnam Wood moving towards you. After the heartbreaking death of your wife and the confirmation of the witches’ prophecy that you won’t die until Birnam Wood moves, you decide to suit up in armor and make a last stand. You first encounter Siward’s teenage son, Young Siward. Knowing that you are facing death today, do you fight with and try to kill him?', NULL),
(8, 1, 'end_mes', 'You have let Scotland down with your cowardice, which has been witnessed by everyone in the army. As a consequence, you have been stripped from your title as military general, and your title of Thane of Glamis has also been removed, forcing you to become a commoner. Duncan’s regime is barely able to maintain control after the rebellion, and your cowardice is central to the discrediting of the current administration in the eyes of the public.', NULL),
(9, 2, 'end_mes', 'You live the rest of your life as a faithful general of the Scottish army. You become Thane of more territories, but have no opportunity to become King, since Duncan’s son Malcolm succeeds him once he dies.', NULL),
(10, 3, 'end_mes', 'Duncan’s death looks somewhat fishy considering you have become King so quickly. With no scapegoat to blame his death on, and everyone’s suspicions turning towards you, you are caught and hanged. Scotland’s throne has changed hands twice in just two days. Nevertheless, at least you did not ruin any more innocent lives.', NULL),
(11, 4, 'end_mes', 'Banquo may be suspicious, but he will not risk doing anything considering the closeness of your relationship with him. However, you fear what Fleance will do more, since he may consider his right to the throne via the prophecy to be infringed. Even if he does not try to do anything, you become increasingly more paranoid that somebody will find out the truth of Duncan’s murder and take revenge.', NULL),
(12, 5, 'end_mes', 'Banquo and Fleance escape since the murderers you sent were incompetent. Now that they know that you tried to assassinate them, they notify the other nobles, who plan a coup and remove you from power, hanging you for high treason against the nation of Scotland.', NULL),
(13, 6, 'end_mes', 'Macduff was indeed plotting against you, and joined forces with Malcolm and Siward to overthrow you. You are found guilty of treason and tyranny against Scotland, and are hanged. At least you did not ruin the innocent lives of Macduff’s wife and sons.', NULL),
(14, 7, 'end_mes', 'Young Siward, who is hailed as a hero, kills you in battle. Malcolm takes the throne of Scotland and your name goes down in history as a cruel tyrant, a loser in a David vs Goliath scenario, Young Siward being David and you being Goliath. At least you spared the life of a teenage boy with hopes and dreams.', NULL),
(15, 7, 'next_mes', 'You have brutally killed Young Siward, but you encounter the revenge-fuelled Macduff. He reveals that he was delivered via C-section, making him not a man of woman born and further confirming the witches’ prophecy. You fight, Macduff kills you, and Malcolm takes the throne of Scotland with Macduff hailed as a hero.', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `final_scores`
--
ALTER TABLE `final_scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `q_response`
--
ALTER TABLE `q_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response_indices`
--
ALTER TABLE `response_indices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scenarios`
--
ALTER TABLE `scenarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_scores`
--
ALTER TABLE `final_scores`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `q_response`
--
ALTER TABLE `q_response`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `response_indices`
--
ALTER TABLE `response_indices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `scenarios`
--
ALTER TABLE `scenarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
