<?php
header("Content-type: text/xml");
    //** Bước 1: Khởi tạo request
    $ch = curl_init(); 

    //** Bước 2: Thiết lập các tuỳ chọn
    // Thiết lập URL trong request
   // $ch, CURLOPT_URL, "codehub.vn"); 

    // Thiết lập để trả về dữ liệu request thay vì hiển thị dữ liệu ra màn hình
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "https://auth.spiderum.com/global-identity?redirectUrl=https://spiderum.com/hot?page=1");

    // ** Bước 3: thực hiện việc gửi request
    $output = curl_exec($ch); 
    // ** Bước 4 (tuỳ chọn): Đóng request để giải phóng tài nguyên trên hệ thống
    curl_close($ch);
$url= strstr($output, 'http');
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_URL, $url);
$rss = curl_exec($ch1);
curl_close($ch1);
$dau = 1;
$i = 0;
$items = '';
while ($i <15 ){
$get1 = strstr($rss, '<h3 class="title"');
$dau = strpos($rss, 'a href="/bai-dang/', $dau);
$cuoi = strpos($rss, '">',$dau);
$get3 = substr($rss, $dau + 8, $cuoi - $dau -8);
$dau = $cuoi;
$i = $i +1;
$items .= '<item>';
$items .= "<title>" . $i . "</title>";
$items .= "<link>https://spiderum.com" . $get3 . "</link>";
$items .= "<description> abc </description>";
$items .= "<guid>https://spiderum.com" . $get3 . "</guid>";
$items .= '</item>'; 
}
echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
  <channel>
    <title>Kindle RSS</title>
    <description>Spiderum</description>
    <language>vi_VN</language>
    '.$items.'
  </channel>
</rss>';
?>
