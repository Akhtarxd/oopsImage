<?php
 class database{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;

    public function connect(){
        $this->host = 'localhost';
        $this->dbusername = 'root';
        $this->dbpassword = '';
        $this->dbname = 'crud';
        $con = new mySQLi($this->host,$this->dbusername,$this->dbpassword,$this->dbname);
        return $con;
    }
 } 

 class query extends database{
    public function getData($table,$field='*',$conditionArr='',$limit='',$orderByField='',$orderByValue='desc'){
        $sql = "SELECT $field FROM $table";

        if($conditionArr!=''){
            $sql.= " WHERE ";
            $count = count($conditionArr);
            $i = 1;
            foreach($conditionArr as $key=>$value){
                if($count!=$i){
                    $sql.= " $key=$value AND ";
                }else{
                    $sql.= " $key=$value ";
                }
                $i++;
            }
        }

        if($limit!=''){
            $sql.= " LIMIT $limit ";
        }

        if($orderByField!=''){
            $sql.= " ORDER BY $orderByField $orderByValue";
        }

        $result = $this->connect()->query($sql);
        if($result->num_rows>0){
            $array = array();
            while($row=$result->fetch_assoc()){
                $array[] = $row;
            }
            return $array;
        }else{
            return 0;
        }
    }

    public function insertData($table,$conditionArr){
        if($conditionArr!=''){
            foreach($conditionArr as $key=>$value){
                $fieldArr[] = $key;
                $valueArr[] = $value;
            }
            $field = implode(',',$fieldArr);
            $value = implode("','",$valueArr);
            $sql= "INSERT INTO $table($field) VALUES('$value')";
        }
        //echo $sql;
        $result = $this->connect()->query($sql);
    }

    public function updateData($table,$conditionArr,$whereField,$whereValue){
        if($conditionArr!=''){
            $sql = "UPDATE $table SET ";
            $count = count($conditionArr);
            $i = 1;
            foreach($conditionArr as $key=>$value){
                if($count!=$i){
                    $sql.= "$key='$value', ";
                }else{
                    $sql.= "$key='$value'";
                }
                $i++;
            }
            $sql.= " WHERE $whereField='$whereValue' ";
        }

        //echo $sql;
        $result = $this->connect()->query($sql);
    }

    public function deleteData($table,$conditionArr){  
        if($conditionArr!=''){
            $sql = "DELETE FROM $table ";
            $count = count($conditionArr);
            $i = 1;
            foreach($conditionArr as $key=>$value){
                if($count!=$i){
                    $sql.= " WHERE $key='$value' AND ";
                }else{
                    $sql.= " WHERE $key='$value'";
                }
                $i++;
            }
        }
        // echo $sql;
        $result = $this->connect()->query($sql);
    }

    public function getSafeStr($str){
        return mysqli_real_escape_string($this->connect(),$str);
    }
 }

?>