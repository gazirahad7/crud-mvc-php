<div class="container mt-5">


    <h4>Add an user</h4>

    <form class="row g-3 " action="index.php?action=store" method="POST" enctype="multipart/form-data">

        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Image</label>
            <input type="file" name="img" class="form-control" id="inputEmail4">


        </div>
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>

        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Age</label>
            <input type="number" name="age" class="form-control" required>

        </div>




        <div class="col-12">
            <button type="submit" class="btn btn-warning">Add</button>
        </div>
    </form>
</div>