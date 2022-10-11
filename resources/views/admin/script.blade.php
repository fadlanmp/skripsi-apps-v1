<script src="https://code.highcharts.com/highcharts.js"></script>

{{-- chart civitas admin & ustad --}}
@canany(['admin', 'ustad'])
<script>
    Highcharts.chart('civitas', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekap Civitas PP Manarul Hasan'
        },
        xAxis: {
            categories: [
                'Laki-laki',
                'Perempuan'
            ],
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Santri',
            data: [{!! json_encode($santrilk) !!},{!! json_encode($santriptr) !!}]
        },
        {
        name: 'Ustad',
        data: [{!! json_encode($ustadlk) !!},{!! json_encode($ustadptr) !!}]
        }]
    });
</script>
@endcanany

{{-- chart civitas santri --}}
<script>
    Highcharts.chart('civitasSantri', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekap Ustad PP Manarul Hasan'
        },
        xAxis: {
            categories: [
                'Laki-laki',
                'Perempuan'
            ],
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
        {
        name: 'Ustad',
        data: [{!! json_encode($ustadlk) !!},{!! json_encode($ustadptr) !!}]
        }]
    });
</script>

{{-- chart kitab --}}
<script>
    Highcharts.chart('kitab', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekap Kitab'
        },
        xAxis: {
            categories:{!! json_encode($rumpun) !!},
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Kitab',
            data: {!! json_encode($jmlRumpun) !!}
        }]
    });
</script>

{{-- chart Posts --}}
<script>
    Highcharts.chart('posts', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekap Postingan/Blog'
        },
        xAxis: {
            categories:{!! json_encode($post) !!},
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'Jumlah'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Post',
            data: {!! json_encode($posts) !!}
        }]
    });
</script>

{{-- chart Nilai --}}
<script>
    Highcharts.chart('nilai', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Rekap Nilai'
        },
        xAxis: {
            categories:{!! json_encode($mapel) !!},
            crosshair: true
        },
        yAxis: {
            title: {
                useHTML: true,
                text: 'Nilai'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Mapel',
            data: {!! json_encode($nilai) !!}
        }]
    });
</script>