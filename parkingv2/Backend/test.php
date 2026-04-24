<?php
require "../includes/db.php";


$currenttime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
$previoustime = new DateTime('2023-5-7 12:22:12');
$output = $currenttime->diff($previoustime);
echo $output->format('%m months %d days %h hours %i minutes %s seconds');
echo "<br>";

if ($output->format('%m') == 0) {
    if ($output->format('%d') == 0) {
        echo $output->format('%h hours %i minutes %s seconds');
    } else {
        $total_hours = $output->format('%d') * 24 + $output->format('%h');
        echo $total_hours . ' hours ' . $output->format('%i minutes %s seconds');
    }
} else {
    $total_hours = $output->format('%m') * 30 * 24 + $output->format('%d') * 24 + $output->format('%h');
    echo $total_hours . ' hours ' . $output->format('%i minutes %s seconds');
}
?>