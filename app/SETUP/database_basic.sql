-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 15. Dez 2017 um 20:27
-- Server-Version: 10.1.26-MariaDB-0+deb9u1
-- PHP-Version: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `ownboilerplate`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nav`
--

CREATE TABLE `nav` (
  `id` int(11) NOT NULL,
  `nav_navtype` int(11) NOT NULL,
  `nav_title` varchar(100) NOT NULL,
  `nav_desc` text NOT NULL,
  `nav_parentid` int(11) NOT NULL,
  `nav_allowedmask` int(11) NOT NULL,
  `nav_target` varchar(500) NOT NULL,
  `nav_active` int(1) NOT NULL,
  `nav_sort` int(11) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `nav`
--

INSERT INTO `nav` (`id`, `nav_navtype`, `nav_title`, `nav_desc`, `nav_parentid`, `nav_allowedmask`, `nav_target`, `nav_active`, `nav_sort`) VALUES
(1, 1, 'Home', '', 0, 0, '/', 1, 4),
(2, 1, 'Application', 'Main application menue', 4, 0, 'app', 1, 9),
(3, 1, 'About', 'About this app', 1, 0, 'about', 1, 3),
(4, 1, 'App-Management', 'Application management', 0, 262145, 'app_manager', 1, 10),
(5, 1, 'App-Admin', 'Administration', 2, 1, 'app_admin', 1, 8),
(7, 0, 'Startpage', 'Startpage', 1, 1905043, '/', 1, 5),
(8, 0, 'Imprint', 'Imprint', 1, 1905043, 'imprint', 1, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nav_types`
--

CREATE TABLE `nav_types` (
  `id` int(11) NOT NULL,
  `navtype` varchar(50) NOT NULL,
  `navtypedesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `nav_types`
--

INSERT INTO `nav_types` (`id`, `navtype`, `navtypedesc`) VALUES
(1, 'internal', 'Internal page title. Will be set as params to index.php'),
(2, 'external', 'Opens the external link (in a new windows)'),
(3, 'external_local', 'Opens the external link in the current window.'),
(4, 'dropdown', 'DropDown-Parent');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page` varchar(100) NOT NULL,
  `pagetitle` varchar(500) NOT NULL,
  `useacl` int(1) NOT NULL,
  `syspage` int(1) NOT NULL DEFAULT '0',
  `usermask` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pages`
--

INSERT INTO `pages` (`id`, `page`, `pagetitle`, `useacl`, `syspage`, `usermask`) VALUES
(1, 'admin_sysman', 'System Management', 0, 1, 0),
(2, 'admin_userman', 'System Management', 0, 1, 403),
(3, 'debugout', 'debugout Title', 0, 1, 0),
(4, 'dev', 'dev Title', 1, 0, 1),
(5, 'dev_o', 'dev_o Title', 0, 0, 0),
(6, 'login', 'login Title', 0, 1, 0),
(7, 'msgout', 'msgout Title', 0, 1, 0),
(8, 'profile', 'profile Title', 0, 1, 0),
(9, 'pwreset', 'pwreset Title', 0, 1, 0),
(10, 'register', 'register Title', 0, 1, 0),
(11, 'errout', 'errout Title', 0, 0, 0),
(12, 'noaccess', 'noaccess Title', 0, 0, 0),
(13, 'start', 'start Title', 0, 0, 0),
(14, 'imprint', 'Imprint', 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sys_settings`
--

CREATE TABLE `sys_settings` (
  `id` int(11) NOT NULL,
  `set_section` varchar(50) NOT NULL,
  `set_key` varchar(50) NOT NULL,
  `set_val` varchar(255) NOT NULL,
  `set_sensible` int(1) NOT NULL,
  `set_required` int(1) NOT NULL,
  `set_default` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nav_navtypeconst` (`nav_navtype`);

--
-- Indizes für die Tabelle `nav_types`
--
ALTER TABLE `nav_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniquenavtype` (`navtype`);

--
-- Indizes für die Tabelle `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unipage` (`page`);

--
-- Indizes für die Tabelle `sys_settings`
--
ALTER TABLE `sys_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seckeyuniq` (`set_section`,`set_key`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uname` (`username`);

--
-- Indizes für die Tabelle `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Indizes für die Tabelle `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Indizes für die Tabelle `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `nav`
--
ALTER TABLE `nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `nav_types`
--
ALTER TABLE `nav_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT für Tabelle `sys_settings`
--
ALTER TABLE `sys_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT für Tabelle `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;