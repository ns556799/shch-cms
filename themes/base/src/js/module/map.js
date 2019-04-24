import GMaps from 'gmaps'
const mapContainer = document.querySelector('#js-map-container')
const lat = 53.562030
const lng = -0.031480

const map = new GMaps({
  el: mapContainer,
  lat,
  lng
})

map.addMarker({
  lat,
  lng,
  title: 'Sussex House'
})
