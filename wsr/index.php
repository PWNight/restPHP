<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: X-Requested-With');
	header('Content-Type: application/json');
    
    include_once('./class/users.php');
    include_once('./class/files.php');
    include('utils.php');

    $uri=$_SERVER['REQUEST_URI'];
    $uri_explode=explode('?',$uri);
    $link = explode('/',$uri_explode[0]);
    $method=$_SERVER['REQUEST_METHOD'];
    $cmd = $link[2];
    $sub_cmd = $link[3];

    $user = new Users();
    $file = new Files();
    //$utils = new Utils();

    session_start();
    
    switch($method){
        case 'GET':
                switch($cmd){
                    case 'logout':
                        if($_SESSION['token'] == Null){
                            echo $utils->message('403','Forbidden to you');
                            return $utils->message('403','Forbidden to you');
                        }
                        $user -> userLogout();
                        break;
                    case 'shared':
                        if($_SESSION['token'] == Null){
                            echo $utils->message('403','Forbidden to you');
                            return $utils->message('403','Forbidden to you');
                        }
                        $file -> getSharedUrl();
                        break;
                    case 'files':
                        switch($sub_cmd){
                            case 'disk':
                                if($_SESSION['token'] == Null){
                                    echo $utils->message('403','Forbidden to you');
                                    return $utils->message('403','Forbidden to you');
                                }
                                $file -> getDisk();
                                break;
                            default:
                                if($_SESSION['token'] == Null){
                                    echo $utils->message('403','Forbidden to you');
                                    return $utils->message('403','Forbidden to you');
                                }
                                $getData = file_get_contents('php://input');
                                $data = json_decode($getData, true);
                                $file->getFile($data);
                                break;
                        }
                        break;
                }
                break;
        case 'POST':
            switch($cmd){
                case 'authorization':
                    if($_SESSION['token'] != Null){
                        echo $utils->message('400','Already authorized');
                        return $utils->message('400','Already authorized');
                    }
                    $postData = file_get_contents('php://input');
                    $data = json_decode($postData, true);
                    $user->userLogin($data);
                    break;
                case 'registration':
                    if($_SESSION['token'] != Null){
                        echo $utils->message('400','Already authorized');
                        return $utils->message('400','Already authorized');
                    }
                    $postData = file_get_contents('php://input');
                    $data = json_decode($postData, true);
                    $user->userRegister($data);
                    break;
                case 'files':
                    switch($sub_cmd){
                        case 'access':
                            if($_SESSION['token'] == Null){
                                echo $utils->message('403','Forbidden to you');
                                return $utils->message('403','Forbidden to you');
                            }
                            $postData = file_get_contents('php://input');
                            $data = json_decode($postData, true);
                            $file->addAccess($data);
                            break;
                        default:
                            if($_SESSION['token'] == Null){
                                echo $utils->message('403','Forbidden to you');
                                return $utils->message('403','Forbidden to you');
                            }
                            $postData = file_get_contents('php://input');
                            $data = json_decode($postData, true);
                            $file->uploadFile($data);
                            break;
                    }
                    break;
            }
            break;
    }	