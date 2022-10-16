<?php
class ModelExtensionModuleWeather extends Model {

  public function SaveSettings() {
    $this->load->model('setting/setting');
    $this->model_setting_setting->editSetting('module_weather', $this->request->post);
  }
  
  public function GetKey() {
    return $this->config->get('module_weather_key'); 
  }
  
  public function GetCity() {
    return $this->config->get('module_weather_city');
  }

}
?>