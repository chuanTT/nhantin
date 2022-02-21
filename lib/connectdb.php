<?php 
    require_once 'config.php';


    function connect ($sql) {
        $conn = new mysqli(Server,User,Password,Database);

        mysqli_set_charset($conn,'utf8');

        if($conn->connect_error) {
            die("Kết nối cơ sở dữ liệu thất bại");
        }

        $result = $conn -> query($sql);

        if($result == true) {
            return true;
        }

        $conn -> close();

        return false;
    }


    function renderViews ($sql,$isSingle=false) {
        $conn = new mysqli(Server,User,Password,Database);
        $data = null;

        mysqli_set_charset($conn,'utf8');

        if($conn->connect_error) {
            die("Kết nối cơ sở dữ liệu thất bại");
        }

        $result = $conn -> query($sql);

        if($isSingle) {
            $data = mysqli_fetch_array($result,1);
        } else {
            $data = [];
            foreach($result as $item) {
                $data[] = $item;
            }
        }

        $conn->close();
        return $data;
    }