<!DOCTYPE HTML>
<html>
    <head>
        <title>PORTAL SURVEY USU</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="img/logo.png" />
        <link href="assets/css/layout.css" rel="stylesheet">
        <link href="assets/css/components.css" rel="stylesheet">
        <link href="assets/css/default.theme.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css">     
        <link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200" rel="stylesheet"> 
        <script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="assets/plugins/bootstrap/js/zingchart.min.js"></script>
		<style>
			body{
				font-family: 'Yanone Kaffeesatz', sans-serif;
			}
			.myChart{
		      height: 100%;
		      width: 100%;
		      min-height:15%;
		    }
			hr.style { 
              height: 30px; 
              border-style: solid; 
              border-color: #8c8b8b; 
              border-width: 2px 0 0 0; 
              border-radius: 20px; 
              margin-top: -5px;
            } 

            hr.style:before { 
              display: block; 
              height: 30px; 
              margin-top: -31px; 
              border-style: solid; 
              border-color: #8c8b8b; 
              border-width: 0 0 1px 0; 
              border-radius: 20px; 
            }			
            @media print {
	    		.bg-theme {
				  background-color: #81b71a !important;
				  border: 1px solid #81b71a;
				  color: white;
				}   
			    .myChart{
			      width: 100%;
			      height: 100%;    

			    }

			      .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
			      .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
			           float: left;     
			           width: 100%;        

			    }
			}
		</style>
	</head>
