
var url = "https://api.nasa.gov/planetary/apod?hd=true&api_key=pcUo97Jqo7Yv7jCXBJFb7BwICA7kK25rKY26eTDi";


$.ajax({
  url: url,
  success: function(result){
  if("copyright" in result) {
    $("#copyright").text("Image Credits: " + result.copyright);
  }
  else {
    $("#copyright").text("Image Credits: " + "Public Domain");
  }
  
  if(result.media_type == "video") {
    $("#apod_img_id").css("display", "none"); 
    $("#apod_vid_id").attr("src", result.url);
  }
  else {
    $("#apod_vid_id").css("display", "none"); 
    $("#apod_img_id").attr("src", result.url);
  }
  $("#reqObject").text(url);
  $("#returnObject").text(JSON.stringify(result, null, 4));  
  $("#apod_explaination").text(result.explanation);
  $("#apod_title").text(result.title);
  $("#apod_date").text(result.date);
}
});

var apiKey = 'pcUo97Jqo7Yv7jCXBJFb7BwICA7kK25rKY26eTDi'; 

              document.addEventListener('DOMContentLoaded', submitButtonsReady);

              function submitButtonsReady(){
                document.getElementById('dateInput').addEventListener('click', function(event){
                  var request = new XMLHttpRequest();
                  var startDate = document.getElementById('startDateValue').value;
                  var endDate = document.getElementById('endDateValue').value;

                  var startDateArray = startDate.split("-");
                  var startDay = startDateArray[2];
                  var endDateArray = endDate.split("-");
                  var endDay = endDateArray[2];
                  startNum = Number(startDay);
                  endNum = Number(endDay);
                  var numDays = (endNum - startNum) + 1;

                  var tableHeader = document.getElementById("tableHeader");
                    var myNode = document.getElementById("tableHeader");
                    while (myNode.firstChild) 
                    {
                      myNode.removeChild(myNode.firstChild);
                    }

                  request.open('GET', 'https://api.nasa.gov/neo/rest/v1/feed?start_date=' + startDate +'&end_date='+ endDate +'&api_key=' + apiKey, true);
                  request.addEventListener('load',function(){
                   if(request.status >= 200 && request.status < 400){
                      var response = JSON.parse(request.responseText);
                      var neoObj = response.near_earth_objects;
                      
                      for(var count = 0; count < numDays; count++)
                      {
                        var NEOarray = neoObj[Object.keys(neoObj)[count]];
                        var NEOclose = NEOarray[Object.keys(NEOarray)[0]];
                        var NEOCAD = NEOclose.close_approach_data;
                        var NEOCADdate = NEOCAD[Object.keys(NEOCAD)[0]];
                        var capString = NEOCADdate.close_approach_date;


                        var newTable = document.createElement("table");
                        newTable.setAttribute('class', 'neoFeedList');
                        var tableCap = document.createElement("caption");
                        tableCap.textContent = "Date: " + capString;
                      for(var index = 0; index < NEOarray.length; index++)
                      {
                        var row1 = document.createElement("tr");
                        row1.setAttribute('class', 'neoFeedListHeader');
                        var header1 = document.createElement("th");
                        header1.textContent = "Object Name";
                        var header2 = document.createElement("th");
                        header2.textContent = NEOarray[count].name;
                        
                        var row2 = document.createElement("tr");
                        var data1 = document.createElement("td");
                        data1.setAttribute("id", "cell1");
                        data1.textContent = "Distance from Earth (kilometers)";
                        var data2 = document.createElement("td");
                        data2.textContent = NEOarray[count].close_approach_data[0].miss_distance.kilometers;

                        var row3 = document.createElement("tr");
                        var data3 = document.createElement("td");
                        data3.setAttribute("id", "cell1");
                        data3.textContent = "Classified Dangerous";
                        var data4 = document.createElement("td");
                        data4.textContent = NEOarray[count].is_potentially_hazardous_asteroid;

                        var row4 = document.createElement("tr");
                        var data5 = document.createElement("td");
                        data5.setAttribute("id", "cell1");
                        data5.textContent = "Estimated Diameter (kilometers)";
                        var data6 = document.createElement("td");
                        data6.textContent = NEOarray[count].estimated_diameter.kilometers.estimated_diameter_min;

                        var row5 = document.createElement("tr");
                        var data7 = document.createElement("td");
                        data7.setAttribute("id", "cell1");
                        data7.textContent = "Link";
                        var data8 = document.createElement("td");
                        var NEOlink = document.createElement("a");
                        var linkText = document.createTextNode("More Info On nasa.gov");
                        NEOlink.appendChild(linkText);
                        NEOlink.title = "Additional Info";
                        NEOlink.href = NEOarray[count].nasa_jpl_url;
                        NEOlink.target = "_blank";
                        data8.appendChild(NEOlink);



                        row1.appendChild(header1);
                        row1.appendChild(header2);

                        row2.appendChild(data1);
                        row2.appendChild(data2);

                        row3.appendChild(data3);
                        row3.appendChild(data4);

                        row4.appendChild(data5);
                        row4.appendChild(data6);

                        row5.appendChild(data7);
                        row5.appendChild(data8);

                        newTable.appendChild(tableCap);

                        newTable.appendChild(row1);
                        newTable.appendChild(row2);
                        newTable.appendChild(row3);
                        newTable.appendChild(row4);
                        newTable.appendChild(row5);

                      }

                      tableHeader.appendChild(newTable);
                      }
                    } 
                    else 
                    { 
                          console.log("Error in network request: " + request.statusText);
                     }});
                  request.send(null);
                  event.preventDefault();
                })
              }
