# 创建数据库
create database if not exists admin;

use admin;

# 后台管理员
create table if not exists `admin_auth` (
	`id` int(10) unsigned not null AUTO_INCREMENT,
	`uname` varchar(20) not null comment '用户名',
	`pwd` text not null comment '密码',
	`encry` char(6) not null comment '加密串',
	`role_id` int(10) unsigned not null comment '组id',
	`display_name` varchar(100) default '' comment '显示用户名',
	`logined_at`  datetime comment '最近登陆时间',
	`created_at` timestamp null default current_timestamp,
	`status` tinyint(1) default 1 comment '状态 0 启用 1禁用 ',
  	`deleted` tinyint(1) default 0 ,
	PRIMARY key(`id`),
	UNIQUE KEY(`uname`)
) engine=InnoDB default CHARSET=utf8mb4 COMMENT='后台管理员';

INSERT INTO `admin_auth`(`id`, `uname`, `pwd`, `encry`, `role_id`, `display_name`, `status`, `deleted`) VALUES 
(1, 'admin', '617d19b72e725a05addf91d5430d240f', 'XK.?}<', 1, 'jmz', 1, 0)
,(2, 'jmz', '76f754fabe97d1e1e451fe531df5160b', 'M@q}DS', 2, 'caiwu 123', 1, 0);


# 组
create table if not exists `admin_role` (
	`id` int(10) unsigned not null AUTO_INCREMENT,
	`name` varchar(50) not null comment '组名',
	`detail` varchar(200) not null comment '简单描述',
	`rules_checked` text  comment 'layui 树形选中的checked',
	`rules` text  comment '权限列表 所有打勾的',
	`pid` int(10) unsigned default 0 comment '上级部门',
	`created_at` timestamp default current_timestamp,
	PRIMARY key(`id`)
) engine =InnoDB default charset=utf8mb4 comment= '组名';

INSERT INTO `admin_role`(`id`, `name`, `detail`, `rules_checked`, `rules`) VALUES 
(1, '超级管理员', '网站建设者', '5,6,7,8,9,10,11,12,17,13,14,15,16', '1,2,5,6,7,8,3,9,10,11,12,17,4,13,14,15,16')
,(2,'测试','测试小角色','5,6,7,8,9,10,11,12,17,13,14,15,16,19','1,2,5,6,7,8,3,9,10,11,12,17,4,13,14,15,16,18,19');

# 权限
CREATE TABLE if not exists `admin_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '名称',
  `node` varchar(50) default '' comment '节点',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1 启用; 0 禁用',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `created_at` timestamp default current_timestamp,
  PRIMARY KEY (`id`),
  KEY node(`node`),
  KEY `status_node` (`status`,`node`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限点和菜单列表';

INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (1, '管理用户', 'auth', 1, 0);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (2, '后台管理员', 'auth.auth', 1, 1);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (3, '角色管理', 'auth.role', 1, 1);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (4, '权限管理', 'auth.rule', 1, 1);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (5, '查看管理列表', 'auth.auth.view', 1, 2);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (6, '添加管理员', 'auth.auth.add', 1, 2);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (7, '修改管理员', 'auth.auth.set', 1, 2);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (8, '删除管理员', 'auth.auth.del', 1, 2);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (9, '查看角色', 'auth.role.view', 1, 3);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (10, '增加角色', 'auth.role.add', 1, 3);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (11, '修改角色', 'auth.role.set', 1, 3);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (12, '删除角色', 'auth.role.del', 1, 3);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (13, '查看权限', 'auth.rule.view', 1, 4);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (14, '增加权限', 'auth.rule.add', 1, 4);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (15, '修改权限', 'auth.rule.set', 1, 4);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (16, '删除权限', 'auth.rule.del', 1, 4);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (17, '变更权限', 'auth.role.rule', 1, 3);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (18, '主页', 'index', 1, 0);
INSERT INTO `admin_rule`(`id`, `name`, `node`, `status`, `pid`) VALUES (19, '登录日志', 'index.login.log', 1, 18);

# 操作日志记录
CREATE TABLE if not exists `admin_log` (
	`id` int(10) unsigned not null auto_increment,
	`url` varchar(50) not null DEFAULT '' comment '操作url',
	`data` text comment '信息',
	`uid` int(10) comment '操作人',
	`created_at` timestamp default current_timestamp,
	PRIMARY KEY(`id`)
) engine=MyISAM default CHARSET=utf8mb4 comment='操作记录表';

# 登录日志记录
CREATE TABLE if not exists `admin_login_log`(
	`id` int(10) unsigned not null auto_increment,
	`uname` varchar(20) comment '登录人',
	`status` tinyint(1) default '0' comment '是否登录 1 登录成功，0失败',
	`created_at` timestamp default current_timestamp,
	PRIMARY KEY(`id`)
)engine=MyISAM default CHARSET=utf8mb4 comment='登录日志记录表';