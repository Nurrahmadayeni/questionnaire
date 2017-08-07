<?php
    $level = $_SESSION['level'];
    if($level=="super"){ 
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel rounded shadow panel-theme">
            <div class="panel-heading">
                <div>
                    <h3 class="panel-title pull-left"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Profile</h3>  
                    <p class='pull-right'><a href='#addProfile' class='btn btn-default btn-sm addUser btn-push' data-toggle='modal'><i class='fa fa-plus'></i> Tambah Profile Skala</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id='response'></div>
            <div class="panel-body">
            	<table class='table table-responsive table-theme' id="data">
	                <thead>
	                    <tr class="text-center">
	                        <th class="text-center" width="5%">No</th>
	                        <th class="text-center">Profile</th>
	                        <th class="text-center">Skala</th>
	                        <th class="text-center">Value</th>
	                        <th class="text-center" data-hide="phone,tablet">Aksi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php
	                        $no=1;
	                        $query = "SELECT *from profile";
	                        $result = $mysqli->query($query);

	                        while ($row = $result->fetch_assoc()) {
	                            echo "<tr>";
	                            echo "<td class='text-center' data-hide='phone'>".$no."</td>";
	                            echo "<td>".$row['profile']."</td>";	                            
	                            echo "<td class='text-center'>".$row['skala']."</td>";
	                            echo "<td>".$row['value']."</td>";
	                            echo "
	                                <td class='text-center' data-hide='phone,tablet'>
	                            ";
	                            ?>
	                            	<a href="#editProfile" class="editProfile btn btn-sm brn-xs btn-primary btn-xs btn-push" data-toggle="modal" title="edit" data-id="<?php echo $row['id']; ?>"><i class='fa fa-pencil'></i> Edit Value </a>
	                                <a href='mods/backend/act.php?act=deleteProf&id=<?=$row[id]?>' title='Hapus Survey' class='btn btn-sm btn-danger btn-xs btn-push' onclick='return confirm_delete()'><i class='fa fa-trash'></i> Delete</a>
	                                </td>
	                            <?php
	                            echo "</tr>";
	                            $no++;
	                        }
	                    ?>
	                    
	                </tbody>
	                <tfoot>
	                    <tr>
	                    	<th data-hide="phone,tablet" class="text-center" width="5%">No</th>
	                        <th data-hide="phone,tablet" class="text-center">Profile</th>
	                        <th data-hide="phone,tablet" class="text-center">Skala</th>
	                        <th data-hide="phone,tablet" class="text-center">Value</th>
	                        <th data-hide="phone,tablet" class="text-center" data-hide="phone,tablet">Aksi</th>
	                    </tr>
	                </tfoot>
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