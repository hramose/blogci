-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2017 a las 04:13:20
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint(20) NOT NULL,
  `name_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`) VALUES
(1, 'Computadoras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `addtime` int(11) DEFAULT '0',
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `backgroundColor` varchar(255) DEFAULT NULL,
  `borderColor` varchar(255) DEFAULT NULL,
  `allDay` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `user_id`, `addtime`, `start`, `end`, `url`, `backgroundColor`, `borderColor`, `allDay`) VALUES
(3, 'sdfsdfsdf', 23207, 1447208656, '2015-11-12 00:00:00', '2015-11-13 00:00:00', '', 'rgb(221, 75, 57)', 'rgb(221, 75, 57)', 1),
(4, 'sdfvsdfsdf', 23207, 1447208700, '2015-11-14 00:00:00', '2015-11-15 00:00:00', '', 'rgb(255, 133, 27)', '', 1),
(16, 'sdfdsfgdf', 23207, 1447210716, '2015-07-28 00:00:00', '2015-07-29 00:00:00', NULL, '#3c8dbc', '#3c8dbc', 1),
(11, 'xvfvdfv', 23207, 1447209687, '2015-11-10 20:00:00', '2015-11-11 00:00:00', NULL, '#3c8dbc', '#3c8dbc', 0),
(13, 'sdfsdfsdfsdf', 23207, 1447209888, '2015-11-11 02:00:00', '2015-11-11 06:30:00', NULL, '#3c8dbc', '#3c8dbc', 0),
(14, 'zdcsdvsgfbvsdfgb', 23207, 1447209899, '2015-11-14 00:00:00', '2015-11-14 03:30:00', NULL, 'rgb(96, 92, 168)', 'rgb(96, 92, 168)', 0),
(15, 'sdvsdgsfg', 23207, 1447209906, '2015-11-13 19:00:00', '2015-11-14 00:00:00', NULL, '#3c8dbc', '#3c8dbc', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '编号',
  `permKey` varchar(255) NOT NULL COMMENT '权限key',
  `permName` varchar(255) NOT NULL COMMENT '权限名称',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级权限编号',
  `lft` int(11) DEFAULT '0',
  `rgt` int(11) DEFAULT '0',
  `root_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `sortid` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `issys` int(11) NOT NULL DEFAULT '0' COMMENT '系统的',
  `permType` int(11) DEFAULT '0' COMMENT '权限类型',
  `rel_id` int(11) DEFAULT '0' COMMENT '权限对应类型对应记录的id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限表';

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `permKey`, `permName`, `parent_id`, `lft`, `rgt`, `root_id`, `addtime`, `sortid`, `issys`, `permType`, `rel_id`) VALUES
(125, 'admin_manage', 'Gestión de admin', 0, 0, 0, 0, '2015-11-21 18:12:58', 0, 0, 0, 0),
(782, 'admin-permissions', 'Permisos', 125, 0, 0, 0, '2015-11-23 11:46:27', 0, 0, 0, 0),
(783, 'admin-add-permission', 'Añadir Permission', 782, 0, 0, 0, '2015-11-23 11:46:40', 0, 0, 0, 0),
(784, 'admin-del-permission', 'Eliminar Permisos', 782, 0, 0, 0, '2015-11-23 11:46:55', 0, 0, 0, 0),
(785, 'admin-edit-permission', 'Editar Permisos', 782, 0, 0, 0, '2015-11-23 11:47:07', 0, 0, 0, 0),
(833, 'admin-users', 'Usuarios', 125, 0, 0, 0, '2015-11-24 12:49:07', 0, 0, 0, 0),
(834, 'admin-add-user', 'Añadir Usuarios', 833, 0, 0, 0, '2015-11-24 12:49:22', 0, 0, 0, 0),
(835, 'admin-del-user', 'Eliminar usuarios', 833, 0, 0, 0, '2015-11-24 12:49:37', 0, 0, 0, 0),
(836, 'admin-edit-user', 'Editar Usuarios', 833, 0, 0, 0, '2015-11-24 12:49:50', 0, 0, 0, 0),
(837, 'admin-roles', 'Roles', 125, 0, 0, 0, '2015-11-24 12:50:07', 0, 0, 0, 0),
(838, 'admin-add-role', 'Añadir Roles', 837, 0, 0, 0, '2015-11-24 12:50:20', 0, 0, 0, 0),
(839, 'admin-del-role', 'Eliminar Roles', 837, 0, 0, 0, '2015-11-24 12:50:39', 0, 0, 0, 0),
(840, 'admin-edit-role', 'Editar Roles', 837, 0, 0, 0, '2015-11-24 12:50:54', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL COMMENT '角色编号',
  `roleName` varchar(20) NOT NULL COMMENT '角色名称',
  `issys` int(11) NOT NULL DEFAULT '0' COMMENT '系统的',
  `company_id` int(11) UNSIGNED DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表';

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `roleName`, `issys`, `company_id`) VALUES
(3, 'Admin', 1, 0),
(4, 'Register User', 1, 0),
(5, 'Super Admin', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_perms`
--

CREATE TABLE `role_perms` (
  `id` int(11) NOT NULL COMMENT '编号',
  `roleID` bigint(20) NOT NULL DEFAULT '0' COMMENT '角色编号',
  `permID` bigint(20) NOT NULL DEFAULT '0' COMMENT '权限编号',
  `value` tinyint(1) NOT NULL DEFAULT '0' COMMENT '值',
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色权限表';

--
-- Volcado de datos para la tabla `role_perms`
--

INSERT INTO `role_perms` (`id`, `roleID`, `permID`, `value`, `addDate`) VALUES
(5287, 5, 125, 1, '2015-11-28 23:53:18'),
(5288, 5, 782, 1, '2015-11-28 23:53:18'),
(5289, 5, 783, 1, '2015-11-28 23:53:18'),
(5290, 5, 784, 1, '2015-11-28 23:53:18'),
(5291, 5, 785, 1, '2015-11-28 23:53:18'),
(5296, 5, 833, 1, '2015-11-28 23:53:18'),
(5297, 5, 834, 1, '2015-11-28 23:53:18'),
(5298, 5, 835, 1, '2015-11-28 23:53:18'),
(5299, 5, 836, 1, '2015-11-28 23:53:18'),
(5300, 5, 837, 1, '2015-11-28 23:53:18'),
(5301, 5, 838, 1, '2015-11-28 23:53:18'),
(5302, 5, 839, 1, '2015-11-28 23:53:18'),
(5303, 5, 840, 1, '2015-11-28 23:53:18'),
(5305, 4, 125, 0, '2015-11-28 23:53:40'),
(5306, 4, 782, 0, '2015-11-28 23:53:40'),
(5307, 4, 783, 0, '2015-11-28 23:53:40'),
(5308, 4, 784, 0, '2015-11-28 23:53:40'),
(5309, 4, 785, 0, '2015-11-28 23:53:40'),
(5314, 4, 833, 0, '2015-11-28 23:53:40'),
(5315, 4, 834, 0, '2015-11-28 23:53:40'),
(5316, 4, 835, 0, '2015-11-28 23:53:40'),
(5317, 4, 836, 0, '2015-11-28 23:53:40'),
(5318, 4, 837, 0, '2015-11-28 23:53:40'),
(5319, 4, 838, 0, '2015-11-28 23:53:40'),
(5320, 4, 839, 0, '2015-11-28 23:53:40'),
(5321, 4, 840, 0, '2015-11-28 23:53:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '用户编号',
  `username` varchar(255) NOT NULL COMMENT '登录名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `cur_login_time` datetime DEFAULT NULL COMMENT '当前登录时间',
  `cur_login_ip` varchar(255) DEFAULT NULL COMMENT '当前登录ip',
  `cur_login_area` varchar(255) DEFAULT NULL COMMENT '当前登录地区',
  `last_login_ip` varchar(255) DEFAULT NULL COMMENT '最后登录ip',
  `last_login_area` varchar(255) DEFAULT NULL COMMENT '最后登录地区',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `reg_ip` varchar(255) NOT NULL COMMENT '注册ip',
  `reg_area` varchar(255) NOT NULL COMMENT '注册地区',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `owner_sites` text,
  `parent_user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `company_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `user_type` tinyint(1) UNSIGNED DEFAULT '0',
  `issys` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户基本信息表';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `cur_login_time`, `cur_login_ip`, `cur_login_area`, `last_login_ip`, `last_login_area`, `last_login_time`, `reg_time`, `reg_ip`, `reg_area`, `status`, `login_times`, `owner_sites`, `parent_user_id`, `company_id`, `photo`, `user_type`, `issys`) VALUES
(3, 'admin', '$2y$10$xHMQKNYwEkhGwGIDM9rKo.lu2ZDUypqgv4oOi2DF2cTzH5n5sR2r.', 'chaegumi@qq.com', '2017-02-09 01:50:47', '::1', '', '::1', '', '2017-02-08 21:00:41', '2013-09-18 15:33:48', '::1', '', 1, 799, 'a:6:{i:0;s:2:"52";i:1;s:2:"53";i:2;s:2:"55";i:3;s:2:"56";i:4;s:2:"57";i:5;s:2:"58";}', 0, 0, NULL, 1, 1),
(23216, 'nuevo', '$2y$10$11m01hGQh5hHoUgIEb/LTOPU4PfXwzFtE/5lMc84Q3GxANhcoA0z2', 'sartin.consultas@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2017-02-08 05:20:33', '', '', 1, 0, NULL, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_perms`
--

CREATE TABLE `user_perms` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '编号',
  `userID` bigint(20) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户编号',
  `permID` bigint(20) NOT NULL DEFAULT '0' COMMENT '权限编号',
  `value` tinyint(1) NOT NULL DEFAULT '0' COMMENT '值',
  `addDate` datetime NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户权限表';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `userID` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户编号',
  `roleID` bigint(20) NOT NULL DEFAULT '0' COMMENT '角色编号',
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `id` int(11) UNSIGNED NOT NULL COMMENT '编号'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表';

--
-- Volcado de datos para la tabla `user_roles`
--

INSERT INTO `user_roles` (`userID`, `roleID`, `addDate`, `id`) VALUES
(3, 5, '2015-11-29 00:09:33', 79),
(23216, 4, '2017-02-08 05:51:25', 85);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_userid` (`user_id`) USING BTREE;

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permKey` (`permKey`) USING BTREE,
  ADD KEY `parent_id` (`parent_id`) USING BTREE,
  ADD KEY `lft` (`lft`) USING BTREE,
  ADD KEY `rgt` (`rgt`) USING BTREE,
  ADD KEY `root_id` (`root_id`) USING BTREE,
  ADD KEY `issys` (`issys`) USING BTREE;

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issys` (`issys`) USING BTREE,
  ADD KEY `roleName` (`roleName`) USING BTREE;

--
-- Indices de la tabla `role_perms`
--
ALTER TABLE `role_perms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roleID_2` (`roleID`,`permID`) USING BTREE;

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`) USING BTREE,
  ADD KEY `company_id` (`company_id`) USING BTREE,
  ADD KEY `user_type` (`user_type`) USING BTREE,
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`);

--
-- Indices de la tabla `user_perms`
--
ALTER TABLE `user_perms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`,`permID`) USING BTREE;

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`,`roleID`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号', AUTO_INCREMENT=862;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色编号', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `role_perms`
--
ALTER TABLE `role_perms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号', AUTO_INCREMENT=5327;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户编号', AUTO_INCREMENT=23218;
--
-- AUTO_INCREMENT de la tabla `user_perms`
--
ALTER TABLE `user_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号', AUTO_INCREMENT=853;
--
-- AUTO_INCREMENT de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '编号', AUTO_INCREMENT=87;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
