-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 23 日 02:52
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jc-admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `competition`
--

CREATE TABLE IF NOT EXISTS `competition` (
  `competition_id` int(6) NOT NULL AUTO_INCREMENT,
  `game_id` int(6) NOT NULL COMMENT '游戏名称',
  `competition_name` varchar(50) NOT NULL COMMENT '比赛名称',
  `information` mediumtext NOT NULL COMMENT '比赛信息',
  PRIMARY KEY (`competition_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `game`
--

CREATE TABLE IF NOT EXISTS `game` (
  `game_id` int(6) NOT NULL AUTO_INCREMENT COMMENT '游戏id',
  `game_name` varchar(50) NOT NULL COMMENT '游戏名称',
  `information` mediumtext NOT NULL COMMENT '游戏信息',
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


INSERT INTO `game` (`game_id`, `game_name`, `information`) VALUES
(1, '英雄联盟', '《英雄联盟》是由美国Riot Games公司开发的3D竞技场战网游戏，其主创团队是由实力强劲的魔兽争霸系列游戏多人即时对战自定义地图（DOTA-Allstars）的开发团队，以及动视暴雪等著名游戏公司的美术、程序、策划人员组成，将DOTA的玩法从对战平台延伸到网络游戏世界。除了DOTA的游戏节奏、即时战略、团队作战外，《英雄联盟》拥有特色的英雄、自动匹配的战网平台，包括天赋树、召唤师系统、符文等元素，让玩家感受全新的英雄对战。'),
(2, 'DOTA2', 'DOTA2脱离了War3的引擎，由美国Valve公司研发运营，完美世界代理（国服），韩国NEXON代理（韩服），并由DotA的地图核心制作者IceFrog（冰蛙）联手Valve开发的多人联机即时战略游戏。DOTA2整个游戏将会保持原有风格不变，DotA中的100多位英雄正在逐步的移植到DOTA2中。从某种程度上来说，DOTA2是现有DOTA的新引擎版。完美正式宣布DOTA2于2013年4月28日开始测试， 已发布中文名“刀塔”。'),
(3, '炉石传说', '《炉石传说：魔兽英雄传》是一款在Windows、Mac系统上推出的免费策略类卡牌游戏。《炉石传说：魔兽英雄传》中国大陆地区独家运营权已被授予网易公司。作为暴雪娱乐公司旗下的一款主打游戏，同时也是经典《魔兽争霸》和《魔兽世界》系列的延伸。在《炉石传说》的游戏中，玩家可以选取魔兽系列中的九大经典英雄人物之一，围绕其英雄的职业为主题组建自己独特的套牌，与其他玩家进行对战，赢取新的卡牌，享受乐趣。'),
(4, '星际争霸2', '《星际争霸Ⅱ》（StarCraftⅡ）是由暴雪娱乐在2010年7月27日推出的一款即时战略游戏，作为《星际争霸》的续篇讲述了人族、星灵和异虫三族的故事。《星际争霸Ⅱ》以三部曲的形式推出，即《自由之翼》（Wings of Liberty）、《虫群之心》（Heart of the Swarm）和Legacy of the Void（暂译：虚空之遗）。');

-- --------------------------------------------------------

--
-- 表的结构 `guess`
--

CREATE TABLE IF NOT EXISTS `guess` (
  `guess_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(6) NOT NULL COMMENT '游戏名称id',
  `competition_id` int(6) NOT NULL COMMENT '比赛名称id',
  `create_time` varchar(50) NOT NULL COMMENT '创建时间',
  `update_time` varchar(50) NOT NULL,
  `start_time` varchar(50) NOT NULL COMMENT '开始时间',
  `end_time` varchar(50) NOT NULL COMMENT '结束时间',
  `state` varchar(50) NOT NULL COMMENT '状态',
  `home_team_id` int(6) NOT NULL COMMENT '主队id',
  `guest_team_id` int(6) NOT NULL COMMENT '客队id',
  `win_odds` int(5) NOT NULL COMMENT '主胜赔率',
  `lose_odds` int(5) NOT NULL COMMENT '主负赔率',
  `draw_odds` int(5) NOT NULL COMMENT '平赔率',
  `home_number` int(10) NOT NULL COMMENT '主队下注人数',
  `guest_number` int(10) NOT NULL COMMENT '客队下注人数',
  PRIMARY KEY (`guess_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(6) NOT NULL AUTO_INCREMENT,
  `game_id` int(6) NOT NULL COMMENT '游戏名称',
  `team_name` varchar(50) NOT NULL COMMENT '队伍名称',
  `information` mediumtext NOT NULL COMMENT '队伍信息',
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
