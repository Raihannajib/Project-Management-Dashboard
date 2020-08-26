
 TimeSeriesAnalyseAlgo = function (response,y,q) {

     var mapQ1 = new Map();
     var mapQ2 = new Map();
     var mapQ3 = new Map();
     var mapQ4 = new Map();
     var lastYear = 0;
     var firstYear = 0;


     axios.get('/season_data').then(function (response) {

         //get first & last year
         firstYear = response.data.forcastingData[0].year;
         lastYear = response.data.forcastingData[response.data.forcastingData.length-1].year;
         // classification data based on Quarter of year
         response.data.forcastingData.forEach(function (Data) {
             if (Data.month <= 3) {
                 if (mapQ1.has(Data.year)) {
                     mapQ1.set(Data.year, mapQ1.get(Data.year) + Data.count)
                 } else {
                     mapQ1.set(Data.year, Data.count)
                 }
             } else if (Data.month <= 6) {
                 if (mapQ2.has(Data.year)) {
                     mapQ2.set(Data.year, mapQ2.get(Data.year) + Data.count)
                 } else {
                     mapQ2.set(Data.year, Data.count)
                 }
             } else if (Data.month <= 9) {
                 if (mapQ3.has(Data.year)) {
                     mapQ3.set(Data.year, mapQ3.get(Data.year) + Data.count)
                 } else {
                     mapQ3.set(Data.year, Data.count)
                 }
             } else {
                 if (mapQ4.has(Data.year)) {
                     mapQ4.set(Data.year, mapQ4.get(Data.year) + Data.count)
                 } else {
                     mapQ4.set(Data.year, Data.count)
                 }
             }
         });
         // make all maps have some keys
         number_years = lastYear-firstYear+1;
         number_season = 4;
         maps = [mapQ1, mapQ2, mapQ3, mapQ4];
         for (let i = 0; i < number_season; i++) {
             for (let j = firstYear; j < lastYear+1; j++) {
                 if (!maps[i].has(j)) {
                     maps[i].set(j, 0);
                 }
             }
         }
         //create table of sales Quarters/Year
         tableDataForEachSeason = [Array.from(maps[0].values()), Array.from(maps[1].values()), Array.from(maps[2].values()), Array.from(maps[3].values())];


         //number of elements
         totalData = number_season * number_years;

         // create X array (abscissa axe): Quarters
         xcode = [];
         for (let i = 0; i < totalData; i++) {
             xcode.push(i);
         }

         // create Y array (ordered axis): Sales
         Y = [];
         for (let i = 0; i < number_years; i++) {
             for (let j = 0; j < number_season; j++) {
                 Y.push(tableDataForEachSeason[j][i]);
             }
         }

        // calculate Moving Average (4) array
         fourQMean = [];
         for (let i = 0; i < totalData - 3; i++) {
             fourQMean.push((Y[i] + Y[i + 1] + Y[i + 2] + Y[i + 3]) / 4);
         }

         //calculate Centred Moving Average array from fourQMean array
         centerAverge = [];
         centerAvergeLength = fourQMean.length - 1;
         for (let i = 0; i < centerAvergeLength; i++) {
             centerAverge.push((fourQMean[i] + fourQMean[i + 1]) / 2);
         }

         //calculate  array of center average array elements percentage
         pourcentOfAverge = [];
         for (let i = 0; i < centerAvergeLength; i++) {
             pourcentOfAverge.push((centerAverge[i] / Y[i + 2]) * 100);
         }

         //classification based on season(Quarter)
         quarter1 = [];
         quarter2  = [];
         quarter3  = [];
         quarter4  = [];
         for (let i = 0; i < centerAvergeLength; i++) {
             if (i % 4 === 0) {
                 quarter1.push(pourcentOfAverge[i]);
             } else if (i % 4 === 1) {
                 quarter2.push(pourcentOfAverge[i]);
             } else if (i % 4 === 2) {
                 quarter3.push(pourcentOfAverge[i]);
             } else {
                 quarter4.push(pourcentOfAverge[i]);
             }
         }
         //calculate Average Quarter
         meanQ1 = 0;
         for (let i = 0; i < quarter1.length; i++) {
             meanQ1 += quarter1[i];
         }
         meanQ1 /= quarter1.length;

         meanQ2 = 0;
         for (let i = 0; i < quarter2.length; i++) {
             meanQ2 += quarter2[i];
         }
         meanQ2 /= quarter2.length;

         meanQ3 = 0;
         for (let i = 0; i < quarter3.length; i++) {
             meanQ3 += quarter3[i];
         }
         meanQ3 /= quarter3.length;

         meanQ4 = 0;
         for (let i = 0; i < quarter4.length; i++) {
             meanQ4 += quarter4[i];
         }
         meanQ4 /= quarter4.length;



         // calculate final season index for each quarter after normalize it
         seasonalIndexs = [meanQ1, meanQ2, meanQ3, meanQ4];
         sumMeanQuartile = meanQ1 + meanQ2 + meanQ3 + meanQ4;
         adjusementFactor = 0;
         if (sumMeanQuartile !== 400) {
             adjusementFactor = 400 / sumMeanQuartile;
             for (let i = 0; i < 4; i++) {
                 seasonalIndexs[i] *= adjusementFactor;
             }
         }


         //calculate factors of trend equation
         // Y = aX +b
         //b = Ybar - Xbar*a
         //a = (n*sum(xy)-sum(x)sum(y))/(n*sum(x^2)-sum(x)^2)

         Ybar = 0;
         ySum = 0;
         for (let i = 0; i < Y.length; i++) {
             ySum += Y[i];
         }
         Ybar = ySum / Y.length;

         Xbar = 0;
         xSum = 0;
         xSumSquare = 0;
         for (let i = 0; i < xcode.length; i++) {
             xSum += xcode[i];
             xSumSquare += xcode[i] ^ 2;
         }
         Xbar = xSum / xcode.length;

         xySum = 0;
         for (let i = 0; i < totalData; i++) {
             xySum += xcode[i] * Y[i];
         }


         //a:coefficient , b:intercept
         coefficient = (totalData * xySum - xSum * ySum) / (totalData * xSumSquare - xSum * xSum);
         intercept = Ybar - Xbar * coefficient;

         //use a and b to predict (forecast)
         // predict sales value based on quarter and year inserted by user
         expectedX = (y-lastYear-1)*4+q+totalData;
         expectedSales = (coefficient*expectedX + intercept) * seasonalIndexs[q-1]/100;

         // calculate the differences between all predictions before inserted year
         YEARS =[];
         PREDICTIONS=[];
         for (let i = lastYear+1; i <= y; i++) {
             YEARS.push(i);
             expX = (i-lastYear-1)*4+q+totalData;
             expX2 = (i+1-lastYear-1)*4+q+totalData;
             PREDICTIONS.push(((coefficient*expX2 + intercept) * seasonalIndexs[q-1]/100)-((coefficient*expX + intercept) * seasonalIndexs[q-1]/100));
         }

         // display result in view
         var rs = document.getElementById('result');
         rs.innerHTML = parseInt(expectedSales);
         rs.style.Color = "1DFFDD";

         var area = document.getElementById('ctxA');
         var area2 = document.getElementById('ctxF');

         //create a chart
         new Chart(area, {
             type: 'line',
             data: {
                 labels: YEARS,
                 datasets: [{
                     label: '# orders',
                     data: PREDICTIONS,
                     borderColor:'rgba(0,0,255)',
                     borderWidth: 3,
                 }],
                 options: {
                     scales: {
                         xAxes: [{
                             type: 'time',
                             time: {
                                 unit: 'year'
                             }
                         }]
                     }
                 }
             }
         });

     });
 };

getPredictions = function (y,q) {
    axios.get('/season_data').then(function (response) {
        return TimeSeriesAnalyseAlgo(response,y,q);
    });
};

predict = function () {
 var yr = document.getElementById('years');
 var qr = document.getElementById('quarters');

 var optY = yr.options[yr.selectedIndex].value;
 var optQ = qr.options[qr.selectedIndex].value;

getPredictions(optY,optQ);

 };

