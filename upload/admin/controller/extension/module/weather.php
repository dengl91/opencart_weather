<?php
class ControllerExtensionModuleWeather extends Controller {

  public function index() {

    $this->load->model('extension/module/weather');

    if( $this->request->server['REQUEST_METHOD'] == 'POST' ) {
      $this->model_extension_module_weather->SaveSettings();
      $this->session->data['success'] = true;
      $this->response->redirect($this->url->link('extension/module/weather', 'user_token=' . $this->session->data['user_token'], true));
    }

    $data = array();
    $data['success'] = isset($this->session->data['success']) ? true : false;
    $data['module_weather_key'] = $this->model_extension_module_weather->GetKey();
    $data['module_weather_city'] = $this->model_extension_module_weather->GetCity(); 
    $data += $this->load->language('extension/module/weather');

    $data['action'] = $this->url->link('extension/module/weather', 'user_token=' . $this->session->data['user_token'], true);
    $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

    $data['header'] = $this->load->controller('common/header'); 
    $data['column_left'] = $this->load->controller('common/column_left');
    $data['footer'] = $this->load->controller('common/footer');

    $this->response->setOutput($this->load->view('extension/module/weather', $data));

  }

}