

(function () {
    $(document).ready(function () {

        setInterval(function () {


            //labels
            var orderLabels = [];
            var orderData = [];

            var regionLabels = [];
            var regionData = [];
            var area = document.getElementById('orderChart');
            var area2 = document.getElementById('regionChart');

            //make a call
            axios.get('/admin/order_date_region').then(function (response) {
                response.data.orders.forEach(function (Monthly) {
                    //orders
                    orderLabels.push(Monthly.date);
                    orderData.push(Monthly.count);


                });

                response.data.regions.forEach(function (Monthly) {
                    //regions
                    regionLabels.push(Monthly.region);
                    regionData.push(Monthly.countO)

                });


                new Chart(area, {
                    type: 'line',
                    data: {
                        labels: orderLabels,
                        datasets: [{
                            label: '# orders',
                            data: orderData,
                            borderColor:'rgba(0,0,255)',
                            borderWidth: 3,
                            backgroundColor: ['#16ff04']
                        }]
                    }
                });

                new Chart(area2, {
                    type: 'pie',
                    data: {
                        labels: regionLabels,
                        datasets: [{
                            label: '# regions',
                            data: regionData,
                            borderColor:'rgba(0,0,255)',
                            borderWidth: 3,
                            backgroundColor: ['#cfff09',
                                '#9ed2ff',
                                '#e5ff52',
                                '#3d2cff',
                                '#65fff8',
                                '#ffcf7b'
                            ]
                        }]
                    }
                });


            });
        },2000);
    });
})();
