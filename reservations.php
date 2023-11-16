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
                        <th>Customer Name</th>
                        <th>Room Number</th>
                        <th>Reservation Type</th>
                        <th>Reserved Date</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Adults</th>
                        <th>Children</th>
                        <th>Guaranteed</th>
                        <th>Meal</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Room Number</th>
                        <th>Reservation Type</th>
                        <th>Reserved Date</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Adults</th>
                        <th>Children</th>
                        <th>Guaranteed</th>
                        <th>Meal</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $sql = $db->prepare("SELECT reservations.id,rooms.name as room_name, room_id, CONCAT(first_name,' ',middle_name,' ',last_name) as customer_name, customer_id, reservation_types.name as reservation_type_name, reserved_date, checkin, checkout, adults, children, guaranteed, meal, reservations.remark
                            FROM reservations 
                                JOIN customers ON (reservations.customer_id = customers.id)
                                JOIN rooms ON (reservations.room_id = rooms.id)
                                JOIN reservation_types ON (reservation_type_id = reservation_types.id)
                            WHERE ISNULL(reservations.deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                            extract($data);
                            $guaranteed = $guaranteed?"Yes":"No";
                            $meal = $meal?"Yes":"No";
                            echo "
                               <tr>
                                    <td>$id</td>
                                    <td>$customer_name&nbsp;<button class='btn btn-sm btn-dark' type='button' ><span class='fas fa-eye' ></span></button></td>
                                    <td>$room_name&nbsp;<button class='btn btn-sm btn-dark' type='button' ><span class='fas fa-eye' ></span></button></td>
                                    <td>$reservation_type_name</td>
                                    <td>$reserved_date</td>
                                    <td>$checkin</td>
                                    <td>$checkout</td>
                                    <td>$adults</td>
                                    <td>$children</td>
                                    <td>$guaranteed</td>
                                    <td>$meal</td>
                                    <td>$remark</td>
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