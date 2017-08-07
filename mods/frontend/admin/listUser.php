<?php
    $level = $_SESSION['level'];
    if($level=="super"){ 
?>
<div class="row">
    <div class="col-md-12">
        <a><label><h4 class="pull-left"><i class="fa fa-list" aria-hidden="true"></i> Daftar User Admin</h4></label></a>
        <a href='#addUser' class="btn btn-theme btn-sm btn-push pull-right" data-toggle="modal" ><i class="fa fa-plus-circle"></i> Tambah User </a>
        <hr class="title">
        
    </div>
</div>
<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-default rounded shadow">
	        <div class="panel-body">	
	        	   <table id="data" class="table table-responsive table-theme table-hover">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" width="12px">No</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th class="text-center" data-hide="phone,tablet">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $query = "SELECT *FROM users_auth ORDER BY created_date DESC";
                                $result = $mysqli->query($query);

                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='text-center' data-hide='phone'>".$no."</td>";
                                    echo "<td>".$row['username']."</td>";
                                    echo "<td>".$row['unit']."</td>";
                                    echo "<td>".$row['created_date']."</td>";
                                    echo "<td class='text-center'>";
                                        echo "
                                            <a href='#editUser' class='editUser' title='Ubah Username' data-id='$row[id]' data-toggle='tooltip' data-placement='top'><i class='fa fa-pencil'></i></a>
                                            <a href='#confirm-delete-user' class='delete_user' data-toggle='modal' data-placement='top' data-id='$row[id]'><span data-toggle='tooltip' data-placement='top' title='Hapus User'><i class='fa fa-trash'></i></span> </a>
                                        ";
                                   
                                    echo "</td></tr>";
                                    $no++;
                                }
                            ?>
                            
                        </tbody>
                    </table>
	        </div>
	    </div>
	</div>
</div>
<?php
    }else{
        echo"<script>
                document.location.href='?d=tampilan_error_pengguna_admin';
            </script>";
    }
?>