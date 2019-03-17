<?php

/**
 * convert an url string to the needed format
 *
 * @param $string
 * @return string
 */
function convertStringUrl($string){

    $wasteValue = [3];
    $url = parse_url($string);

    $scheme = $url['scheme'];
    $host = $url['host'];
    $path = $url['path'];

    $query = explode('&', $url['query']);

    $params = getFilteredArrayFromString($query, $wasteValue);

    //sort params by value
    asort($params);

    //add path parameter from input link to array
    $params['url'] = $path;

    //form get params as a string
    $paramsString = http_build_query($params);

    //form a valid url as a string
    $result = $scheme . '://' . $host . '/?' . $paramsString;

    return $result;

}

/**
 * remove waste values from query string
 *
 * @param $string
 * @param $wasteValue
 * @return array
 */
function getFilteredArrayFromString($string, $wasteValue){
    $params = [];
    foreach ($string as $item) {
        $res = explode('=', $item);
        //delete params with value = '3'
        if (!in_array($res[1], $wasteValue)) {
            $params[$res[0]] = $res[1];
        }
    }
    return $params;
}

echo convertStringUrl('https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3');

/**
 *
 * В имеющейся строке  param1=1
 * В нужной строке param1=4
 * В задании ничего не было сказано об изменении значений параметров.
 * Посчитал это опечаткой, привел param1 к значению 4 в вызове функции
 * Удаление ненужных значений параметров выделил в отдельную функцию, так как возможно, что будет повторно где-то использоваться
 * Возможно нежелательных значений будет больше одного, поэтому в массиве.
 *
 */
