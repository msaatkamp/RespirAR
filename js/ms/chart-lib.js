xmlDOM = "";
readXml = null;

function addData(chart, label, data, cor) {
	if (chart) {
		chart.data.labels.push(label);
		chart.data.datasets.forEach((dataset) => {
			dataset.data.push(data);
			dataset.backgroundColor.push(cor);
		});

		chart.update();
	} else {
		console.log("Chart IS NOT Defined: " + chart);
	}
}

function addLabels(chart, label) {
	if (chart && chart.data) {
		chart.data.labels.push(label);
		chart.update();
	} else if (chart && chart.labels) {
		chart.labels.push(label);
		chart.update();
	} else {
		console.log("Chart IS NOT Defined: ");
		console.log(chart);
	}
}

function addDataSets(chart, data) {
	if (chart && chart.data) {
		chart.data.datasets.forEach((dataset) => {
			dataset.data.push(data);
		});

		chart.update();
	} else if (chart && chart.datasets) {
		chart.datasets.push(data);
		//chart.update();
	} else {
		console.log("Chart IS NOT Defined: " + chart);
	}
}

function removeData(chart) {
	chart.data.labels.pop();
	chart.data.datasets.forEach((dataset) => {
		dataset.data.pop();
		dataset.backgroundColor.pop();
	});
	chart.update();
}

function clearData(chart) {
	if (chart.data) {
		chart.data.labels = [];
		chart.data.datasets.forEach((dataset) => {
			dataset.data = [];
			dataset.backgroundColor = [];
		});
		chart.update();
	} else {
		chart.datasets = [];
	}
}

function updateConfigByMutating(chart) {
	chart.options.title.text = 'new title';
	chart.update();
}

function updateConfigAsNewObject(chart) {
	chart.options = {
		responsive: true,
		title: {
			display: true,
			text: 'Chart.js'
		},
		scales: {
			xAxes: [{
				display: true
			}],
			yAxes: [{
				display: true
			}]
		}
	}
	chart.update();
}

function updateScales(chart) {
	var xScale = chart.scales['x-axis-0'];
	var yScale = chart.scales['y-axis-0'];
	chart.options.scales = {
		xAxes: [{
			id: 'newId',
			display: true
		}],
		yAxes: [{
			display: true,
			type: 'logarithmic'
		}]
	}
	chart.update();
	// need to update the reference
	xScale = chart.scales['newId'];
	yScale = chart.scales['y-axis-0'];
}

function updateScale(chart) {
	chart.options.scales.yAxes[0] = {
		type: 'logarithmic'
	}
	chart.update();
}

function clearCharts() {
	//clearData(mediaTemperatura);
};

function updateGraphs() {
	//clearData(mediaTemperatura);

	var cores = [
		"#7acdb8",
		"#115469",
		"lightblue",
		"green",
		"yellow",
		"orange",
		"maroon",
		"navy",
		"pink",
		"#0e5763",
	];

	function loadTotalMedias(callback) {
		console.log("Calling mediaTemperatura")
		$.ajax({
			url: 'api.php?data=graphs&type=totais',
			dataType: 'json',
			success: function (data) {
				//clearData(mediaTemperatura);
				console.log(data);
				dados = data;
				var temperaturas = data.measures.map(function (x) { return x.temperatura });
				var umidades = data.measures.map(function (x) { return x.umidade });
				var datasets = [];
				var labels = [];
				var i = 0;

				while (i < data.measures.length) {
					//addData(mediaTemperatura, data.measures[i].data + " (" + data.measures[i].qtd + ")", data.measures[i].temperatura, cores[i]);
					//addData(mediaTemperatura, data.measures[i].data, {label: "Temperatura", backgroundColor: color[i], data: temperaturas}, null);
					//addLabels(mediaTemperatura, data.measures[i].data);
					//addData(mediaTemperatura, data.measures[i].data, {})
					labels.push(data.measures[i].data);
					i++;
				}
				let temps = { label: "Temperatura", backgroundColor: cores[1], data: temperaturas };
				let umids = { label: "Umidade", backgroundColor: cores[2], data: umidades, type: 'bar' };
				//addDataSets(mediaTemperatura, temps);
				//addDataSets(mediaTemperatura, umids);

				datasets.push(temps);
				datasets.push(umids);

				mediaTemperaturas = {
					labels: labels,
					datasets: datasets
				};

				var ctx = document.getElementById("mediaTemperaturas").getContext("2d");
				window.myBar = new Chart(ctx, {
					type: "bar",
					data: mediaTemperaturas,
					options: chartOptions
				});

				/*label: "American Express",
				backgroundColor: "pink",
				borderColor: "red",
				borderWidth: 1,*/

				callback;
			},
			error: function (x, y, z) {
				console.log(x);
				console.log(y);
				console.log(z);
				callback;
			}
		});
	}

	loadTotalMedias();
}