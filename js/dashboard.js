

// Initialize the map centered on Banyuwangi
const map = L.map('map').setView([-8.25135, 114.2840704], 9);

// Add OpenStreetMap tiles
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Add markers for popular locations in Banyuwangi
const locations = [{
    name: "Pelabuhan Ketapang",
    coords: [-8.1265, 114.3923],
    description: "Pelabuhan penghubung Jawa-Bali"
},
{
    name: "Kawah Ijen",
    coords: [-8.0580, 114.2420],
    description: "Famous for its blue fire phenomenon"
},
{
    name: "Pantai Pulau Merah",
    coords: [-8.5360, 113.9320],
    description: "Beautiful beach with red-colored hill"
},
{
    name: "Alun-alun Banyuwangi",
    coords: [-8.2176, 114.3772],
    description: "City center square"
}
];

// Add markers to the map
locations.forEach(location => {
    L.marker(location.coords)
        .addTo(map)
        .bindPopup(`<b>${location.name}</b><br>${location.description}`);
});

Highcharts.chart('hadir', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render() {
                const chart = this,
                    series = chart.series[0];
                let customLabel = chart.options.chart.custom.label;

                if (!customLabel) {
                    customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            'Total<br/>' +
                            '<strong>1,279</strong>'
                        )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                }

                const x = series.center[0] + chart.plotLeft,
                    y = series.center[1] + chart.plotTop -
                        (customLabel.attr('height') / 2);

                customLabel.attr({
                    x,
                    y
                });
                // Set font size based on chart diameter
                customLabel.css({
                    fontSize: `${series.center[2] / 12}px`
                });
            }
        }
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    title: {
        text: 'Hadir Pemicuan dan Ikut Layanan',
    },
    subtitle: {
        text: 'Perbandingan Warga yang ikut pemicuan dan yang bersedia ikut layanan'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
        enabled: true
    },
    exporting: {
        enabled: false //
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: [{
                enabled: true,
                distance: 3,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: -15,
                format: '{point.percentage:.0f}%',
                style: {
                    fontSize: '0.9em'
                }
            }],
            showInLegend: true
        }
    },
    series: [{
        name: 'Perbandingan',
        colorByPoint: true,
        innerSize: '75%',
        data: [{
            name: 'Hadir Pemicuan',
            y: 23.9
        }, {
            name: 'Ikut Layanan',
            y: 12.6
        }]
    }]
});


Highcharts.chart('dana', {
    chart: {
        type: 'bar'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['Desa', 'Dinkes', 'Puskesmas', 'Bwi Hijau'],
        title: {
            text: null
        },
        gridLineWidth: 1,
        lineWidth: 0
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Titik',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        },
        gridLineWidth: 0
    },
    exporting: {
        enabled: false //
    },
    tooltip: {
        valueSuffix: ' titik'
    },
    plotOptions: {
        bar: {
            //borderRadius: '50%',
            dataLabels: {
                enabled: true
            },
            groupPadding: 0.1
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: 'var(--highcharts-background-color, #ffffff)',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Jumlah Titik',
        data: [632, 727, 3202, 721]
    }]
});