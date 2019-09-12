<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/3
 * Time: 10:32
 */
namespace App\Controllers;

class ManagerController
{
    // 聊天类型
    const CHAT_TYPE_HELLO = 'hello'; // 向系统say hello
    const CHAT_TYPE_ROOM = 'chatRoom'; // 公共聊天室
    const CHAT_TYPE_FRIEND = 'friend'; // 好友聊天
    const CHAT_TYPE_ALL = 'all'; // 全服聊天
    const CHAT_TYPE_SYS = 'system'; // 系统类型的请求

    // 消息类型
    const CHAT_MSG_TYPE_TEXT = 'text'; // 文本消息
    const CHAT_MSG_TYPE_IMAGE = 'image'; // 图片消息
    const CHAT_MSG_TYPE_AUDIO = 'audio'; // 语音消息
    const CHAT_MSG_TYPE_VIDEO = 'video'; // 视频消息
    const CHAT_MSG_TYPE_SYS = 'sys'; // 系统消息

    // 公共聊天室用户集
    protected static $_chatPools = [];

    // 用户--socket句柄
    protected static $_userPools = [];

    // 用户信息集
    protected static $_userInfos = [];

    /**
     * 用户进入公共聊天室，添加用户
     * @param $user_id
     */
    public static function setChatPool($user_id)
    {
        if(!in_array($user_id, self::$_chatPools)){
            self::$_chatPools[] = $user_id;
        }
    }

    /**
     * 用户池新增用户连接句柄
     * @param $user_id
     * @param $fd
     */
    public static function setUserPool($user_id, $fd)
    {
        self::$_userPools[$user_id] = $fd;
    }

    /**
     * 用户信息池新增用户信息
     * @param $user_id
     * @param $info
     */
    public static function setUserInfo($user_id, $info)
    {
        self::$_userInfos[$user_id] = $info;
    }

    /**
     * 获取聊天室用户
     * @return array
     */
    public static function getChatPools()
    {
        return self::$_chatPools;
    }

    /**
     * 获取服务器用户
     * @return array
     */
    public static function getUserPools()
    {
        return self::$_userPools;
    }

    /**
     * 获取指定用户的连接句柄
     * @param $user_id
     * @return mixed
     */
    public static function getUserPool($user_id)
    {
        return self::$_userPools[$user_id];
    }

    /**
     * 获取服务器用户信息
     * @return array
     */
    public static function getUserInfos()
    {
        return self::$_userInfos;
    }

    /**
     * 获取指定用户的信息
     * @param $user_id
     * @return mixed
     */
    public static function getUserInfo($user_id)
    {
        return self::$_userInfos[$user_id];
    }

    /**
     * 清空聊天室用户池
     */
    public static function delChatPools()
    {
        self::$_chatPools = [];
    }

    /**
     * 从聊天室中删除某个用户
     * @param $user_id
     */
    public static function delChatPool($user_id)
    {
        $key = array_search($user_id, self::$_chatPools);
        if($key !== false){
            unset(self::$_chatPools[$key]);
        }
    }

    /**
     * 清空服务器用户池
     */
    public static function delUserPools()
    {
        self::$_userPools = [];
    }

    /**
     * 删除服务器用户池中指定用户
     * @param $user_id
     */
    public static function delUserPool($user_id)
    {
        if(isset(self::$_userPools[$user_id])){
            unset(self::$_userPools[$user_id]);
        }
    }

    /**
     * 清空服务器用户信息池
     */
    public static function delUserInfos()
    {
        self::$_userInfos = [];
    }

    /**
     * 删除服务器用户信息池中指定用户的信息
     * @param $user_id
     */
    public static function delUserInfo($user_id)
    {
        if(isset(self::$_userInfos[$user_id])){
            unset(self::$_userInfos[$user_id]);
        }
    }

    public static function clear($user_id = null)
    {
        if($user_id){
            self::delUserPool($user_id);
            self::delUserInfo($user_id);
            self::delChatPool($user_id);
        }else{
            self::delChatPools();
            self::delUserInfos();
            self::delUserPools();
        }
    }
}