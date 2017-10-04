<?php

namespace Service;


class apixuApiService
{

    /**
     * @var string
     */
    private $key = "c5389c6377b8428c9ae92900170310";
    private $baseUrl = "http://api.apixu.com/v1/";

    public function getWeatherForecast ($city, $days = 1)
    {

        $url = $this->baseUrl."forecast.json?key=$this->key&q=$city&days=$days&=";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $json_output=curl_exec($ch);

        return json_decode($json_output);
    }

    public function getAutocomplete ($string)
    {
        $url = $this->baseUrl."search.json?key=$this->key&q=$string";

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $json_output=curl_exec($ch);
        return json_decode($json_output);
    }

}