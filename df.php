<?php

function df()
    {
        $fp = popen('df -lh | grep -E "^(/)"', "r");
        $rs = fread($fp, 1024);
        pclose($fp);
        $rs = preg_replace("/\s{2,}/", ' ', $rs);  //把多个空格换成 “_”
        $hd = explode(" ", $rs);
        $hd_size = trim($hd[1], 'G');
        $hd_used = trim($hd[2], 'G');
        $hd_avail = trim($hd[3], 'G');
        $hd_usage = trim($hd[4], '%');

        //检测时间
        $fp = popen("date +\"%Y-%m-%d %H:%M\"", "r");
        $rs = fread($fp, 1024);
        pclose($fp);
        $detection_time = trim($rs);

        return ['hd_size' => $hd_size, 'hd_used' => $hd_used, 'hd_avail' => $hd_avail, 'hd_usage' => $hd_usage, 'detection_time' => $detection_time];
    }