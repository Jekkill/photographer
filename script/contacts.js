flatpickr("#pickDate", {
    altInput: true, 
    altFormat: "D, d.m.Y", 
    minDate: 'today', 
    maxDate: new Date().fp_incr(120),
    dateFormat: "Y-m-d",
    "locale": "ru", 
    wrap: true
});
var cleave = new Cleave('#telNumber', {
    delimiters: ['+ ', ' - ( ', ' ) - ', ' - ', ' - '],
    blocks:[0, 1, 3, 3, 2, 2]
});
// Set the geographical coordinates and a zoom level: 
var mymap = L.map('mapmain').setView([55.567, 38.225], 15);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: 'mapbox.streets'
}).addTo(mymap);
var marker = L.marker([55.568, 38.230]).addTo(mymap);
marker.bindPopup(" улица Михалевича, д.3 ");