<?php
    class Connect {
        protected static function start()
        {
            return new \PDO('mysql:host=localhost;dbname=4u', 'root', '');
        }
    }
?>
