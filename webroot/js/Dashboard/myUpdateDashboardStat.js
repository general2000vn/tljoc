// var urlYTDTotalCNV = 'http://ict/cake4/dashboard-prd-days/ajax-get-ytd-cnv-total.json';
// var urlTotalCNV = 'http://ict/cake4/dashboard-prd-days/ajax-get-cnv-total.json';
// var urlYTDTotalTGT = 'http://ict/cake4/dashboard-prd-days/ajax-get-ytd-tgt-total.json';
// var urlTotalTGT = 'http://ict/cake4/dashboard-prd-days/ajax-get-tgt-total.json';
// var urlPrdDaily = 'http://ict/cake4/dashboard-prd-days/ajax-get-daily.json';
// var urlHseStat = 'http://ict/cake4/hse-stats/ajax-get-hse-stat.json';

var urlYTDTotalCNV = APP_FULL_BASE + 'dashboard-prd-days/ajax-get-ytd-cnv-total.json';
var urlTotalCNV = APP_FULL_BASE + 'dashboard-prd-days/ajax-get-cnv-total.json';
var urlYTDTotalTGT = APP_FULL_BASE + 'dashboard-prd-days/ajax-get-ytd-tgt-total.json';
var urlTotalTGT = APP_FULL_BASE + 'dashboard-prd-days/ajax-get-tgt-total.json';
var urlPrdDaily = APP_FULL_BASE + 'dashboard-prd-days/ajax-get-daily.json';
var urlHseStat = APP_FULL_BASE + 'hse-stats/ajax-get-hse-stat.json';
var urlOilPrice = APP_FULL_BASE + 'oil-prices/ajax-get-oil-prices.json';
var urlPrdTrend = APP_FULL_BASE + 'dashboard-prd-days/ajax-get-trend.json';
var urlUserBD = APP_FULL_BASE + 'users/ajax-get-bd.json';
var urlNotice = APP_FULL_BASE + 'notices/ajax-get-current.json';


// TRANSACTIONS
var myTGTCanvas = document.getElementById("tgt-transactions");
myTGTCanvas.height = "330";
var myTGTCanvasContext = myTGTCanvas.getContext("2d");

var myCNVCanvas = document.getElementById("cnv-transactions");
myCNVCanvas.height = "330";
var myCNVCanvasContext = myCNVCanvas.getContext("2d");

var gradientStroke1 = myTGTCanvasContext.createLinearGradient(0, 80, 0, 280);
gradientStroke1.addColorStop(0, hexToRgba(myVarVal, 0.8) || 'rgba(108, 95, 252, 0.8)');
gradientStroke1.addColorStop(1, hexToRgba(myVarVal, 0.2) || 'rgba(108, 95, 252, 0.2) ');

var gradientStroke2 = myCNVCanvasContext.createLinearGradient(0, 80, 0, 280);
gradientStroke2.addColorStop(0, hexToRgba(myVarVal1, 0.8) || 'rgba(5, 195, 251, 0.8)');
gradientStroke2.addColorStop(1, hexToRgba(myVarVal1, 0.2) || 'rgba(5, 195, 251, 0.2) ');

const cnvChartStyle = {borderColor: myVarVal, pointBorderColor: myVarVal};
const tgtChartStyle = {borderColor: '#05c3fb', pointBorderColor: '#05c3fb'};

document.getElementById('tgt-transactions').innerHTML = '';
document.getElementById('cnv-transactions').innerHTML = '';




function createChart(theCanvas, theStyle, theStroke, mylabels, mydata) {
    myChart = new Chart(theCanvas, {

        type: 'line',
        data: {
            labels: mylabels,
            type: 'line',
            datasets: [{
                data: mydata,
                backgroundColor: theStroke,
                borderColor: theStyle.borderColor,
                pointBackgroundColor: '#fff',
                pointHoverBackgroundColor: theStroke,
                pointBorderColor: theStyle.pointBorderColor,
                pointHoverBorderColor: theStroke,
                pointBorderWidth: 0,
                pointRadius: 0,
                pointHoverRadius: 0,
                borderWidth: 3,
                fill: 'origin'
            }
        
        ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false,
                labels: {
                    usePointStyle: false,
                },
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false,
                        color: 'rgba(119, 119, 142, 0.08)'
                    },
                    ticks: {
                        fontColor: '#b0bac9',
                        autoSkip: true,
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Month',
                        fontColor: 'transparent'
                    }
                }],
                yAxes: [{
                    ticks: {
                        //min: 0,
                        //max: 1050,
                        //stepSize: 1000,
                        fontColor: "#b0bac9",
                    },
                    display: true,
                    gridLines: {
                        display: true,
                        drawBorder: false,
                        zeroLineColor: 'rgba(142, 156, 173,0.1)',
                        color: "rgba(142, 156, 173,0.1)",
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'sales',
                        fontColor: 'transparent'
                    }
                }]
            },
            title: {
                display: false,
                text: 'Normal Legend'
            }
        }
    });

}




$('#carousel-chart').on('slide.bs.carousel', function onSlide (ev) {
    //var slide = ev.relatedTarget;
    var canvasElement = $(ev.relatedTarget).find("canvas")[0];
    canvasElement.height = '330';

    $.getJSON(urlPrdTrend, function (json) {
        
        if (canvasElement.id == "tgt-transactions"){
            createChart(canvasElement, tgtChartStyle,gradientStroke2, json.results.labels, json.results.tgt);
        }

        if (canvasElement.id == "cnv-transactions"){
            createChart(canvasElement, cnvChartStyle, gradientStroke1, json.results.labels, json.results.cnv);
        }
        
    });
    
    //console.log (canvasElement);
});

