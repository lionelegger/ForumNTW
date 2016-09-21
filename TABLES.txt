-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 21, 2016 at 07:56 PM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `user_id`, `message`, `created`, `modified`) VALUES
(62, 110, 26, 'La version de cakePHP est la version 3.2.12', '2016-08-30 20:03:23', '2016-08-30 20:12:09'),
(63, 110, 24, 'Lionel, pourquoi n\'as-tu pas utilisé la version 3.3?', '2016-08-30 20:14:29', '2016-08-30 20:14:29'),
(64, 110, 26, '@Nicolas, parce que lorsque j\'ai commencé mon travail, la version 3.3 n\'était pas encore sortie', '2016-08-30 20:16:15', '2016-08-30 20:16:15'),
(66, 110, 23, 'Ah oui, cela me parait logique....', '2016-08-30 20:19:35', '2016-08-30 20:19:35'),
(67, 111, 26, 'Un auteur peut poser une question et éditer/effacer ses propres questions.', '2016-08-30 20:26:15', '2016-08-30 20:35:38'),
(68, 111, 23, 'Peut-il également répondre aux questions posées par d\'autres auteurs?', '2016-08-30 20:36:15', '2016-08-30 20:36:15'),
(69, 111, 26, 'Oui, bien sûr. Il peut répondre à n\'importe quelle question. Même les questions posées par un admin.', '2016-08-30 20:36:46', '2016-08-30 20:36:46'),
(70, 111, 23, 'Est-ce qu\'un auteur peut editer ou effacer les réponses d\'autres utilisateurs?', '2016-08-30 20:38:22', '2016-09-04 14:07:37'),
(71, 111, 26, 'Non, uniquement les admin peuvent effacer ou editer les questions et les réponses d\'autres utilisateurs', '2016-08-30 20:39:09', '2016-08-30 20:39:09'),
(72, 112, 26, 'La version d\'AngularJS est la 1.5.8. J\'ai pris la version minifiée.', '2016-08-30 20:45:00', '2016-08-30 20:45:00'),
(73, 112, 24, 'Mais pourquoi pas te lancer dans la version 2?', '2016-08-30 20:45:54', '2016-08-30 20:45:54'),
(74, 112, 26, 'Le travail comportait déjà suffisament de nouveaux défis. J\'ai été prudent.', '2016-08-30 20:46:52', '2016-08-30 20:46:52'),
(75, 112, 23, 'Tu as bien fait Lionel.', '2016-08-30 20:47:13', '2016-08-30 20:47:13'),
(76, 112, 26, 'Oui, je pense aussi. Merci Camille et Nicolas.', '2016-08-30 20:47:35', '2016-08-30 20:47:35'),
(77, 113, 26, 'Un utilisateur loggé (droits user) ne peut pas poser de question mais peut répondre à toute question. Il peut également éditer ses propres réponses et les effacer.', '2016-08-30 20:49:59', '2016-08-30 20:49:59'),
(78, 113, 24, 'Et lorsque l\'utilisateur n\'est pas loggé?', '2016-08-30 20:50:34', '2016-08-30 20:50:34'),
(79, 113, 26, 'En étant pas loggé, on voir toutes les questions et réponses, ainsi que rechercher dans les questions et les réponses. Mais il n\'est pas possible de poster une question ou une réponse.', '2016-08-30 20:51:49', '2016-08-30 20:51:49'),
(80, 113, 24, 'C\'est correct, merci', '2016-08-30 20:52:08', '2016-08-30 20:52:08'),
(81, 114, 26, 'J\'ai désactivé la pagination de cakePHP. Il est donc possible de poser autant de questions que l\'on veut. Il n\'y a pas de limite.', '2016-08-30 20:54:08', '2016-08-30 20:54:08'),
(82, 114, 26, 'J\'ai vu qu\'il était possible de paginer le json avec du jQuery... mais je ne me suis pas lancé dans cette étape étant donné qu\'elle n\'était pas demandée.', '2016-08-30 20:56:27', '2016-08-30 20:56:27'),
(83, 114, 26, '... et il faut bien s\'arrêter quelque part... Sinon j\'aurais jamais terminé', '2016-08-30 20:56:59', '2016-08-30 20:56:59'),
(84, 115, 23, 'Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Duis leo. Curabitur a felis in nunc fringilla tristique.', '2016-08-30 21:00:36', '2016-08-30 21:00:36'),
(85, 115, 26, 'Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Sed libero. Praesent venenatis metus at t', '2016-08-30 21:01:10', '2016-08-30 21:01:10'),
(86, 115, 23, 'Fusce egestas elit eget lorem. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Phasellus blandit leo ut odio. Phasellus nec sua', '2016-08-30 21:01:24', '2016-09-21 17:52:54'),
(87, 115, 26, 'Curabitur vestibulum aliquam leo. Praesent nec nisl a purus blandit viverra. Quisque id mi. Praesent blandit laoreet nibh. Sed a libero.\n\nFusce fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vesti', '2016-08-30 21:01:41', '2016-08-30 21:01:41'),
(88, 115, 23, 'Curabitur vestibulum aliquam leo. Praesent nec nisl a purus blandit viverra. Quisque id mi. Praesent blandit laoreet nibh. Sed a libero. Fusce fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vestib', '2016-08-30 21:02:08', '2016-09-21 17:46:08'),
(89, 115, 23, 'Curabitur vestibulum aliquam leo. Praesent nec nisl a purus blandit viverra. Quisque id mi. Praesent blandit laoreet nibh. Sed a libero.\n\nFusce fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vesti', '2016-08-30 21:02:14', '2016-09-21 17:45:53'),
(90, 115, 21, 'Curabitur vestibulum aliquam leo. Praesent nec nisl a purus blandit viverra. Quisque id mi. Praesent blandit laoreet nibh. Sed a libero. Fusce fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent vestib', '2016-08-30 21:04:43', '2016-08-30 21:04:43'),
(91, 116, 25, 'Les admins ont tous les droits. Ils peuvent ajouter des questions et des réponses, mais également editer et effacer les questions et les réponses des autres utilisateurs et auteurs. Bref, ils peuvent tout faire.', '2016-08-30 21:06:47', '2016-08-30 21:06:47'),
(92, 116, 21, 'Trop cool. Merci', '2016-08-30 21:07:05', '2016-08-30 21:07:05'),
(93, 116, 25, 'De nada !', '2016-08-30 21:07:25', '2016-08-30 21:07:25'),
(94, 114, 23, 'C\'est correct Lionel.', '2016-09-04 12:33:02', '2016-09-04 14:09:07'),
(110, 114, 26, ';-)', '2016-09-05 19:49:34', '2016-09-05 19:49:34'),
(112, 115, 23, 'Aenean massa. Sed hendrerit. Maecenas malesuada.. Suspendisse faucibus, nunc et pellentesque egestas, lacus ante convallis tellus, vitae iaculis lacus elit id tortor. Et nullam quis ante. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique', '2016-09-21 17:46:41', '2016-09-21 17:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `answers_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `title`, `body`, `created`, `modified`, `answers_count`) VALUES
(110, 23, 'Version de CakePHP', 'Quelle est la version de cakePHP utilisé dans ce travail?', '2016-08-30 19:59:28', '2016-08-30 20:20:18', 4),
(111, 23, 'Droits d\'un auteur', 'Quels sont les droits d\'un auteur d\'une question ?', '2016-08-30 20:24:49', '2016-09-06 17:35:34', 5),
(112, 24, 'Version d\'AngularJS', 'Quelle est la version d\'AngularJS que tu as utilisé pour ton travail?', '2016-08-30 20:42:40', '2016-08-30 20:42:40', 5),
(113, 24, 'Droits d\'un utilisateur', 'Quels sont les droits d\'un utilisateur (compte user loggé)?', '2016-08-30 20:48:21', '2016-08-30 20:48:21', 4),
(114, 23, 'Maximum de questions', 'Combien de questions est-il possible de poser au maximum?', '2016-08-30 20:53:17', '2016-08-30 20:53:17', 5),
(115, 23, 'Lorem Ipsum (to test the design with long text)', 'Curabitur vestibulum aliquam leon. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. Phasellus tempus. Sed in libero ut nibh placerat accumsan. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Curabitur nisi. Curabitur turpis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Duis leo. Curabitur a felis in nunc fringilla tristique. Fusce fermentum. Aliquam lobortis. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Duis lobortis massa imperdiet quam. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Ut varius tincidunt libero. Fusce fermentum. Vivamus elementum semper nisi. Nam at tortor in tellus interdum sagittis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.', '2016-08-30 21:00:21', '2016-09-21 17:42:57', 8),
(116, 21, 'Droits d\'un admin', 'C\'est bien joli tout ça, mais quels sont les droits des admins?', '2016-08-30 21:05:31', '2016-08-30 21:05:31', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `role`, `created`, `modified`) VALUES
(21, 'admin@email.com', '$2y$10$q8Ghn2IUFOYSGQB3OyVLqe1/0K1IXldHIipeA0I7hGiuCEnsxfQtG', 'Admin', 'admin', '2016-08-30 19:54:56', '2016-08-30 19:54:56'),
(22, 'author@email.com', '$2y$10$8tRB.TegZuUpEhMOagjpVOoKd4SdopalIz4R39ouqO6rNAG4Ih68m', 'Author', 'author', '2016-08-30 19:55:31', '2016-08-30 19:55:31'),
(23, 'camille@email.com', '$2y$10$HfpPBTS2COsS47/pS1o.ouN/7iuh./iGpSzlmgBNfFwNSjEduHobu', 'Camille', 'author', '2016-08-30 19:55:53', '2016-08-30 19:55:53'),
(24, 'nicolas@email.com', '$2y$10$rVMHo9dV1n9XKtqkvfZAd.KuyYEMof3Y.rDHCCnYZlpzTRMEhvB6C', 'Nicolas', 'author', '2016-08-30 19:56:11', '2016-08-30 19:56:11'),
(25, 'user@email.com', '$2y$10$.Q7mNRA24otjFcnmOjai0ujaJtuhp1n.iJNV06Hm7C1zzpNAIR146', 'User', 'user', '2016-08-30 19:56:28', '2016-08-30 19:56:28'),
(26, 'lionel@email.com', '$2y$10$7Qnxbf2o7TIt4eYma9DK3.rk0NgZC/Lanng5ZJ08E89L7jFYQlgAe', 'Lionel', 'user', '2016-08-30 19:56:43', '2016-08-30 19:56:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_key` (`question_id`),
  ADD KEY `user_key` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_key` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
