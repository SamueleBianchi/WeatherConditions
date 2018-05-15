<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function setImage($s,$ss) {
    if ($s === "Clear")
        return "<div class='icons'><img src='icon/sole.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    if ($s ==="Clouds")
        return "<div class='icons'><img class='icone' src='icon/nuvole.jpg' height='260' width'350' style='border-radius: 5px;'></img></div>";
    if ($s === "Rain")
        return "<div class='icons'><img src='icon/pioggia.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    if ($s === "Drizzle")
        return "<div class='icons'><img src='icon/pioggierella.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    if ($s === "Thunderstorm")
        return "<div class='icons'><img src='icon/fulmini.svg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    if ($s === "Snow")
        return "<div class='icons'><img src='icon/neve.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    if ($s === "Mist")
        return "<div class='icons'><img src='icon/nebbia2.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    if ($s === "Fog")
        return "<div class='icons'><img src='icon/nebbia2.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    
    if ($s === "Atmosphere") {
        if ($ss === "fog" || $ss === "haze" || $ss === "mist" || $ss === "smoke")
            return "<div class='icons'><img src='icon/nebbia2.jpg'  style='border-radius: 5px;'></img></div>";
        if ($ss === "sand" || $ss === "dust" || $ss === "sand, dust whirls")
            return "<div class='icons'><img src='icon/sand.png'></img></div>";
        if ($ss === "tornado" || $ss === "squalls")
            return "<div class='icons'><img src='icon/torn.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
    }

    if ($s === "Extreme") {
        if ($ss === "hot")
            return "<div class='icons'><img src='icon/caldo.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
        if ($ss === "cold")
            return "<div class='icons'><img src='icon/freddo.jpg' height='260' width='350' style='border-radius: 5px;'></img></div>";
        if ($ss === "windy")
            return "<div class='icons'><img src='icon/windy.png' height='200' width='200'></img></div>";
        if ($ss === "tornado" || $ss === "tropical storms" || $ss === "hurricane")
            return "<div class='icons'><img src='icon/tornado.png' height='200' width='200'></img></div>";
        if ($ss === "hail")
            return "<div class='icons'><img src='icon/hail.png' height='200' width='200'></img></div>";
    }
}
