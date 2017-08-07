

<!DOCTYPE html>
<html>
	<head>
		<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
	
  <style>
    html,
    body,
    #myChart,
    #myChart2, #myChart3 {
      height: 100%;
      width: 100%;
      min-height:250px;
    }
  </style>
</head>

<body>
  gfghfhgfhgf
  <div id='myChart'></div>
  djgejdge
  <div id='myChart2'></div>
  dekjdkjeg
   <div id='myChart3'></div>
  <script>
    var myData = [24, 68, 48, 70, 40, 15, 30];

    var myConfig = {
      "graphset": [{
        "type": "line",
        "title": {
          "text": "Data Pulled from MySQL Database"
        },
        "scale-x": {
          "labels": ["Webster", "Parnel", "Dena", "Tyrell", "Martha", "Summer", "Linton"]
        },
        "series": [{
          "values": myData
        }]
      }]
    };

    zingchart.render({
      id: 'myChart',
      data: myConfig,
      height: "70%",
      width: "70%"
    });

    var myData2 = [24, 68, 48, 70, 40, 15, 30];

    var myConfig2 = {
      "graphset": [{
        "type": "line",
        "plot": {
          "value-box": {
            "text": "%v%"
          }
        },
        "title": {
          "text": "Data Pulled from MySQL Database"
        },
        "scale-x": {
          "labels": ["Webster", "Parnel", "Dena", "Tyrell", "Martha", "Summer", "Linton"]
        },
        "series": [{
          "values": myData2
        }]
      }]
    };

    zingchart.render({
      id: 'myChart2',
      data: myConfig2,
      height: "70%",
      width: "70%"
    });

    var myConfig3 = {
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
      id : 'myChart3', 
      data : myConfig3, 
      height: '70%', 
      width: '70%' 
    });
  </script>
</body>

</html>
<script>
  window.load = print_d();
  function print_d(){
    window.print();
  }
</script>