<?php
namespace api;
header('Content-Type: application/json');

include(dirname(__DIR__) . '/Kernel.php');

use Exception;
use Service\Transformer\forecastRequestTransformer;
use Service\Transformer\forecastResponseTransformer;
use Service\WeatherService;

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
        $response = $this->getForecastResponseTransformer()->transform($results);

        return json_encode($response);
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
     * @return WeatherService
     */
    private function getWeatherService()
    {
        return new WeatherService();
    }

    /**
     * @return forecastRequestTransformer
     */
    private function getForecastRequestTransformer()
    {
        return new forecastRequestTransformer();
    }

    /**
     * @return forecastResponseTransformer
     */
    private function getForecastResponseTransformer()
    {
        return new forecastResponseTransformer();
    }

    /**
     * @param Exception $e
     * @return array
     */
    private function handleError(Exception $e)
    {
        http_response_code($e->getCode());

        return [
            'error_code' => $e->getCode(),
            'error_message' => $e->getMessage()
        ];
    }

}

$controller = new forecastController();
echo $controller->render();

?>