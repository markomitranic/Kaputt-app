<?php
namespace api;
header('Content-Type: application/json');

include(dirname(__DIR__) . '/Kernel.php');

use Exception;
use Service\Transformer\forecastRequestTransformer;
use Service\weatherService;

class autocompleteController
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

        $results = $this->getWeatherService()->getAutocompleteResults($params);

        return json_encode($results);
    }


    private function getRequestParameters() {

        if (!isset($_GET['city'])) {
            throw new Exception('The city field may not be empty', 400);
        }

        $city = $_GET['city'];
        $city = preg_replace('[,\s]', ',', $city);
        $city = preg_replace('[\s]', '-', $city);
        $city = strtolower($city);

        return $city;
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

$controller = new autocompleteController();
echo $controller->render();

?>