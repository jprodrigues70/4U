<?php
class Image {
    public static $allowedTypes = array(
        "image/gif",
        "image/jpeg",
        "image/png",
    );
    public $name;
    public $type;
    public $image;

    function __construct($image) {
        $this->name = md5(sha1(date('d-m-y H:i:s').$image['tmp_name']));
        $this->type = end((explode('/', $image['type'])));
        $this->image = imagecreatefromstring(file_get_contents($image['tmp_name']));
    }

    public function resize($width) {
        $x = imagesx($this->image);
        $y = imagesy($this->image);
        $height = $width * $y / $x;
        $new = imagecreatetruecolor($width, $height);
        imagecopyresampled($new /*destino*/, $this->image /*origem*/, 0, 0, 0, 0, $width, $height, $x, $y);
        $this->image = $new;
    }

    public function save($dir) {
        $dir .= $this->name.".".$this->type;
        $func = 'image'.$this->type;
        $func($this->image, $dir);
    }

    public static function validateType($type) {
        return in_array($type, self::$allowedTypes);
    }
}
?>