<?php

/**
 * @file Security.php
 * @author Damien Calesse
 * @date 23/07/2015
 * @description Security class for hashing and encrypt/decrypt password
 */

class Security {

  private static $_alphanum = "0123456789abcdef";

  /**
   * Hash function
   * @param algo : algorithm to use
   * @param data : data to hash
   * @return hash of the data or null if algo does not exist
   */
  public static function hash ($algo, $data) {
    if (!in_array(strtolower($algo), hash_algos())) {
      return null;
    }

    return hash($algo, $data);
  }


  /**
  * Encrypt function
  * @param algo : algorithm to use
  * @param data : data to encrypt
  * @param mode : mode to use for the encryption
  * @return array with encrypted data, key and iv size or null if the
  *         algo or mode does not exist
  */
  public static function encrypt ($algo, $data, $mode = "cbc") {
    if (!in_array(strtolower($algo), mcrypt_list_algorithms())) {
      return null;
    }

    if (!in_array(strtolower($mode), mcrypt_list_modes())) {
      return null;
    }

    $key = self::generate_random_key();
    $iv_size = mcrypt_get_iv_size($algo, $mode);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $ciphertext = base64_encode($iv . mcrypt_encrypt($algo, $key, $data, $mode, $iv));

    $r = array ("ciphertext" => $ciphertext, "key" => $key, "iv_size" => $iv_size);
    return $r;
  }

  /**
  * Decrypt function
  * @param ciphertext : data to decrypt
  * @param algo : algo to use
  * @param mode : mode used for the encryption
  * @param key : key used for the encryption
  * @param iv_size : iv size
  * @return decrypted text
  */
  public static function decrypt ($ciphertext, $algo, $mode, $key, $iv_size) {
    $_cipher = base64_decode($ciphertext);
    $iv_dec = substr($_cipher, 0, $iv_size);
    $ciphertext_dec = substr($_cipher, $iv_size);

    $r = mcrypt_decrypt($algo, $key, $ciphertext_dec, $mode, $iv_dec);
    return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $r);
  }

  public static function get_supported_algos () {
    return mcrypt_list_algorithms();
  }

  private static function generate_random_key () {
    $algo = '256';
    switch ($algo) {
      case '128' :
          $k = pack('H*', self::generate_random_hexa(16));
        break;
      case '192' :
          $k = pack('H*', self::generate_random_hexa(24));
        break;
      case '256' :
          $k = pack('H*', self::generate_random_hexa(32));
        break;
      default :
          return null;
        break;
    }

    return $k;
  }

  private static function generate_random_hexa ($size) {
    $str = '';
    $l = strlen(self::$_alphanum);
    for ($i = 0; $i < $size; $i++) {
      $str .= self::$_alphanum[rand(0, $l - 1)];
    }

    return $str;
  }

}
