$(()=>{
    $("#alert").hide();
    $('.title').hide();
    $('.title2').hide();
});

$("#periodo").on('change',()=>{
let valor = $("#periodo").val();
open_modal(valor);
});

open_modal =(valor)=>{
  valor == 1? $("#search_year").modal('show'):$("#search_month").modal('show');
  
}



close_modal_2=()=>{
  $("#search_year").modal('hide');
  $("#periodo").val("");
  $(".year").val("");
}

close_modal_1=()=>{
  $("#search_month").modal('hide');
  $("#periodo").val("");
  $(".year").val("");
  $("#month").val("");
}


get_avg = () => {
   let search = $("#periodo").val();
   let data={};
   if(search==1){
    data = { year : $("#year1").val() ,period : $("#periodo").val()}
   }else{
    data = { year : $("#year").val(), month: $("#month").val() , period : $("#periodo").val()}
  }
   
  month_avg(data);
  
}

month_avg=(data)=>{
  console.log("entre ajax");
  console.log(data);
  $.ajax({
      data: { data },
      type: "POST",
      url: host_url + "module_kpi/kpi/avgProduction",
      crossOrigin: false,
      dataType: "json",
      success: (result) => {
        
          avg = parseInt(result[0].kpi_production);

          if(data.period == 2){
                
          $("#search_month").modal('hide');
          $(".title2").hide();
          $("#periodo").val("");
          cleanModal();
          drawProduction(avg);
          fillInput(data.year ,data.month,5,avg,data.period);
          
         }else {
          
          $("#search_year").modal('hide');
          $(".title").hide();
          $("#periodo").val("");
          cleanModal();
          drawProduction(avg);
          fillInput(data.year ,0,5,avg,data.period);

          }

          
      },
      error: (result) => {   
          swal({
              title: "Error",
              icon: "error",
              text: "No se encuentran registros en este período.",
          }).then(()=>{  
              swal.close();
              cleanModal();
           });
      },
  });
}

cleanModal =()=>{
$(".year").val("");
$("#month").val("");
}


$("#btn_month").on("click", get_avg);
$("#btn_year").on("click", get_avg);

fillInput=(year, month, ot , avg ,period )=>{

  if(period==2){

  $(".title").show();
  $("#year_info").val(year);
  $("#month_info").val(convertirMes(month));
  $("#ot_info").val(ot);
  $("#avg_info").val(avg);

  }else if(period==1){
    $(".title2").show();
    $("#year_info_2").val(year);
    $("#ot_info_2").val(ot);
    $("#avg_info_2").val(avg);

  }
  
}


convertirMes = (valor )=>{ 

  let mes ="";
  let meses = [{ mes:'Enero'},{ mes:'Febrero'},{ mes:'Marzo'},{ mes:'Abril'}
  ,{ mes:'Mayo'},{ mes:'Junio'},{ mes:'Julio'},{ mes:'Agosto'}
  ,{ mes:'Septiembre'},{ mes:'Octubre'},{ mes:'Noviembre'},{ mes:'Diciembre'}];

  meses.forEach((item,index)=>{
      if(index == ((parseInt(valor)-1))){ mes = item.mes ;}
  });

  return mes;
}



function drawProduction(avg) {

  var data = google.visualization.arrayToDataTable([
    ['Label', 'Value'],
    ['Producción',0],
   
  ]);

  var options = {
    width: 350,height: 300,
    greenFrom: 0, greenTo: 5,
    yellowFrom:5, yellowTo: 10,
    redFrom: 10, redTo: 15,
    min:0, max:15
    
  };

  var chart = new google.visualization.Gauge(document.getElementById('gaugeChart'));

  chart.draw(data, options);

    data.setValue(0, 1, avg);
    //data.setValue(0, 1, Math.round(Math.random()*10));
    chart.draw(data, options);
}

google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawQuotation);