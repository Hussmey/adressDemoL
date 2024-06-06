// chart.js
var citiesCount = document.currentScript.getAttribute('data-cities-count');
var areasCount = document.currentScript.getAttribute('data-areas-count');
var streetsCount = document.currentScript.getAttribute('data-streets-count');

var ctx = document.getElementById('chart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['المدن', 'المناطق', 'الشوارع'],
        datasets: [{
            label: 'عدد العناصر',
            data: [citiesCount, areasCount, streetsCount],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
