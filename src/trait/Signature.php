<?php
/**
 * Created by PhpStorm.
 * User: hankunwang
 * Date: 15/04/18
 * Time: 9:29 PM
 */

namespace Hugostech\Data_interaction;


trait Signature
{
    public function sign($data){
        $data['_timestamp'] = time();
        $data['signature'] = $this->generateSignature($data);
        return $data;
    }

    public function verify($data){
        if (isset($data['signature']) && isset($data['_timestamp'])){
            $signature = $data['signature'];
            unset($data['signature']);
            return $signature == $this->generateSignature($data);
        }else{
            throw new \Exception('Data format error');
        }
    }

    function generateSignature($data){
        $data['_nonce_str'] = config('DataInteraction.NONCE_STR');
        ksort($data);
        return md5($this->glued($data));
    }

    function glued($data){
        $glue = '';
        foreach ($data as $k=>$v){
            $glue .= sprintf('%d=%d&',$k,$v);
        }
        return strtoupper(substr($glue,0,-1));
    }

}