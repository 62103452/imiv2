<!doctype html>
<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    </head>
  <body>
    <center><h1>62103452 Dararat Khanngang</h1></center>
  <div class="container">
     <div class="row">
        <div class="col-6">
          <canvas id="myChart" width="400" height="200"></canvas>
        </div>

      <div class="row">
        <div class="col-6">
          <canvas id="chart1" width="400" height="200"></canvas>
        </div>
      </div>

      </div>
      <div class="row">
        <div class="col-4">
          <div class="row">
              <div class="col-4">
                <b>Temperature</b>
              </div>
               <div class="col-8">
                  <b><span id="lastTempearature"></span></b>
               </div> 
          </div>

          <div class="row">
            <div class="col-4">
              <b>Humadity</b>
            </div>
             <div class="col-8">
                <b><span id="lastHumadity"></span></b>
             </div> 
        </div>
        <div class="row">
          <div class="col-4">
            <b>Update</b>  
          </div>
           <div class="col-8">
          <b><span id="lastUpdate"></span></b> 
           </div> 
      </div>

      </div>
  </div>
    
  </body>
  <script>

     function showChart(data,xlabel,id,label){      
        var ctx = document.getElementById(id).getContext('2d');
        var myChart = new Chart (ctx, 
        {
            type: 'line',
            data: {
                labels: xlabel,
                datasets: [{

                    label: label,
                    data: data,
                }]
            }
    
        });

      }
      
      function load(xlabel,data1,data2,url){
        $.getJSON(url,
        function( data) {
             let feeds = data.feeds;

              $("#lastTempearature").text(feeds[29].field2+" C");
              $("#lastHumadity").text(feeds[29].field1+" %");
              $("#lastUpdate").text(feeds[29].created_at);


        $.each(feeds, (k, v)=>{
              xlabel.push(v.entry_id);
              data1.push(v.field1);
              data2.push(v.field2);
        });
        });  
}

$(
    ()=>{
          var plot_data = Object();
          var xlabel=[];
          var data1=[];
          var data2=[];
          var id1 = 'myChart';  
          var id2 = 'chart1';
          var label1 = 'Humadity';
          var label2 = 'Tempearature';
          let url = " https://api.thingspeak.com/channels/1458744/feeds.json?results=30";
       
      load(xlabel,data1,data2,url);
      showChart(data1,xlabel,id1,label1);
      showChart(data2,xlabel,id2,label2); 
      })     
  </script>
  </script>
</html>
