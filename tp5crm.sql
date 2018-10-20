/*
 Navicat MySQL Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : tp5crm

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 20/10/2018 10:51:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for crm_client
-- ----------------------------
DROP TABLE IF EXISTS `crm_client`;
CREATE TABLE `crm_client`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `company` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '公司名称',
  `name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '联系人',
  `tel` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '移动电话',
  `source` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '客户来源',
  `enter` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '录入员',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_client
-- ----------------------------
INSERT INTO `crm_client` VALUES (1, '网易科技', '丁磊', '13989454854', '广告营销', '李炎恢', '2016-10-04 18:07:32');
INSERT INTO `crm_client` VALUES (2, '阿里巴巴', '马云', '15854694534', '电话营销', '李炎恢', '2016-10-04 18:08:18');
INSERT INTO `crm_client` VALUES (3, '腾讯科技', '马化腾', '15834834343', '主动联系', '李炎恢', '2016-10-04 18:08:43');

-- ----------------------------
-- Table structure for crm_documentary
-- ----------------------------
DROP TABLE IF EXISTS `crm_documentary`;
CREATE TABLE `crm_documentary`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `sn` char(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '跟单编号',
  `title` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '跟单的标题',
  `client_id` mediumint(8) UNSIGNED NOT NULL COMMENT '公司id',
  `client_company` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '公司名称',
  `staff_id` mediumint(8) UNSIGNED NOT NULL COMMENT '跟单员id',
  `staff_name` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '跟单员',
  `way` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '跟单方式',
  `evolve` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '进展阶段',
  `remark` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '简要详情',
  `enter` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '录入员',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_documentary
-- ----------------------------
INSERT INTO `crm_documentary` VALUES (1, '20160404102659', '关于腾讯科技办公用品采购方案', 3, '腾讯科技', 1, '王大锤', '	\r\n电话沟通', '已成交', '努力拿下了~', '录入员', '2016-11-16 15:36:22');
INSERT INTO `crm_documentary` VALUES (3, '20161122211932', '关于默认公司办公用品采购方案', 1, '默认公司', 1, '默认跟单员', '电话沟通', '谈判中', '谈判中的方案...', 'admin', '2016-11-22 21:19:32');
INSERT INTO `crm_documentary` VALUES (6, '20161124095826', '关于阿里巴巴办公采购案', 2, '阿里巴巴', 2, '赵晓丽', '上门拜访', '已成交', '谈的还不错...', 'admin', '2016-11-24 09:58:26');
INSERT INTO `crm_documentary` VALUES (12, '20180926152902', 'test02', 3, '腾讯科技', 11, 'yang学习', '电话沟通', '谈判中', '111111x', 'admin', '2018-09-26 15:29:02');

-- ----------------------------
-- Table structure for crm_inform
-- ----------------------------
DROP TABLE IF EXISTS `crm_inform`;
CREATE TABLE `crm_inform`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '通知标题',
  `details` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '通知内容',
  `staff_id` mediumint(8) UNSIGNED NOT NULL COMMENT '发布者ID',
  `staff_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '发布者',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_inform
-- ----------------------------
INSERT INTO `crm_inform` VALUES (3, '关于国庆放假通知。。。', '<p>关于国庆放假通知。。。关于国庆放假通知。。。关于国庆放假通知。。。关于国庆放假通知。。。关于国庆放假通知。。。</p>', 18, '阳毅', '2018-10-16 15:35:28');

-- ----------------------------
-- Table structure for crm_inlib
-- ----------------------------
DROP TABLE IF EXISTS `crm_inlib`;
CREATE TABLE `crm_inlib`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `product_id` mediumint(8) UNSIGNED NOT NULL COMMENT '产品ID',
  `number` mediumint(8) UNSIGNED NOT NULL COMMENT '入库的数量',
  `staff_name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '经办人',
  `mode` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '入库方式',
  `mode_explain` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '入库方式说明',
  `enter` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '录入员',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_inlib
-- ----------------------------
INSERT INTO `crm_inlib` VALUES (23, 13, 1212, 'yang学习', '采购', '1111221121', 'admin', '2018-09-24 17:59:50');
INSERT INTO `crm_inlib` VALUES (24, 14, 2121, 'yang学习', '退货', '222222', 'admin', '2018-09-24 18:00:25');
INSERT INTO `crm_inlib` VALUES (25, 14, 11111, 'yang学习', '退货', '22222222222', 'admin', '2018-09-24 18:02:00');
INSERT INTO `crm_inlib` VALUES (26, 14, 222, 'yang学习', '采购', '2222222', 'admin', '2018-09-24 18:03:22');
INSERT INTO `crm_inlib` VALUES (28, 14, 21, 'yang学习', '退货', '2121', 'admin', '2018-09-24 18:33:10');
INSERT INTO `crm_inlib` VALUES (29, 13, 12, 'yang学习', '采购', '111', 'admin', '2018-10-12 21:13:43');
INSERT INTO `crm_inlib` VALUES (30, 14, 23, 'yang学习', '采购', '212', '阳毅', '2018-10-12 21:19:26');

-- ----------------------------
-- Table structure for crm_letter
-- ----------------------------
DROP TABLE IF EXISTS `crm_letter`;
CREATE TABLE `crm_letter`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '私信内容',
  `staff_id` mediumint(8) UNSIGNED NOT NULL COMMENT '收件人的ID',
  `staff_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收件人的名称',
  `send_id` mediumint(8) UNSIGNED NOT NULL COMMENT '发件人的ID',
  `send_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '发件人的名称',
  `isread` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '是否已读',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_letter
-- ----------------------------
INSERT INTO `crm_letter` VALUES (3, '<p>测试一下<br/></p>', 11, 'yang学习', 18, '阳毅', '未读', '2018-10-16 20:30:29');
INSERT INTO `crm_letter` VALUES (4, '<p>我再来测试一下<br/></p>', 11, 'yang学习', 18, '阳毅', '未读', '2018-10-16 20:58:18');

-- ----------------------------
-- Table structure for crm_log
-- ----------------------------
DROP TABLE IF EXISTS `crm_log`;
CREATE TABLE `crm_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `user` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '登录名+真实姓名',
  `type` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作名称',
  `type_name` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作名称',
  `module` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '操作模块',
  `ip` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'IP',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 69 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of crm_log
-- ----------------------------
INSERT INTO `crm_log` VALUES (62, 'admin(阳毅)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-17 12:56:57');
INSERT INTO `crm_log` VALUES (60, 'admin01(yang学习)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-17 09:46:06');
INSERT INTO `crm_log` VALUES (61, 'admin01(yang学习)', '登录系统', 'save', '人事管理 >> 新增职位', '::1', '2018-10-17 09:50:13');
INSERT INTO `crm_log` VALUES (63, 'admin(阳毅)', '登录系统', 'save', '人事管理 >> 新增职位', '::1', '2018-10-17 12:57:17');
INSERT INTO `crm_log` VALUES (64, 'admin(阳毅)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-18 19:26:03');
INSERT INTO `crm_log` VALUES (65, 'admin(阳毅)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-19 14:06:33');
INSERT INTO `crm_log` VALUES (66, 'admin(阳毅)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-19 14:08:31');
INSERT INTO `crm_log` VALUES (67, 'admin(阳毅)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-20 08:39:42');
INSERT INTO `crm_log` VALUES (68, 'admin01(yang学习)', '登录系统', 'check_login', '人事管理 >> 登录帐号', '::1', '2018-10-20 10:02:05');

-- ----------------------------
-- Table structure for crm_migrations
-- ----------------------------
DROP TABLE IF EXISTS `crm_migrations`;
CREATE TABLE `crm_migrations`  (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `start_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_migrations
-- ----------------------------
INSERT INTO `crm_migrations` VALUES (20170822041240, 'Rbac', '2018-10-17 12:45:24', '2018-10-17 12:45:25', 0);

-- ----------------------------
-- Table structure for crm_order
-- ----------------------------
DROP TABLE IF EXISTS `crm_order`;
CREATE TABLE `crm_order`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `sn` char(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单编号',
  `title` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单标题',
  `documentary_id` mediumint(8) UNSIGNED NOT NULL COMMENT '跟单ID',
  `original` decimal(10, 2) UNSIGNED NOT NULL COMMENT '原价',
  `cost` decimal(10, 2) UNSIGNED NULL DEFAULT NULL COMMENT '现价',
  `pay_state` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付状态',
  `enter` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '录入员',
  `create_time` datetime(0) NOT NULL COMMENT '创建的时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_order
-- ----------------------------
INSERT INTO `crm_order` VALUES (17, '20181008171532', 'test01', 12, 1111.00, 344.00, '已支付', 'admin', '2018-10-08 17:15:32');
INSERT INTO `crm_order` VALUES (19, '20181009145510', 'test', 3, 11.00, 3131.00, '未支付', 'admin', '2018-10-09 14:55:10');
INSERT INTO `crm_order` VALUES (20, '20181009153542', 'test03', 12, 100.00, 3313.00, '未支付', 'admin', '2018-10-09 15:35:42');
INSERT INTO `crm_order` VALUES (21, '20181009154201', 'test05', 12, 333.00, 212.00, '已支付', 'admin', '2018-10-09 15:42:01');
INSERT INTO `crm_order` VALUES (22, '20181009155922', 'test06', 12, 212.00, 65751.00, '未支付', 'admin', '2018-10-09 15:59:22');

-- ----------------------------
-- Table structure for crm_order_extend
-- ----------------------------
DROP TABLE IF EXISTS `crm_order_extend`;
CREATE TABLE `crm_order_extend`  (
  `order_id` mediumint(8) UNSIGNED NULL DEFAULT NULL COMMENT '订单的ID',
  `details` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '订单的详情'
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_order_extend
-- ----------------------------
INSERT INTO `crm_order_extend` VALUES (17, '11111');
INSERT INTO `crm_order_extend` VALUES (19, '111111111');
INSERT INTO `crm_order_extend` VALUES (20, 'wwww');
INSERT INTO `crm_order_extend` VALUES (21, 'xxxxxxxx');
INSERT INTO `crm_order_extend` VALUES (22, '33333333');

-- ----------------------------
-- Table structure for crm_outlib
-- ----------------------------
DROP TABLE IF EXISTS `crm_outlib`;
CREATE TABLE `crm_outlib`  (
  `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `product_id` mediumint(10) UNSIGNED NOT NULL COMMENT '关联产品ID',
  `order_sn` char(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单号',
  `number` smallint(5) UNSIGNED NOT NULL COMMENT '产品数量',
  `state` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '出库的状态',
  `clerk` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '配货出货的仓管员',
  `enter` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '下单员',
  `dispose_time` datetime(0) NULL DEFAULT NULL COMMENT '出库时间',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_outlib
-- ----------------------------
INSERT INTO `crm_outlib` VALUES (24, 12, '20181008171532', 21, '已收款', 'admin', 'admin', '2018-10-11 16:12:35', '2018-10-08 17:15:32');
INSERT INTO `crm_outlib` VALUES (25, 13, '20181008171532', 11, '已收款', 'admin', 'admin', '2018-10-11 16:12:35', '2018-10-08 17:15:32');
INSERT INTO `crm_outlib` VALUES (27, 12, '20181009145510', 1, '未处理', '', 'admin', NULL, '2018-10-09 14:55:10');
INSERT INTO `crm_outlib` VALUES (28, 14, '20181009153542', 20, '未处理', '', 'admin', NULL, '2018-10-09 15:35:42');
INSERT INTO `crm_outlib` VALUES (29, 12, '20181009154201', 21, '已出货', 'admin', 'admin', '2018-10-11 16:12:35', '2018-10-09 15:42:01');
INSERT INTO `crm_outlib` VALUES (30, 12, '20181009155922', 31, '未处理', '', 'admin', NULL, '2018-10-09 15:59:22');

-- ----------------------------
-- Table structure for crm_permission
-- ----------------------------
DROP TABLE IF EXISTS `crm_permission`;
CREATE TABLE `crm_permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限名称',
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限路径',
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限描述',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '权限状态',
  `create_time` int(10) NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_permission
-- ----------------------------
INSERT INTO `crm_permission` VALUES (5, '职位部门管理', '/index/post/index', '职位部门增删改的管理...', 1, 1539866391);
INSERT INTO `crm_permission` VALUES (6, '员工档案管理', '/index/staff/index', '员工档案增删改的管理...', 1, 1539867430);
INSERT INTO `crm_permission` VALUES (7, '登录账号管理', '/index/user/index', '登录账号增删改的管理...', 1, 1539867515);
INSERT INTO `crm_permission` VALUES (8, '工作计划管理', '/index/work/index', '工作计划管理...', 1, 1539868729);
INSERT INTO `crm_permission` VALUES (9, '分配任务管理', '/index/allo/index', '分配任务管理...', 1, 1539868754);
INSERT INTO `crm_permission` VALUES (10, '通知管理管理', '/index/inform/index', '通知管理管理...', 1, 1539868775);
INSERT INTO `crm_permission` VALUES (11, '私信收发管理', '/index/letter/index', '私信收发管理...', 1, 1539868799);
INSERT INTO `crm_permission` VALUES (12, '客户信息管理', '/index/client/index', '客户信息管理...', 1, 1539868827);
INSERT INTO `crm_permission` VALUES (13, '跟单记录管理', '/index/documentary/index', '跟单记录管理...', 1, 1539868855);
INSERT INTO `crm_permission` VALUES (14, '销售订单管理', '/index/order/index', '销售订单管理...', 1, 1539868880);
INSERT INTO `crm_permission` VALUES (15, '产品信息管理', '/index/product/index', '产品信息管理...', 1, 1539868916);
INSERT INTO `crm_permission` VALUES (16, '入库记录管理', '/index/inlib/index', '入库记录管理...', 1, 1539868936);
INSERT INTO `crm_permission` VALUES (17, '出库记录管理', '/index/outlib/index', '出库记录管理...', 1, 1539868960);
INSERT INTO `crm_permission` VALUES (18, '库存警报管理', '/index/alarm/index', '库存警报管理...', 1, 1539868983);
INSERT INTO `crm_permission` VALUES (19, '采购记录管理', '/index/procure/index', '采购记录管理...', 1, 1539869007);
INSERT INTO `crm_permission` VALUES (20, '收款记录管理', '/index/receipt/index', '收款记录管理...', 1, 1539869145);
INSERT INTO `crm_permission` VALUES (21, '支出记录管理', '/index/payment/index', '支出记录管理...', 1, 1539869183);
INSERT INTO `crm_permission` VALUES (22, '操作日志管理', '/index/log/index', '操作日志管理...', 1, 1539869242);

-- ----------------------------
-- Table structure for crm_post
-- ----------------------------
DROP TABLE IF EXISTS `crm_post`;
CREATE TABLE `crm_post`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//自动编号',
  `name` char(10) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `create_time` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 62 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of crm_post
-- ----------------------------
INSERT INTO `crm_post` VALUES (1, '总经理', '2018-09-10 14:53:34');
INSERT INTO `crm_post` VALUES (2, '销售', '2018-09-10 14:53:49');
INSERT INTO `crm_post` VALUES (3, '财务', '2018-09-10 14:54:04');
INSERT INTO `crm_post` VALUES (4, '技术总监', '2018-09-11 20:12:21');
INSERT INTO `crm_post` VALUES (5, '项目经理', '2018-09-11 20:16:06');

-- ----------------------------
-- Table structure for crm_product
-- ----------------------------
DROP TABLE IF EXISTS `crm_product`;
CREATE TABLE `crm_product`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `sn` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '产品编号',
  `name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '产品名称',
  `type` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '产品类型',
  `pro_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '采购价格',
  `sell_price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '销售价格',
  `unit` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '计量单位',
  `inventory` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存量',
  `inventory_in` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '出库总量',
  `inventory_out` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '出库总量',
  `inventory_alarm` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存警报量',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_product
-- ----------------------------
INSERT INTO `crm_product` VALUES (12, '21213', '444', '办公耗材', 12.00, 2121.00, '个', 2118, 2121, 53, 21, '2018-09-22 11:01:30');
INSERT INTO `crm_product` VALUES (13, '21231', '555zx1', '办公耗材', 21213.00, 21213.00, '个', 112, 112, 0, 10, '2018-09-22 11:05:03');
INSERT INTO `crm_product` VALUES (14, '12134', '2121', '办公耗材', 123.00, 222.00, '个', 22062, 21982, 20, 221, '2018-09-22 18:02:39');

-- ----------------------------
-- Table structure for crm_product_extend
-- ----------------------------
DROP TABLE IF EXISTS `crm_product_extend`;
CREATE TABLE `crm_product_extend`  (
  `product_id` mediumint(8) UNSIGNED NOT NULL COMMENT '产品ID',
  `details` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '产品详情'
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_product_extend
-- ----------------------------
INSERT INTO `crm_product_extend` VALUES (14, '<p>22222222222222<br/></p>');
INSERT INTO `crm_product_extend` VALUES (12, '<p>22222222222222<br/></p>');
INSERT INTO `crm_product_extend` VALUES (13, '<p>22222222222222xx11111111111<br/></p>');

-- ----------------------------
-- Table structure for crm_receipt
-- ----------------------------
DROP TABLE IF EXISTS `crm_receipt`;
CREATE TABLE `crm_receipt`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `title` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收款标题',
  `order_sn` char(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单号',
  `cost` decimal(10, 2) UNSIGNED NOT NULL COMMENT '收款金额',
  `enter` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '录入员',
  `remark` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '简易备注',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_receipt
-- ----------------------------
INSERT INTO `crm_receipt` VALUES (6, 'test01收款', '20181008171532', 1111.00, 'admin', 'test01  ok....', '2018-10-10 15:32:52');
INSERT INTO `crm_receipt` VALUES (7, 'test03收款...', '20181009154201', 222.00, 'admin', 'test....', '2018-10-10 15:47:51');
INSERT INTO `crm_receipt` VALUES (8, 'test000', '20181008171532', 111.00, 'admin', '222222', '2018-10-12 21:11:51');

-- ----------------------------
-- Table structure for crm_role
-- ----------------------------
DROP TABLE IF EXISTS `crm_role`;
CREATE TABLE `crm_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父角色id',
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '角色状态',
  `sort_num` int(11) NOT NULL DEFAULT 0 COMMENT '排序值',
  `left_key` int(11) NOT NULL DEFAULT 0 COMMENT '用来组织关系的左值',
  `right_key` int(11) NOT NULL DEFAULT 0 COMMENT '用来组织关系的右值',
  `level` int(11) NOT NULL DEFAULT 0 COMMENT '所处层级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for crm_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `crm_role_permission`;
CREATE TABLE `crm_role_permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '角色Id',
  `permission_id` int(11) NOT NULL DEFAULT 0 COMMENT '权限ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 155 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色权限对应表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_role_permission
-- ----------------------------
INSERT INTO `crm_role_permission` VALUES (115, 7, 22);
INSERT INTO `crm_role_permission` VALUES (116, 7, 21);
INSERT INTO `crm_role_permission` VALUES (117, 7, 20);
INSERT INTO `crm_role_permission` VALUES (118, 7, 19);
INSERT INTO `crm_role_permission` VALUES (119, 7, 18);
INSERT INTO `crm_role_permission` VALUES (120, 7, 17);
INSERT INTO `crm_role_permission` VALUES (121, 7, 16);
INSERT INTO `crm_role_permission` VALUES (122, 7, 15);
INSERT INTO `crm_role_permission` VALUES (123, 7, 14);
INSERT INTO `crm_role_permission` VALUES (124, 7, 13);
INSERT INTO `crm_role_permission` VALUES (125, 7, 12);
INSERT INTO `crm_role_permission` VALUES (126, 7, 11);
INSERT INTO `crm_role_permission` VALUES (127, 7, 10);
INSERT INTO `crm_role_permission` VALUES (128, 7, 9);
INSERT INTO `crm_role_permission` VALUES (129, 7, 8);
INSERT INTO `crm_role_permission` VALUES (130, 7, 7);
INSERT INTO `crm_role_permission` VALUES (131, 7, 6);
INSERT INTO `crm_role_permission` VALUES (132, 7, 5);
INSERT INTO `crm_role_permission` VALUES (152, 15, 22);
INSERT INTO `crm_role_permission` VALUES (153, 15, 19);

-- ----------------------------
-- Table structure for crm_staff
-- ----------------------------
DROP TABLE IF EXISTS `crm_staff`;
CREATE TABLE `crm_staff`  (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键、自动编号',
  `user_id` int(8) NULL DEFAULT 0,
  `name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '员工真实姓名',
  `number` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '员工编号，从 1001 开',
  `gender` char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '员工性别',
  `post` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 职位名称',
  `type` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 员工类型 ',
  `id_card` char(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '员工身份证 ',
  `tel` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '员工手机号码 ',
  `nation` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '员工民族 ',
  `marital_status` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '婚姻状况',
  `entry_status` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '在职状况',
  `entry_date` date NULL DEFAULT NULL COMMENT '入职时间',
  `dimission_date` date NULL DEFAULT NULL COMMENT ' 离职时间',
  `politics_statu` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 政治面貌',
  `education` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 学历',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT ' 创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of crm_staff
-- ----------------------------
INSERT INTO `crm_staff` VALUES (11, 27, 'yang学习', '1121', '女', '财务', '合同员工', '212121212121', '21212121', '12', '离异', '调休', '2018-09-18', '2018-09-18', '团员', '大专', '2018-09-18 15:50:18');
INSERT INTO `crm_staff` VALUES (18, 3, '阳毅', '2122', '男', '财务', '临时员工', '21212121', '2121', '21', '离异', '调休', '2018-09-04', '2018-09-22', '团员', '本科', '2018-09-22 10:36:08');

-- ----------------------------
-- Table structure for crm_staff_extend
-- ----------------------------
DROP TABLE IF EXISTS `crm_staff_extend`;
CREATE TABLE `crm_staff_extend`  (
  `staff_id` int(8) NULL DEFAULT NULL COMMENT '关联主表 id',
  `health` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '健康状况',
  `specialty` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '专业 ',
  `registered` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 户口类型 ',
  `registered_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '户口所在地 ',
  `graduate_date` date NULL DEFAULT NULL COMMENT ' 毕业时间 ',
  `graduate_college` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 毕业院校 ',
  `intro` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT ' 简介 ',
  `datails` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT ' 备注详情\r\n 备注详情'
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_staff_extend
-- ----------------------------
INSERT INTO `crm_staff_extend` VALUES (11, '11112121', '12121', '本地农村户口', '212121', '2018-09-18', '22222222', '22222222222222222221', '<p>1111111111111111111111111111xxxx<br/></p>');
INSERT INTO `crm_staff_extend` VALUES (18, '2121', '21', '本地农村户口', '2121', '2018-09-22', '2121', '2121', '<p>212121<br/></p>');

-- ----------------------------
-- Table structure for crm_user
-- ----------------------------
DROP TABLE IF EXISTS `crm_user`;
CREATE TABLE `crm_user`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accounts` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_login_time` datetime(0) NULL DEFAULT NULL,
  `login_count` int(10) UNSIGNED NULL DEFAULT 0,
  `last_login_ip` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `state` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `staff_name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int(1) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of crm_user
-- ----------------------------
INSERT INTO `crm_user` VALUES (27, 'admin01', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2018-10-16 14:23:36', 0, '::1', '正常', '2018-10-16 14:23:36', 'yang学习', 1);
INSERT INTO `crm_user` VALUES (3, 'admin', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', '2018-09-14 14:47:56', 0, '::1', '正常', '2018-09-14 14:47:56', 'test1', 1);
INSERT INTO `crm_user` VALUES (28, 'test-rbac', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2018-10-17 12:39:20', 0, '::1', '正常', '2018-10-17 12:39:20', '', 1);

-- ----------------------------
-- Table structure for crm_user_role
-- ----------------------------
DROP TABLE IF EXISTS `crm_user_role`;
CREATE TABLE `crm_user_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '角色id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色对应关系' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_user_role
-- ----------------------------
INSERT INTO `crm_user_role` VALUES (1, 27, 7);
INSERT INTO `crm_user_role` VALUES (2, 28, 15);

-- ----------------------------
-- Table structure for crm_work
-- ----------------------------
DROP TABLE IF EXISTS `crm_work`;
CREATE TABLE `crm_work`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自动编号',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工作计划名称',
  `type` char(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '工作类型',
  `stage` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '当前进度名称',
  `state` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '当前状态',
  `start_date` date NOT NULL COMMENT '开始时间',
  `end_date` date NOT NULL COMMENT '结束时间',
  `staff_id` mediumint(8) UNSIGNED NOT NULL COMMENT '员工的ID',
  `staff_name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '实行人',
  `allo_id` mediumint(8) UNSIGNED NOT NULL COMMENT '发起人的ID',
  `allo_name` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '发起人',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_work
-- ----------------------------
INSERT INTO `crm_work` VALUES (15, 'test', '业务', 'test04...', '已完成', '2018-10-05', '2018-10-20', 3, '阳毅', 3, '阳毅', '2018-10-12 15:45:36');
INSERT INTO `crm_work` VALUES (16, '分配test01', '业务', '创建工作计划', '进行中', '2018-10-05', '2018-10-13', 27, 'yang学习', 27, 'yang学习', '2018-10-16 14:58:18');
INSERT INTO `crm_work` VALUES (17, '分配test02', '业务', '创建工作计划', '进行中', '2018-10-05', '2018-10-13', 3, '阳毅', 27, 'yang学习', '2018-10-16 14:59:45');
INSERT INTO `crm_work` VALUES (18, '分配test03', '内勤', '创建工作计划', '进行中', '2018-10-04', '2018-10-13', 27, 'yang学习', 3, '阳毅', '2018-10-16 15:04:05');
INSERT INTO `crm_work` VALUES (19, '分配test04', '内勤', 'test', '进行中', '2018-10-04', '2018-10-13', 3, '阳毅', 27, 'yang学习', '2018-10-16 15:04:19');

-- ----------------------------
-- Table structure for crm_work_stage
-- ----------------------------
DROP TABLE IF EXISTS `crm_work_stage`;
CREATE TABLE `crm_work_stage`  (
  `work_id` mediumint(8) UNSIGNED NOT NULL COMMENT '关联工作计划的ID',
  `title` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '每个阶段的名称',
  `create_time` datetime(0) NOT NULL COMMENT '创建时间'
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of crm_work_stage
-- ----------------------------
INSERT INTO `crm_work_stage` VALUES (15, '创建工作任务', '2018-10-12 15:45:36');
INSERT INTO `crm_work_stage` VALUES (15, 'test01', '2018-10-16 19:27:13');
INSERT INTO `crm_work_stage` VALUES (15, 'test02', '2018-10-15 19:59:15');
INSERT INTO `crm_work_stage` VALUES (15, 'test03...', '2018-10-15 21:22:59');
INSERT INTO `crm_work_stage` VALUES (15, 'test04...', '2018-10-15 21:27:11');
INSERT INTO `crm_work_stage` VALUES (16, '创建工作任务', '2018-10-16 14:58:18');
INSERT INTO `crm_work_stage` VALUES (17, '创建工作任务', '2018-10-16 14:59:45');
INSERT INTO `crm_work_stage` VALUES (18, '创建工作任务', '2018-10-16 15:04:05');
INSERT INTO `crm_work_stage` VALUES (19, '创建工作任务', '2018-10-16 15:04:19');
INSERT INTO `crm_work_stage` VALUES (19, 'test', '2018-10-16 15:07:50');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父角色id',
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '角色状态',
  `sort_num` int(11) NOT NULL DEFAULT 0 COMMENT '排序值',
  `left_key` int(11) NOT NULL DEFAULT 0 COMMENT '用来组织关系的左值',
  `right_key` int(11) NOT NULL DEFAULT 0 COMMENT '用来组织关系的右值',
  `level` int(11) NOT NULL DEFAULT 0 COMMENT '所处层级',
  `key` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (7, '超级管理员', 0, '我拥有所有权限...', 1, 7, 17, 18, 1, 1);
INSERT INTO `role` VALUES (15, '普通管理员', 0, '我拥有一些权限', 1, 15, 1, 2, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
