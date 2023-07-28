<div class="container">
    <div class="mt-5">

        <h1>Users!</h1>



        <!-- <form action="index.php?action=search">


            <div class="input-group mb-3 rounded-pill">
                <input type="text" name="search" class="form-control rounded-pill p-2 " value="<?php echo $search ?>"
                    placeholder="Search user">
                <button class="btn btn-outline-secondary btn-warning rounded-pill" type="submit"
                    id="button-addon2">Search</button>
            </div>
        </form> -->

        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">SL</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th>Join</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($users as $i => $user): ?>
                <tr class="text-center">
                    <th scope="row"><?= $i + 1 ?></th>
                    <td> <img class="rounded-circle border border-warning border-2" src="uploads/<?= $user->img ?>"
                            alt="IMG" width="50px" height="50px"></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->age ?></td>
                    <td><?= $user->create_at ?></td>
                    <td>

                        <!-- <form class="d-inline" action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?= $user->id ?>">
                            <button type="submit" class="btn btn-outline-danger"> Delete</button>
                        </form> -->

                        <a href="index.php?action=edit&id=<?php echo $user->id ?>"
                            class="btn btn-outline-success">Edit</a>
                        <a href="index.php?action=delete&id=<?php echo $user->id ?>"
                            class="btn btn-outline-danger">Delete</a>

                    </td>
                </tr>

                <?php endforeach; ?>


            </tbody>
        </table>
    </div>





</div>