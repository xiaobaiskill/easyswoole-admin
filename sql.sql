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