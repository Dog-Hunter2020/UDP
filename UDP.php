<?php
/**
 * Created by PhpStorm.
 * User: kisstheraik
 * Date: 16/7/23
 * Time: 上午11:10
 * Description: 模拟发送UDP报文
 */

/*
 * @param $host string 目的主机
 * @param $port int    目的端口
 */
function sendPackage($host,$port,$data,$callback){

    $package=$data;

    $socket=socket_create(AF_INET,SOCK_DGRAM,getprotobyname('udp'));

    socket_sendto($socket,$package,strlen($package),0,$host,$port);



    //处理回调的结果的函数
    if($callback!=null)call_user_func($callback,$socket);

    socket_close($socket);

}


