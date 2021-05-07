var ctx = document.getElementById('myChart').getContext('2d');
const data = {
  labels: [
    'Revenus',
    'Dépenses',
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [100, 50],
    backgroundColor: [
      'rgb(54, 162, 235)',
      'rgb(255, 99, 132)',
    ],
    hoverOffset: 4
  }]
};
const config = {
  type: 'pie',
  data: data,
};
var myChart = new Chart(ctx, config);
console.log(ctx);