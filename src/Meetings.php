<?php 

namespace Gandhist\Zoom;
/**
* بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ (Bismillahirrahmanirrahim)
* Dengan menyebut nama Allah yang Maha Pengasih lagi Maha Penyayang 
* Library ini di buat untuk 
* > melakukan koneksi restfull API ke ZOOM
* > membuat meeting
* > menambah partisipant
* > NOTE ::
* > MAKE SURE YOU ALREADY INSTALL AND AUTHORIZE YOUR ZOOM ACCOUNT TO OAUTH
* REFERENCE : https://marketplace.zoom.us/docs/api-reference/using-zoom-apis
* crafted by Gandhi Tabrani ¯\_(ツ)_/¯
*/
class Meetings 
{



     /**
     * GET LIST MEETINGS
     * for body : read the docs @ https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetings
     * @param string $url it means end point
     * @param string $body
     * @return array
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function list($url, $body){
        $refresh = self::checkStatusCode();
        $token = $refresh['access_token'];
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => env('ZOOM_ENDPOINT').$url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            $result = json_decode($result, true);
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
        }
        return array_merge($data,$result);
     }

     /**
     * CREATE MEETINGS
     * for body : read the docs @ https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetings
     * @param string $url it means end point
     * @param string $body
     * @return array
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function createMeeting($url, $body){
        $refresh = self::checkStatusCode();
        $token = $refresh['access_token'];
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => env('ZOOM_ENDPOINT').$url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' .$token
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        $curl_options[CURLOPT_POST] = 1;
        $body_parsed = json_encode($body);
        $curl_options[CURLOPT_POSTFIELDS] = $body_parsed;
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            $result = json_decode($result, true);
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
        }
        return array_merge($data,$result);

     }

     /**
     * UPDATE MEETINGS
     * for body : read the docs @ https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetings
     * @param string $url it means end point
     * @param string $body
     * @return array
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function updateMeeting($url, $body){
        $refresh = self::checkStatusCode();
        $token = $refresh['access_token'];
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => env('ZOOM_ENDPOINT').$url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' .$token
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        $curl_options[CURLOPT_CUSTOMREQUEST] = 'PATCH';
        $body_parsed = json_encode($body);
        $curl_options[CURLOPT_POSTFIELDS] = $body_parsed;
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            // throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
            $err = new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
            $result = ['err' => $err];
        } else {
            $result = json_decode($result, true);
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
        }
        if($info['http_code'] == 204){
            return array_merge($data,$info);

        }
        else {
            return array_merge($data,$result);
        }

     }

     /**
     * DELETE MEETINGS
     * for body : read the docs @ https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetings
     * @param string $url it means end point
     * @param string NULLABLE $body
     * @return array
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function deleteMeeting($url, $body){
        $refresh = self::checkStatusCode();
        $token = $refresh['access_token'];
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => env('ZOOM_ENDPOINT').$url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        $curl_options[CURLOPT_CUSTOMREQUEST] = "DELETE";
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            $result = json_decode($result, true);
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
               
        }
        return array_merge($data,['response' => $result]);
        return array_merge($data);

        if(count($result) > 0){
        }
        else {
            return array_merge($data);
        }
     }

     /**
     * add meeting registrant
     * for body : read the docs @ https://marketplace.zoom.us/docs/api-reference/zoom-api/meetings/meetings
     * @param string $url it means end point
     * @param string $body
     * @return array
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function addRegistrant($url, $body){
        $refresh = self::checkStatusCode();
        $token = $refresh['access_token'];
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => env('ZOOM_ENDPOINT').$url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' .$token
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        $curl_options[CURLOPT_POST] = 1;
        $body_parsed = json_encode($body);
        $curl_options[CURLOPT_POSTFIELDS] = $body_parsed;
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            $result = json_decode($result, true);
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
        }
        return array_merge($data,$result);
     } 

     /**
     * GET ACCOUNT
     * need model ZoomCredentials for accessing refresh token from table zoom_credentials
     * row with grant_type 'access_token' must filled with credentials oauth from zoom api
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function getAccount(){
        $account_id = env('ZOOM_USERID');
        // $refresh = self::refreshToken();
        // if($refresh['http_code'] == 200) {
        //     $token = $refresh['access_token'];
        // }
        // else {
        //     $s = \App\Models\ZoomCredentials::where('grant_type', 'access_token')->first();
        //     $token = $s->access_token;
        // }
        $s = \App\Models\ZoomCredentials::where('grant_type', 'access_token')->first();
        $token = $s->token;
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => env('ZOOM_ENDPOINT')."users/".$account_id,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' .$token
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            $result = json_decode($result, true);
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
        }
        return array_merge($data,$result);
     }

    /**
     * REFRESH TOKEN
     * need model ZoomCredentials for accessing refresh token from table zoom_credentials
     */
    public static function checkStatusCode(){
        $getAccount = self::getAccount();
        switch ($getAccount['http_code']) {
            case '401':
                # unauthorized
                $refresh = self::refreshToken();
                return $refresh;
                break;
            default:
                # get current token
                $s = \App\Models\ZoomCredentials::where('grant_type', 'access_token')->first();
                $token = $s->token;
                return [
                    'access_token' => $token
                ];
                break;
        }
    }

