document.addEventListener('DOMContentLoaded', function () {
    var mymap = L.map('map').setView([32.8872, 13.1913], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap المساهمون'
    }).addTo(mymap);


    window.searchAddress = function (input) {
        console.log('البحث عن العنوان:', input);
    
        if (Array.isArray(housesData) && housesData.length > 0) {
            var found = false;
    
            housesData.forEach(function (house) {
                var houseNumber = house.number.trim();
                var streetName = house.street && house.street.name || '';
                var areaName = house.street && house.street.area && house.street.area.name || '';
                var cityName = house.street && house.street.area && house.street.area.city && house.street.area.city.name || '';
                var postalCode = house.street && house.street.area && house.street.area.city && house.street.area.city.postalCodes && house.street.area.city.postalCodes.code || '';
    
                // Check if the input includes house number, area, or if it matches the city name
// Check if the input includes house number, area, or if it matches the city name
if (input.toLowerCase() === cityName.toLowerCase()) {
    found = true;
    console.log('المدينة موجودة:', house);
    searchCity(cityName);
} else if (input.toLowerCase() === areaName.toLowerCase()) {
    found = true;
    console.log('المنطقة موجودة:', house);
    // Assuming the coordinates of the area are available, you can pass them to addCircleForArea
    addCircleForArea(house.latitude, house.longitude);
} else if (input.includes(houseNumber)) {
    found = true;
    console.log('العنوان موجود:', house);
    var popupText = houseNumber + ', ' + streetName + ', ' + areaName + ', ' + cityName + ', ' + postalCode;
    addMarker(house.latitude, house.longitude, popupText);
}

            });
    
            if (!found) {
                console.log('العنوان غير موجود.');
                showErrorToast('العنوان غير موجود.');
            }
        } else {
            console.error('housesData ليس مصفوفة صالحة مع عناصر');
        }
    };
    
    // Modify the searchCity function to clear the map before adding circles
    window.searchCity = function (cityName) {
        console.log('البحث عن المدينة:', cityName);
    
        if (Array.isArray(housesData) && housesData.length > 0) {
            var cityHouses = housesData.filter(function (house) {
                return house.street &&
                    house.street.area &&
                    house.street.area.city &&
                    house.street.area.city.name === cityName;
            });
    
            if (cityHouses.length > 0) {
                console.log('المدينة موجودة:', cityHouses);
    
                // Clear existing map features
                clearMap();
    
                // Add circles for each house in the city
                cityHouses.forEach(function (house) {
                    addCircle(house.latitude, house.longitude);
                });
            } else {
                console.log('المدينة غير موجودة في بيانات البيوت.');
                showErrorToast('المدينة غير موجودة في بيانات البيوت.');
            }
        } else {
            console.error('housesData ليس مصفوفة صالحة مع عناصر');
        }
    };
    
    // Function to search and display areas
    window.searchArea = function (areaName) {
        console.log('البحث عن المنطقة:', areaName);
    
        if (Array.isArray(housesData) && housesData.length > 0) {
            var areaHouses = housesData.filter(function (house) {
                return house.street &&
                    house.street.area &&
                    house.street.area.name === areaName;
            });
    
            if (areaHouses.length > 0) {
                console.log('المنطقة موجودة:', areaHouses);
    
                // Clear existing map features
                clearMap();
    
                // Add circles for each house in the area
                areaHouses.forEach(function (house) {
                    addCircleForArea(house.latitude, house.longitude);
                });
            } else {
                console.log('المنطقة غير موجودة في بيانات البيوت.');
                showErrorToast('المنطقة غير موجودة في بيانات البيوت.');
            }
        } else {
            console.error('housesData ليس مصفوفة صالحة مع عناصر');
        }
    };
    
    function addCircleForArea(lat, lon) {
        console.log('إضافة دائرة عند:', lat, lon);
    
        // Add new circle
        var circle = L.circle([lat, lon], {
            color: 'green',  // You can adjust the color
            fillColor: '#008000',  // You can adjust the fill color
            fillOpacity: 0.5,
            radius: 400  // Adjust the radius as needed
        }).addTo(mymap);
    
        mymap.setView([lat, lon], 16);
    }

    
    
    // Function to clear circles, polygons, and markers
    function clearMap() {
        // Remove existing circles, polygons, and markers
        mymap.eachLayer(function (layer) {
            if (layer instanceof L.Circle || layer instanceof L.Polygon || layer instanceof L.Marker) {
                mymap.removeLayer(layer);
            }
        });
    }
    

    function addCircle(lat, lon) {
        console.log('إضافة دائرة عند:', lat, lon);
    
        // Add new circle
        var circle = L.circle([lat, lon], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 5000  // Adjust the radius as needed
        }).addTo(mymap);
        mymap.setView([lat, lon],11);
    }
    
    function clearCircles() {
        // Remove existing circles
        mymap.eachLayer(function (layer) {
            if (layer instanceof L.Circle) {
                mymap.removeLayer(layer);
            }
        });
    }
    
    
    
    function addMarker(lat, lon, popupText) {
        console.log('إضافة علامة عند:', lat, lon);
    
        // Remove existing markers
        mymap.eachLayer(function (layer) {
            if (layer instanceof L.Marker) {
                mymap.removeLayer(layer);
            }
        });
    
        // Add new marker
        var marker = L.marker([lat, lon]).addTo(mymap);
        marker.bindPopup(popupText).openPopup();
    
        // Set the view to the marker location with a zoom level of 10
        mymap.setView([lat, lon], 14);
    }

    function showErrorToast(message) {
        var errorToast = document.getElementById('errorToast');
        var errorToastMessage = document.getElementById('errorToastMessage');
    
        errorToastMessage.textContent = message;
        var toast = new bootstrap.Toast(errorToast);
        toast.show();
    
        // Hide the toast after 3000 milliseconds (3 seconds)
        setTimeout(function () {
            toast.hide();
        }, 4000);
    }

    document.getElementById('searchForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var address = document.getElementById('addressSearch').value;
        console.log('تم تقديم النموذج بالعنوان:', address);
        searchAddress(address);
    });

});





