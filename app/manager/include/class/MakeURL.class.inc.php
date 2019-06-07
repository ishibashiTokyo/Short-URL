<?php
class MakeURL
{
    private $base_strings = '';
    const ALPHANUMERIC = '0123456789';
    const UPPER_LETTER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const LOWER_LETTER = 'abcdefghijklmnopqrstuvwxyz';

    private $useAlphanumeric = true;
    private $useUpperLetter = true;
    private $useLowerLetter = true;

    private $length = 5;

    public function useAlphanumeric($isUse = true) {
        if ( $isUse ) $this->useAlphanumeric = true;
        else $this->useAlphanumeric = false;
    }

    public function useUpperLetter($isUse = true) {
        if ( $isUse ) $this->useUpperLetter = true;
        else $this->useUpperLetter = false;
    }

    public function useLowerLetter($isUse = true) {
        if ( $isUse ) $this->useLowerLetter = true;
        else $this->useLowerLetter = false;
    }

    private function baseStrings() {
        // 初期化
        $this->base_strings = '';

        if ( $this->useAlphanumeric )
            $this->base_strings .= self::ALPHANUMERIC;

        if ( $this->useUpperLetter )
            $this->base_strings .= self::UPPER_LETTER;

        if ( $this->useLowerLetter )
            $this->base_strings .= self::LOWER_LETTER;

        // なにも選択されていない場合はすべてを連結して返す
        if ( strlen($this->base_strings) === 0 )
            return self::ALPHANUMERIC . self::UPPER_LETTER . self::LOWER_LETTER

        return $this->base_strings;
    }

    public function setLength( $value = 5 ) {
        $this->length = intval($value);
    }


    public function checkPatterns(){
        echo strlen($this->baseStrings());
        return pow( strlen($this->baseStrings()), $this->length );
    }

    public function get()
    {
        return substr(str_shuffle(str_repeat($this->baseStrings(), $this->length)), 0, $this->length);
    }
}

// test code
// $MakeURL = new MakeURL;
// $MakeURL->useAlphanumeric(true);
// $MakeURL->useUpperLetter(true);
// $MakeURL->useLowerLetter(true);
// $MakeURL->setLength(10);
// echo 'Patterns: ' . $MakeURL->checkPatterns() . PHP_EOL;
// echo $MakeURL->get() . PHP_EOL;