    /**
     * REFRESH TOKEN
     * first check if while get user is 401 or unauthorized, so wi will request for refresh token
     * need model ZoomCredentials for accessing refresh token from table zoom_credentials
     * row with grant_type 'refresh_token' must filled with credentials oauth from zoom api
     * RESPONSES
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function refreshToken(){
        if(env('APP_ENV') == 'production'){
            $token = \App\Models\ZoomCredentials::where('grant_type', 'refresh_token')->first();
            $refresh_token = $token->token;
            $auth = base64_encode($token->client_id.":".$token->client_secret);
            $ch = curl_init();

            $curl_options = array(
                CURLOPT_URL => "https://zoom.us/oauth/token?grant_type=refresh_token&refresh_token=$refresh_token",
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'Authorization: Basic ' .$auth
                ),
                CURLOPT_RETURNTRANSFER => 1
            );
            $curl_options[CURLOPT_POST] = 1;
            curl_setopt_array($ch, $curl_options);
            $result = curl_exec($ch);
            $info = curl_getinfo($ch);
            if ($result === false) {
                throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
            } else {
                $result = json_decode($result, true);
                $data = [
                    'url' => $info['url'],
                    'http_code' => $info['http_code'],
                    'primary_ip' => $info['primary_ip'],
                    'local_ip' => $info['local_ip'],
                ];
                if($info['http_code'] != 401){
                    $token->refresh_token = $result['refresh_token'];
                    $token->token = $result['refresh_token'];
                    $token->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                    $token->save();
                    $dt_token = [
                        "refresh_token" => $result['refresh_token'],
                        "expires_in" => $result['expires_in'],
                        "scope" => $result['scope'],
                        "created_at" => \Carbon\Carbon::now()->toDateTimeString(),
                        "updated_at" => \Carbon\Carbon::now()->toDateTimeString()
                    ];
                    $access_token = \App\Models\ZoomCredentials::where('grant_type', 'access_token')->update(array_merge(['token' => $result['access_token']], $dt_token));
                    $refresh_token = \App\Models\ZoomCredentials::where('grant_type', 'refresh_token')->update(array_merge(['token' => $result['refresh_token']], $dt_token));
                }
                    \App\Models\ZoomCredentials::where('grant_type', 'refresh_token')->update([
                        "response" => json_encode(array_merge($data,$result))
                    ]);
                
            }
            return array_merge($data,$result);
         }
        
     }

    /**
     * REQUEST ACCESS TOKEN
     * need model ZoomCredentials for accessing refresh token from table zoom_credentials
     * row with 'authorization_code' must filled with credentials oauth from zoom api
     * @param string $authCode
     * @return array
     * url
     * http_code
     * primary_ip
     * local_ip 
     * {another zoom response}
     */
     public static function requestToken($authCode){
        $token = \App\Models\ZoomCredentials::where('grant_type', 'authorization_code')->first();
        $auth = base64_encode($token->client_id.":".$token->client_secret);
        // set body
        $body = [
            "grant_type" => $token->grant_type,
            "code" => $authCode,
            "redirect_uri" => $token->redirect_uri,
        ];
        $ch = curl_init();

        $curl_options = array(
            CURLOPT_URL => "https://zoom.us/oauth/token?grant_type=$token->grant_type&code=$authCode&redirect_uri=$token->redirect_uri",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' .$auth
            ),
            CURLOPT_RETURNTRANSFER => 1
        );
        $curl_options[CURLOPT_POST] = 1;
        curl_setopt_array($ch, $curl_options);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($result === false) {
            throw new \Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            $result = json_decode($result, true);

            
            $data = [
                'url' => $info['url'],
                'http_code' => $info['http_code'],
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
            if($info['http_code'] == 200){
                // update access_token and refresh_token
                $token = [
                    'refresh_token' => $result['refresh_token'],
                    'expires_in' => $result['expires_in'],
                    'scope' => $result['scope'],
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(), 
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(), 
                ];
                // array_merge(['token' => $result['access_token']], $token);
                // update access token
                \App\Models\ZoomCredentials::where('grant_type', 'access_token')->update(array_merge(['token' => $result['access_token']], $token));
                \App\Models\ZoomCredentials::where('grant_type', 'refresh_token')->update(array_merge(['token' => $result['refresh_token']], $token));
            }
            else {
                return array_merge($data,$result);
            }
            
        }
        return array_merge($data,$result);
     }

}
