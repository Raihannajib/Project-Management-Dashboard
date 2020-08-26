

(function () {
    $(document).ready(function () {

        setInterval(function () {


            //label
            var orderLabels = [];
            var orderCost = [];
            var orderRevenue = [];
            var orderProfit = [];

            
            var area = document.getElementById('myChart');
            var area2 = document.getElementById('myChartLine');
            var area3=document.getElementById('myChartRevenue');
            var area4=document.getElementById('myChartLineRevenue');
            var area5=document.getElementById('myChartProfit');
            var area6=document.getElementById('myChartLineProfit');



            //make a call
            axios.get('get_post_chart_data').then(function (response) {
                response.data.chartData.forEach(function (Monthly) {
                    //orders
                    orderLabels.push(Monthly.year);
                    orderCost.push(Monthly.totalCost);
                    orderRevenue.push(Monthly.totalRevenue);
                    orderProfit.push(Monthly.totalProfit);


             });

                //
            new Chart(area, {
                type: 'bar',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        label: 'annual cost',
                        data:orderCost,
                        backgroundColor: 'rgba(0,0,255)',
                        borderColor:'rgba(0,0,255)',
                        borderWidth: 3
                    }]
                }
            });
            new Chart(area2, {
                type: 'line',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        label: 'annual cost',
                        data:orderCost,
                        //backgroundColor: 'rgba(0,0,255)',
                        borderColor:'rgba(0,0,255)',
                        borderWidth: 3
                    }]
                }
            });
            new Chart(area3, {
                type: 'bar',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        label: 'Annual revenue',
                        data:orderRevenue,
                        backgroundColor: 'rgba(0,0,255)',
                        borderColor:'rgba(0,0,255)',
                        borderWidth: 3
                    }]
                }
            });
            new Chart(area4, {
                type: 'line',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        label: 'Annual revenue',
                        data:orderRevenue,
                        borderColor:'rgba(0,0,255)',
                        borderWidth: 3
                    }]
                }
            });
            new Chart(area5, {
                type: 'bar',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        label: 'Annual profit',
                        data:orderProfit,
                        backgroundColor: 'rgba(0,0,255)',
                        borderColor:'rgba(0,0,255)',
                        borderWidth: 3
                    }]
                }
            });
            new Chart(area6, {
                type: 'line',
                data: {
                    labels: orderLabels,
                    datasets: [{
                        label: 'Annual profit',
                        data:orderProfit,
                        borderColor:'rgba(0,0,255)',
                        borderWidth: 3
                    }]
                }
            });
            

                

              

        });
            
        },2000);
    });
})();

