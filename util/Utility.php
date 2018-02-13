<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function arraysIsEmpty ($datas){
    $bool = true;
    foreach ($datas as $d){
        if(empty($d)){
            $bool = false;
        }
    }
    return $bool;
}