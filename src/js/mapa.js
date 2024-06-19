if (document.querySelector('#mapa')) {

    const lat = 9.976553039848557;
    const long = -84.15097286784395;
    const zoom = 16;
    
    const map = L.map('mapa').setView([lat, long], zoom);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([lat, long]).addTo(map)
    .bindPopup(`
        <h2 class="mapa__heading">DevWebCamp</h2>
        <p class="mapa__texto">Centro de Convenciones Cariari</p>
    `)
    .openPopup();
}