<?php include("model/dbconnection.php"); ?>
<?php include("_include/header.php"); ?>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        <?= $title ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th> ID </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $sql = $db->prepare("SELECT id,`full_name`, `username`, `email`, `permission` FROM `users` WHERE 1");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                            extract($data);
                            echo "
                               <tr>
                                    <td>$id</td>
                                    <td>$full_name</td>
                                    <td>$email</td>
                                    <td>$username</td>
                                    <td>$permission</td>
                                    <td><button class='btn btn-sm btn-danger delete_btn' type='button' ><span class='fas fa-trash' ></span>&nbsp;Delete</button>&nbsp;<button class='btn btn-sm btn-warning change_password' type='button' ><span class='fas fa-lock' ></span>&nbsp;Change Password</button></td>
                                </tr>
                            ";
                        }
                    ?>
                    
                                                            
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("_include/footer.php"); ?>