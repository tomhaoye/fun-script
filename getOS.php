<?php

function getOS(){ 
 $os=''; 
 $Agent=$_SERVER['HTTP_USER_AGENT']; 
 if (mb_eregi('win',$Agent)&&strpos($Agent, '95')){ 
  $os='Windows 95'; 
 }elseif(mb_eregi('win 9x',$Agent)&&strpos($Agent, '4.90')){ 
  $os='Windows ME'; 
 }elseif(mb_eregi('win',$Agent)&&ereg('98',$Agent)){ 
  $os='Windows 98'; 
 }elseif(mb_eregi('win',$Agent)&&mb_eregi('nt 5.0',$Agent)){ 
  $os='Windows 2000'; 
 }elseif(mb_eregi('win',$Agent)&&mb_eregi('nt 6.0',$Agent)){ 
  $os='Windows Vista'; 
 }elseif(mb_eregi('win',$Agent)&&mb_eregi('nt 6.1',$Agent)){ 
  $os='Windows 7'; 
 }elseif(mb_eregi('win',$Agent)&&mb_eregi('nt 5.1',$Agent)){ 
  $os='Windows XP'; 
 }elseif(mb_eregi('win',$Agent)&&mb_eregi('nt',$Agent)){ 
  $os='Windows NT'; 
 }elseif(mb_eregi('win',$Agent)&&ereg('32',$Agent)){ 
  $os='Windows 32'; 
 }elseif(mb_eregi('linux',$Agent)){ 
  $os='Linux'; 
 }elseif(mb_eregi('unix',$Agent)){ 
  $os='Unix'; 
 }else if(mb_eregi('sun',$Agent)&&mb_eregi('os',$Agent)){ 
  $os='SunOS'; 
 }elseif(mb_eregi('ibm',$Agent)&&mb_eregi('os',$Agent)){ 
  $os='IBM OS/2'; 
 }elseif(mb_eregi('Mac',$Agent)&&mb_eregi('PC',$Agent)){ 
  $os='Macintosh'; 
 }elseif(mb_eregi('PowerPC',$Agent)){ 
  $os='PowerPC'; 
 }elseif(mb_eregi('AIX',$Agent)){ 
  $os='AIX'; 
 }elseif(mb_eregi('HPUX',$Agent)){ 
  $os='HPUX'; 
 }elseif(mb_eregi('NetBSD',$Agent)){ 
  $os='NetBSD'; 
 }elseif(mb_eregi('BSD',$Agent)){ 
  $os='BSD'; 
 }elseif(ereg('OSF1',$Agent)){ 
  $os='OSF1'; 
 }elseif(ereg('IRIX',$Agent)){ 
  $os='IRIX'; 
 }elseif(mb_eregi('FreeBSD',$Agent)){ 
  $os='FreeBSD'; 
 }elseif($os==''){ 
  $os='Unknown'; 
 } 
 return $os; 
} 
