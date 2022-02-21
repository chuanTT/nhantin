<?php 
    function convert($pwd) {
        return md5(md5($pwd).key);
    }

    function createToken ($code) {
        $date = date('d-m-Y H:i:sa');
        return md5(md5($code).$date);
    }

    function getPost ($value) {
        if(isset($_POST[$value])) {
            $result = $_POST[$value];
            return $result;
        }
    }

    function getGet ($value) {
        if(isset($_GET[$value])) {
            $result = $_GET[$value];
            return $result;
        }
    }


    function createDate ($stringFormat = 'Y-m-d H:i:s A') {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date($stringFormat);
        return $date;
    }

    function random_name_photo ($name_photo) {
        $date = createDate ();
        return md5(md5($name_photo).$date);
    }

    function format_date ($date,$strFormat) {
        $date_cr = date_create($date);
        $date_format = date_format($date_cr,$strFormat);
        return $date_format;
    }

    function randomPhotoDefault ($arr,$max,$min=0) {
        if(is_array($arr)) {
            $index = rand($min,$max-1);
            return $arr[$index];
        }
    }

    function render_id_token ($token) {
        if($token != '') {
            $sql = "SELECT id_user FROM token_user WHERE token = '$token'";
            $result = renderViews($sql,true);
            return $result['id_user'];
        }
    }

    function DeleteFile($BASEURL, $nameFile) {
        if($nameFile != null || $nameFile != '') {
            if(file_exists($BASEURL.$nameFile)) {
                unlink($BASEURL.$nameFile);
                return 1;
            }
        }
    }

    function link_thumbnail ($baseUrl, $default, $check, $nameImg, $folderTime) {
        if((string)$check === '0') {
            $linkImgFriend = $baseUrl.$default.$nameImg;
        } else {
            $crDate = date_create($folderTime);
            $formatDate = date_format($crDate, 'd-m-Y');
            $linkImgFriend = baseUrl.$formatDate.'/'.$nameImg;
        }
        return $linkImgFriend;
    }

    function uploadFile ($file,$baseUrl,$name_folder,$Invalid,$max_size) {

        function validatefiles($file,$index,$baseUrls,$name_folders,$Invalids,$max_sizes) {
            if($file['size'][$index] > 0) {

                $type = explode('/', $file['type'][$index])[1];
                
                if(!in_array($type,$Invalids)) {
                    return;
                }
                $linkFolder = $baseUrls.$name_folders;
                $crFolder = 1;
                if(!is_dir($linkFolder)) {
                    $crFolder = mkdir($linkFolder);
                }
                if($crFolder) {  
                    $newName = random_name_photo ($file['name'][$index]).'.'.$type;

                    if($file['size'][$index] <= $max_sizes) {
                        $isMoveFile = move_uploaded_file($file['tmp_name'][$index],$linkFolder.'/'.$newName);

                        if(!$isMoveFile) {
                            return;
                        } else {
                            return array(
                                "status" => 200,
                                "name" => $newName
                            );
                        }
                    } else {
                        return;
                    }

                } else {
                    return;
                }
            } else {
                return;
            }
        }

        if(is_array($file['name'])) {
            $maxIndex = count($file['name']);
            $arr = [];

            if($maxIndex > 1) {
                for($i=0;$i<$maxIndex;$i++):
                    $arr[$i] = validatefiles($file,$i,$baseUrl,$name_folder,$Invalid,$max_size);
                endfor; 
            } else if($maxIndex == 1) {
                $arr[0] = validatefiles($file,0,$baseUrl,$name_folder,$Invalid,$max_size);
            }

            return $arr;
        } else {
            if($file['size'] > 0) {
                $type = explode('/', $file['type'])[1];
                
                if(!in_array($type,$Invalid)) {
                    return;
                }
                $linkFolder = $baseUrl.$name_folder;
                $crFolder = 1;
                if(!is_dir($linkFolder)) {
                    $crFolder = mkdir($linkFolder);
                }

                if($crFolder) {  
                    $newName = random_name_photo ($file['name']).'.'.$type;

                    if($file['size'] <= $max_size) {
                        $isMoveFile = move_uploaded_file($file['tmp_name'],$linkFolder.'/'.$newName);

                        if(!$isMoveFile) {
                            return;
                        } else {
                            return array(
                                "status" => 200,
                                "name" => $newName
                            );
                        }
                    } else {
                        return;
                    }

                } else {
                    return;
                }
            } else {
                return;
            }
        }
    }
?>