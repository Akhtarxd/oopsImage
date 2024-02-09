<?php
    include "config.php";
    $obj = new query;

    
    
    if(isset($_POST['submit']) && $_POST['name']!='' && $_POST['email']!='' && $_POST['mobile']!=''){
        $name = $obj->getSafeStr($_POST['name']);
        $email = $obj->getSafeStr($_POST['email']);
        $mobile = $obj->getSafeStr($_POST['mobile']);

            if(isset($_FILES['image']['name'])){
                $arr = explode(".", $_FILES['image']['name']);
                $ext = (trim(end($arr)));
                if( $ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
                    $upload_path = "Image/". time() . "." .$ext;
    
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);
                    $conditionArr = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'image'=>$upload_path];
                }else{
                    $conditionArr = ['name'=>$name,'email'=>$email,'mobile'=>$mobile];
                }
            }
        
       
        
        $obj->insertData('user',$conditionArr);
        
        header("location: viewUser.php");
    
    }


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
    <div class="container mt-3">
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php if(isset($name)) echo $name?>" aria-describedby="emailHelp" > 
        </div>
        
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if(isset($email)) echo $email?>" id="exampleInputPassword1" >
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mobile</label>
            <input type="tel" class="form-control" value="<?php if(isset($mobile)) echo $mobile?>" name="mobile" >
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>
</html>