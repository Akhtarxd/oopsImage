<?php
    include "config.php";

     $obj = new query;

     $conditionArr = array('email'=>'tuhingmail','name'=>'tuhin');

    // $res=$obj->getData('user','*');
    $obj->insertData('user',$conditionArr);
    //$obj->updateData('user',$conditionArr,'id',1);
    //$obj->deleteData('user',$conditionArr,'id',1);

    // echo "<pre>";
    // print_r($res);
    
?>