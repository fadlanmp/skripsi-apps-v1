<script src="https://code.highcharts.com/highcharts.js"></script>

{{-- chart civitas admin & ustad --}}
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


