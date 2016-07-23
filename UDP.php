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
function sendPackage($host,$port,$data){

    //源端口
    $localPort=8546;

    //初始化数据包
    $package=pack('n',$localPort);
    $package.=pack('n',$port);

    //udp长度和校验和
    $package.=pack('n',0);
    $package.=pack('n',0);


    $socket=socket_create(AF_INET,SOCK_DGRAM,getprotobyname('udp'));

    socket_sendto($socket,$package,strlen($package),0,$host,$port);

    socket_close($socket);


}

sendPackage('120.26.65.167',80,null);