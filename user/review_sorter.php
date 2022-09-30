<?php
session_start();

$sort_val= $_POST['sort'];
$text = $_POST['text'];

if($sort_val == '0')
{
    $sorter = 'date';
    $order = 'DESC';
   
    $_SESSION['sorter'] = $sorter;
    $_SESSION['order'] = $order;
    $_SESSION['text'] = $text;
  
}

if($sort_val == '1')
{
    $sorter = 'rating';
    $order = 'DESC';

    $_SESSION['sorter'] = $sorter;
    $_SESSION['order'] = $order;
     $_SESSION['text'] = $text;
   
}

if($sort_val == '2')
{
    $sorter = 'rating';
    $order = 'ASC';

    $_SESSION['sorter'] = $sorter;
    $_SESSION['order'] = $order;
    $_SESSION['text'] = $text;
}



?>