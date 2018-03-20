<?php
/**
 * Created by PhpStorm.
 * User: MehrdadEP
 * Date: 3/20/2018
 * Time: 3:16 PM
 */

require_once ('InstaPic.php');

$insta = new InstaPic();

echo $insta->getLargePhoto('mehrdad');
