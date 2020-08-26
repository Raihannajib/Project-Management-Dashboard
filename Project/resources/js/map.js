function getColor(d) {
    return d > 40 ? '#800026' :
        d > 35  ? '#BD0026' :
            d > 30 ? '#E31A1C' :
                d > 25  ? '#FC4E2A' :
                    d > 20   ? '#FD8D3C' :
                        d > 15   ? '#FEB24C' :
                            d > 10   ? '#FED976' :
                                '#FFEDA0';
}


var mapAdmin = function () {

    var orders = document.getElementById('mapid');
    var mapCountry = [];
    var mapValues = [];
    var mapCoordinate= [];

    var map = new Map();

    //make a call;
    axios.defaults.headers.post['Content-Type'] ='application/x-www-form-urlencoded';
    axios.get('/countries').then(function (response) {
        response.data.countries.forEach(function (infos) {
            mapCountry.push(infos.country);
            mapValues.push(infos.orders);

        });
     //   console.log(mapCountry);
       // console.log(mapValues);

    });

    axios.get('/country_data').then(function (response) {
        response.data.forEach(function (paye) {
         map.set(paye.name , paye.latlng);  // get all countries data
        });
        for ( i =0; i< mapCountry.length ; i++){
            if(map.has(mapCountry[i])){ // search countries coordination
                mapCoordinate.push(map.get(mapCountry[i]));  // save results
            }
        }

      //  console.log(mapCoordinate);


        const mymap = L.map('mapid').setView([10, 0], 2.2); // [L,l],zoom

        const attribution =
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
        const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

        const tiles = L.tileLayer(tileUrl, { attribution });
        tiles.addTo(mymap);


        for (var i =0; i< mapCountry.length ; i++) {

            var circle = L.circle(mapCoordinate[i], {
                color: 'black',
                fillColor: getColor(mapValues[i]),
                fillOpacity: 0.5,
                radius: mapValues[i]*10000,
            }).addTo(mymap);
        }



    });


    };



(function () {

    $(document).ready(
        mapAdmin()
    )
})();
