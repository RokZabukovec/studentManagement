-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Gostitelj: localhost:8889
-- Čas nastanka: 05. sep 2019 ob 23.35
-- Različica strežnika: 5.7.23
-- Različica PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Zbirka podatkov: `student_management`
--

-- --------------------------------------------------------

--
-- Struktura tabele `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) UNSIGNED NOT NULL,
  `subject_id` int(11) UNSIGNED NOT NULL,
  `date_time` datetime NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `exams`
--

INSERT INTO `exams` (`exam_id`, `subject_id`, `date_time`, `duration`) VALUES
(21, 36, '2020-02-22 15:00:00', 60),
(22, 37, '2010-02-22 22:00:00', 60),
(23, 38, '2002-04-04 22:00:00', 45),
(24, 39, '2020-03-31 22:00:00', 60),
(28, 41, '2020-06-05 16:00:00', 77);

-- --------------------------------------------------------

--
-- Struktura tabele `job_titles`
--

CREATE TABLE `job_titles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `job_titles`
--

INSERT INTO `job_titles` (`id`, `name`, `permission`) VALUES
(1, 'Standard', ''),
(2, 'Admin', '{admin : 1}');

-- --------------------------------------------------------

--
-- Struktura tabele `professors`
--

CREATE TABLE `professors` (
  `professor_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `professors`
--

INSERT INTO `professors` (`professor_id`, `first_name`, `last_name`, `title`, `subject`, `phone`) VALUES
(1, 'Marko', 'Lužar', 'doc. dr.', 'Uvod v programiranje', '040262866'),
(2, 'Slavoj', 'Žižek', 'prof. dr.', 'Filozofija', '041231222');

-- --------------------------------------------------------

--
-- Struktura tabele `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(80) NOT NULL,
  `program_type` varchar(15) NOT NULL,
  `semesters` int(2) NOT NULL,
  `title_after_completion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `program_type`, `semesters`, `title_after_completion`) VALUES
(1, 'Računalništvo in spletne tehnologije', 'VSŠ', 6, 'Diplomirani inženir računalništva in spletnih tehnologij'),
(2, 'Informatika v sodobni družbi', 'VSŠ', 6, 'Diplomirani družboslovni informatik');

-- --------------------------------------------------------

--
-- Struktura tabele `students`
--

CREATE TABLE `students` (
  `student_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(256) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `birthday`, `address`, `program_id`) VALUES
(8, 'Rok', 'Zabukovec', '1994-06-08', 'Potočna vas 6', 1),
(9, 'Ana', 'Zabukovec', '1991-08-03', 'Potočna vas 6', 1),
(10, 'Miha', 'Novak', '2000-06-05', 'Kočevarjeva ulica 12', 2),
(12, 'Ožbej', 'Jerman', '2000-04-03', 'Potočna vas', 2);

-- --------------------------------------------------------

--
-- Struktura tabele `student_exam_registration`
--

CREATE TABLE `student_exam_registration` (
  `exam_registration_id` int(11) NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `exam_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `student_exam_registration`
--

INSERT INTO `student_exam_registration` (`exam_registration_id`, `student_id`, `exam_id`) VALUES
(1, 8, 21),
(2, 8, 23),
(3, 8, 24);

-- --------------------------------------------------------

--
-- Struktura tabele `student_subject`
--

CREATE TABLE `student_subject` (
  `id` int(11) NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `subject_id` int(11) UNSIGNED NOT NULL,
  `Grade` int(2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `student_subject`
--

INSERT INTO `student_subject` (`id`, `student_id`, `subject_id`, `Grade`) VALUES
(1, 8, 36, 9),
(2, 8, 38, 9),
(3, 8, 39, 10);

-- --------------------------------------------------------

--
-- Struktura tabele `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) UNSIGNED NOT NULL,
  `professor_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(80) NOT NULL,
  `semester` int(5) NOT NULL,
  `hours` int(5) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `subjects`
--

INSERT INTO `subjects` (`subject_id`, `professor_id`, `title`, `semester`, `hours`, `program_id`) VALUES
(34, 1, 'Spletno programiranje 2', 3, 120, 1),
(36, 1, 'Matematika 2', 2, 122, 1),
(37, 1, 'Uvod v algoritme', 2, 122, 2),
(38, 1, 'Elektronsko komuniciranje in pismenost', 1, 111, 1),
(39, 1, 'Statistika 1', 2, 222, 1),
(40, 1, 'Sodobni družbeni trendi', 3, 33, 2),
(41, 1, 'Spletna varnost', 4, 333, 2);

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `joined` datetime NOT NULL,
  `job_title` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_name`, `joined`, `job_title`) VALUES
