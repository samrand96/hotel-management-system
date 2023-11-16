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
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $sql = $db->prepare("SELECT id, name, remark
                                                 FROM reservation_types
                                                 WHERE ISNULL(deleted_at)");
                        $sql->execute();
                        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                            extract($data);
                            echo "
                                <tr>
                                    <td>{$id}</td>
                                    <td>{$name}</td>
                                    <td>{$remark}</td>
                                    <td><button class='btn btn-sm btn-warning edit_btn' type='button'><span class='fas fa-edit'></span>&nbsp;Edit</button>&nbsp;<button class='btn btn-sm btn-danger delete_btn' type='button'><span class='fas fa-trash'></span>&nbsp;Delete</button></td>
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