<?php
header("content-Type: text/html; charset=utf-8");
require_once(__DIR__.'/forbiden_words.txt');
class filterword{
    public $origin_words;
    public $final_words_unit;
    public $final_words;
    public $words_length;
    public $words_array;
    public $forbid_array;
    public $forbid_path;
    public $forbid_length;
    function __construct($input_words){
        $this->origin_words=$input_words;
        $this->words_length=strlen($input_words);
        $this->words_array=explode(" ",$input_words);
        $this->forbid_path=__DIR__.'/forbiden_words.txt';
        $str = file_get_contents($this->forbid_path);
        $this->forbid_array= explode("\r\n",$str);
        $this->final_words=array();
        $this->forbid_length=count($this->forbid_array);
        foreach($this->forbid_array as $key=>$senwor){
            foreach($this->words_array as $range_unit){ 
                $this->final_words_unit=str_replace($senwor,"*",$range_unit);
                array_push($this->final_words,$this->final_words_unit);
            }
            $this->words_array=$this->final_words;
            if($key!=($this->forbid_length-1)){
               $this->final_words=array();
            }
        }
    }
    public function filter(){

        echo("\n"."\n");
        print_r($this->forbid_array);
        echo("\n"."\n");
        echo("\n"."\n");
        foreach($this->forbid_array as $key=>$sen){
            echo("这是".$key."和"."$sen"."\n");
        }
        echo("\n");
        return implode(" ",$this->final_words);
    }
}