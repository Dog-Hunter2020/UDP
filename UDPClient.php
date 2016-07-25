<?php
/**
 * Created by PhpStorm.
 * User: kisstheraik
 * Date: 16/7/25
 * Time: 上午9:58
 * Description: 模拟UDP客户端
 */


require_once('UDP.php');

for($id=0;$i<20;$i++){
    if(($pid=pcntl_fork())==0){

        sleep(2);
        for($j=0;$j<10;$j++) {
            sendPackage('localhost', 7654, 'Thread'.$i.'zfy'.$j, function ($socket) {

                socket_recvfrom($socket, $rec, 65535, 0, $host, $port);


                echo $rec . PHP_EOL;


            });
        }


    }
}






