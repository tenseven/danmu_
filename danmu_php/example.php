<?php
require_once(__DIR__.'/filter_word.php');
$server = new swoole_websocket_server("0.0.0.0", 3389);//0.0.0.0表示广播消息； 9502是刚才前端页面中定好的通信端口
$server->on('open', function (swoole_websocket_server $server, $request) {

    echo "server: handshake success with fd{$request->fd}\n";//$request->fd 是客户端id

});

$server->on('message', function (swoole_websocket_server $server, $frame) {

    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

    //$frame->fd 是客户端id，$frame->data是客户端发送的数据

    //服务端向客户端发送数据是用 $server->push( '客户端id' ,  '内容')

    $data = $frame->data;
    echo("\n");
    echo($data);
    echo("\n");
    echo("\n");
    $filter_wor=new filterword($data);
    $getwords=$filter_wor->filter();
    $final_data=[
        'data'=>$getwords
    ];
    var_dump($getwords);
    echo("\n");
    print_r("filter words is a ".$getwords);
    echo("\n");
    foreach($server->connections as $fd){

        $server->push($fd , $getwords);//循环广播

    }

});

$server->on('close', function ($ser, $fd) {

    echo "client {$fd} closed\n";

});

$server->start();