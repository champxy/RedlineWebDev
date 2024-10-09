<?php

use Illuminate\Contracts\Session\Session;
use Kreait\Firebase\Contract\Database;
if (!function_exists('textFormat')) {
    function textFormat($text = '', $pattern = '', $ex = ''): string
    {
        $cid = ($text == '') ? '0000000000000' : $text;
        $pattern = ($pattern == '') ? '_-____-_____-__-_' : $pattern;
        $p = explode('-', $pattern);
        $ex = ($ex == '') ? '-' : $ex;
        $first = 0;
        $last = 0;
        for ($i = 0; $i <= count($p) - 1; $i++) {
            $first = $first + $last;
            $last = strlen($p[$i]);
            $returnText[$i] = substr($cid, $first, $last);
        }

        return implode($ex, $returnText);
    }
}

if (!function_exists('thai_date_short')) {
    function thai_date_short($time): bool|string
    {
        if ($time == null) {
            return false;
        }

        $thai_month_arr = [
            "0" => "",
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];
        $thai_date_return = " " . date("j", $time);
        $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
        $thai_date_return .= " " . (date("Y", $time) + 543);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date')) {
    function thai_date($time): bool|string
    {
        if ($time == null) {
            return false;
        }

        $thai_day_arr = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"];
        $thai_month_arr = [
            "0" => "",
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_day_arr[date("w", $time)];
        $thai_date_return .= " ที่ " . date("j", $time);
        $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
        $thai_date_return .= " พ.ศ. " . (date("Y", $time) + 543);

        return $thai_date_return;
    }
}

if (!function_exists('thai_month')) {
    function thai_month($time): bool|string
    {
        if ($time == null) {
            return false;
        }

        $thai_month_arr = [
            "0" => "",
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_month_arr[date("n", $time)];
        $thai_date_return .= " " . (date("Y", $time) + 543);

        return $thai_date_return;
    }
}

if (!function_exists('thai_month_only')) {
    function thai_month_only($time): bool|string
    {
        if ($time == null) {
            return false;
        }

        $thai_month_arr = [
            "0" => "",
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_month_arr[date("n", $time)];

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_time')) {
    function thai_date_time($time): bool|string
    {
        if ($time == null) {
            return false;
        }

        $thai_day_arr = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"];
        $thai_month_arr = [
            "0" => "",
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = $thai_day_arr[date("w", $time)];
        $thai_date_return .= " ที่ " . date("j", $time);
        $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
        $thai_date_return .= " พ.ศ. " . (date("Y", $time) + 543);
        $thai_date_return .= " เวลา " . (date("H", $time)) . ":";
        $thai_date_return .= date("i", $time);

        return $thai_date_return;
    }
}

if (!function_exists('thai_date_time_short')) {
    function thai_date_time_short($time): bool|string
    {
        if ($time == null) {
            return false;
        }

        $thai_day_arr = ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์"];
        $thai_month_arr = [
            "0" => "",
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $thai_date_return = date("j", $time);
        $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
        $thai_date_return .= " " . (date("Y", $time) + 543);
        $thai_date_return .= " " . (date("H", $time)) . ":";
        $thai_date_return .= date("i", $time);

        return $thai_date_return;
    }
}

if (!function_exists('month_name')) {
    function month_name($month = NULL): array|string
    {
        $thai_month_arr = [
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];
        if ($month != NULL) {
            return $thai_month_arr[$month];
        }

        return $thai_month_arr;
    }
}

if (!function_exists('getMonth')) {
    function getMonth($month): string
    {
        $m = [1 => "มกราคม", 2 => "กุมภาพันธ์", 3 => "มีนาคม", 4 => "เมษายน", 5 => "พฤษภาคม", 6 => "มิถุนายน", 7 => "กรกฎาคม", 8 => "สิงหาคม", 9 => "กันยายน", 10 => "ตุลาคม", 11 => "พฤศจิกายน", 12 => "ธันวาคม"];
        return $m[$month];
    }
}

if (!function_exists('m2t')) {
    function m2t($number): string
    {
        $number = number_format($number, 2, '.', '');
        $numberx = $number;
        $txtnum1 = ['ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ'];
        $txtnum2 = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
        $number = str_replace(",", "", $number);
        $number = str_replace(" ", "", $number);
        $number = str_replace("บาท", "", $number);
        $number = explode(".", $number);
        if (sizeof($number) > 2) {
            return 'ทศนิยมหลายตัวนะจ๊ะ';
            exit;
        }
        $strlen = strlen($number[0]);
        $convert = '';
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[0], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) and $n == 1) {
                    $convert .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) and $n == 2) {
                    $convert .= 'ยี่';
                } elseif ($i == ($strlen - 2) and $n == 1) {
                    $convert .= '';
                } else {
                    $convert .= $txtnum1[$n];
                }
                $convert .= $txtnum2[$strlen - $i - 1];
            }
        }

        $convert .= 'บาท';
        if (
            $number[1] == '0' or $number[1] == '00' or
            $number[1] == ''
        ) {
            $convert .= 'ถ้วน';
        } else {
            $strlen = strlen($number[1]);
            for ($i = 0; $i < $strlen; $i++) {
                $n = substr($number[1], $i, 1);
                if ($n != 0) {
                    if ($i == ($strlen - 1) and $n == 1) {
                        $convert
                            .= 'เอ็ด';
                    } elseif (
                        $i == ($strlen - 2) and
                        $n == 2
                    ) {
                        $convert .= 'ยี่';
                    } elseif (
                        $i == ($strlen - 2) and
                        $n == 1
                    ) {
                        $convert .= '';
                    } else {
                        $convert .= $txtnum1[$n];
                    }
                    $convert .= $txtnum2[$strlen - $i - 1];
                }
            }
            $convert .= 'สตางค์';
        }
        //แก้ต่ำกว่า 1 บาท ให้แสดงคำว่าศูนย์ แก้ ศูนย์บาท
        if ($numberx < 1) {
            $convert = "ศูนย์" . $convert;
        }

        //แก้เอ็ดสตางค์
        $len = strlen($numberx);
        $lendot1 = $len - 2;
        $lendot2 = $len - 1;
        if (($numberx[$lendot1] == 0) && ($numberx[$lendot2] == 1)) {
            $convert = substr($convert, 0, -10);
            $convert = $convert . "หนึ่งสตางค์";
        }

        //แก้เอ็ดบาท สำหรับค่า 1-1.99
        if ($numberx >= 1) {
            if ($numberx < 2) {
                $convert = substr($convert, 4);
                $convert = "หนึ่ง" . $convert;
            }
        }

        return $convert;
    }
}

if (!function_exists('alert')) {
    /**
     * @param string $type
     * @param string $mode
     * @param string $message
     * @param string $title
     */
    function alert($type, $mode, $message, $title = null): void
    {
        if ($type == 'alert') {
            session()->flash($type, $mode . '|' . $message);
        } elseif ($type == 'swal') {
            session()->flash($type, $mode . '|' . $title . '|' . $message);
        }
    }
}


if (!function_exists('Nameofuser')) {
    function Nameofuser($id)
    {
        $getuser = \App\Models\User::find($id);
        if ($getuser == null) {
            return (null);
        }
        return ($getuser->email);
    }
}




if (!function_exists('admin_check')) {
    function admin_check($session)
    {
        if(isset($session['user_type'])){
            if ($session['user_type'] !== 'admin') {
                return redirect('/login');
            }
        }else{
            return redirect('/login');
        }
    }
}


if (!function_exists('logout_user')) {
    function logout_user()
    {
        session()->forget('user_type');
        session()->forget('user_name');
        return redirect('/login');
    }
}

if (!function_exists('money_format')) {
    function money_format($format, $number){
        $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?' .
    
            '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
        if (setlocale(LC_MONETARY, 0) == 'C') {
    
            setlocale(LC_MONETARY, '');
        }
        $locale = localeconv();
        preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
        foreach ($matches as $fmatch) {
            $value = floatval($number);
            $flags = array(
                'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                    $match[1] : ' ',
                'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
                'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                    $match[0] : '+',
                'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
                'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
            );
            $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
            $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
            $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
            $conversion = $fmatch[5];
            $positive = true;
            if ($value < 0) {
                $positive = false;
                $value  *= -1;
            }
            $letter = $positive ? 'p' : 'n';
            $prefix = $suffix = $cprefix = $csuffix = $signal = '';
            $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
            switch (true) {
                case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                    $prefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                    $suffix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                    $cprefix = $signal;
                    break;
                case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                    $csuffix = $signal;
                    break;
                case $flags['usesignal'] == '(':
                case $locale["{$letter}_sign_posn"] == 0:
                    $prefix = '(';
                    $suffix = ')';
                    break;
            }
            if (!$flags['nosimbol']) {
                $currency = $cprefix .
                    ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                    $csuffix;
            } else {
                $currency = '';
            }
            $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';
            $value = number_format(
                $value,
                $right,
                $locale['mon_decimal_point'],
                $flags['nogroup'] ? '' : $locale['mon_thousands_sep']
            );
            $value = @explode($locale['mon_decimal_point'], $value);
            $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
            if ($left > 0 && $left > $n) {
                $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
            }
            $value = implode($locale['mon_decimal_point'], $value);
            if ($locale["{$letter}_cs_precedes"]) {
                $value = $prefix . $currency . $space . $value . $suffix;
            } else {
                $value = $prefix . $value . $space . $currency . $suffix;
            }
            if ($width > 0) {
                $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
    
                    STR_PAD_RIGHT : STR_PAD_LEFT);
            }
            $format = str_replace($fmatch[0], $value, $format);
        }
        return $format;
    }
}