<body>
	<div class='container-fluid'>
	<?php 
		error_reporting(0);
		session_start();
		include('lib/config.php');
		$id_survey = base64_decode("$_GET[ids]");
		$ss = base64_decode("$_GET[ss]");

		$level = $_SESSION['level'];
		if($level=="fakultas" || $level=="unit" || $level=="super"){ 
			if($ss==1){
				$jdl = $mysqli->query("SELECT title from survey where id_survey='$id_survey'")->fetch_object()->title;
				// echo "<center><h3>LAPORAN SURVEY</h3></center>";
				// echo "<hr class='style'>";
				echo "
                <div class='row'>
                	<div class='col-md-3'></div>
                    <div class='col-md-3'>
                        <div class='mini-stat-type-4 bg-theme shadow'>
                            <h3>Judul Survey</h3>
                            <h5 style='text-align:justify;'>\" $jdl  \"</h5>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class='mini-stat-type-4 bg-theme shadow'>
                            <h2>Jumlah Responden</h2>
                            <h3>Total </h3>
                        </div>
                    </div>
                    <div class='col-md-3'></div>
                </div>";
                // <h3>\" ".$jdl." \"</h3>
				// echo "<h3>Judul Survey : <i>".$jdl. "</i></h3></br>";

					$q_d = " SELECT * FROM question where id_survey='$id_survey' group by id_q";
					// echo $q_d;
				    $data = $mysqli->query($q_d);

					$no=1;

					$total_user = $mysqli->query("SELECT count(username) as jlh_user FROM quest_user WHERE id_survey='$id_survey' group by id_q, id_survey")->fetch_object()->jlh_user;

					while($row = $data->fetch_assoc()) {
						echo $no.". ";
						echo $row['question']."<br/>";

						${'answer' . $no} = "";
						${'profile' . $no} = "";

						if($row['id_style_ans']==1){

			    			$val = explode(', ', $row['answer_value']);
			    			// print_r($val);
			    			// echo "count ". count($val);
			    			for($q=0; $q<=count($val)-1; $q++){
			    				if($q==count($val)-1){
			    					${'profile' . $no}.= '"'.$val[$q].'"';
			    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$id_survey' GROUP BY id_q, id_survey")->fetch_object()->jlh;
			    					
				    				if(isset($q_answer)){
										${'answer' . $no}.= number_format((($q_answer/$total_user)*100),2);
									}else{
										${'answer' . $no}.= "0";
									}							
			    				}else{
			    					${'profile' . $no}.= '"'.$val[$q].'"'. ", ";

			    					$eu = "SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$id_survey' GROUP BY id_q, id_survey";
			    					// echo "no last ".$eu;

			    					$q_answer = $mysqli->query("SELECT count(answer) as jlh FROM quest_user where answer='$val[$q]' and id_q='$row[id_q]' and id_survey='$id_survey' GROUP BY id_q, id_survey")->fetch_object()->jlh;
			    				
				    				if(isset($q_answer)){
										${'answer' . $no}.= number_format((($q_answer/$total_user)*100),2).", ";
									}else{
										${'answer' . $no}.= "0, ";
									}
			    				}
			    			}
			    			echo "<div class='myChart' id='myChart$no'></div>";
			    			// echo ${'answer' . $no}."<br/>";
			    			// echo ${'profile' . $no}."<br/>";
							echo "
								<script type='text/javascript'>
									var myData$no = [${'answer' . $no}];
									var myProfile$no = [${'profile' . $no}];
									// alert(myData1+myProfile1);
								</script>
							";
							echo "
							<script>
								var myConfig$no = {
								  'graphset': [{
								    'type': 'line',
								    'title': {
								      'text': 'Analisis (%)',
								      'font-size':'12pt'
								    },
								    'plot': {
									    'aspect': 'spline',
									    'tooltip': {
									      'text': '%v %',
									      'border-width': 1,
									      'border-radius': '9px',
									      'padding': '10%'							      
									    },
									    'value-box': {
							            	'text': '%v%',
										    'background-color': 'white',
										    'border-width': 1,
										    'border-color': '#666699',
										    'shadow': true,
										    'padding': '5%'
							          	}
									},
								    'scale-x': {
								      'labels': myProfile$no,
								      'line-color':'#555',
								      'item': {
						                    'font-angle': -45
						                }
								    },
								    'series': [{
								      'values': myData$no,
								      'background-color':'#81B71A', 
      								  'line-color': '#81B71A'
								    }]
								  }]
								};
							
								zingchart.render({
								  id: 'myChart$no',
								  data: myConfig$no,
								  height: '50%', 
      							  width: '50%' 
								});
							</script>
							";
						}else if($row['id_style_ans']==2){
			    			$val = explode(', ', $row['answer_value']);
			    			// echo "val ". count($val);

			    			$que_s = "SELECT answer FROM quest_user where id_style_ans='2' and id_q='$row[id_q]' and id_survey='$id_survey'";
							$style2 = $mysqli->query($que_s);

							$nilai = array();
							while($data_s = $style2->fetch_assoc()){
								// echo $data_s['answer']."<br/>";
								$e = explode(', ', $data_s['answer']);
								for($o=0; $o<=count($e)-1; $o++){
									// $val_e = '"'.$e[$o].'"';
									array_push($nilai, $e[$o]);
								}
							}
							// print_r(array_count_values($nilai));

			    			for($i=0; $i<=count($val)-1; $i++){
			    				if($i==count($val)-1){
			    					${'profile' . $no}.= '"'.$val[$i].'"';

			    					$counts = array_count_values($nilai);
			    					if(isset($counts[$val[$i]])){
			    						$value = $counts[$val[$i]];

			    						${'answer' . $no}.= number_format((($value/$total_user)*100),2);
			    					}else{
			    						${'answer' . $no}.= '0';
			    					}
			    				}else{
			    					${'profile' . $no}.= '"'.$val[$i].'"'. ", ";

			    					$counts = array_count_values($nilai);
			    					if(isset($counts[$val[$i]])){
			    						$value = $counts[$val[$i]];

			    						${'answer' . $no}.= number_format((($value/$total_user)*100),2).", ";
			    					}else{
			    						${'answer' . $no}.= '0, ';
			    					}

			    				}
			    			}
			    			
			    			echo "<div id='myChart$no' class='myChart'></div>";
			    			echo "<br/>";
			    			echo "
								<script type='text/javascript'>
									var myData$no = [${'answer' . $no}];
									var myProfile$no = [${'profile' . $no}];
									// alert(myData2+myProfile2);
								</script>
							";
							?>
							<script>
								var myConfig<?php echo $no; ?> = {
								  'graphset': [{
								    'type': 'line',
								    'plot': {
									    'aspect': 'spline',
									    'tooltip': {
									      'text': '%v %',
									      'border-width': 1,
									      'border-radius': '9px',
									      'padding': '10%'							      
									    },
									    'value-box': {
							            	'text': '%v%',
										    'background-color': 'white',
										    'border-width': 1,
										    'border-color': '#666699',
										    'shadow': true,
										    'padding': '5%'
							          	}
									},
								    'title': {
								      'text': 'Analisis (%)',
								      'font-size':'12pt'
								    },
								    'scale-x': {
								      'labels': myProfile<?php echo $no; ?>,
								      'line-color':'#555',
								      "item": {
						                    "font-angle": -45
						                }
								    },
								    'series': [{
								      'values': myData<?php echo $no; ?>,
								      'background-color':'#81B71A', 
      								  'alpha':0.5 
								    }]
								  }]
								};
								
								zingchart.render({ 
							      id : 'myChart<?php echo $no; ?>', 
							      data : myConfig<?php echo $no; ?>, 
							      height: '99%', 
							      width: '99%' 
							    });

							</script>

							 <div class='row'>
							      <div class='col-md-6'>
							         gfghfhgfhgf
							          <div id='myChartX' class='myChart' ></div>
							      </div>
							      <div class='col-md-6'>
							        djgejdge
							        <div id='myChartY' class='myChart' ></div>
							      </div>
							  </div>

							<script>
							  var myChartX = {
						      type: "pie", 
						      plot: {
						        borderColor: "#2B313B",
						        borderWidth: 2,
						        // slice: 90,
						        valueBox: {
						          placement: 'out',
						          text: '%t\n%npv%',
						          fontFamily: "Open Sans"
						        },
						        tooltip:{
						          fontSize: '18',
						          fontFamily: "Open Sans",
						          padding: "5 10",
						          text: "%npv%"
						        }
						      },
						      plotarea: {
						        margin: "10 0 0 0"  
						      },
						      series : [
						        {
						          values : [11.38],
						          text: "Internet Explorer",
						          backgroundColor: '#50ADF5',
						        },
						        {
						          values: [56.94],
						          text: "Chrome",
						          backgroundColor: '#FF7965'
						        },
						        {
						          values: [14.52],
						          text: 'Firefox',
						          backgroundColor: '#FFCB45'
						        },
						        {
						          text: 'Safari',
						          values: [9.69],
						          backgroundColor: '#6877e5'
						        },
						        {
						          text: 'Other',
						          values: [7.48],
						          backgroundColor: '#6FB07F'
						        }
						      ]
						    };

						    zingchart.render({ 
						      id : 'myChartX', 
						      data : myChartX, 
						      height: '99%', 
						      width: '99%' 
						    });

						    zingchart.render({ 
						      id : 'myChartY', 
						      data : myConfigX, 
						      height: '99%', 
						      width: '99%' 
						    });
						</script>
							<?php
						}else{
							$q_u = "SELECT answer FROM quest_user where id_q='$row[id_q]'";
			    			// echo $q_u;
			    			$data_qu = $mysqli->query($q_u);
			    			$jlh_user = $data_qu->num_rows;

			    			echo "<ul>";
			    			while ($answer_u = $data_qu->fetch_assoc()) {
			    				echo "<li>". $answer_u['answer']."</li>";
			    			}
			    			echo "</ul>";
						}
						$no++;
					}
			}
		}
		else{
			echo"<script>
	                document.location.href='?d=tampilan_error_pengguna_admin';
	            </script>";
		}

	?>

	</div>
	
<script>
	window.load = print_d();
	function print_d(){
		window.print();
	}
</script>
</body>
</html>