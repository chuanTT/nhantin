<?php
    session_start();
    require "../lib/connectdb.php";
    require "../lib/handel.php";
    require "../lib/PHPMailer/Exception.php";
    require "../lib/PHPMailer/PHPMailer.php";
    require "../lib/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    if($_SERVER['REQUEST_METHOD']==="GET") {
        $email = getGet('email');
        $json =[];
        if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && !isset($_COOKIE['send_to'])) { 
            $sql = "SELECT * FROM user WHERE email='$email'";
            $result = renderViews($sql,true);

            if($result != null) {
                $id_user = $result['id'];
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];
                // $random = (string)rand(0,9).(string)rand(0,9).(string)rand(0,9).(string)rand(0,9); 
                $random = substr(rand(0,9999999999999),0,4);

                $mail = new PHPMailer();
                $mail -> isSMTP();
                $mail -> Host = Host;
                $mail -> SMTPAuth = "true";
                $mail -> CharSet = "utf8";
                $mail -> SMTPSecure = "tls";
                $mail -> Port = Port;
                $mail -> Username = Username;
                $mail -> Password = PasswordMail;
                $mail -> isHTML(true);
                $mail -> setFrom(Username,"chuansupport");
                $mail -> addAddress($email,$first_name.' '.$last_name);
                $mail -> addCC(Username,"chuansupport");
                $mail -> Subject = "Thay đổi mật khẩu";
                $mail -> Body = 'Xin chào '.$last_name.' bạn đã gửi yêu cầu thay đổi mật khẩu. Mã xác nhận của bạn là <br/><br/>
                    <span style="    
                        padding: 7px 13px;
                        background-color: #7db7b9;
                        font-size: 1.4rem;
                        letter-spacing: 2px;
                        color: black;
                    ">
                        '.$random.'
                    </span>
                ';
                if($mail -> send()) {
                    $json = array(
                        "status" => 200,
                        "msg" => "Gửi email thành công"
                    );
                    setcookie('send_to','send it back', time() + 45, "/");
                    $_SESSION['confirm'] = $random;
                    $_SESSION['user_id'] = $id_user;
                }

                $mail -> smtpClose();
            } else {
                $json = array(
                    "status" => 400,
                    "msg" => "Gửi email thất bại"
                );
            }

            echo json_encode($json);
        }
        
        if(
            isset($_GET['number1'])
            &&
            isset($_GET['number2'])
            &&
            isset($_GET['number3'])
            &&
            isset($_GET['number4'])
        ) {
            $json = [];
            $number1 = getGet('number1');
            $number2 = getGet('number2');
            $number3 = getGet('number3');
            $number4 = getGet('number4');

            if(isset($_SESSION['confirm'])&&isset($_SESSION['user_id'])) {
                $confirm = $_SESSION['confirm'];
                $user_id = $_SESSION['user_id'];
                $number = (string)$number1.(string)$number2.(string)$number3.(string)$number4;
                
                if(
                    $confirm === $number
                    &&
                    strlen($confirm) === strlen($number)
                    &&
                    (integer)$confirm === (integer)$number
                ) {
                    $_SESSION['check'] = 'success';
                    $json = array(
                        "status" => 200,
                        "msg" => "Success",
                    );
                } else {
                    $json = array(
                        "status" => 400,
                        "msg" => "Erorr",
                    );
                }

                echo json_encode($json);
            }
        }
    }

?>