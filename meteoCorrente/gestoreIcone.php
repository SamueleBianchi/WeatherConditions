<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function setImage($s,$ss) {
    if ($s === "Clear")
        return "<div class='icons'><img src='icon/day.svg' height='200' width='200'></img></div>";
    if ($s ==="Clouds")
        return "<div class='icons'><img src='icon/cloudy.svg' height='200' width='200'></img></div>";
    if ($s === "Rain")
        return "<div class='icons'><img src='icon/rainy-6.svg' height='200' width='200'></img></div>";
    if ($s === "Drizzle")
        return "<div class='icons'><img src='icon/drizzle.png'></img></div>";
    if ($s === "Thunderstorm")
        return "<div class='icons'><img src='icon/thunder.svg' height='200' width='200'></img></div>";
    if ($s === "Snow")
        return "<div class='icons'><img src='icon/cloudy.svg' height='200' width='200'></img></div>";
    if ($s === "Mist")
        return "<div class='icons'><img src='icon/mist.png'></img></div>";
    if ($s === "Atmosphere") {
        if ($ss === "fog" || $ss === "haze" || $ss === "mist" || $ss === "smoke")
            return "<div class='icons'><img src='icon/haze.png'></img></div>";
        if ($ss === "sand" || $ss === "dust" || $ss === "sand, dust whirls")
            return "<div class='icons'><img src='icon/sand.png'></img></div>";
        if ($ss === "tornado" || $ss === "squalls")
            return "<div class='icons'><img src='icon/tornado.png'></img></div>";
    }

    if ($s === "Extreme") {
        if ($ss === "hot")
            return "<div class='icons'><img src='icon/hot.png'></img></div>";
        if ($ss === "cold")
            return "<div class='icons'><img src='icon/cold.png'></img></div>";
        if ($ss === "windy")
            return "<div class='icons'><img src='icon/windy.png'></img></div>";
        if ($ss === "tornado" || $ss === "tropical storms" || $ss === "hurricane")
            return "<div class='icons'><img src='icon/tornado.png'></img></div>";
        if ($ss === "hail")
            return "<div class='icons'><img src='icon/hail.png'></img></div>";
    }
}
