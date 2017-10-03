<?php
namespace API;
header('Content-Type: application/json');

include(dirname(__DIR__) . '/Kernel.php');

use Exception;
use Service\Transformer\forecastRequestTransformer;
use Service\weatherService;

class getController
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

        die(var_dump($results));

//        $response['posts'] = $this->getInstaPostTransformer()->postsToArray($response['posts']);
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

$controller = new getController();
echo $controller->render();

?>