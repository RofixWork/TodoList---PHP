<?php
//Interface => Crud Opeartions [Create, Read, Update, Delete]
interface ICrud {
    public static function GetAll();
    public static function Create(\Entities\Todo $todo);
    public static function GetOne(int $id);
    public static function DeleteOne(int $id);
    public static function UpdateOne(int $id, $data);
}