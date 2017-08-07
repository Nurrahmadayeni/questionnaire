

<!DOCTYPE html>
<html>
	<head>
  

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>

	
  <style>
    @page {max-height:100%; max-width:100%;}
    @media print {
    .bg-theme {
  background-color: #81b71a !important;
  border: 1px solid #81b71a;
  color: white;
}        
      body{
        overflow:visible;
      }
      #myChart,
    #myChart2, #myChart3 {
      width: 100%;
      height: 100%;    

    }

      .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
      .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
           float: left;     
           width: 100%;          
      }

      .col-md-12 {
           width: 100%;
      }

      .col-md-11 {
           width: 91.66666666666666%;
      }

      .col-md-10 {
           width: 83.33333333333334%;
      }

      .col-md-9 {
            width: 75%;
      }

      .col-md-8 {
            width: 66.66666666666666%;
      }

       .col-md-7 {
            width: 58.333333333333336%;
       }

       .col-md-6 {
            width: 50%;
       }

       .col-md-5 {
            width: 41.66666666666667%;
       }

       .col-md-4 {
            width: 33.33333333333333%;
       }

       .col-md-3 {
            width: 25%;
       }

       .col-md-2 {
              width: 16.666666666666664%;
       }

       .col-md-1 {
              width: 8.333333333333332%;
        }            
    }
  </style>
</head>

<body>
  <h1 class='text-center'>hgjghgjhjfejkgkjgjkg</h1>
  <br/>
  
      <div class='col-md-6'>
         gfghfhgfhgf
          <div id='myChart' class="pull-left"></div>
      </div>

      <div class='col-md-6'>
        <div id='' style='width:100%;height: 100%%;'>khkghkjkjjkgdkjgkdgfkdgf<br/>  kjdgfkjdgfkjdgfkjdgfdkfkjdfkjdfjkdgkdfkjgfkdjgfkjdgfkjdgfkg</div>
      </div>
 
      <div class='col-md-6'>
         gfghfhgfhgf
          <div id='myChart3' class="pull-left"></div>
      </div>

      <div class='col-md-6'>
        djgejdge
        <div id='myChart4' class="pull-left"></div>
      </div>
  
      <div class='col-md-6'>
         gfghfhgfhgf
          <div id='myChart5' class="pull-left"></div>
      </div>

      <div class='col-md-6'>
        djgejdgeffffffffffffffffffffffffffffffffffffffffff
        <div id='myChart6' class="pull-left"></div>
      </div>
  
      <div class='col-md-6'>
         gfghfhgfhgffeeeeeeeeee
          <div id='myChart7' class="pull-left"></div>
      </div>

      <div class='col-md-6'>
        djgejdge
        <div id='myChart8' class="pull-left"></div>
      </div>
 
      <div class='col-md-6'>
         gfghfhgfhgf
          <div id='myChart9' class="pull-left"></div>
      </div>

      <div class='col-md-6'>
        djgejdgefefefefefe
        <div id='myChart10' class="pull-left"></div>
      </div>
  
    
  
  <script>
    var myData = [24, 68, 48, 80, 40, 15, 30];

    var myConfig = {
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
          backgroundColor: '#50ADF5', // tampung warna di dalam array $a=array("red","green","blue","yellow",'banyakan lagi warna ny');
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
      id: 'myChart',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart2',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

     zingchart.render({
      id: 'myChart3',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart4',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart5',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart6',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart7',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart8',
      data: myConfig,
      height: "80%",
      width: "80%"
    });

    zingchart.render({
      id: 'myChart9',
      data: myConfig,
      height: "80%",
      width: "80%"
    });
    zingchart.render({
      id: 'myChart10',
      data: myConfig,
      height: "80%",
      width: "80%"
    });


    // var myData2 = [24, 68, 48, 80, 40, 15, 30];

    // var myConfig2 = {
    //   type: "pie", 
    //   plot: {
    //     borderColor: "#2B313B",
    //     borderWidth: 2,
    //     // slice: 90,
    //     valueBox: {
    //       placement: 'out',
    //       text: '%t\n%npv%',
    //       fontFamily: "Open Sans"
    //     },
    //     tooltip:{
    //       fontSize: '18',
    //       fontFamily: "Open Sans",
    //       padding: "5 10",
    //       text: "%npv%"
    //     }
    //   },
    //   plotarea: {
    //     margin: "10 0 0 0"  
    //   },
    //   series : [
    //     {
    //       values : [11.38],
    //       text: "Internet Explorer",
    //       backgroundColor: '#50ADF5',
    //     },
    //     {
    //       values: [56.94],
    //       text: "Chrome",
    //       backgroundColor: '#FF7965'
    //     },
    //     {
    //       values: [14.52],
    //       text: 'Firefox',
    //       backgroundColor: '#FFCB45'
    //     },
    //     {
    //       text: 'Safari',
    //       values: [9.69],
    //       backgroundColor: '#6877e5'
    //     },
    //     {
    //       text: 'Other',
    //       values: [7.48],
    //       backgroundColor: '#6FB07F'
    //     }
    //   ]
    // };

    // zingchart.render({
    //   id: 'myChart2',
    //   data: myConfig2,
    //   height: "80%",
    //   width: "80%"
    // });

    // var myConfig3 = {
    //   type: "pie", 
    //   plot: {
    //     borderColor: "#2B313B",
    //     borderWidth: 2,
    //     // slice: 90,
    //     valueBox: {
    //       placement: 'out',
    //       text: '%t\n%npv%',
    //       fontFamily: "Open Sans"
    //     },
    //     tooltip:{
    //       fontSize: '18',
    //       fontFamily: "Open Sans",
    //       padding: "5 10",
    //       text: "%npv%"
    //     }
    //   },
    //   plotarea: {
    //     margin: "10 0 0 0"  
    //   },
    //   series : [
    //     {
    //       values : [11.38],
    //       text: "Internet Explorer",
    //       backgroundColor: '#50ADF5',
    //     },
    //     {
    //       values: [56.94],
    //       text: "Chrome",
    //       backgroundColor: '#FF7965'
    //     },
    //     {
    //       values: [14.52],
    //       text: 'Firefox',
    //       backgroundColor: '#FFCB45'
    //     },
    //     {
    //       text: 'Safari',
    //       values: [9.69],
    //       backgroundColor: '#6877e5'
    //     },
    //     {
    //       text: 'Other',
    //       values: [7.48],
    //       backgroundColor: '#6FB07F'
    //     }
    //   ]
    // };

    // zingchart.render({ 
    //   id : 'myChart3', 
    //   data : myConfig3, 
    //   height: '80%', 
    //   width: '80%' 
    // });
  </script>
</body>

</html>
<script>
  window.load = print_d();
  function print_d(){
    window.print();
  }
</script>