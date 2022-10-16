<?php
class ControllerExtensionModuleWeather extends Controller {
    public function index()
    {
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode(
            [
                "success" => true, 
                "message" => "ok",  
                "data" => []
            ]
        ));
    }
    
    public function getweather()
    {
        $this->response->addHeader('Content-Type: application/json');
        $target_url = 'https://api.openweathermap.org/data/2.5/weather';

        $post = array(
            'q'     => $this->request->post['city'],
            'appid' => $this->request->post['key'],
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url . '?' . http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $res_obj = json_decode($result);
        $this->response->setOutput(json_encode(
            [
                "success" => $res_obj->cod == 200 ? true : false, 
                "data"    => json_decode($result),
            ]
        ));
        curl_close($ch);
    }

}