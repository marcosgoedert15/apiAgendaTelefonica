<?php

    class Db
    {
        public static function connect()
        {
            return new PDO(
                'mysql:host=localhost;dbname=agendatelefonica',
                'root',
                ''
            );
        }
    }

