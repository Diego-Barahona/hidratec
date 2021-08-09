

let kpi_quotation = 0;

const seccionesPagina = new fullpage ('#fullpage',{ 
    autoscrolling:true, 
    fitToSection: false,
    fitToSectionDelay:300,
    scrollingSpeed:300,
    easing:'easeInOutCubic',
    loopBottom:true,
    anchors: ['firstPage', 'secondPage', 'thirdPage'],
    sectionsColor: ['#34495E', '#34495E', '#FDFEFE'],
    slidesNavigation: true,
    navigation:true,
});

function drawQuotation() {
  
  var data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    ['Cotización',0],
   
  ]);

  var options = {
    width: 800,height: 600,
    greenFrom: 0, greenTo: 5,
    yellowFrom:5, yellowTo: 10,
    redFrom: 10, redTo: 15,
    min:0, max:15
    
  };

  var chart = new google.visualization.Gauge(document.getElementById('chart_quotation'));

  chart.draw(data, options);


  setInterval(function() {
       
       let xhr = new XMLHttpRequest();
	     xhr.open("get", `${host_url}/api/projector/kpiQuotation`);
	     xhr.responseType = "json";
	     xhr.addEventListener("load", () => {

	    	if (xhr.status === 200) {
			       response = xhr.response;
             kpi_quotation = parseInt(response.kpi_quotation);
          
		    } 
	});
  	xhr.send();
    data.setValue(0, 1, kpi_quotation);
    //data.setValue(0, 1, Math.round(Math.random()*10));
    chart.draw(data, options);
  }, 3000);
  
}

	
google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawQuotation);




function drawProduction() {

    var data = google.visualization.arrayToDataTable([
      ['Label', 'Value'],
      ['Producción',5]
     
    ]);
  
    var options = {
      width: 800, height: 600,
      greenFrom: 0, greenTo: 5,
      yellowFrom:5, yellowTo: 10,
      redFrom: 10, redTo: 15,
      min:0, max:15
      
    };
  
    var chart = new google.visualization.Gauge(document.getElementById('chart_production'));
  
    chart.draw(data, options);
  
   
    setInterval(function() {
      
      data.setValue(0, 1,6 );
      chart.draw(data, options);
    }, 3000);
    
  }
  
      
  google.charts.load('current', {'packages':['gauge']});
  google.charts.setOnLoadCallback(drawProduction);





 





