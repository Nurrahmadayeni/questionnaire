<?php
    // error_reporting(0);
    // include('../../lib/config.php');
?>


<!-- Persentase -->
<div id="diagram" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Hasil Survey</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-theme" data-dismiss="modal">Tutup</button>
          </div>
        </div>
    </div>
</div>    


<!-- Persentase -->
<div id="prev_donwload" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>   

<!-- Tambah User Admin -->
<div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah User Admin</h4>
            </div>
            <div class="modal-body">
                <div id='response'></div>
                <form id='form_addUser' action="#" method="post" >
                    <div class="form-group">
                        <label for="skala" class="control-label">Username / NIK: </label>
                        <input type="text" class='form-control' id='username_user' name='username' placeholder="input NIK pegawai" required>
                    </div>
                    <div class="form-group">
                        <label for="skala" class="control-label">Unit: </label>
                        <select class="form-control select2 mb-15" multiple="multiple" placeholder="-- Pilih Unit Kerja --" style="width: 100%;" name='unit' id='unit_user' required>
                        <option value="" disabled="">-- Pilih Unit Kerja --</option>
                        <?php include 'admin/listUnFac.php' ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-theme btn-push" value="Save" id="save">
                        <input type="reset" class="btn btn-danger btn-push" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>       

<!-- Tambah Profile Skala -->
<div id="addProfile" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Profile Skala</h4>
            </div>
            <div class="modal-body">
                <form id='form_addProfileSkala' action="#" method="post" >
                  <div class="form-group">
                    <label for="skala" class="control-label">Skala: </label>
                    <select class="form-control mb-15" id='jlh_skala' name='skala' required="">
                        <option value="" selected="" disabled="">-- Pilih Skala --</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                  </div>
                  <div id='input_profile'>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-theme" value="Save" id="save">
                    <input type="reset" class="btn btn-default" value="Reset">
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for EditProfile-->
<div id="editProfile" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Value Profile Skala</h4>
            </div>
            <div class="modal-body">                            
            </div>
        </div>
    </div>
</div>  

<!-- Modal for EditQst-->
<div id="editQst" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ubah Pertanyaan</h4>
            </div>
            <div class="modal-body">                            
            </div>
        </div>
    </div>
</div>  

<!-- Modal for EditUser-->
<div id="editUser" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ubah NIK</h4>
            </div>
            <div class="modal-body">                            
            </div>
        </div>
    </div>
</div>  

<!-- Modal for showChosen-->
<div id="show_value_chosen" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pilihan Jawaban</h4>
            </div>
            <div class="modal-body">                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-theme" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>  

<!-- Logout -->
<div class="modal fade modal-theme" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id ="myModalLabel">Konfirmasi Keluar</h4>
        </div>
        <div class="modal-body">Apakah anda yakin ingin keluar dari sistem ini?
        </div>
        <div class="modal-footer">
            <?php  
                use parinpan\fanjwt\libs\JWTAuth;
                $logoutLink = JWTAuth::makeLink([
                    'baseUrl' => 'https://akun.usu.ac.id/auth/logout',
                    'redir' => 'https://survey.usu.ac.id',
                    'callback' => 'https://survey.usu.ac.id/callback.php',
                ]);
            ?>
            
            <form action="<?=$logoutLink?>" method="post">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button class="btn btn-theme">Ya</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- StyleAnswe -->
<div class="modal fade modal-theme" id="style_answer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog vertical-align-center modal-lg">
        <div class="modal-content ">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id ="myModalLabel">Jenis Pilihan Jawaban</h4>
        </div>
        <div class="modal-body">
            <table class="table table-hover table-theme">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Jawaban</th>
                        <th>Contoh</th>
                    </tr>
                </thead>
                <tbody>

                <?php 
                    $query = "SELECT * from style_ans";
                    $data = $mysqli->query($query); 

                    $no=1;
                    while ($s = $data->fetch_assoc()) {
                        echo "<tr>
                            <td>$no</td>
                            <td>$s[style_ans]</td>
                            <td>";
                            if($s['id_style_ans']==1){
                                // Satu Jawaban Banyak Pilihan
                                echo "<i>urutan dari terendah</i>
                                <br/>1. 
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input id='radio-primary' type='radio' name='radio'>
                                    <label for='radio-primary'>Pilihan 1</label>
                                </div>
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input id='radio-primary2' type='radio' name='radio'>
                                    <label for='radio-primary2'>Pilihan 2</label>
                                </div>
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input id='radio-primary3' type='radio' name='radio' required >
                                    <label for='radio-primary3'>Pilihan 3</label>
                                </div>
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input id='radio-primary4' type='radio' name='radio' required >
                                    <label for='radio-primary4'>Pilihan 4</label>
                                </div>
                                <br/>
                                ";
                                echo "
                                2.
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input id='radio-primary5' type='radio' name='radio'>
                                    <label for='radio-primary5'>Ya</label>
                                </div>
                                <div class='rdio radio-inline rdio-theme rounded'>
                                    <input id='radio-primary6' type='radio' name='radio'>
                                    <label for='radio-primary6'>Tidak</label>
                                </div>
                                ";
                            }else if($s['id_style_ans']==2){
                                //Banyak Jawaban Banyak Pilihan
                                echo "
                                <div class='ckbox ckbox-theme'>
                                    <input id='1' class='sampel' type='checkbox' name='sampel[]' value='mhs'>
                                    <label for='1' class='control-label'>Pilihan 1</label>
                                </div>
                                <div class='ckbox ckbox-theme'>
                                    <input id='2' class='sampel' type='checkbox' name='sampel[]' value='dsn'>
                                    <label for='2' class='control-label'>Pilihan 2</label>
                                </div>
                                <div class='ckbox ckbox-theme'>
                                    <input id='3' class='sampel' type='checkbox' name='sampel[]' value='pgw'>
                                    <label for='3' class='control-label'>Pilihan 3</label>
                                </div>
                                ";

                            }else if($s['id_style_ans']==3){
                                //angka
                                echo "<input type='number' class='form-control' value='input angka' required>";

                            }else if($s['id_style_ans']==4){
                                //text
                                echo "<input type='text' class='form-control' required>";

                            }else if($s['id_style_ans']==5){
                                //text
                                echo "<textarea class='form-control' rows='2'></textarea>";
                            }
                        echo "</td>
                        </tr>";
                        $no++;
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-theme" data-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal for EditSurvey-->
<div id="editSurvey" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ubah Survey</h4>
            </div>
            <div class="modal-body">                            
            </div>
        </div>
    </div>
</div>  

<!-- Delete QST -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
                <form method="post" action='#' id='delQst'>
                <input type="hidden" name="qst" id="qst" value=""/>
                <input type="hidden" name="srv" id="srv" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-push" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok btn-push">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Survey -->
<div class="modal fade" id="confirm-delete-survey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
                <form method="post" action='#' id='delSrv'>
                <input type="hidden" name="srv" id="srv" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-push" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok btn-push">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete user -->
<div class="modal fade" id="confirm-delete-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data ini?</p>
                <form method="post" action='#' id='delUser'>
                <input type="hidden" name="id" id="id" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-push" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok btn-push">Hapus</a>
            </div>
        </div>
    </div>
</div>