"use strict";


// var myChart = new Chart(statistics_chart, {
  
//   data: {
//     labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],

//   },
  
// });

// $('#visitorMap').vectorMap(
// {
//   map: 'world_en',
//   backgroundColor: '#ffffff',
//   borderColor: '#f2f2f2',
//   borderOpacity: .8,
//   borderWidth: 1,
//   hoverColor: '#000',
//   hoverOpacity: .8,
//   color: '#ddd',
//   normalizeFunction: 'linear',
//   selectedRegions: false,
//   showTooltip: true,
//   pins: {
//     id: '<div class="jqvmap-circle"></div>',
//     my: '<div class="jqvmap-circle"></div>',
//     th: '<div class="jqvmap-circle"></div>',
//     sy: '<div class="jqvmap-circle"></div>',
//     eg: '<div class="jqvmap-circle"></div>',
//     ae: '<div class="jqvmap-circle"></div>',
//     nz: '<div class="jqvmap-circle"></div>',
//     tl: '<div class="jqvmap-circle"></div>',
//     ng: '<div class="jqvmap-circle"></div>',
//     si: '<div class="jqvmap-circle"></div>',
//     pa: '<div class="jqvmap-circle"></div>',
//     au: '<div class="jqvmap-circle"></div>',
//     ca: '<div class="jqvmap-circle"></div>',
//     tr: '<div class="jqvmap-circle"></div>',
//   },
// });

// weather
// getWeather();
// setInterval(getWeather, 600000);

// function getWeather() {
//   $.simpleWeather({
//   location: 'Bogor, Indonesia',
//   unit: 'c',
//   success: function(weather) {
//     var html = '';
//     html += '<div class="weather">';
//     html += '<div class="weather-icon text-primary"><span class="wi wi-yahoo-' + weather.code + '"></span></div>';
//     html += '<div class="weather-desc">';
//     html += '<h4>' + weather.temp + '&deg;' + weather.units.temp + '</h4>';
//     html += '<div class="weather-text">' + weather.currently + '</div>';
//     html += '<ul><li>' + weather.city + ', ' + weather.region + '</li>';
//     html += '<li> <i class="wi wi-strong-wind"></i> ' + weather.wind.speed+' '+weather.units.speed + '</li></ul>';
//     html += '</div>';
//     html += '</div>';

//     $("#myWeather").html(html);
//   },
//   error: function(error) {
//     $("#myWeather").html('<div class="alert alert-danger">'+error+'</div>');
//   }
//   });
// }