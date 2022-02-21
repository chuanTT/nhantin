<?php 
    require_once "../lib/connectdb.php";
    require_once "../lib/handel.php";

    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $json = [];
        $result = filter_var($search, FILTER_VALIDATE_EMAIL);
        if(!empty($search)) {
            if($result) {
                $sql = "SELECT id, avatar, change_photo ,update_at, first_name, last_name FROM `user` WHERE email LIKE '%$search%'";
            } else {
                $sql = "SELECT id, avatar, change_photo, update_at, first_name, last_name FROM user WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR userName LIKE '%$search%' OR concat_ws(' ',first_name,last_name)= '$search'";
            }
    
            $result = renderViews($sql);
    
            if($result != null) {
                if(count($result) > 0) {
                    foreach ($result as $item) {
                        if($item['change_photo'] === "0") {
                            $dir = baseUrl.defaultFolder.$item['avatar'];
                        } else {
                            $crdate = date_create($item['update_at']);
                            $formatDate = date_format($crdate,'d-m-Y');
                            $dir = baseUrl.$formatDate.'/'.$item['avatar'];
                        }
                        $item['dir'] = $dir;
                        $json[] = array_unique($item);;
                    }
                }
            } else {
                $json = [];
            }
        }

        echo json_encode($json);
    }
?>