(16, 'hashtest', '$2y$10$wLd0CidbUce3ViyqlbmvZe9yFI9TZj66yjIhItMZgNYHZyZCsemK2', 'Hastest', 'test', '2019-05-26 14:39:23', 1),
(17, 'rokjecar', '$2y$10$Fi9YGwSMgjzQD7lm5bJeqOV5ul1Bw2eHzaAncTbCRUQZ2GxQCiVCm', 'Rok', 'Zabukovec', '2019-05-26 14:47:18', 1),
(18, 'Markožagar', '$2y$10$Y5I4SFXMNAQ/8SkpMw04t.H1KVxvBwNvugbCpQZgHd8D1F9uA1ZoC', 'Marko', 'Žagar', '2019-05-26 14:53:31', 1),
(19, 'markoskače', '$2y$10$XD2PfDZkCZbh4sVLnr3qhOzQlCm5BGPQotRrXNQbEGpYWkDZrYHeq', 'Marko', 'Žagar', '2019-05-26 14:54:27', 1),
(20, 'rootaa', '$2y$10$Aqep89exXpn1fjJtfcI/xOBiKWbt1t9dxAEkcfaEKrmjQx1xeSsUi', 'aa', 'aa', '2019-05-26 14:55:18', 1),
(21, 'žabac', '$2y$10$ZDqIQOsEF/c9OJEZsogwz.sNqtB6n11IoUt1ZR04zvTowsnWiHIpS', 'Miha', 'Žabac', '2019-05-26 15:09:31', 1),
(22, 'roothaha', '$2y$10$7wvIGmz3HsrpXwE8rmac1e0PAx23l5uMsSmBI9GpTL6gE0tJF0aCu', 'haha', 'haha', '2019-05-26 15:10:18', 1),
(23, 'Swilson', '$2y$10$Npq1jNh1bcX2yQRmZOjTTeYvGMRB3Zzn5Qr1u0Ng9RQZu6umZ8z2y', 'Roki', 'Samo', '2019-05-26 15:13:19', 1),
(24, 'Swilson1223', '$2y$10$07EKUnuqhdYvBucgE8bmyeyRlg/FCnURxW3pWerSloemre0qtmgpa', 'Samo', 'Wilson', '2019-05-26 15:14:12', 1),
(25, 'samowilson', '$2y$10$SUYOT7ygeJe7x5FM0lyWVes7nUZiqhlDScEONJIK4wIOUZDG/U0Ri', 'Samo', 'Wilson', '2019-05-27 15:08:39', 1),
(26, 'rootmiha', '$2y$10$igLaST/00srz/k66E9hIJOnlU2cnimRMvJs7rQuXqMiroSKrh6Ze2', 'Mihs', 'Zabukovec', '2019-05-27 15:09:17', 1),
(27, 'rootp', '$2y$10$dte0PAALhy7TkWqyTTGqCeO1XcI4WXKYTtFDTBbLAkPKuti/aaXmq', 'Rok', 'Zabukovec', '2019-05-27 15:29:21', 1),
(28, 'rz123', '$2y$10$WAPrnrD.FasA1P8YI2vwfOsgDkGkmutFWs/7wIdhwj11W52fNIh9S', 'Rok', 'Zabukovec', '2019-05-27 16:28:04', 1),
(29, 'root', '$2y$10$mNQTqtrRR/0REVWx.FCtueiTJ/9zlPzU91HHt2nB9gekupOEz0yC6', 'root', 'root', '2019-05-27 16:30:42', 1),
(30, 'mihazabukovec', '$2y$10$3UJbYI6F0b.7Tn5Ppd.bXe68NwIXOePILPWf.SzxNEc5aJKzxu/MO', 'Miha', 'Zabukovec', '2019-05-27 19:27:30', 1),
(31, 'mkovac', '$2y$10$CQsFSemta1klqrQLvyVBAecQgL4CVdLxJcbGOKblU/pCdHClDHhM2', 'Marko', 'Kovač', '2019-05-27 19:31:28', 1),
(32, 'jz', '$2y$10$JtyyRx2NbiGkRrEXNPz2L.ZVb/3yEY0FQEMQM8nPrjhYs.j/5yyc.', 'Jana', 'Zalokar', '2019-05-27 19:55:26', 1),
(33, 'Žiga', '$2y$10$NY58pt5On3Z9lh1ddqweIeU2tOBPe0PZZOnVbD4OgxlM8D77uZC8a', 'Žiga', 'Špelič', '2019-05-27 20:18:16', 1),
(34, 'markozabukovec', '$2y$10$FPEJThic65p31.jMpGrHiu1NX5gE4f9u3pkAu0.IxRAvfBMpL5Xiu', 'Marko', 'Zabukovec', '2019-06-19 17:56:04', 1);

-- --------------------------------------------------------

--
-- Struktura tabele `users_sessions`
--

CREATE TABLE `users_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `users_sessions`
--

INSERT INTO `users_sessions` (`id`, `user_id`, `hash`) VALUES
(3, 29, '5cec2d1e2d676'),
(4, 34, '5d0a5b281c7bc');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indeksi tabele `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`professor_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indeksi tabele `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indeksi tabele `students`
--
ALTER TABLE `students`
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `student_id_2` (`student_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indeksi tabele `student_exam_registration`
--
ALTER TABLE `student_exam_registration`
  ADD PRIMARY KEY (`exam_registration_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indeksi tabele `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`id`,`student_id`,`subject_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indeksi tabele `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `professor_id` (`professor_id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `users_sessions`
--
ALTER TABLE `users_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT tabele `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabele `professors`
--
ALTER TABLE `professors`
  MODIFY `professor_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabele `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabele `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT tabele `student_exam_registration`
--
ALTER TABLE `student_exam_registration`
  MODIFY `exam_registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT tabele `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT tabele `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT tabele `users_sessions`
--
ALTER TABLE `users_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);

--
-- Omejitve za tabelo `student_exam_registration`
--
ALTER TABLE `student_exam_registration`
  ADD CONSTRAINT `student_exam_registration_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_exam_registration_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;

--
-- Omejitve za tabelo `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omejitve za tabelo `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`),
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`professor_id`) REFERENCES `professors` (`professor_id`);
