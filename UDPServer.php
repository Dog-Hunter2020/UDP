<?php
/**
 * Created by PhpStorm.
 * User: kisstheraik
 * Date: 16/7/25
 * Time: 上午9:58
 * Description: 模拟UDP服务器,使用预先创建进程的服务器模型,加上ICMP的错误处理
 */

//传入的参数  num 进程数目
require_once('UDP.php');

$num=$argv[1];

if($num==0)exit('参数错误');
$ids=array();


forkAll();

foreach($ids as $key=>$value){

    pcntl_waitpid($value,$status);
}

//产生所有的进程
function forkAll(){

    //初始化socket
    $socket=socket_create(AF_INET,SOCK_DGRAM,SOL_UDP);
    socket_bind($socket,'localhost',7654);


    global $num;
    for($i=0;$i<$num;$i++){
        forkWorker($socket);
    }

}

//产生新进程,在新进程上执行listen任务
function forkWorker($socket){


    global $ids;
    $pid=pcntl_fork();

    if($pid==0){

        listen($socket);

    }elseif($pid<0){

        exit('fork failed!');

    }else{

        $ids[]=$pid;


    }


}

//执行循环任务
function listen($socket){

    while(true) {

        socket_recvfrom($socket,$rec,65535,0,$host,$port);

        task($rec,$host,$port);

    }

}

//相应的任务
function task($data,$addr,$port){

    sleep(1);
    echo posix_getpid()."Receive data from $addr:$port $data".PHP_EOL;
    sendPackage($addr,$port,'Hello this is a udp server! And your data is '.$data,null);

}