$('#carousel-prd-stat').on('slide.bs.carousel', function onSlide (ev) {
    
    //******now fire firework on both CNV and TGT */

    // if (ev.to == 0){ //if TGT stat
    //     bFireworks = true;
    // } else {
    //     bFireworks = false;
    // }
    

});



function InitiateCharts() {
    $.getJSON(urlPrdTrend, function (json) {

        createChart(myTGTCanvas, tgtChartStyle, gradientStroke2, json.results.labels, json.results.tgt);
        //createChart(myCNVCanvas, gradientStroke1, json.results.labels, json.results.cnv);
    });
}

function getCnvYtdTotal() {
    $.getJSON(urlYTDTotalCNV, function (json) {
        $("#cnv_ytd").text(json.results.ytd.toLocaleString('en-US'));
        $("#cnv_achive").text(json.results.achivement.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' %');
        $("#cnv_achive_bar").attr('style', 'width: ' + json.results.achivement.toLocaleString('en-US') + '%;');
    });
}

function getCnvTotal() {
    $.getJSON(urlTotalCNV, function (json) {
        $("#cnv_total").text(json.results[0].total_cnv.toLocaleString('en-US'));

    });
}

function getTgtYtdTotal() {
    $.getJSON(urlYTDTotalTGT, function (json) {
        $("#tgt_ytd").text(json.results.ytd.toLocaleString('en-US'));
        $("#tgt_achive").text(json.results.achivement.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' %');
        $("#tgt_achive_bar").attr('style', 'width: ' + json.results.achivement.toLocaleString('en-US') + '%;');
    });
}

function getTgtTotal() {
    $.getJSON(urlTotalTGT, function (json) {
        $("#tgt_total").text(json.results[0].total_tgt.toLocaleString('en-US'));

    });
}

function getPrdDaily() {
    $.getJSON(urlPrdDaily, function (json) {
        //$( "span.stat_date" ).text(json.results.stat_date);
        $("#cnv_daily").text(json.results.oil_rate_cnv.toLocaleString('en-US'));
        $("#tgt_daily").text(json.results.oil_rate_tgt.toLocaleString('en-US'));
    });
}

function getHSEStat() {
    $.getJSON(urlHseStat, function (json) {
        $("#man_day").text(json.results.man_day.toLocaleString('en-US'));
        $("#hse_from_date").text('From ' + json.results.hse_stat.from_date);
        $("#lost_time").text(json.results.hse_stat.lost_time.toLocaleString('en-US'));
        $("#med_treat_case").text(json.results.hse_stat.med_treat_case.toLocaleString('en-US'));
        $("#first_aid_case").text(json.results.hse_stat.first_aid_case.toLocaleString('en-US'));
        $("#fire_explosion").text(json.results.hse_stat.fire_explosion.toLocaleString('en-US'));
        $("#near_miss").text(json.results.hse_stat.near_miss.toLocaleString('en-US'));
        $("#obs_card").text(json.results.hse_stat.obs_card.toLocaleString('en-US'));
    });
}

function getOilPrices() {
    $.getJSON(urlOilPrice, function (json) {
        $("#brent_price").text('$ ' + json.results.brent);
        $("#wti_price").text('$ ' + json.results.wti);
        $("#usd_vnd").text('đ ' + json.results.usd.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    });
}

function getNotices() {
    //console.log('Start getNotices');
    $("#notice-span").html("");

    iLength = 0;

    $.getJSON(urlNotice, function (json) {
        sNotice = "";
        if (json.results.length > 0){

            json.results.forEach(notice => {
                //console.log(notice);
                sNotice = sNotice
                            + '<span class="notice-item">'
                            + notice.content
                            + '</span>'
                            ;
                
            });
            
        }
        $("#notice-span").html(sNotice);
        iLength += sNotice.length;
        //console.log("lenth = " + iLength);
        //console.log(sNotice);
    });

    $.getJSON(urlUserBD, function (json) {
        sNotice = $("#notice-span").html();

        if (json.results.length > 0){
            
            json.results.forEach(user => {
                sNotice = sNotice
                            + '<span class="notice-item">Happy Birthday to '
                            + user.title + ' '
                            + user.name
                            + '</span>'
                            ;
            });

        }

        $("#notice-span").html(sNotice);
        iLength = sNotice.length;
        //console.log("lenth = " + iLength);
        //console.log(sNotice);

        updateSpeed();
    });

    //console.log("lenth = " + iLength);


}

function updateSpeed(){
    iLength = $('#notice-span').width();
    //console.log("function length = " + iLength);
    sSpeed = Math.round(iLength / 60) + "s";
    //console.log(sSpeed);
    document.getElementById("notice-span").style.animationDuration = sSpeed;
}



function refreshAllStat() {
    //call others
    getCnvYtdTotal();
    getCnvTotal();
    getTgtYtdTotal();
    getTgtTotal();
    getPrdDaily();
    getHSEStat();
    getOilPrices();
    


    setTimeout(refreshAllStat, 30000); //30 sec
    //console.log('Run RefreshAllStat');
}

function refreshNotice() {
    getNotices();

    setTimeout(refreshNotice, 300000); //5 mins
}


$(document).ready(function () {
    InitiateCharts();
    refreshAllStat();
    refreshNotice();
    //clickOnTGT();
});
