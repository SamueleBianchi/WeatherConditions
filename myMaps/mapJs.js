function onInput() {
    var val = document.getElementById("input").value;
    var opts = document.getElementById('cities').childNodes;
    for (var i = 0; i < opts.length; i++) {
        if (opts[i].value === val) {
            search(opts[i].value);
            break;
        }
    }
}

function search(x) {
    for (i = 0; i < data.list.length; i++) {
        if (x === data.list[i].name) {
            mappa.flyTo(new L.LatLng(data.list[i].coord.Lat, data.list[i].coord.Lon), 9);
            flag[i].openPopup();
            break;
        }
    }
}
var posLon, posLat;

function initGeolocation()
{
    if (navigator.geolocation)
    {
        // Call getCurrentPosition with success and failure callbacks
        navigator.geolocation.getCurrentPosition(success, fail);
    } else
    {
        alert("Sorry, your browser does not support geolocation services.");
    }
}

function success(position)
{
    varLon = position.coords.longitude;
    varLat = position.coords.latitude;
}
function fail(){}

function setImage(s, ss) {
    if (s === "Clear")
        return "<i class='wi wi-day-sunny image'></i>";
    if (s ==="Clouds")
        return "<i class='wi wi-cloud image'></i>";
    if (s === "Rain")
        return "<i class='wi wi-rain image'></i>";
    if (s === "Drizzle")
        return "<i class='wi wi-raindrops image'></i>";
    if (s === "Thunderstorm")
        return "<i class='wi wi-thunderstorm image'></i>";
    if (s === "Snow")
        return "<i class='wi wi-snow image'></i>";
    if (s === "Mist")
        return "<i class='wi wi-fog image'></i>";
    if (s === "Atmosphere") {
        if (ss === "fog" || ss === "haze" || ss === "mist" || ss === "smoke")
            return "<i class='wi wi-fog image'></i>";
        if (ss === "sand" || ss === "dust" || ss === "sand, dust whirls")
            return "<i class='wi wi-dust image'></i>";
        if (ss === "tornado" || ss === "squalls")
            return "<i class='wi wi-tornado image'></i>";
        if (ss === "volcanic ash")
            return "<i class='wi wi-volcano image'></i>";
    }

    if (s === "Extreme") {
        if (ss === "hot")
            return "<i class='wi wi-thermometer image'></i>";
        if (ss === "cold")
            return "<i class='wi wi-thermometer-exterior image'></i>";
        if (ss === "windy")
            return "<i class='wi wi-strong-wind image'></i>";
        if (ss === "tornado" || ss === "tropical storms" || ss === "hurricane")
            return "<i class='wi wi-tornado image'></i>";
        if (ss === "hail")
            return "<i class='wi wi-day-showers image'></i>";
    }
}//fine set image

function showMore(o) {
    if (close[o]) {
        close[o] = false;
        document.getElementById(o).innerHTML = "<a class='underline' href='#' style='color:white'>Show less details <i id='w" + i + "' class='wi wi-wind towards-0-deg'></i></a>";
        document.getElementById("h" + o).style.opacity = "1";
        document.getElementById("h" + o).style.fontSize = "13px";
    } else {
        close[o] = true;
        document.getElementById(o).innerHTML = "<a class='underline' href='#' >Show more details <i id='w" + i + "' class='wi wi-wind towards-180-deg'></i></a>";
        document.getElementById("h" + o).style.opacity = "0";
        document.getElementById("h" + o).style.fontSize = "0px";
    }
}// fine showMore
function showPop(){
    document.getElementById("nascosto").style.opacity=1;
    setTimeout(noPop,2000);
}
function noPop(){
    document.getElementById("nascosto").style.opacity=0;
}

function recall(){
    mappa.flyTo(new L.LatLng(varLat,varLon), 9);
}

var day,day1,day2,day3,dayM1,dayM2,dayM3;
function setRange(){
    var mesi=["January","February","March","April","May","June","July","August","September","October","November","December"];
    day=new Date().getTime()- 86400000;
    day1=new Date().getTime() + 86400000- 86400000;
    day2=new Date().getTime() + 172800000- 86400000;
    day3=new Date().getTime() + 259200000- 86400000;
    dayM1=new Date().getTime() - 86400000- 86400000;
    dayM2=new Date().getTime() -172800000- 86400000;
    dayM3=new Date().getTime() - 259200000- 86400000;
    document.getElementById("rr").setAttribute("max",new Date(day3).getDate());
    document.getElementById("rr").setAttribute("min",new Date(dayM3).getDate());
    document.getElementById("rr").value=new Date(day).getDate();
    document.getElementById("vista").innerHTML=new Date(day).getDate()+" - "+ mesi[new Date(day).getMonth()];
    historyCall();
}
function vogliovedere(){
    var mesi=["January","February","March","April","May","June","July","August","September","October","November","December"];
    if(document.getElementById("rr").value == new Date(day).getDate())
        document.getElementById("vista").innerHTML=new Date(day).getDate() +" - "+mesi[new Date(day).getMonth()];
    if(document.getElementById("rr").value == new Date(day1).getDate())
        document.getElementById("vista").innerHTML=new Date(day1).getDate() +" - "+mesi[new Date(day1).getMonth()];
    if(document.getElementById("rr").value == new Date(day2).getDate())
        document.getElementById("vista").innerHTML=new Date(day2).getDate() +" - "+mesi[new Date(day2).getMonth()];
    if(document.getElementById("rr").value == new Date(day3).getDate())
        document.getElementById("vista").innerHTML=new Date(day3).getDate() +" - "+mesi[new Date(day3).getMonth()];
    if(document.getElementById("rr").value == new Date(dayM1).getDate())
        document.getElementById("vista").innerHTML=new Date(dayM1).getDate() +" - "+mesi[new Date(dayM1).getMonth()];
    if(document.getElementById("rr").value == new Date(dayM2).getDate())
        document.getElementById("vista").innerHTML=new Date(dayM2).getDate() +" - "+mesi[new Date(dayM2).getMonth()];
    if(document.getElementById("rr").value == new Date(dayM3).getDate())
        document.getElementById("vista").innerHTML=new Date(dayM3).getDate() +" - "+mesi[new Date(dayM3).getMonth()];
    historyCall()
}
function historyCall(){

    if(document.getElementById("rr").value == new Date(day).getDate())
       document.getElementById("ja").value=day;

    if(document.getElementById("rr").value == new Date(day1).getDate())
        document.getElementById("ja").value=day1;

    if(document.getElementById("rr").value == new Date(day2).getDate())
        document.getElementById("ja").value=day2;

    if(document.getElementById("rr").value == new Date(day3).getDate())
        document.getElementById("ja").value=day3;

    if(document.getElementById("rr").value == new Date(dayM1).getDate())
        document.getElementById("ja").value=dayM1;

    if(document.getElementById("rr").value == new Date(dayM2).getDate())
        document.getElementById("ja").value=dayM2;

    if(document.getElementById("rr").value == new Date(dayM3).getDate())
        document.getElementById("ja").value=dayM3;


}
