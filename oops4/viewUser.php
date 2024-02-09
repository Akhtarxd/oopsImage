<?php
    include "config.php";

    $obj = new query;
    if(isset($_GET['type']) && $_GET['type']=='delete'){
        $id = $obj->getSafeStr($_GET['id']);
        $conditionArr = ['id' => $id];
        $obj->deleteData('user',$conditionArr);
    }

    $list = $obj->getdata('user','*');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <table class="table table-light table-hover mt-3">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Image</th>
                <th>Action</th>
                <th><a href="addUser.php" class="btn btn-primary">Add User</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(isset($list['0'])){
                $i = 1;          
                foreach($list as $row){               
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['mobile'] ?></td>
                <td><img src="<?php echo $row['image'] ?>" class="rounded-circle" width="50" height="50"></td>
                <td>
                    <a href="editUser.php?id=<?= $row['ID'] ?>" class="btn btn-primary">Edit</a>
                    <a href="viewUser.php?type=delete&id=<?=$row['ID']?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
                $i++;
                 }
                }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>