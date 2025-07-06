<script>
    $(document).ready(function() {
        new ApexCharts(document.getElementById('revenue-chart'), {
            series: @json($revenues('value')),
            colors: @json($revenues('color')),
            chart: {
                height: '250',
                type: 'donut'
            },
            chartOptions: {
                labels: @json($revenues('label'))
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '71%',
                        polygons: {
                            strokeWidth: 0
                        }
                    },
                    expandOnClick: true
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'darken',
                        value: .9
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            tooltip: {
                enabled: false
            }
        }).render();

        new ApexCharts(document.getElementById('sales-report-chart'), {
            series: @json($bookingsReport['series']),
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            colors: @json($bookingsReport['colors']),
            xaxis: {
                type: 'datetime',
                categories: @json($bookingsReport['dates'])
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                }
            },
            noData: {
                text: '{{ trans('core/base::tables.no_data') }}',
            }
        }).render()
    })
</script>
