<?php
    function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function lookForTwitterLink($website)
    {
        $doc = new DOMDocument();
        @$doc->loadHTML($website);
        $elements = $doc->getElementsByTagName('a');
        foreach($elements as $item) {
            $link = $item->getAttribute('href');
            if(strpos($link,'twitter'))
                echo "<h1>I FOUND $link</h1>";
        }
        //echo "<h1> NOT FOUND :(</h1>";
    }
    $website = curl("https://foodgawker.com/");
    echo $website;
//lookForTwitterLink($website);
