<?php

class Model extends Database
{

    public function __construct()
    {
    }

    /**
     * Upload overwrite image
     * @param $field
     * @param array $config
     * @return false|string
     */
    public function upload($field, $config = array())
    {
        $options = array(
            'name' => '',
            'upload_path' => './',
            'allowed_exts' => '*',
            'overwrite' => TRUE,
            'max_size' => 0
        );
        $options = array_merge($options, $config);
        if (!isset($_FILES[$field])) return FALSE;
        $file = $_FILES[$field];
        if ($file['error'] != 0) return FALSE;
        $temp = explode(".", $file["name"]);
        $ext = end($temp);
        if ($options['allowed_exts'] != '*') {
            $allowedExts = explode('|', $options['allowed_exts']);
            if (!in_array($ext, $allowedExts)) return FALSE;
        }
        $size = $file['size'] / 1024 / 1024;
        if (($options['max_size'] > 0) && ($size > $options['max_size'])) return FALSE;

        $name = time() . '_' . (('' == $options['name']) ? $options['name'] . '.' . $ext : $file["name"]);
        $file_path = $options['upload_path'] . $name;
        if ($options['overwrite'] && file_exists($file_path)) {
            unlink($file_path);
        }

        move_uploaded_file($file["tmp_name"], $file_path);
        return $file_path;
    }

    /**
     * Convert slug
     * @param $str
     * @return array|string|string[]
     */
    public static function slug($str)
    {
        $str = self::convert_name($str);
        $str = strtolower($str); //mb_strtolower($str, 'UTF-8');
        $str = str_replace(' ', '-', $str);
        return $str;
    }

    /**
     * Change string to slug format
     * @param $str
     * @return array|string|string[]|null
     */
    public function convert_name($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }
}