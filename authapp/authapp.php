<?php

require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function connectionDatabase() {
    $connection = mysqli_connect('localhost','id18640754_firmanakbarmln','Q3w&c@@qa/CSSF*D','id18640754_api');
    if(!$connection){
        return die(mysqli_connect_error());
    }
    return $connection;
}

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class AuthApp
{
    public static $JWT_SECRET_KEY = "gqC239tcN39T180T3NC91TB9B3N08c18JNT9C148274928031CN380P1t91n491pc8nt410";

    public static function register($_nik, $_role){
        if($_nik != null and $_role != null){
            $nik = $_nik;
            if(strlen($nik) != 16){
                $response = Array(
                    'status'  => 'failed',
                    'message' => "please insert nik only 16 character!"
                );
                return json_encode($response);
            }
            else{
                $role = $_role;
                $password = generateRandomString();

                $dataDatabase = mysqli_query(connectionDatabase(), "SELECT * FROM data WHERE nik='$nik'");
                $fethedData = mysqli_fetch_array($dataDatabase);
                if(!@$fethedData['nik']){
                    mysqli_query(connectionDatabase(), "INSERT INTO data (nik,role,password) VALUES('$nik','$role','$password')");
                    $response = Array(
                        'status'  => 'success',
                        'message' => "'$nik', '$role' and '$password' inserted to database!"
                    );
                    return json_encode($response);
                }
                else{
                    $response = Array(
                        'status'  => 'failed',
                        'message' => "nik = '$nik' is exist in database!"
                    );
                    return json_encode($response);   
                }
            }
        }
        else{
            $response = Array(
                'status'  => 'failed',
                'message' => "please insert nik and role!"
            );
            return json_encode($response);
        }
    }

    public static function login($_nik, $_password){
        
        if($_nik != null and $_password != null){
            $nik = $_POST['nik'];
            $password = $_POST['password'];
            $data = mysqli_query(connectionDatabase(), "SELECT * FROM data WHERE nik='$nik'");
            $fetchData = mysqli_fetch_array($data);
            
            if($nik == $fetchData['nik'] AND $password == $fetchData['password']){
                $payload = array(
                    "id" => $fetchData['id'],
                    "nik" => $fetchData['nik'],
                    "role" => $fetchData['role']
                );

                $jwt = Firebase\JWT\JWT::encode($payload, AuthApp::$JWT_SECRET_KEY, 'HS256');
                setcookie('X-SESSION', $jwt , 0, "/", "firmanakbarm-api.000webhostapp.com", false, false);


                $payload['jwt'] = $jwt;
                $response = Array(
                    'status'  => 'success',
                    'message' => "login success!",
                    'data'  => $payload
                );
                return json_encode($response); 
            }
            else{
                $response = Array(
                    'status'  => 'failed',
                    'message' => "wrong nik or password!"
                );
                return json_encode($response);
            }
        }
        else{
            $response = Array(
                'status'  => 'failed',
                'message' => "please insert nik and role!"
            );
            return json_encode($response);
        }
        
    }

    public static function claim(){
        if(@$_COOKIE['X-SESSION']){
            $jwt = $_COOKIE['X-SESSION'];
            try{
                JWT::decode($jwt, new Key(AuthApp::$JWT_SECRET_KEY,'HS256'));
                $response = Array(
                    'status'  => 'success',
                    'message' => "jwt verified!"
                );
                return json_encode($response);
            }catch(Exception $exception){
                $response = Array(
                    'status'  => 'failed',
                    'message' => "jwt invalid!"
                );
                return json_encode($response);
            }
        }
        else{
            $response = Array(
                'status'  => 'failed',
                'message' => "user not login!"
            );
            return json_encode($response);
        }
    }
}




