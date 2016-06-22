<?php

function get_machine_status()
    {
        $linux = "top -b -n 2 -p0|grep -E \"(load|Cpu|Mem)\"|awk -F ': ' '{print $2}'";
        $OSX = 'top -l 2 -n 0 | grep -E "^(Load|CPU|PhysMem)"';

        $fp = popen(serverOS() ? $OSX : $linux, "r");//获取某一时刻系统cpu和内存使用情况
        $rs = "";
        while (!feof($fp)) {
            $rs .= fread($fp, 1024);
        }
        pclose($fp);
        $sys_info = explode("\n", $rs);

        foreach ($sys_info as $key => $item) {
            $sys_info[$key] = trim($item);
        }

        /*
         * the first sample displayed will have an invalid %CPU displayed for each process,  as
         * it is calculated using the delta between samples
         */
        if (serverOS()) {
            //负荷
            $load_avg = trim($sys_info[3], 'Load Avg: ');

            //CPU占有量
            $cpu_usage = trim($sys_info[4], 'CPU usage: ');  //百分比

            //内存占有量
            $mem_total = trim($sys_info[5], 'PhysMem: ');

            $load_avg = explode(", ", $load_avg);   //负荷
            $cpu_info = explode(", ", $cpu_usage);  //CPU占有量  数组
            $mem_info = explode(", ", $mem_total); //内存占有量 数组

            $cpu_info_key = [];
            foreach ($cpu_info as $value) {
                $key = explode(' ', $value)[1];
                $value = explode(' ', $value)[0];
                $cpu_info_key[$key] = $value;
            }

            $mem_info_key = [];
            foreach ($mem_info as $key => $value) {
                $mem_info_key['memory_info' . $key] = $value;
            }

            $load_avg_key = [];
            foreach ($load_avg as $key => $value) {
                $load_avg_key['load_avg' . $key] = $value;
            }
        } else {
            //负荷
            $load_avg = $sys_info[4];

            //CPU占有量
            $cpu_usage = $sys_info[5];

            //内存占有量
            $mem_total = $sys_info[6];

            $load_avg = explode(",", $load_avg);   //负荷
            $cpu_info = explode(",", $cpu_usage);  //CPU占有量  数组
            $mem_info = explode(",", $mem_total); //内存占有量 数组

            $cpu_info_key = [];
            foreach ($cpu_info as $key => $value) {
                if ($key == 0 || $key == 1 || $key == 3) {
                    $cpu_info_key = trim($value);
                }
            }

            $mem_info_key = [];
            foreach ($mem_info as $key => $value) {
                $mem_info_key['memory' . $key] = trim($value);
            }

            $load_avg_key = [];
            foreach ($load_avg as $key => $value) {
                $load_avg_key['load_avg' . $key] = trim($value);
            }

        }

        return ['cpu_usage' => $cpu_info_key, 'mem_usage' => $mem_info_key, 'load_avg' => $load_avg_key];
    }

