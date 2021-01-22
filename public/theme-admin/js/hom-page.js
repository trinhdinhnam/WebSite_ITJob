
    let listMonth = $("#container1").attr("data-list-month");
    let listRevenue = $("#container1").attr("data-list-revenue");

    let listTotalRecruiter = $("#container1").attr("data-list-total-recruiter");

    listMon = JSON.parse(listMonth);
    listReven = JSON.parse(listRevenue);
    listRecuriter = JSON.parse(listTotalRecruiter);

    Highcharts.chart('container1', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Biểu đồ doanh thu người dùng đăng ký theo tháng'
        },

        xAxis: {
            categories: listMon
        },
        yAxis: {
            title: {
                text: 'Tiền (VNĐ)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            },
        },
        series: [{
            name: 'Doanh thu năm 2020',
            data: listReven
        },
        ]
    });
    let listRevenue2 = $("#container2").attr("data-list-revenue");
    listRevenueAccountNumber = JSON.parse(listRevenue2);

    let d = new Date();
    let yearNow = d.getFullYear() - 1 ;
    Highcharts.chart('container2', {

        chart: {
            styledMode: true
        },

        title: {
            text: 'Biểu đồ thống kê sử dụng dịch vụ năm ' + yearNow
        },

        xAxis: {
            categories: ['Vip 1', 'Vip 2', 'Vip 3', 'Normal']
        },

        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: listRevenueAccountNumber,
            showInLegend: true
        }]
    });
