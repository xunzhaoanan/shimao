<?php
/**
 * Author: MaChenghang
 * Date: 2015/10/22
 * Time: 22:08
 */

namespace common\helpers;

class BaseApiUrlHelper
{
    public static $keyArray = [


        #   通用接口  ------------------------------------------------------------------------------------------------------------------------------
        'common-province-list' => '/common/find-province-list',
        'common-city-list' => '/common/find-province-city-list',
        'common-district-list' => '/common/find-city-district-list',
        'common-circle-list' => '/common/find-circle-list',
        'common-area-name' => '/common/get-area-by-id',
        'common-area-list' => '/common/find-area-list',
        ## 会员 ##
        'member-find-member-cost-section-data' => '/member/find-member-data-cost-section',
        'member-find-member-cost-count-data' => '/member/find-member-data-cost-count',
        'member-find-member-count-data' => '/member/find-member-data-count',
        'member-find-member-card-data' => '/member/find-member-data-card',
        'member-get-shop-member-setting' => '/member/get-shop-member-setting',
        'member-update-shop-member-setting' => '/member/update-shop-member-setting',
        'member-sync-wx-card' => '/member/sync-wx-card',
        'member-get-growth-setting' => '/member/get-member-growth-setting',
        'member-update-growth-setting' => '/member/update-member-growth-setting',
        'member-find-card-shopsub' => '/member/find-card-shopsub',
        'member-send-mobile-code' => '/member/send-mobile-code',
        'member-get-last-count' => '/member/get-last-count',
        'member-init-card' => '/member/init-member-card',
        'member-get-card' => '/member/get-member-card',
        'member-get-wxcard' => '/member/get-wx-card',
        'member-access-card' => '/member/access-member-card',
        'member-update-card-share-message' => '/member/update-member-card-share-message',
        'member-update-card' => '/member/update-member-card',
        'member-sync-card' => '/member/member-card-sync-wx',
        'member-get-card-activate' => '/member/get-member-card-activate-setting',
        'member-update-card-activate' => '/member/update-member-card-activate-setting',
        'member-update-card-examine' => '/member/update-member-card-examine',
        'member-get-tag' => '/member/get-member-tag',
        'member-create-console-data' => '/member/create-console-data',
        'member-update-member' => '/member/update-member',
        'member-activate-member' => '/member/activate-member',
        'member-get-member-tag' => '/member/get-member-tag-relation',
        'member-update-tag' => '/member/update-member-tag',
        'member-find-tag' => '/member/find-member-tag',
        'member-find-all-tag' => '/member/find-all-member-tag',
        'member-delete-tag' => '/member/delete-member-tag',
        'member-create-tag' => '/member/create-member-tag',
        'member-get-group' => '/member/get-member-group',
        'member-init-group' => '/member/init-member-group',
        'member-update-group' => '/member/update-member-group',
        'member-find-group' => '/member/find-member-group',
        'member-find-all-group' => '/member/find-all-member-group',
        'member-delete-group' => '/member/delete-member-group',
        'member-create-group' => '/member/create-member-group',
        'member-get-grade' => '/member/get-member-grade',
        'member-init-grade' => '/member/init-member-grade',
        'member-init-growth' => '/member/init-member-growth',
        'member-init-notice' => '/member/init-member-notice',
        'member-init-discount' => '/member/init-member-discount',
        'member-init-gift' => '/member/init-member-gift',
        'member-update-grade' => '/member/update-member-grade',
        'member-find-grade' => '/member/find-member-grade',
        'member-delete-grade' => '/member/delete-member-grade',
        'member-create-grade' => '/member/create-member-grade',
        'member-find-member' => '/member/find-member',
        'member-get-member' => '/member/get-member',
        'member-update-user' => '/wxuser/update-wx-user',
        'member-sync-member-data-to-wx' => '/member/sync-data-to-wx',
        'member/create-member-discounted-product' => '/member/create-member-discounted-product',
        'member/find-member-discounted-product' => '/member/find-member-discounted-product',
        'statistics/statistics-user-by-should-pay' => '/statistics/statistics-user-by-should-pay',
        'statistics/statistics-user-by-order-count' => '/statistics/statistics-user-by-order-count',

        ## 二维码策略 ##
        'employesscode-open' => '/qrcode-policy/enable',
        'employesscode-close' => '/qrcode-policy/disable',
        'employesscode-create' => '/qrcode-policy/create',
        'employesscode-update' => '/qrcode-policy/to-update',
        'employesscode-delete' => '/qrcode-policy/del',
        'employesscode-get' => '/qrcode-policy/get',
        'employesscode-find' => '/qrcode-policy/find',
        'employesscode-find-policy-staff' => '/qrcode-policy/find-policy-staff',
        'employesscode-find-policy-shopsub' => '/qrcode-policy/find-policy-shopsub',

        ## 自定义页面 ##
        'custompage-category-list' => '/custompage/find-category',
        'custompage-category-update' => '/custompage/update-category',
        'custompage-category-delete' => '/custompage/delete-category',
        'custompage-category-create' => '/custompage/create-category',
        'custompage-sethome' => '/custompage/sethome',
        'custompage-setmall' => '/custompage/setmall',
        'custompage-setmenu' => '/custompage/setmenu',
        'custompage-getmenu' => '/custompage/getmenu',
        'custompage-open' => '/custompage/enable',
        'custompage-close' => '/custompage/disable',
        'custompage-copy' => '/custompage/copy',
        'custompage-create' => '/custompage/create',
        'custompage-update' => '/custompage/to-update',
        'custompage-delete' => '/custompage/del',
        'custompage-get' => '/custompage/get',
        'custompage-find' => '/custompage/find',

        ## 代理商 ##
        'agent-create' => '/agent/create-agents-by-admin',
        'agent-list' => '/agent/find-list',
        'agent-list-all' => '/agent/find-all-list',
        'agent-list-belong' => '/agent/find-belong-list',
        'agent-get' => '/agent/get',
        'agent-update' => '/agent/to-update',
        'agent-pwd-update' => '/agent/update-pwd',
        'agent-pwd-manager-update' => '/agent/manager-update-pwd',
        'agent-order-by-agent' => '/statistics/order-list-by-agent',
        'agent-order-count' => '/statistics/order-count-by-agent',
        'agent-agent-count' => '/statistics/count-shop-agents', //统计下级代理商数量
        'agent-agent-count-list' => '/statistics/count-sub-agent', //代理商直属下级代理商数量总数（可统计多个代领商的下级代理商数）

        #   登陆接口  ------------------------------------------------------------------------------------------------------------------------------
        'agent-login' => '/agent/agent-login',
        'staff-login' => '/staff/shop-staff-login',
        'manager-login' => '/shop-manager/shop-manager-login',
        'qq-login' => '/shop-manager/default-manager-login',


        # 系统设置  ------------------------------------------------------------------------------------------------------------------------------
        ## 商家 ##
        'shop-get' => '/shop/get-shop',
        'shop-update' => '/shop/update-shop',
        'shop-setting-update' => '/shop/update-shop-setting',
        'shop-setting-data-test' => '/shop/shop-setting-data-test',
        'shop/create-shop-used-address' => '/shop/create-shop-used-address',
        'shop/find-shop-used-address-list' => '/shop/find-shop-used-address-list',
        'shop/update-shop-used-address' => '/shop/update-shop-used-address',
        'shop/create-shop-self-pickup-sub' => '/shop/create-shop-self-pickup-sub',
        'shop/del-shop-self-pickup-sub' => '/shop/del-shop-self-pickup-sub',
        'shop/find-shop-self-pickup-sub' => '/shop/find-shop-self-pickup-sub',
        'shop/find-all-shop-self-pickup-sub' => '/shop/find-all-shop-self-pickup-sub',
        'shop/find-all-shop' => '/shop/find-all-shop',

        #   终端店接口  ------------------------------------------------------------------------------------------------------------------------------
        'terminal-order' => '/statistics/order-statistics',
        'not-belong-terminal-order' => '/statistics/count-order-not-belong',
        'terminal-order-count' => '/statistics/order-count',
        'terminal-fx' => '/statistics/group-count-fx-order',
        'terminal-fx-detail' => '/statistics/fx-order-list-by-agent',
        'terminal-fx-count' => '/statistics/count-fx-order',
        'terminal-fx-member-count' => '/statistics/count-fx-member',
        'terminal-member' => '/statistics/group-count-wx-user',
        'terminal-member-detail' => '/wxuser/find-list-with-others',
        'terminal-member-count' => '/statistics/count-wx-user',
        'terminal-shop-sub-count' => '/statistics/count-shop-sub',
        'terminal-shop-sub-count-list' => '/statistics/count-sub-agent-shop-sub',

        ## 店铺 ##
        'terminal-list' => '/shop/find-shopsub-list',
        'terminal-setting-update' => '/shop/update-shopsub-setting',
        'terminal-list-belong' => '/shop/find-belong-shopsub-list',
        'terminal-create' => '/shop/create-shopsub',
        'terminal-get' => '/shop/get-shopsub',
        'terminal-add-scan-count' => '/shop/add-shopsub-scan-count',
        'terminal-update' => '/shop/update-shopsub',
        'terminal-del' => '/shop/del-shopsub',
        'terminal-update-ewm' => '/shop/update-shopsub-ewm',
        'terminal-nearest-list' => '/shop/find-nearest-shopsub-list', //获取最近的门店

        ##  第三方平台配置  ##
        'third-party-get' => '/third-party/get-config',
        'third-party-get-by-account' => '/third-party/get-config-byaccount',
        'third-party-update-wx' => '/third-party/update-wx-config',

        ##  支付配置  ##
        'payment-setting-get' => '/payment/get-pay-config',
        'payment-setting-update' => '/payment/update-pay-config',
        'payment-setting-list' => '/payment/find-paytype-list',
        'payment-setting-list-update' => '/payment/update-paytype-list',

        ## 店铺 ##
        'manager-list' => '/shop-manager/find-shop-manager',
        'manager-create' => '/shop-manager/create-shop-manager', //创建管理员
        'manager-get' => '/shop-manager/get-shop-manager',
        'manager-update' => '/shop-manager/update-shop-manager',
        'manager-del' => '/shop-manager/delete-shop-manager',
        'manager-update-manager-password' => '/shop-manager/update-password',

        ##  员工  ##
        'staff-list' => '/staff/find-shop-staff',
        'staff-list-belong' => '/staff/find-belong-shop-staff',
        'staff-create' => '/staff/create',
        'staff-update' => '/staff/to-update',
        'staff-pwd-update' => '/staff/update-pwd',
        'staff-pwd-manager-update' => '/staff/manager-update-pwd',
        'staff-add-scan-count' => '/staff/add-scan-count',
        'staff-get' => '/staff/get',
        'staff-open' => '/staff/open',
        'staff-close' => '/staff/close',
        'staff-del' => '/staff/del',
        'staff-disable' => '/staff/cancel-staff-user-bind',
        'staff-enable' => '/staff/bind-staff-user',
        'staff-find-to-fx-member' => '/fx/find-staff-to-member-list', //未成为分销员或需要调整归属的员工帐号列表

        ##  文件管理  ##
        'document-list' => '/document-lib/find-doc',
        'document-create' => '/document-lib/create-doc',
        'document-update' => '/document-lib/update-doc',
        'document-delete' => '/document-lib/delete-doc',
        'document-multi-delete' => '/document-lib/multi-delete-doc',
        'document-multi-update' => '/document-lib/multi-update-doc-category',
        'document-category-create' => '/document-lib/create-doc-category',
        'document-category-update' => '/document-lib/update-doc-category',
        'document-category-delete' => '/document-lib/delete-doc-category',
        'document-category-get' => '/document-lib/get-doc-category',
        'document-category-find' => '/document-lib/find-doc-category',

        ##  用户文件管理  ##
        'document-for-user-create' => '/document-lib-for-user/create-doc',

        ##  帮助  ##
        'notice-get' => '/bulletin/get-bulletin',
        'notice-find' => '/bulletin/find-bulletin',
        'help-get' => '/bulletin/get-faq-type',
        'help-faq-type-find' => '/bulletin/find-faq-type',//获取帮助类型列表
        'help-find' => '/bulletin/find-faq-type',
        'feedback-find' => '/bulletin/find-feedback',
        'feedback-type-find' => '/bulletin/find-feedback-type',//获取反馈类型列表
        'feedback-create' => '/bulletin/create-feedback',
        'feedback-get' => '/bulletin/get-feedback',

        #   微杂志开始  ------------------------------------------------------------------------------------------------------------------------------
        ## 杂志 ##
        'magazine-update-to-template' => '/magazine/update-to-template',
        'magazine-update-shopid' => '/magazine/update-shopid',
        'magazine-create' => '/magazine/create-magazine',
        'magazine-create-by-template' => '/magazine/create-magazine-by-template',
        'magazine-update' => '/magazine/update-magazine',
        'magazine-delete' => '/magazine/del-magazine',
        'magazine-open' => '/magazine/enable-magazine',
        'magazine-close' => '/magazine/disable-magazine',
        'magazine-get' => '/magazine/get-magazine',
        'magazine-find' => '/magazine/find-magazine',
        'magazine-pv' => '/magazine/add-magazine-pv',
        'magazine-copy' => '/magazine/copy-magazine',
        'magazine-copypage' => '/magazine/copy-page',
        'magazine-create-page' => '/magazine/create-single-magazine-info',
        'magazine-delete-page' => '/magazine/del-magazine-info',
        'magazine-create-form' => '/magazine/create-magazine-form',
        'magazine-find-form' => '/magazine/find-magazine-form',
        'magazine-get-form' => '/magazine/get-magazine-form',
        'magazine-update-form' => '/magazine/update-magazine-form',
        'magazine-delete-form' => '/magazine/del-magazine-form',
        'magazine-create-form-join' => '/magazine/create-magazine-form-join',
        'magazine-examine-form-join' => '/magazine/examine-magazine-form-join',
        'magazine-get-form-join' => '/magazine/get-magazine-form-join',
        'magazine-find-form-join' => '/magazine/find-magazine-form-join',
        'magazine-delete-form-join' => '/magazine/del-magazine-form-join',
        'magazine-create-category' => '/magazine/create-magazine-category',
        'magazine-update-category' => '/magazine/update-magazine-category',
        'magazine-find-category' => '/magazine/find-magazine-category',
        'magazine-delete-category' => '/magazine/del-magazine-category',
        'magazine-template-pv' => '/magazine/create-magazine-template-log',
        'magazine-get-template' => '/magazine/get-magazine-template',
        'magazine-find-template' => '/magazine/find-magazine-template',
        'magazine-find-template-category' => '/magazine/find-magazine-template-category',
        'magazine-get-template-page' => '/magazine/get-magazine-page',
        'magazine-find-template-page' => '/magazine/find-magazine-page',
        'magazine-find-template-page-category' => '/magazine/find-magazine-page-category',
        'magazine-find-template-tag' => '/magazine/find-magazine-template-tag',

        #   微信开始  ------------------------------------------------------------------------------------------------------------------------------
        ## 微信菜单 ##
        'wx-menu-create' => '/wx/create-menu',
        'wx-menu-batch-create' => '/wx/create-all-menu',
        'wx-menu-list' => '/wx/find-menu-list',
        'wx-menu-get' => '/wx/get-menu',
        'wx-menu-update' => '/wx/update-menu',
        'wx-menu-del' => '/wx/del-menu',
        'wx-menu-update-sort' => '/wx/update-menu-sort',
        'wx-menu-batch-update' => '/wx/batch-update-menu',

        ## 关键字回复 ##
        'wx-reply-keyword-create' => '/wx/create-keyword-reply',
        'wx-reply-keyword-list' => '/wx/find-keyword-reply-list',
        'wx-reply-keyword-get' => '/wx/get-keyword-reply',
        'wx-reply-keyword-update' => '/wx/update-keyword-reply',
        'wx-reply-keyword-del' => '/wx/del-keyword-reply',
        'wx-reply-keyword-open' => '/wx/open-keyword-reply',
        'wx-reply-keyword-close' => '/wx/close-keyword-reply',

        ## 关注时回复 ##
        'wx-reply-attention-create' => '/wx/create-attention-reply',
        'wx-reply-attention-get' => '/wx/get-attention-reply',
        'wx-reply-attention-update' => '/wx/update-attention-reply',
        'wx-reply-attention-open' => '/wx/open-attention-reply',
        'wx-reply-attention-close' => '/wx/close-attention-reply',

        ## 默认回复 ##
        'wx-reply-default-create' => '/wx/create-default-reply',
        'wx-reply-default-get' => '/wx/get-default-reply',
        'wx-reply-default-update' => '/wx/update-default-reply',
        'wx-reply-default-open' => '/wx/open-default-reply',
        'wx-reply-default-close' => '/wx/close-default-reply',

        ## 文本素材 ##
        'wx-material-text-create' => '/wx/create-text-material',
        'wx-material-text-list' => '/wx/find-text-material-list',
        'wx-material-text-get' => '/wx/get-text-material',
        'wx-material-text-update' => '/wx/update-text-material',
        'wx-material-text-del' => '/wx/del-text-material',

        ## 图片素材 ##
        'wx-material-image-create' => '/wx/create-image-material',
        'wx-material-image-list' => '/wx/find-image-material-list',
        'wx-material-image-get' => '/wx/get-image-material',
        'wx-material-image-update' => '/wx/update-image-material',
        'wx-material-image-update-by-media-id' => '/wx/update-image-material-by-media-id',
        'wx-material-image-del' => '/wx/del-image-material',

        ## 图文素材 ##
        'wx-material-news-create' => '/wx/create-news-material',
        'wx-material-news-list' => '/wx/find-news-material-list',
        'wx-material-news-list-new' => '/wx/find-news-material-list-new',
        'wx-material-news-get' => '/wx/get-news-material',
        'wx-material-news-get-new' => '/wx/get-news-material-new',
        'wx-material-news-update' => '/wx/update-news-material',
        'wx-material-news-del' => '/wx/del-news-material',

        ## 语音素材 ##
        'wx-material-voice-create' => '/wx/create-voice-material',
        'wx-material-voice-list' => '/wx/find-voice-material-list',
        'wx-material-voice-get' => '/wx/get-voice-material',
        'wx-material-voice-update' => '/wx/update-voice-material',
        'wx-material-voice-del' => '/wx/del-voice-material',

        ## 音乐素材 ##
        'wx-material-music-create' => '/wx/create-music-material',
        'wx-material-music-list' => '/wx/find-music-material-list',
        'wx-material-music-get' => '/wx/get-music-material',
        'wx-material-music-update' => '/wx/update-music-material',
        'wx-material-music-del' => '/wx/del-music-material',

        ## 视频素材 ##
        'wx-material-video-create' => '/wx/create-video-material',
        'wx-material-video-list' => '/wx/find-video-material-list',
        'wx-material-video-get' => '/wx/get-video-material',
        'wx-material-video-update' => '/wx/update-video-material',
        'wx-material-video-del' => '/wx/del-video-material',

        ## 微信用户消息 ##
        'wx-user-message-create' => '/wxuser/create-message',
        'wx-user-message-list' => '/wxuser/find-message-list',
        'wx-user-message-get' => '/wxuser/get-message',
        'wx-user-message-reply' => '/wxuser/reply-message',
        'wx-user-message-like' => '/wxuser/like-message',

        ## 微信用户 ##
        'wxuser-update-wx-user' => '/wxuser/update-wx-user',
        'wxuser-find-point-log-by-shop' => '/wxuser/find-point-log-by-shop',
        'wx-user-create' => '/wxuser/create',
        'wx-user-list' => '/wxuser/find-list',
        'wx-user-update-mid' => '/wxuser/update-mid',
        'wx-user-get' => '/wxuser/get',
        'wx-user-get-by-openid' => '/wxuser/get-by-open-id',
        'wx-user-update' => '/wxuser/to-update',
        'wx-user-update-belong' => '/wxuser/to-update-belong',
        'wx-user-login' => '/wxuser/update-login',
        'wx-user-group-create' => '/wxuser/create-category',
        'wx-user-group-get' => '/wxuser/get-category',
        'wx-user-group-list' => '/wxuser/find-category-list',
        'wx-user-group-update' => '/wxuser/update-category',
        'wx-user-attention' => '/wxuser/subscribe',
        'wx-user-attention-sync' => '/wxuser/subscribe-sync',
        'wx-user-unattention' => '/wxuser/cancel-subscribe',
        'wx-user-authorize' => '/wxuser/authorize',
        'wx-user-process-attribution' => '/wxuser/share',
        'user-redpack-get' => '/red-packet/get-user-red-packet',
        'user-redpack-find' => '/red-packet/find-user-red-packet',
        'user-collect-find' => '/collect/find-collect-join',
        'user-point-log-find' => '/wxuser/find-point-log',
        'wx-user-count' => '/wxuser/count-wx-member',
        'wx-user-increment' => '/wxuser/wx-member-increment',
        'wxuser/count-user-point' => '/wxuser/count-user-point',

        ## 微信小店 ##
        'wx-shop-category-find' => '/wx/find-category',
        'wx-shop-category-get' => '/wx/get-category',
        'wx-shop-sync-to-wx' => '/shop-setting/sync-shop-setting', //同步门店到微信
        'wx-shop-batch-sync-to-wx' => '/shop-setting/batch-sync-shop-setting', //批量同步门店到微信
        'wx-shop-batch-sync-from-wx' => '/shop-setting/batch-sync-add-shop-setting', //同步微信门店到本地
        'wx-shop-update-status' => '/shop-setting/update-status', //更新审核结果
        'wx-batch-sync-shop-status' => '/shop-setting/batch-sync-shop-status', //同步微信审核状态到系统
        'wx-shop-fix-shopstaff' => '/shop-setting/fix-shop-staff', //修复拉取微信门店没创建默认门店员工角色和员工的接口

        ## 微信消息模板 ##
        'wx-msg-tpl-create' => '/wx-message/create-msg-tpl',
        'wx-optional-msg-tpl-get' => '/wx-message/get-optional-msg-tpl',
        'wx-msg-tpl-get' => '/wx-message/get-msg-tpl-by-shop-id',
        'wx-msg-tpl-update' => '/wx-message/update-msg-tpl',
        'wx-msg-tpl-detail-get' => '/wx-message/get-msg-tpl-detail',
        'wx-msg-optional-default-staff-get' => '/wx-message/get-optional-default-staff',
        'wx-msg-default-staff-create' => '/wx-message/create-default-staff',
        'wx-msg-default-staff-get' => '/wx-message/get-default-staff',
        'wx-default-staff-update' => '/wx-message/update-default-staff',
        'wx-msg-enable-tpl-get' => '/wx-message/get-enable-msg-tpl',
        'wx-msg-get-message-id' => '/wx-message/get-message-id',
        'wx-msg-get-detail' => '/wx-message/get-detail',
        'wx-msg-get-msg-tpl-list' => '/wx-message/get-msg-tpl-list',
        'wx-msg-get-msg-tpl-detail' => '/wx-message/get-detail',
        'wx-msg-set-message-state' => '/wx-message/set-message-state',
        'wx-msg-update-message' => '/wx-message/update-message',
        'wx-msg-get-shop-receive' => '/wx-message/get-shop-receive',
        'wx-msg-set-shop-receive' => '/wx-message/set-shop-receive',
        'wx-msg-add-shop-receive' => '/wx-message/add-shop-receive',
        'wx-msg-delete-shop-receive' => '/wx-message/delete-shop-receive',
        'wx-msg-add-shop-receive-by-user' => '/wx-message/add-shop-receive-by-user',
        'wx-msg-add-shop-receive-by-user-and-auth' => '/wx-message/add-shop-receive-by-user-and-auth',

        ## 用户收货地址 ##
        'user-address-create' => '/user-delivery/create-user-delivery',
        'user-address-update' => '/user-delivery/update-user-delivery',
        'user-address-find' => '/user-delivery/find-user-delivery',
        'user-address-get' => '/user-delivery/get-user-delivery',
        'user-address-del' => '/user-delivery/del-user-delivery',

        ## 消怎推送设置 ##
        'wx-push-setting-list' => '/notice/find-wx-setting-list',
        'wx-push-setting-create' => '/notice/create-wx-setting',
        'wx-push-setting-get' => '/notice/get-wx-setting',
        'wx-push-setting-update' => '/notice/update-wx-setting',

        ## 商品分类信息 ##
        'product-category-create' => '/product/create-category',
        'product-category-list' => '/product/find-category-list',
        'product-category-get' => '/product/get-category',
        'product-category-update' => '/product/update-category',
        'product-category-disable' => '/product/disable-category',
        'product-category-enable' => '/product/enable-category',

        ## 商品规格信息 ##
        'product-kind-create' => '/product/create-kind',
        'product-kind-list' => '/product/find-kind-list',
        'product-kind-update' => '/product/update-kind',
        'product-kind-del' => '/product/del-kind',
        'product-kind-value-create' => '/product/create-kind-value',
        'product-kind-value-list' => '/product/find-kind-value-list',
        'product-kind-value-update' => '/product/update-kind-value',
        'product-kind-value-del' => '/product/del-kind-value',

        ## 商品信息 ##
        'product-create' => '/product/create',
        'product-list' => '/product/find-product-with-other-info',
        'product-get' => '/product/get-product-with-other-info',
        'product-update' => '/product/to-update',
        'product-del' => '/product/mult-del',
        'product-update-category' => '/product/mult-update-product-category',
        'product-off-sale' => '/product/off-sale',
        'product-on-sale' => '/product/on-sale',
        'product-recommend' => '/product/recommend-product',
        'product-un-recommend' => '/product/un-recommend-product',
        'product/find-member-product-with-other-info' => '/product/find-member-product-with-other-info',

        ## 商品评论 ##
        'product-comment-create' => '/product/create-comment',
        'product-comment-list' => '/product/find-comment-list',
        'product-comment-del' => '/product/del-comment',
        'product-average-comment-get' => '/product/avg-star',
        'product-comment-create-without-user' => '/product/create-product-comment-no-user',


        ## 分销策略 ##
        'fx-policy-create' => '/fx/create-policy',
        'fx-policy-create-with-level' => '/fx/create-policy-and-level',
        'fx-policy-list' => '/fx/find-policy-list',
        'fx-policy-get' => '/fx/get-policy',
        'fx-policy-del' => '/fx/del-policy',
        'fx-policy-update' => '/fx/update-policy',
        'fx-policy-update-with-level' => '/fx/update-policy-and-level',
        'fx-policy-enable' => '/fx/enable-policy',
        'fx-policy-disable' => '/fx/disable-policy',

        ## 分销支付类型 ##
        'fx-pay-type-create' => '/fx/create-pay-type',
        'fx-pay-type-list' => '/fx/find-pay-type-list',
        'fx-pay-type-get' => '/fx/get-pay-type',
        'fx-pay-type-update' => '/fx/update-pay-type',
        'fx-pay-type-open' => '/fx/open-pay-type',
        'fx-pay-type-close' => '/fx/close-pay-type',
        'fx-pay-type-del' => '/fx/del-pay-type',

        ## 分销员 ##
        'fx-member-create' => '/fx/create-member',
        'fx-member-list' => '/fx/find-member-list',
        'fx-member-get' => '/fx/get-member',
        'fx-member-update' => '/fx/update-member',
        'fx-member-overage' => '/fx/update-overage',
        'fx-member-open' => '/fx/open-member',
        'fx-member-close' => '/fx/close-member',
        'fx-member-review-success' => '/fx/review-member-ok',
        'fx-member-review-fail' => '/fx/review-member-no',
        'fx-member-overage-log-list' => '/fx/find-member-overage-log-list',
        'fx-member-order-count' => '/fx/count-member-order',
        'fx-member-fans-count' => '/fx/count-member-user',
        'fx-member-fans-list' => '/fx/find-member-user',
        'fx-member-fans-list-brokerage' => '/fx/find-member-user-brokerage',
        'fx-member-simple-get' => '/fx/get-member-simple',
        'fx-member-level-up' => '/fx/member-level-up',
        'fx-member-visitor-list' => '/fx/find-member-visitor',
        'fx-member-member-list' => '/fx/find-member-member',
        'fx-member-save-by-staff' => '/fx/save-staff-fx-member',


        ## 分销员等级 ##
        'fx-member-level-create' => '/fx/create-member-level',
        'fx-member-level-list' => '/fx/find-member-level-list',
        'fx-member-level-get' => '/fx/get-member-level',
        'fx-member-level-update' => '/fx/update-member-level',
        'fx-member-level-del' => '/fx/del-member-level',

        ## 分销商品 ##
        'fx-product-create' => '/fx/create-product',
        'fx-product-list' => '/fx/find-product-list',
        'fx-product-get' => '/fx/get-product',
        'fx-product-policy-update' => '/fx/update-product-policy',
        'fx-product-del' => '/fx/del-product',
        'fx-member-product-get-brokerage' => '/fx/figure-brokerage',

        ## 分销员商品 ##
        'fx-member-product-create' => '/fx/create-member-product',
        'fx-member-product-create-all' => '/fx/create-member-product-a-key',
        'fx-member-product-list' => '/fx/find-member-product-list',
        'fx-member-product-get' => '/fx/get-member-product',
        'fx-member-product-del' => '/fx/del-member-product',
        'fx-member-product-del-all' => '/fx/del-member-product-a-key',

        ## 分销订单 ##
        'fx-order-create' => '/fx/create-order',
        'fx-order-list' => '/fx/find-order-list',
        'fx-order-get' => '/fx/get-order',
        'fx-order-sum' => '/fx/count-member-order-sum',
        'fx-order-get-by-order-id' => '/fx/get-order-by-order-id',
        'fx-order-update' => '/fx/update-order',

        ## 分销操作日志 ##
        'fx-operation-log-list' => '/fx/find-operation-log-list',
        'create-log' => '/fx/create-fx-operation-log',

        ## 商家分销设置 ##
        'fx-setting-create' => '/fx/create-setting',
        'fx-setting-get' => '/fx/get-setting',
        'fx-setting-update' => '/fx/set-setting',
        'fx-setting-apply-open' => '/fx/open-apply',
        'fx-setting-apply-close' => '/fx/close-apply',

        ## 二维码 ##
        'qrcode-create' => '/wx/create-persistent-qrcode',
        'qrcode-get' => '/wx/get-persistent-qrcode',
        'qrcode-add-hit' => '/wx/increase-by-hit',
        'qrcode-add-attention' => '/wx/increase-by-attention',
        'qrcode-max-scene-id' => '/wx/get-max-scene-id',

        #   订单接口  ------------------------------------------------------------------------------------------------------------------------------
        'order-get' => '/order/get-order',
        'order-create' => '/order/create-order',
        'order-create-scan' => '/order/create-scan-order',
        'order-create-secondkill' => '/order/create-activity-order',
        'order-find' => '/order/find-order-list',
        'deliver-done' => '/order/deliver-done',
        'order-cancel' => '/order/cancel-order',
        'order-seller-cancel' => '/order/seller-cancel-order',
        'order-close' => '/order/close-order',
        'order-take-over' => '/order/confirm-receipt',
        'order-simple-pay' => '/order/simple-order-pay',
        'order-pay-done' => '/order/pay-done',
        'order-update-delivery' => '/order/update-delivery',
        'order-apply-refund' => '/after-sales-service/apply-order-refund',
        'order-cancel-refund' => '/after-sales-service/cancel-order-refund',
        'order-refund-log' => '/after-sales-service/find-log-list',
        'after-order-confirm' => '/after-sales-service/after-sales-confirm',
        'order-pass-refund' => '/after-sales-service/pass',
        'order-refuse-refund' => '/after-sales-service/refuse',
        'order-refund-list' => '/after-sales-service/find-list',
        'order-seller-update-delivery' => '/order/update-delivery-hard',
        'order-seller-update-discount' => '/order/seller-update-order-discount',
        'order-find-log' => '/order/find-order-log-list',
        'order-create-log' => '/order/create-order-log',
        'order-staff-confirm-receipt' => '/order/staff-confirm-receipt',
        'order-find-can-cancel-by-activity' => '/order/find-can-cancel-by-activity',
        'order-batch-cancel-order-by-activity' => '/order/batch-cancel-order-by-activity',
        'find-logistics' => '/order/find-logistics',
        'order-sync-unpay-status' => '/order/sync-unpay-order',

        'after-sales-service/return-goods-logistics-add' => '/after-sales-service/return-goods-logistics-add',
        'after-sales-service/get-all-after-sale-logs' => '/after-sales-service/get-all-after-sale-logs',
        'after-sales-service/get' => '/after-sales-service/get',
        'after-sales-service/customer-edit-after-sale-info' => '/after-sales-service/customer-edit-after-sale-info',
        'after-sales-service/return-goods-handle-by-seller' => '/after-sales-service/return-goods-handle-by-seller',
        'order/find-member-order-list' => '/order/find-member-order-list',

        ## 邮费模板
        'shipping-mode-create' => '/delivery/create',
        'shipping-mode-find' => '/delivery/find-list',
        'shipping-mode-get' => '/delivery/get',
        'shipping-mode-update' => '/delivery/to-update',
        'shipping-mode-open' => '/delivery/open',
        'shipping-mode-close' => '/delivery/close',
        'shipping-mode-del' => '/delivery/del',
        'shipping-fee-del' => '/delivery/del-shipping-fee',

        #   商城接口  ------------------------------------------------------------------------------------------------------------------------------
        ## 导航信息 ##
        'website-category-create' => '/website/create-website-category',
        'website-category-update' => '/website/update-website-category',
        'website-category-list' => '/website/find-website-category',
        'website-category-get' => '/website/get-website-category',
        'website-category-enable' => '/website/enable-website-category',
        'website-category-disable' => '/website/disable-website-category',
        'website-category-del' => '/website/del-website-category',
        ## 幻灯片信息 ##
        'website-slide-create' => '/website/create-website-slide',
        'website-slide-update' => '/website/update-website-slide',
        'website-slide-list' => '/website/find-website-slide',
        'website-slide-get' => '/website/get-website-slide',
        'website-slide-enable' => '/website/enable-website-slide',
        'website-slide-disable' => '/website/disable-website-slide',
        'website-slide-del' => '/website/del-website-slide',
        ## 模版信息 ##
        'website-template-list' => '/website/find-website-template',
        'website-template-get' => '/website/get-website-template',
        'website-template-cate-list' => '/website/find-website-template-cate',
        'website-template-cate-get' => '/website/get-website-template-cate',
        'website-template-options-update' => '/website/save-website-templates-options',
        'website-template-options-get' => '/website/get-website-templates-options',

        #   活动接口  ------------------------------------------------------------------------------------------------------------------------------
        ## 秒杀活动信息 ##
        'second-kill-create' => '/second-kill/create',
        'second-kill-find' => '/second-kill/find-second-kill-list',
        'second-kill-get' => '/second-kill/get-second-kill',
        'second-kill-update' => '/second-kill/to-update',
        'second-kill-open' => '/second-kill/general-enable',
        'second-kill-close' => '/second-kill/general-disable',
        'second-kill-del' => '/second-kill/general-del',
        'seckill-goods-create' => '/second-kill/create-seckill-goods',
        'seckill-goods-update' => '/second-kill/update-seckill-goods',
        'seckill-goods-del' => '/second-kill/seckill-goods-del',
        'seckill-goods-find' => '/second-kill/find-seckill-goods-list',
        'seckill-goods-get' => '/second-kill/get-seckill-goods',
        'seckill-get-with-Goods' => '/second-kill/get-second-kill-with-goods',
        'seckill-user-seckill-buy' => '/second-kill/user-seckill-buy',

        ## 积分活动信息 ##
        'activity-point-find' => '/points-consumption/find-points-consumption-list',
        'activity-point-get' => '/points-consumption/get',
        'activity-point-create' => '/points-consumption/create',
        'activity-point-update' => '/points-consumption/to-update',
        'activity-point-open' => '/points-consumption/general-enable',
        'activity-point-close' => '/points-consumption/general-disable',
        'activity-point-del' => '/points-consumption/general-del',
        'point-goods-create' => '/points-consumption/create-points-consumption-goods',
        'point-goods-find' => '/points-consumption/find-points-consumption-goods-list',
        'point-goods-del' => '/points-consumption/del-points-consumption-goods',

        ## 积分抵扣活动信息 ##
        'point-redeem-find' => '/points-redeem/find-list',
        'point-redeem-get' => '/points-redeem/get',
        'point-redeem-create' => '/points-redeem/create',
        'point-redeem-update' => '/points-redeem/to-update',
        'point-redeem-open' => '/points-redeem/general-enable',
        'point-redeem-close' => '/points-redeem/general-disable',
        'point-redeem-del' => '/points-redeem/general-del',

        ## 预约活动信息 ##
        'reserve-find' => '/reserve/find-reserve',
        'reserve-get' => '/reserve/get-reserve',
        'reserve-create' => '/reserve/create-reserve',
        'reserve-update' => '/reserve/update-reserve',
        'reserve-open' => '/reserve/general-enable',
        'reserve-close' => '/reserve/general-disable',
        'reserve-del' => '/reserve/delete-reserve',
        'reserve-user-get' => '/reserve/delete-reserve',
        'reserve-get-user-data' => '/reserve/get-reserve-user-data',
        'reserve-find-user-data' => '/reserve/find-reserve-user-data',
        'reserve-create-user-data' => '/reserve/create-reserve-user-data',
        'reserve-update-user-data' => '/reserve/update-reserve-user-data',
        'reserve-pass-user-data' => '/reserve/pass-user-data',
        'reserve-reject-user-data' => '/reserve/reject-user-data',
        'reserve-del-user-data' => '/reserve/delete-reserve-user-data',


        ## 红包活动信息 ##
        'redpack-find' => '/red-packet-event/find-list',
        'redpack-create' => '/red-packet-event/create',
        'redpack-update' => '/red-packet-event/to-update',
        'redpack-get' => '/red-packet-event/get',
        'redpack-on-status' => '/red-packet-event/general-enable',
        'redpack-off-status' => '/red-packet-event/general-disable',
        'redpack-delete' => '/red-packet-event/general-del',

        'redpack-get-item' => '/red-packet-event/get-item', //获取对应活动领取的红包
        'redpack-find-item-list' => '/red-packet-event/find-item-list', //获取对应活动领取的红包
        'redpack-find-group-log-list' => '/red-packet-event/find-group-log-list', //获取群红包领取记录
        'redpack-get-group-log' => '/red-packet-event/get-group-log', //获取群红包领取记录
        'redpack-find-transmit-log-list' => '/red-packet-event/find-transmit-log-list', //获取接龙红包领取记录
        'redpack-receive-item' => '/red-packet-event/receive-item', //领取红包
        'transmit-get-log' => '/red-packet-event/get-transmit-log', //获取接龙红包领取记录详情
        'transmit-guess' => '/red-packet-event/get-transmit-item', //获取接龙红包详情
        'group-get-item' => '/red-packet-event/get-group-item', //瓜分红包
        ## 红包管理信息 ##
        'redpack-manage-find' => '/red-packet/find-list',
        'redpack-manage-get' => '/red-packet/get',
        'redpack-manage-create' => '/red-packet/create',
        'redpack-manage-update' => '/red-packet/to-update',
        'redpack-manage-del' => '/red-packet/general-del',

        ## 众筹活动 通用接口##
        'collect-create' => '/collect/create-collect',
        'collect-update' => '/collect/update-collect',
        'collect-get' => '/collect/get-collect',
        'collect-find' => '/collect/find-collect',
        'collect-create-product' => '/collect/create-collect-product',
        'collect-create-custom-gift' => '/collect/create-collect-custom-gift',
        'collect-update-custom-gift' => '/collect/update-collect-custom-gift',
        'collect-update-product' => '/collect/update-collect-product',
        'collect-find-product' => '/collect/find-collect-product',
        'collect-find-custom-gift' => '/collect/find-collect-custom-gift',
        'collect-delete-product' => '/collect/del-collect-product',
        'collect-delete-custom-gift' => '/collect/del-collect-custom-gift',
        'collect-open' => '/collect/enable-collect',
        'collect-close' => '/collect/disable-collect',
        'collect-del' => '/collect/del-collect',
        'collect-find-join-user' => '/collect/find-collect-join', //参与用户 join表
        'collect-get-collect-join' => '/collect/get-collect-join', //参与用户 join表
        'collect-get-collect-join-with-click' => '/collect/get-collect-join-with-click', //雷锋列表 click表
        'collect-create-collect-join' => '/collect/create-collect-join', //创建参与用户 join表
        'collect-update-collect-join' => '/collect/update-collect-join', //创建参与用户 join表
        'collect-create-collect-click' => '/collect/create-collect-click', //帮点用户 click 表
        'collect-find-click-user' => '/collect/find-collect-click', //帮点用户 click 表
        'collect-get-receive-product' => '', //获取代领商品详情
        'collect-exchange-join' => '/collect/sent-join-gift', //手动兑换

        ## 抽奖活动 ##
        'market-activity-create' => '/marketing-activity/create-marketing-activity',
        'market-activity-update' => '/marketing-activity/update-marketing-activity',
        'market-activity-find' => '/marketing-activity/find-marketing-activity-list',
        'market-activity-get' => '/marketing-activity/get-marketing-activity',
        'market-activity-open' => '/marketing-activity/general-enable',
        'market-activity-close' => '/marketing-activity/general-disable',
        'market-activity-del' => '/marketing-activity/general-del',
        'market-find-record-list' => '/marketing-activity/find-record-list', //获取中奖记录
        'market-get-record' => '/marketing-activity/get-record', //获取中奖纪录详情
        'market-get-prize' => '/marketing-activity/get-marketing-activity-prize', //请求抽奖
        'market-exchange-record' => '/marketing-activity/exchange-record', //兑换中奖
        'market-update-record' => '/marketing-activity/update-record', //修改兑奖地址
        'market-activity-join' => '/marketing-activity/join-activity', //参加抽奖活动
        'market-get-left-chance-count' => '/marketing-activity/get-left-chance-count', //获取用户剩余抽奖次数
        'market-get-marketing-chance' => '/marketing-activity/get-marketing-chance', //获取用户抽奖次数信息
        'market-add-points-chance' => '/marketing-activity/add-points-chance', //使用积分增加抽奖次数

        ## 卡券 ##
        'card-coupon-create' => '/card/create',
        'card-coupon-update' => '/card/to-update',
        'card-coupon-get' => '/card/get',
        'card-coupon-find' => '/card/find-list',
        'card-coupon-del' => '/card/general-del',
        'card-coupon-hard-del' => '/card/del-hard',
        'card-coupon-open' => '/card/general-enable',
        'card-coupon-close' => '/card/general-disable',
        'card-create-strategy' => '/card/create-strategy',
        'card-update-strategy' => '/card/to-update-strategy',
        'card-get-strategy' => '/card/get-strategy',
        'card-find-strategy' => '/card/find-strategy-list',
        'card-del-strategy' => '/card/del-strategy',
        'card-open-strategy' => '/card/enable-strategy',
        'card-close-strategy' => '/card/disable-strategy',
        'card-create-receive' => '/card/create-receive',
        'card-update-receive' => '/card/to-update-receive',
        'card-get-receive' => '/card/get-receive',
        'card-find-receive' => '/card/find-receive-list',
        'card-del-receive' => '/card/del-receive',
        'card-hand-send' => '/card/hand-send-card-info',
        'card-update-examine' => '/card/update-examine',
        'card-receive' => '/card/receive-card-info',//领取卡券
        'card-accept' => '/card/accept-card-info',//接收赠送的卡券
        'card-send-card' => '/card/accept-hand-send-card',//领取微信卡券 手动派发的和直接领取的和领取转赠的
        'card-get-info' => '/card/get-card-info',
        'card-cancel-card' => '/card/cancel-card',//核销卡券
        'card-cancel-card-new' => '/card/cancel-card-log-callback',//核销卡券
        'card-find-info' => '/card/find-card-info-list',
        'card-del-info' => '/card/del-card-info',

        ## 现金红包 ##
        'cash-redpack-create' => '/cash-redpack/create-cash-redpack',
        'cash-redpack-update' => '/cash-redpack/update-cash-redpack',
        'cash-redpack-get' => '/cash-redpack/get-cash-redpack',
        'cash-redpack-find' => '/cash-redpack/find-cash-redpack-list',
        'cash-redpack-find-all' => '/cash-redpack/find-all-redpack-list', //查找所有现金红包，无分页
        'cash-redpack-open' => '/cash-redpack/enable-cash-redpack',
        'cash-redpack-close' => '/cash-redpack/disable-cash-redpack',
        'cash-redpack-del' => '/cash-redpack/del-cash-redpack',
        'cash-redpack-data-find' => '/cash-redpack/find-cash-redpack-data-list',
        'cash-redpack-group-find' => '/cash-redpack/find-cash-redpack-group-list',
        'cash-redpack-send' => '/cash-redpack/send-cash-redpack',
        'cash-redpack-send-by-scan' => '/cash-redpack/scan-send',
        'cash-redpack-group-send' => '/cash-redpack/group-send-cash-redpack',
        'cash-redpack-resend' => '/cash-redpack/resend-cash-redpack',
        'cash-redpack-update-data-status' => '/cash-redpack/update-cash-redpack-data-status',
        'cash-redpack-strategy-create' => '/cash-redpack/create-cash-redpack-strategy',
        'cash-redpack-strategy-update' => '/cash-redpack/update-cash-redpack-strategy',
        'cash-redpack-strategy-get' => '/cash-redpack/get-cash-redpack-strategy',
        'cash-redpack-strategy-find' => '/cash-redpack/find-cash-redpack-strategy-list',
        'cash-redpack-strategy-open' => '/cash-redpack/enable-cash-redpack-strategy',
        'cash-redpack-strategy-close' => '/cash-redpack/disable-cash-redpack-strategy',
        'cash-redpack-strategy-delete' => '/cash-redpack/del-cash-redpack-strategy',

        ## 拼团活动 ##
        'together-buy-create' => '/together-buy/create',
        'together-buy-find' => '/together-buy/find-together-buy-list',
        'together-buy-get' => '/together-buy/get-together-buy',
        'together-buy-update' => '/together-buy/to-update',
        'together-buy-open' => '/together-buy/general-enable',
        'together-buy-close' => '/together-buy/general-disable',
        'together-buy-del' => '/together-buy/general-del',
        'togetherbuy-goods-create' => '/together-buy/create-together-buy-goods',
        'togetherbuy-goods-update' => '/together-buy/update-together-buy-goods',
        'togetherbuy-goods-del' => '/together-buy/together-buy-goods-del',
        'togetherbuy-goods-find' => '/together-buy/find-together-buy-goods-list',
        'togetherbuy-goods-get' => '/together-buy/get-together-buy-goods',
        'togetherbuy-get-with-Goods' => '/together-buy/get-together-buy-with-goods',
        'together-buy-queue-find' => '/together-buy/find-together-buy-queue',
        'together-buy-queue-get' => '/together-buy/get-together-buy-queue',
        'together-buy-join-find' => '/together-buy/find-together-buy-join',
        'togetherbuy-user-buy-count' => '/together-buy/count-user-buy',
        'together-buy-join-by-queue' => '/together-buy/find-together-buy-join-by-queue',
        'together-buy-join-activity' => '/together-buy/get-together-buy-with-one-goods',
        'together-buy-get-user-buy-detail' => '/together-buy/get-user-buy-detail',
        'together-buy-queue-open' => '/together-buy/open-queue',
        'together-buy-join-queue' => '/together-buy/join-queue',
        'together-buy-close-queue' => '/together-buy/close-together-buy-queue',
        'together-buy-help-success-queue' => '/together-buy/help-success-queue',

        ## 签到活动 ##
        'signin-setting-create' => '/signin-setting/create',
        'signin-setting-update' => '/signin-setting/to-update',
        'signin-setting-find' => '/signin-setting/find-list',
        'signin-setting-get' => '/signin-setting/get',
        'signin-setting-open' => '/signin-setting/general-enable',
        'signin-setting-close' => '/signin-setting/general-disable',
        'signin-setting-del' => '/signin-setting/general-del',
        'signin-setting-get-user-data' => '/signin-setting/get-join',
        'signin-setting-find-user-data' => '/signin-setting/find-join-list',
        'signin-setting-create-user-data' => '/signin-setting/sign-in',
        'signin-setting-count-join' => '/signin-setting/count-signin-join',

        ## 满减包邮 ##
        'reduction-create' => '/reduction/create-full-reduction',
        'reduction-update' => '/reduction/update-reduction',
        'reduction-find' => '/reduction/find-reduction',
        'reduction-get' => '/reduction/get-reduction',
        'reduction-conditions-update' => '/reduction/update-reduction-strategys',
        'reduction-product-del' => '/reduction/del-reduction-product',
        'reduction-product-create' => '/reduction/create-reduction-product',
        'reduction-product-list-create' => '/reduction/create-reduction-products',
        'reduction-open' => '/reduction/enable-reduction',
        'reduction-close' => '/reduction/disable-reduction',
        'reduction-delete' => '/reduction/del-reduction',
        'reduction-product-find' => '/reduction/find-reduction-product',
        'reduction-apply-reduction' => '/reduction/is-apply-reduction',
        'reduction-find-product-reductions' => '/reduction/find-product-reductions',
        'reduction-find-selected-products' => '/reduction/find-used-product',


        ## 核销管理 ##
        'cancel-find-cancel-records' => '/cancel/find-cancel-records',
        'staff-bind-staff-user' => '/staff/bind-staff-user',
        'cancel-cancel-staff-user-bind' => '/cancel/cancel-staff-user-bind',
        'cancel-create-cancel-member' => '/cancel/bind-cancel-member',
        'cancel-update-cancel-member' => '/cancel/update-cancel-member',
        'cancel-get-cancel-member' => '/cancel/get-cancel-member',
        'cancel-find-cancel-member' => '/staff/find-shop-staff',
        'cancel-enable-cancel-member' => '/cancel/enable-cancel-member',
        'cancel-disable-cancel-member' => '/cancel/unbind-cancel-member',
        'cancel-del-cancel-member' => '/cancel/del-cancel-member',
        'cancel-shopsub-list' => '/cancel/find-cancel-shop',
        'cancel-staff-list' => '/cancel/count-cancel-staff',

        ## 权限管理 ##
        'auth-get-class-info' => '/auth/get-class-info',
        'auth-get-class' => '/auth/get-class',
        'auth-create-class' => '/auth/create-class',
        'auth-create-function' => '/auth/create-function',
        'auth-batch-create-function' => '/auth/batch-create-function',
        'auth-find-function-menu' => '/auth/find-function-menu',

        ## 角色管理 ##
        'role-create' => '/auth/create-role',
        'role-update' => '/auth/update-role',
        'role-get' => '/auth/get-role',
        'role-find' => '/auth/find-role',
        'role-del' => '/auth/del-role',
        'find-role-function' => '/auth/find-role-function',
        'role-find-role-menu' => '/auth/find-role-function-menus', //获取角色权限菜单
        'role-find-menu' => '/auth/find-function-menu',
        'role-find-function-menu-with-function' => '/auth/find-function-menu-with-function', //获取权限菜单列表以及权限列表
        'role-save-role-function' => '/auth/save-role-function-menu', //分配角色功能权限

        #   硬件接口  ------------------------------------------------------------------------------------------------------------------------------
        ## 打印机 ##
        'printer-clients-list' => '/printer/find-printer-clients',
        'printer-clients-info' => '/printer/get-printer-clients-info',
        'printer-client-get' => '/printer/get-printer-client',
        'printer-client-edit' => '/printer/update-printer-clients',
        'printer-client-info-get' => '/printer/get-printer-client-info',
        'printer-client-bind-template' => '/printer/bind-printer-templates',
        'printer-materials-list' => '/printer/find-printer-materials',
        'printer-materials-get-id' => '/printer/get-printer-materials-id',
        'printer-materials-add' => '/printer/create-printer-materials',
        'printer-materials-del' => '/printer/del-printer-materials',
        'printer-templates-list' => '/printer/find-printer-templates',
        'printer-template-get' => '/printer/get-printer-templates',
        'printer-template-add' => '/printer/create-printer-templates',
        'printer-template-edit' => '/printer/update-printer-templates',
        'printer-template-del' => '/printer/del-printer-templates',
        'printer-list-get' => '/printer/get-printer-lists',
        'printer-list-update' => '/printer/update-printer-lists',
        'printer-list-create' => '/printer/create-printer-lists',
        'user-print-limit-check' => '/printer/check-user-print-limit',
        'printer-clients-sync' => '/printer/sync-printer-clients',
        'print-do' => '/printer/do-print',
        'printer-response-value-get' => '/printer/get-printer-response-value',
        'print-to-statistics-add' => '/printer/add-print-to-statistics',
        'printer-statistics-count' => '/printer/count-printer-statistics',
        'printer-statistics-find' => '/printer/shop-printer-statistics',
        'printer-statistics-list-find' => '/printer/client-printer-statistics',
        'printer-statistics-detail-find' => '/printer/find-printer-statistics',
        'printer-responses-get' => '/printer/find-printer-responses',
        'printer-responses-edit' => '/printer/edit-printer-responses',

        ##Pos机广告##
        'ad-site-list' => '/pos/find-ad-site ',
        'shop-sub-list' => '/pos/choose-shop-sub',
        'activity-list' => '/pos/find-ad-activity',
        'close-act' => '/pos/disable-ad-activity',
        'open-act' => '/pos/enable-ad-activity',
        'delete-act' => '/pos/del-ad-activity',
        'act-content-list' => '/pos/find-ad-content',
        'close-ad' => '/pos/disable-ad-content',
        'open-ad' => '/pos/enable-ad-content',
        'delete-ad' => '/pos/del-ad-content',
        'add-ad-content' => '/pos/create-ad-content',
        'edit-ad-content' => '/pos/update-ad-content',
        'act-info' => '/pos/get-ad-activity',
        'ad-act-info' => '/pos/create-ad-activity',
        'edit-act-info' => '/pos/update-ad-activity',
        'del-range-shop' => '/pos/del-ad-range',
        'find-pos-count-list' => '/statistics/pos-client-count',
        'update-pos-desc' => '/pos/update-pos-client',
        'get-pos-desc' => '/pos/get-pos-client',
        'staff-ad-count' => '/pos/staff-ad-count',


        ##wifi##
        'yeah-wifi-list' => '/wifi/find-wifi-client',
        'yeah-wifi-get' => '/wifi/get-wifi-client',
        'yeah-wifi-update' => '/wifi/update-wifi-client',
        'yeah-wifi-portal' => '/wifi/find-portal-list',
        'yeah-wifi-action-bar' => '/wifi/find-bar-list',
        'yeah-wifi-get-ssid' => '/wifi/get-wx-shop-wifi-ssid',
        'yeah-wifi-get-info-with-other' => '/wifi/get-wifi-info-with-other',
        'yeah-wifi-find-statistics-list' => '/wifi/find-wifi-statistics',
        'yeah-wifi-ap-update' => '/wifi/wifi-ap-update',
        'yeah-wifi-get-ap-info' => '/wifi/get-wifi-ap-info',
        'yeah-wifi-get-wx-wifi-shop' => '/wifi/sync-wx-wifi-shop-by-shop-id',

        ##Ibeacon##
        'ibeacon-find-client-list' => '/ibeacon/find-client-list',
        'ibeacon-get-client' => '/ibeacon/get-client',
        'ibeacon-update-client' => '/ibeacon/update-client',
        'ibeacon-create-page' => '/ibeacon/create-page',
        'ibeacon-find-page-list' => '/ibeacon/find-page-list',
        'ibeacon-get-page' => '/ibeacon/get-page',
        'ibeacon-update-page' => '/ibeacon/update-page',
        'ibeacon-del-page' => '/ibeacon/del-page ',
        'ibeacon-find-main-statistic' => '/ibeacon/find-main-statistic',
        'ibeacon-find-statistics-list' => '/ibeacon/find-statistics-list',
        'ibeacon-get-statistics' => '/ibeacon/get-statistics',
        'ibeacon-get-sum-shake-uv' => '/ibeacon/get-sum-shake-uv',

        #   第三方平台开发，代公众号实现业务  ------------------------------------------------------------------------------------------------------------------------------
        'thrid-send-verify-ticket' => '/wx-api/component-verify',

        ##Statement##
        'statement-receive-setting' => '/statement/edit-statement-receive-setting',
        'statement-receive-setting-get' => '/statement/get-statement-receive-setting',
        'statement-record-add' => '/statement/create-statement-record',
        'statement-record-find' => '/statement/find-statement-record-list',
        'statement-detail-find' => '/statement/find-statement-detail-list',
        'statement-detail-get' => '/statement/get-statement-detail',
        'statement-detail-update' => '/statement/update-statement-detail',
        'statement-log-find' => '/statement/find-statement-log-list',
        'statement-send-message' => '/statement/send-statement-message',
        'statement-push-msg-staff-find' => '/statement/find-push-msg-staff',

        ##Sms##
        'sms-send-log-list' => '/sms/find-sms-send-log-list',
        'sms-package-list' => '/sms/find-sms-package-list',
        'sms-recharge-order-list' => '/sms/find-sms-recharge-order-list',
        'sms-shop' => '/sms/get-sms-shop',
        'sms-receive' => '/sms/sms-receive',
        'sms-rechange' => '/sms/make-prepay-order',
        'sms-rechange-wx' => '/sms/make-prepay-order-wx',
		'sms-log-tenpay-notice' => '/sms/log-tenpay-notice',
        'sms-pay-callback' => '/sms/pay-callback',
        'sms-pay-callback-wx' => '/sms/pay-callback-wx',

       #   世贸项目 ------------------------------------------------------------------------------------------------------------------------------
       ##test##
        'test' => '/site/index',

    ];

}
