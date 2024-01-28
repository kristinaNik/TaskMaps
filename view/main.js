function updateResult(result, coordinates) {
    $('#result').html(result);

    const map = L.map('map').setView(coordinates, 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add a marker at the specified coordinates
    L.marker(coordinates).addTo(map);
}

function clearForm() {
    $('#address').val('');
}
function submitForm() {
    const address = $('#address').val();

    $.ajax({
        type: 'POST',
        url: 'geocode.php',
        data: {address: address},
        success: function (response) {
            const parsedResponse = JSON.parse(response);
            updateResult(parsedResponse.coordinates, parsedResponse.coordinates);
            clearForm();
        },
        error: function () {
            updateResult('An error occurred while processing the request.', []);
        }
    });
}
