<?php
	$url = base64_decode($_GET['d']);
	if($_GET['d']!='dashboard_tampilan_home_pengguna' && $_SESSION['level']=='unit' || $_SESSION['level']=='fakultas' || $_SESSION['level']=="super"){
		?>
		<!-- <aside style='position: fixed; width: 100%' >
			<div class='row'>
				<div class='col-sm-1'>kjhkhkkjhhjgjgjhjjhgjhjghjgjhghjgjjhgjhgjh</div>
			</div>
		</aside> -->
		<div class="sidebar-nav-fixed affix" style='width: 16%; background-color: #2A2A2A; padding-bottom: 7%;height: 100%'>
            <aside id='sidebar-left' class='sidebar-circle'>
			    <ul id='tour-9' class='sidebar-menu '>
			    	<li class='submenu' style='padding-top: 5%; padding-bottom: 3%; background-color: black;color:white;'>
			    		<a href="?d=<?=base64_encode("dashboard_tampilan_home_pengguna")?>">
                            <span class="icon"><i class="fa fa-home"></i></span>
	                        <span>BERANDA</span>
	                    </a>
                    </li>
                    <li <?php if($url=='tambah_survey_pengguna_admin'){echo "class='active'"; } ?>>
				        <a href='?d=<?=base64_encode("tambah_survey_pengguna_admin")?>'>
			                <span class='icon'><i class='fa fa-plus-circle'></i></span>
			                <span class='text'>Tambah Survey Baru</span>
			            </a>
		            </li>
                    <li <?php if($url=='list_survey_pengguna_admin'){echo "class='active'"; } ?>>
		            	<a href='?d=<?= base64_encode("list_survey_pengguna_admin"); ?>'>
			                <span class='icon'><i class='fa fa-list'></i></span>
			                <span class='text'>Daftar Survey</span>
			            </a>
		            </li>	
		            <?php  
		            if($_SESSION['level']!='super'){
		            	?>
		            <li <?php if($url=='jawab_survey_pengguna_admin'){echo "class='active'"; } ?>>
		            	<a href='?d=<?=base64_encode("jawab_survey_pengguna_admin")?>'>
			                <span class='icon'><i class='fa fa-check-square-o'></i></span>
			                <span class='text'>Jawab Survey</span>
			            </a>
		            </li>
		            <?php } ?>
		            <li <?php if($url=='report_survey_pengguna_admin'){echo "class='active'"; } ?>>
		            	<a href='?d=<?=base64_encode("report_survey_pengguna_admin")?>'>
			                <span class='icon'><i class='fa fa-bar-chart'></i></span>
			                <span class='text'>Laporan Survey</span>
			            </a>
		            </li>
		            <?php  
		            if($_SESSION['level']=='super'){
		            	?>
		            	<li <?php if($url=='daftar_user_admin_superuser'){echo "class='active'"; } ?>>
			            	<a href='?d=<?=base64_encode("daftar_user_admin_superuser")?>'>
				                <span class='icon'><i class='fa  fa-list-alt'></i></span>
				                <span class='text'>Daftar User Admin</span>
				            </a>
			            </li>
			            <?php 
		            }
		            ?>
		        </ul>
		    </aside>
        </div>
		
    <?php
	}
	?>