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
                        <th>ID</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Postal Code</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Postal Code</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $sql = $db->prepare("SELECT customers.id, `title`, `first_name`, `middle_name`, `last_name`, `gender`, `birthday`, customer_types.name as type_name, `email`, `phone`, `country`, `city`, `address`, `postalcode`,  `customers`.`remark` FROM `customers` JOIN customer_types ON (customers.type_id = customer_types.id) WHERE ISNULL(customers.deleted_by)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                            extract($data);
                            echo "
                               <tr>
                                    <td> $id </td>
                                    <td> $title </td>
                                    <td> $first_name </td>
                                    <td> $middle_name </td>
                                    <td> $last_name </td>
                                    <td> $gender </td>
                                    <td> $birthday </td>
                                    <td> $type_name </td>
                                    <td> $email </td>
                                    <td> $phone </td>
                                    <td> $country </td>
                                    <td> $city </td>
                                    <td> $address </td>
                                    <td> $postalcode </td>
                                    <td> $remark </td>
                                    <td><button class='btn btn-sm btn-danger delete_btn' type='button' ><span class='fas fa-trash' ></span>&nbsp;Delete</button></td>
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