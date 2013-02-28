#!/usr/bin/php
<?php
$config = array(
  'mail_from' => 'username@example.com', //Who you want the emails to come from
  'mail_to' => 'username@example.com', // Who you want the emails to go to
  'mail_subject' => 'IP Address Auto-Updater' // The email subject
);
$ipfile = dirname(__FILE__) . '/current_ip.txt';
$stored_ip = file_get_contents($ipfile);
$raw_ip = file_get_contents('http://ip6.me');

// Trim IP based on HTML formatting
$pos = strpos( $raw_ip, '+3' ) + 3;
$ip = substr( $raw_ip, $pos, strlen( $raw_ip ) );

// Trim IP based on HTML formatting
$pos = strpos( $ip, '</' );
$ip = substr( $ip, 0, $pos );

if ($stored_ip != $ip)
{
  file_put_contents($ipfile, $ip);
  ob_start();
?>
The IP address of your home network has changed and the 

Raspberry Pi is therefore no longer accessible on the old IP. 

The new IP address is: <?php echo $ip; ?>
<?php
  $msg = ob_get_contents();
  ob_end_clean();
  mail($config['mail_to'],
       $config['mail_subject'],
	$msg,
        "From: ".$config['mail_from']."\r\n");
}
?>
