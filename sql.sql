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

# 组
create table if not exists `admin_role` (
	`id` int(10) unsigned not null AUTO_INCREMENT,
	`name` varchar(50) not null comment '组名',
	`detail` varchar(200) not null comment '简单描述',
	`rules_checked` text  comment 'layui 树形选中的checked',
	`rules` text  comment '权限列表 所有打勾的',
	`created_at` timestamp null default current_timestamp,
	PRIMARY key(`id`)
) engine =InnoDB default charset=utf8mb4 comment= '组名';

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

INSERT INTO `admin_rule` VALUES ('1', '管理用户', 'auth', '1', '0', '2019-07-10 17:53:07'), ('2', '后台管理', 'auth.auth', '1', '1', '2019-07-10 17:53:24'), ('3', '角色管理', 'auth.role', '1', '1', '2019-07-10 17:53:38'), ('4', '权限管理', 'auth.rule', '1', '1', '2019-07-10 17:53:55'), ('5', '查看管理列表', 'auth.auth.view', '1', '2', '2019-07-10 17:54:33'), ('6', '添加管理员', 'auth.auth.add', '1', '2', '2019-07-10 17:54:51'), ('7', '修改管理员', 'auth.auth.set', '1', '2', '2019-07-10 17:55:07'), ('8', '删除管理员', 'auth.auth.del', '1', '2', '2019-07-10 17:55:27'), ('9', '查看角色', 'auth.role.view', '1', '3', '2019-07-10 17:56:08'), ('10', '增加角色', 'auth.role.add', '1', '3', '2019-07-10 17:56:36'), ('11', '修改角色', 'auth.role.set', '1', '3', '2019-07-10 17:56:48'), ('12', '删除角色', 'auth.role.del', '1', '3', '2019-07-10 17:57:34'), ('13', '查看权限', 'auth.rule.view', '1', '4', '2019-07-10 17:57:58'), ('14', '增加权限', 'auth.rule.add', '1', '4', '2019-07-10 17:58:17'), ('15', '修改权限', 'auth.rule.set', '1', '4', '2019-07-10 17:59:13'), ('16', '删除权限', 'auth.rule.del', '1', '4', '2019-07-10 17:59:26');

CREATE TABLE if not exists `admin_log` (
	`id` int(10) unsigned not null auto_increment,
	`url` varchar(50) not null DEFAULT '' comment '操作url',
	`data` text comment '信息',
	`uid` int(10) comment '操作人',
	`created_at` timestamp default current_timestamp,
	PRIMARY KEY(`id`)
) engine=MyISAM default CHARSET=utf8mb4 comment='操作记录表';


CREATE TABLE if not exists `admin_login_log`(
	`id` int(10) unsigned not null auto_increment,
	`uname` varchar(20) comment '登录人',
	`status` tinyint(1) default '0' comment '是否登录 1 登录成功，0失败',
	`created_at` timestamp default current_timestamp,
	PRIMARY KEY(`id`)
)engine=MyISAM default CHARSET=utf8mb4 comment='登录日志记录表';