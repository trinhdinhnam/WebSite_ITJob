
let listMonth = $("#container1").attr("data-list-month");
let listRevenue = $("#container1").attr("data-list-revenue");

listMon = JSON.parse(listMonth);
listReven = JSON.parse(listRevenue);

Highcharts.chart('container1', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Biểu đồ số lượng đơn ứng tuyển theo tháng'
    },

    xAxis: {
        categories: listMon
    },
    yAxis: {
        title: {
            text: 'Số lượng (Hồ sơ)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Doanh thu năm 2020',
        data: listReven
    }]
});
let listRevenue2 = $("#container2").attr("data-list-revenue");

listRevenueProfileNumber = JSON.parse(listRevenue2);
let d = new Date();
let yearNow = d.getFullYear() ;
Highcharts.chart('container2', {

    chart: {
        styledMode: true
    },

    title: {
        text: 'Biểu đồ thống kê đơn ứng tuyển theo việc làm năm '+yearNow
    },

    xAxis: {
        categories: ''
    },

    series: [{
        type: 'pie',
        allowPointSelect: true,
        keys: ['name', 'y', 'selected', 'sliced'],
        data: listRevenueProfileNumber,
        showInLegend: true
    }]
});
