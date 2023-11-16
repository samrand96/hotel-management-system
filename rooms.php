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
                        <th>Name</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Accommodation</th>
                        <th>Price</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Accommodation</th>
                        <th>Price</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $sql = $db->prepare("SELECT
                                                rooms.id,
                                                rooms.name,
                                                status,
                                                room_types.name as type_name,
                                                room_locations.name as location_name,
                                                room_accommodations.name as accommodation_name,
                                                price,
                                                rooms.remark
                                            FROM rooms
                                                JOIN room_types ON (rooms.type_id = room_types.id)
                                                JOIN room_locations ON (rooms.location_id = room_locations.id)
                                                JOIN room_accommodations ON (rooms.accommodation_id = room_accommodations.id)
                                            WHERE ISNULL(rooms.deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                            extract($data);
                            $color = $status=="FREE"?"bg-primary":"bg-warning";
                            $btn_type = $status=="FREE"?"reserve_btn":"free_btn";
                            $btn_cont = $status=="FREE"?"Reserve":"Free";
                            echo "
                               <tr>
                                    <td> $id </td>
                                    <td> $name </td>
                                    <td> <span class='badge $color'>$status</span> </td>
                                    <td> $type_name </td>
                                    <td> $location_name </td>
                                    <td> $accommodation_name </td>
                                    <td> $price </td>
                                    <td> $remark </td>
                                    <td><button class='btn btn-sm btn-danger delete_btn' type='button' ><span class='fas fa-trash' ></span>&nbsp;Delete</button>&nbsp;<button class='btn btn-sm btn-primary $btn_type' type='button'><span class='fas fa-unlock' ></span>&nbsp;$btn_cont</button></td>
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