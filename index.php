<?php include("model/dbconnection.php"); ?>
<?php include("_include/header.php"); ?>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Customers</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="customers.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Reservations</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="reservations.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Rooms</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="rooms.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Users</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="users.php">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-users mr-1"></i>
        Latest Customers
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Remark</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $ret_customer = $db->prepare("SELECT customers.id,CONCAT(first_name,' ',middle_name,' ',last_name) as name, gender, email, customers.remark, phone, customer_types.name as type
                                                    FROM customers JOIN customer_types ON (customers.type_id = customer_types.id)
                                                    WHERE ISNULL(customers.deleted_at)
                                                    ORDER BY customers.id DESC");
                        $ret_customer->execute();
                        while($customers = $ret_customer->fetch(PDO::FETCH_ASSOC)){
                            extract($customers);
                            echo "<tr>
                                    <td>$name</td>
                                    <td>$gender</td>
                                    <td>$type</td>
                                    <td>$email</td>
                                    <td>$phone</td>
                                    <td>$remark</td>
                                   </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("_include/footer.php"); ?>