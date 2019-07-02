# 后台管理员
create table if not exists `admin_auth` (
	`id` int(10) unsigned not null AUTO_INCREMENT,
	`uname` varchar(200) not null comment '用户名',
	`pwd` text not null comment '密码',
	`encry` char(6) not null comment '加密串',
	`role_id` int(10) unsigned not null comment '组id',
	`logind_at`  datetime comment '最近登陆时间',
	`created_at` timestamp null default current_timestamp,
	`status` tinyint(1) default 1 comment '状态 0 启用 1禁用 ',
  	`deleted` tinyint(1) default 0 ,
	PRIMARY key(`id`)
) engine=InnoDB default CHARSET=utf8mb4 COMMENT='后台管理员';

# 组
create table if not exists `admin_role` (
	`id` int(10) unsigned not null AUTO_INCREMENT,
	`name` varchar(50) not null comment '组名',
	`detail` varchar(200) not null comment '简单描述',
	`rules` text  comment '权限列表',
	`created_at` timestamp null default current_timestamp,
	PRIMARY key(`id`)
) engine =InnoDB default charset=utf8mb4 comment= '组名';

# 权限
CREATE TABLE if not exists `admin_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '权限点',
  `title` varchar(128) NOT NULL DEFAULT '' COMMENT '名称',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1 启用; 0 禁用',
  `menu` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1 作为菜单显示; 0 不显示',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `deleted` tinyint(1) DEFAULT '0' COMMENT '是否删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='权限点和菜单列表';
