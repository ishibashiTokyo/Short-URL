<?php

class SURL {
    private $code = '';
    private $row = [];

    // function __construct(){
    // }

    public function isCode( string $code = '' ):bool {
        $this->setCode($code);
        $this->row = $this->selectRecode();
        if ( empty($this->row) ){
            return (bool) false;
        }
        return (bool) true;
    }

    public function notFoundAndExit() {
        header("HTTP/1.1 404 Not Found");
        if ( file_exists(BASE_PATH . '../404.html') ){
            echo file_get_contents(BASE_PATH . '../404.html');
        }
        exit();
    }

    public function redirect(){
        $this->execCountUp();
        $this->execRedirect();
    }

    private function execCountUp():bool {
        return (bool) true;
    }

    private function execRedirect(){
        header( 'HTTP/1.1 ' . $this->row['http_status'] . ' ' . $this->transStatusInfo($this->row['http_status']) ); 
        header( 'Location: ' . $this->row['transfer_destination'] ); 
        exit;
    }

    private function selectRecode():array {
        // テストデータ
        return [
            'id'=> 1,
            'transfer_source' => $this->code,
            'transfer_destination' => 'https://saku.fun/',
            'http_status' => '302',
            'group_id' => 1,
            'enabled_flag' => 1,
            'delete_flag' => 0
        ];
    }

    private function setCode(string $code = '') {
        $this->code = $code;
    }

    /**
     * doc RFC 7231
     */
    private function transStatusInfo($http_status):string {
        switch ($http_status) {
            case '300':
                return 'Multiple Choices';
                break;
            case '301':
                return 'Moved Permanently';
                break;
            case '302':
                return 'Found';
                break;
            case '303':
                return 'See Other';
                break;
            case '304':
                return 'Not Modified';
                break;
            case '305':
                return 'Use Proxy';
                break;
            // case '306':
            //     break;
            case '307':
                return 'Temporary Redirect';
                break;
            case '308':
                return 'Permanent Redirect';
                break;
            default:
                # code...
                break;
        }
    }
}