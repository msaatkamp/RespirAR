// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// load Data
// Pie Chart Example
var ctx = document.getElementById("mediaTem");
var mediaTem = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      data: [],
      backgroundColor: [],
      hoverBackgroundColor: [],
      hoverBorderColor: "rgba(234, 236, 244, 1, 5)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 5,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
	legend: {
      display: false
    },
    cutoutPercentage: 80,
	scales: {
            xAxes: [{
                stacked: true
            }],
            yAxes: [{
                stacked: true
            }]
        }
  },
});

var mediaTemperaturas = {
  labels: [
  ],
  datasets: [
  ]
};

var chartOptions = {
  responsive: true,
  legend: {
    position: "top"
  },
  title: {
    display: true,
    text: "Médias"
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  }
}

/*window.onload = function() {
  var ctx = document.getElementById("mediaTemperaturas").getContext("2d");
  window.myBar = new Chart(ctx, {
    type: "bar",
    data: mediaTemperaturas,
    options: chartOptions
  });
};*/
