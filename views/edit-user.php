<?php

session_start();
require "../classes/user.php";

// instantiate
$user_obj = new User;
$user = $user_obj -> getUser();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include "user-menu.php" ?>

<main class="row justify-content-center gx-0">
    <div class="col-4">
        <h2 class="text-center text-uppercase">Edit user</h2>
        <form action="../actions/edit-user.php" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center mb-3">
                <div class="col-6 text-center">
                    <?php if($user['photo']){ ?>
                        <img src="../assets/images/<?= $user['photo'] ?>" alt="<?= $user['photo'] ?>" class="d-block mx-auto edit-photo">
                        <?php }else{ ?>
                            <i class="fa-solid fa-user text-secondary text-center edit-icon"></i>
                    <?php } ?>
                    <input type="file" class="form-control mt-2" accept="image/*" name="photo">
                </div>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" required autodocus value="<?= $user['first_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" required autodocus value="<?= $user['last_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required autodocus value="<?= $user['username'] ?>">
            </div>
            <div class="text-end mt-3">
                <a href="dashboard.php" class="btn btn-secondary btn-sm px-5">Cancel</a>
                <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
            </div>
        </form>
    </div>
</main>

    

</body>
</html>