<?php
require_once __DIR__ . "/Entities/TodoManage.php";
require_once __DIR__ . "/partials/header.php";
if(!isset($_GET["id"]) or empty($_GET["id"])) {
    include_once __DIR__ . '/partials/not_found.php';
    exit();
}

$todo = \Entities\TodoManage::GetOne($_GET["id"]);

if(empty($todo)) {
    include_once __DIR__ . '/partials/not_found.php';
    exit();
}
$errors = [
    "todo_name" => ""
];
$isValid = true;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $todo_name = $_POST["name"];

    if(empty($todo_name)) {
        $errors["todo_name"] = "please enter todoName";
        $isValid = false;
    }
    if($isValid) {
        echo "<pre>";
        $update_todo = ["TodoName" => $_POST["name"], "CreatedDate" => date_format(date_create("now"), "d-m-Y, h:i:s A")];
        \Entities\TodoManage::UpdateOne($todo["Id"], $update_todo);
        header("Location: index.php");
        echo "</pre>";
    }
}

?>
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1>Update Todo</h1>
            <form method="post">
                <div class="mb-3">
                    <input value="<?php echo empty($errors["todo_name"]) ? $todo["TodoName"] : ""?>" class="form-control <?= !empty($errors["todo_name"]) ? "is-invalid" : "" ?>" type="text" placeholder="Enter Here..." name="name" >
                    <div  class="invalid-feedback">
                        <?php echo $errors["todo_name"];?>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                <a href="index.php" class="btn btn-lg btn-dark">Back</a>
            </form>
        </div>
    </div>
</div>
