<?php
namespace API;
header('Content-Type: application/json');

include(dirname(__DIR__) . '/Kernel.php');

use Exception;
use Service\InstagramService;
use Service\InstaPostTransformer;

class postController
{

    /**
     * @return string
     */
    public function render()
    {
        return 'false';
        $request = $this->validateRequest();

        try {
            $hydratedPosts = $this->getInstaPostTransformer()->arrayToPosts($request);
            $this->getInstagramService()->acceptPosts($hydratedPosts);
        } catch (Exception $e) {
            return json_encode([
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage()
            ]);
        }

        return json_encode(true);
    }

    /**
     * Die if data is not formatted properly
     */
    private function validateRequest()
    {
        function isValidJSON($str) {
            json_decode($str);
            return json_last_error() == JSON_ERROR_NONE;
        }

        $json_params = file_get_contents("php://input");
        if (strlen($json_params) > 0 && isValidJSON($json_params)) {
            $decoded_params = json_decode($json_params, true);

            return $decoded_params;
        } else {
            die(json_encode([
                'error_code' => 400,
                'error_message' => 'Invalid JSON'
            ]));
        }
    }

    /**
     * @return InstagramService
     */
    private function getInstagramService()
    {
        return new InstagramService();
    }

    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}

$controller = new postController();
echo $controller->render();

?>