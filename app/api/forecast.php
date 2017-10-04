<?php
namespace api;
header('Content-Type: application/json');

include(dirname(__DIR__) . '/Kernel.php');

use Exception;
use Service\Transformer\forecastRequestTransformer;
use Service\weatherService;

class forecastController
{

    /**
     * @return string
     */
    public function render()
    {
        try {
            $params = $this->getRequestParameters();
        } catch (Exception $e) {
            return json_encode($this->handleError($e));
        }

        $results = $this->getWeatherService()->getForecastResults($params);

//        $response['posts'] = $this->getInstaPostTransformer()->postsToArray($response['posts']);
        return json_encode($results);
    }


    private function getRequestParameters() {
        $request = [
            'city'          => (isset($_GET['city'])) ? $_GET['city'] : null,
            'start_date'    => (isset($_GET['start_date'])) ? $_GET['start_date'] : null,
            'end_date'      => (isset($_GET['end_date'])) ? $_GET['end_date'] : null
        ];

        $transformedRequest = $this->getForecastRequestTransformer()->hydrate($request);

        return $transformedRequest;
    }

    /**
     * @return weatherService
     */
    private function getWeatherService()
    {
        return new weatherService();
    }

    /**
     * @return forecastRequestTransformer
     */
    private function getForecastRequestTransformer()
    {
        return new forecastRequestTransformer();
    }

    /**
     * @param Exception $e
     * @return array
     */
    private function handleError(Exception $e)
    {
        return [
            'error_code' => $e->getCode(),
            'error_message' => $e->getMessage()
        ];
    }

}

//$controller = new forecastController();
//echo $controller->render();


echo '{
	"location" : {
		"name": "Valetta",
		"country": "Malta",
		"latitude": 35.9,
		"longtitude": 14.51
	},
	"weather" : [
		{
			"date": "2017-10-03",
			"day": "Monday",
			"temperature" : 22,
			"condition": "Patchy light rain with thunder",
			"icon": "http://kaputt.com/assets/weather/sun-cloud.png"
		},
		{
			"date": "2017-10-04",
			"day": "Tuesday",
			"temperature" : 24,
			"condition": "Patchy light rain with thunder",
			"icon": "http://kaputt.com/assets/weather/rain.png"
		},
		{
			"date": "2017-10-05",
			"day": "Wednsday",
			"temperature" : 20,
			"condition": "Patchy light rain with thunder",
			"icon": "http://kaputt.com/assets/weather/sunny.png"
		}
	],
	"clothes" : [
		{
			"name": "Coat",
			"description": "Temperature will drop below 20c",
			"icon": "http://kaputt.com/assets/clothes/sweater.png"
		},
		{
			"name": "T-shirt",
			"description": "Bla bla bla",
			"icon": "http://kaputt.com/assets/clothes/sweater.png"
		},
		{
			"name": "Jeans",
			"description": "or pants, trousers...",
			"icon": "http://kaputt.com/assets/clothes/sweater.png"
		},
		{
			"name": "Umbrella",
			"description": "It will be raining.",
			"icon": "http://kaputt.com/assets/clothes/sweater.png"
		}
	]
}';



?>