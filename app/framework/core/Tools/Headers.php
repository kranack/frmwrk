<?php

class Headers {

  private static $_HEADERS_TYPE = array(
    'txt' => 'text/plain',
    'htm' => 'text/html',
    'html' => 'text/html',
    'php' => 'text/html',
    'css' => 'text/css',
    'js' => 'application/javascript',
    'json' => 'application/json',
    'xml' => 'application/xml',
    'swf' => 'application/x-shockwave-flash',
    'flv' => 'video/x-flv',

    // images
    'png' => 'image/png',
    'jpe' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpeg',
    'gif' => 'image/gif',
    'bmp' => 'image/bmp',
    'ico' => 'image/vnd.microsoft.icon',
    'tiff' => 'image/tiff',
    'tif' => 'image/tiff',
    'svg' => 'image/svg+xml',
    'svgz' => 'image/svg+xml',

    // archives
    'zip' => 'application/zip',
    'rar' => 'application/x-rar-compressed',
    'exe' => 'application/x-msdownload',
    'msi' => 'application/x-msdownload',
    'cab' => 'application/vnd.ms-cab-compressed',

    // audio/video
    'mp3' => 'audio/mpeg',
    'qt' => 'video/quicktime',
    'mov' => 'video/quicktime',

    // adobe
    'pdf' => 'application/pdf',
    'psd' => 'image/vnd.adobe.photoshop',
    'ai' => 'application/postscript',
    'eps' => 'application/postscript',
    'ps' => 'application/postscript',

    // ms office
    'doc' => 'application/msword',
    'rtf' => 'application/rtf',
    'xls' => 'application/vnd.ms-excel',
    'ppt' => 'application/vnd.ms-powerpoint',

    // open office
    'odt' => 'application/vnd.oasis.opendocument.text',
    'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
  );

  private static $_HEADERS_RESP = array(
    '403' => 'Forbidden',
    '404' => 'Page Not Found',
    '418' => 'I\'m a teapot',
    '500' => 'Internal Server Error'
  );

  public static function set_content ($type) {
    if (in_array($type, array_keys(self::$_HEADERS_TYPE))) {
      return 'Content-Type: ' . self::$_HEADERS_TYPE[$type];
    } else {
      throw new HeaderTypeException;
    }
  }

  public static function save ($header) {
    header($header);
  }

  public static function set_response ($code) {
    if (in_array($code, array_keys(self::$_HEADERS_RESP))) {
      return 'HTTP/1.1 ' . $code . ' ' . self::$_HEADERS_RESP[$code];
    } else {
      throw new HeaderStatusException;
    }
  }

  public static function get_response ($code) {
    if (in_array($code, array_keys(self::$_HEADERS_RESP))) {
      return self::$_HEADERS_RESP[$code];
    } else {
      throw new HeaderStatusException;
    }
  }

  public static function set_charset ($charset) {
    return "charset=$charset";
  }

  public static function location ($url) {
    return "Location: $url";
  }

}
