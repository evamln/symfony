<?php
namespace App\Enum;

enum PersonnagesEtat : string
    {
    case MORT = 'Mort';
    case VIVANT = 'Vivant';
    case INCONNU = 'Inconnu';
 } 
