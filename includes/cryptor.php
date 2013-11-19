<?php
class Cryptor
{
    // This is called when we wish to set a variable
    function __set($name, $value)
    {
        switch($name)
        {
            case 'key':
            case 'ivs':
            case 'iv':
            $this->$name = $value;
            break;

            default:
            throw new Exception("$name cannot be set");
        }
    }

    // Gettor - This is called when an non existant variable is called
    public function __get($name)
    {
        switch($name)
        {
            case 'key':
            return 'keee';

            case 'ivs':
            return mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);

            case 'iv':
            return mcrypt_create_iv($this->ivs);

            default:
            throw new Exception("$name cannot be called");
        }
    }

    public function encrypt($text)
    {
		if(!empty($text)) {
			// add end of text delimiter
			$data = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $text, MCRYPT_MODE_ECB, $this->iv);
			return base64_encode($data);
		}
		else {
			return $text;
		}
    }

    public function decrypt($text)
    {
		if(!empty($text)) {
			$text = base64_decode($text);
			return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $text, MCRYPT_MODE_ECB, $this->iv);
		}
		else {
			return $text;
		}
    }
}
?>