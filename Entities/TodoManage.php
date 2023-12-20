<?php
namespace Entities;
require_once __DIR__ . "/ICrud.php";

class TodoManage implements \ICrud
{
    private const FILE_URL = "C:\\xampp\\htdocs\\todolist\\todos\\todos.json";
    public static function GetAll()
    {
        $todos = file_exists(self::FILE_URL) ? file_get_contents(self::FILE_URL) : "[]";
        return json_decode($todos, TRUE);
    }
//    create todo
    public static function Create(\Entities\Todo $todo) : void
    {
        $todos = self::GetAll();

        $todos[] = $todo;

        file_put_contents(self::FILE_URL, json_encode($todos, JSON_PRETTY_PRINT));
    }
//get todo by ID
    public static function GetOne(int $id)
    {
        $todos = self::GetAll();

        foreach ($todos as $todo) {
            if($todo["Id"] == $id) {
                return $todo;
            }
        }
        return null;
    }
//delete todo by id
    public static function DeleteOne(int $id) : void
    {
        $todos = self::GetAll();
        $filter_todos = array_filter($todos, fn($todo) => $todo["Id"] !== $id);
        file_put_contents(self::FILE_URL, json_encode($filter_todos, JSON_PRETTY_PRINT));
    }

//    update todo By id
    public static function UpdateOne(int $id, $data) : void
    {
        $todos = self::GetAll();
        $update_todos = array_map(function ($todo) use ($id, $data) {
            if($todo["Id"] == $id) {
                $todo["TodoName"] = $data["TodoName"];
                $todo["CreatedDate"] = $data["CreatedDate"];
                return $todo;
            }
            return $todo;
        }, $todos);

        print_r($update_todos);
        file_put_contents(self::FILE_URL, json_encode($update_todos, JSON_PRETTY_PRINT));
    }
}