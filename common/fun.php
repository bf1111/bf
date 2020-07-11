<?php

/**
 * js alert弹框信息
 *
 * @param [type] $msg 提示信息
 * @return void
 */
function alertExit($msg, $page)
{
    echo "<script>alert('" . $msg . "');window.location.href='" . $page . "'</script>";
    exit;
}

//长度截取
function subtext($text, $length = "100")
{
    if (mb_strlen($text, 'utf8') > $length) {
        return mb_substr($text, 0, $length, 'utf8') . '...';
    } else {
        return $text;
    }
}
