<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $select1 = $_POST['sel'];
    switch ($select1) {
        case 'Precipitazioni':
            echo 'Precipitazzzzzz';
            break;
        case 'Umidità':
            echo 'vUmdiid';
            break;
        case 'Minima':
            echo 'min';
            break;
        case 'Massima':
            echo 'max';
            break;
        default:
            # code...
            break;
    }

