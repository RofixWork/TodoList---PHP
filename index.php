<?php
include_once __DIR__ . "/Entities/Todo.php";
include_once __DIR__ . "/Entities/TodoManage.php";
include_once __DIR__ . "/partials/header.php";
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
        //create a new TODO
        $id = rand(100, 50000);
        $todo = new \Entities\Todo($id, $todo_name);
        echo "<pre>";
        \Entities\TodoManage::Create($todo);
        echo "</pre>";

    }
}
?>
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1>Add New Todo</h1>
            <form method="post">
                <div class="mb-3">
                    <input class="form-control <?= !empty($errors["todo_name"]) ? "is-invalid" : "" ?>" type="text" placeholder="Enter Here..." name="name" >
                    <div  class="invalid-feedback">
                        <?php echo $errors["todo_name"];?>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-primary">Add</button>
            </form>
<!--            create table-->
            <?php if(\Entities\TodoManage::GetAll()) { ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Todo Name</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach (\Entities\TodoManage::GetAll() as $Todo): ?>
                            <tr>
                                <th scope="row"><?= $Todo["Id"] ?></th>
                                <td><?= $Todo["TodoName"] ?></td>
                                <td><?= $Todo["CreatedDate"] ?></td>
                                <td>
                                    <a href="update.php?id=<?= $Todo["Id"] ?>" class="btn btn-primary">Update</a>
                                    <a href="delete.php?id=<?= $Todo["Id"] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    Not Exist Any Todos...
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include_once __DIR__ . "/partials/footer.php"?>


