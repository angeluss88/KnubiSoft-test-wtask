<?php
/**
 * Created by PhpStorm.
 * User: angelus
 * Date: 26.05.2016
 * Time: 16:28
 */
require('PolishExpression.php');

$pe = new PolishExpression();
$pe->expr = '15 3 / 11 + 3 5 * - 3.2 / 5.6 10 - *';


echo $pe->getResult();