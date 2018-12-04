<?php
include './simple_html_dom.php';
# Use the Curl extesion to query Google and get back a page of results
function getCurl($url)
{
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$url = "https://www.banglashoppers.com/hair-care-shop/hair-treatment.html";
$result = getCurl($url);

// print_r($result);
// exit();

$html = new simple_html_dom();
$html->load($result);

foreach($html->find('li[class="item product product-item"]') as $oil) {
    //echo $article;
    // $item = $article->find('a[class=product-item-link]')->plaintext;
// if (!empty($item[0])){
        
//         print_r($item);
//     }

    // $item['intro']    = $article->find('div.intro', 0)->plaintext;
    // $item['details'] = $article->find('div.details', 0)->plaintext;
    
   $articles[] = $oil->plaintext;
   // print_r($item['product-item-link']);
   
}
foreach ($articles as $productname){
    print_r("<li>".$productname."</li>");
}

exit(); 


     
//var_dump($html);
$a = array();
$b = array();
foreach ($html->find('table[id=company]') as $table) {
    //$tbody = $table->find('tbody');
    print_r($table->find('tr'));
    exit();
    foreach ($table->find('tr') as $tr) {
        $td = $tr->find('td');
        if (!empty($td[1])) {
            $a[] = $td[0]->text();
            $b[] = $td[1]->text();
        }
    }
}
$c = array_combine($a, $b);

echo '<li> Last Trading Price : ' . $c['Last Trading Price'];
echo '<li> Last Update : ' . $c['Last Update'];
echo '<li> Change : ' . $c['Change*'];
echo '<li> Opening Price : ' . $c['Opening Price'];
echo '<li> Adjusted Opening Price : ' . $c['Adjusted Opening Price'];
echo '<li> Yesterdays Closing Price : ' . $c['Yesterday\'s Closing Price'];

# To see all returned array key with value
# Uncomment this lines

 echo "<table><tr><th>Key</th><th>Value</th></tr>";
 if (!empty($c)) {
    foreach ($c as $x => $x_value) {
        echo "<tr><td>" . $x . "</td><td>" . $x_value . "</td></tr>";
    }
}
 echo "</table>";
