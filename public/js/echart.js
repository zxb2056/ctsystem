var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        baseOption: {
        title: {
            text: '最近6个月情期受胎率'
        },
        tooltip: {},
        legend: {
            // left:'right',
            data:['受胎率']
        },
        xAxis: {
            data: ["一月","二月","三月","四月","五月","六月"]
        },
        yAxis: {},
        series: [{
            name: '受胎率',
            type: 'line',
            data: [45, 50, 60, 55, 75, 50]
        }]
    }
    
};

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

    var myChart = echarts.init(document.getElementById('nanding'));
 myChart.setOption({
    title: {
        text: '牛群结构'
    },
    series : [
        {
            name: '牛群结构',
            type: 'pie',
            radius: '55%',
            data:[
                {value:100, name:'6月龄以下公牛数'},
                {value:60, name:'6月龄以下母牛数'},
                {value:240, name:'6-12月龄公牛数'},
                {value:330, name:'6-12月龄母牛数'},
                {value:400, name:'12-18月龄公牛数'},
                {value:300, name:'12-18月龄母牛数'},
                {value:400, name:'18月龄以上公牛'},
                {value:200, name:'18月龄以上母牛数'}

            ]
        }
    ]
})