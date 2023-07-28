<div class="container mt-5">

    <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>

        <div><?php echo $error ?></div>

        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <a href="index.php" class="btn btn-warning">Go to home </a>
    <h4>Update an user is <b><?php echo $user['name']; ?></b></h4>



    <form class="row g-3 " action="index.php?action=update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">


        <?php if(!empty( $user['img'])): ?>

        <img src="uploads/<?php echo $user['img'] ?>" width="200px" height="200px" alt="IMG"
            class="rounded-circle border border-warning border-2 p-2" style="width: 150px; height: 150px;">

        <?php endif; ?>

        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Image</label>
            <input type="file" name="img" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Name</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" required>
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Age</label>
            <input type="number" name="age" value="<?php echo $user['age']; ?>" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-warning">Update</button>
        </div>
    </form>
</div>