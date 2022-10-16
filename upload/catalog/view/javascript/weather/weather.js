module_weather.addEventListener('submit', function (e) {
  e.preventDefault();
  console.log('Form triggered');
  const f_opt = new FormData()
  f_opt.append('key', module_weather.querySelector('[name=key]').value)
  f_opt.append('city', module_weather.querySelector('[name=city]').value)

  fetch('/index.php?route=extension/module/weather/getweather', {
    method: 'POST',
    body: f_opt
  })
  .then(response => response.json())
  .then((response) => {
    if (response.success) {
      Object.entries(response.data.main).forEach(([key, value]) => {
        module_weather_result.innerHTML += `> ${key}: ${value} <br>`
      })
    } else {
      module_weather_result.innerHTML += '> Something went wrong<br>'
    }
  })
  .catch(error => console.log(error));
});
