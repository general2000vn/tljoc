$(function() {
    "use strict";
    
    initMyC3Chart();    
});


function initC3Chart() {
    setTimeout(function(){ 
           
        $(document).ready(function(){
            
            var chart = c3.generate({
                bindto: '#chart-pie', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        ['data1', 55],
                        ['data2', 25],
                        ['data3', 20],
                    ],
                    type: 'pie', // default type of chart
                    
                    
                    colors: {
                        'data1': Aero.colors["lime"],
                        'data2': Aero.colors["teal"],
                        'data3': Aero.colors["gray"],
                    },
                    
                    names: {
                        // name of each serie
                        'data1': 'Arizona',
                        'data2': 'Florida',
                        'data3': 'Texas',
                    }
                },
                axis: {
                },
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });
        });
        
    }, 500);
}

function initMyC3Chart() {
    setTimeout(function(){ 
           
        $(document).ready(function(){
            var myInt = 0;
            var myChart;
            $('.myPieChart').each(function() {
                //alert( this.id );
                var nameIndex = this.id;
                var myCols = window[nameIndex];
                var myBind = "#" + nameIndex;

                //alert(myVal);
                //eval('var ' + nameIndex . ';');
                var cahrt = c3.generate({
                //myChart[nameIndex] = c3.generate({
                    bindto: myBind, // id of chart wrapper
                    data: {
                        columns: myCols,
                            
                        type: 'pie', // default type of chart
                        colors: {
                            'data1': Aero.colors["pink"],
                            'data2': Aero.colors["indigo"],
                            'data3': Aero.colors["teal"],
                        },
                        
                    
                        names: {
                            // name of each serie
                            'data1': 'On Leave',
                            'data2': 'Checked-in',
                            'data3': 'Not yet',
                        }
                    },
                    axis: {
                    },
                    legend: {
                        show: true, //hide legend
                    },
                    padding: {
                        bottom: 0,
                        top: 0
                    },
                    pie: {
                        label: {
                            format: function (value, ratio, id) {
                                return d3.format('')(value);
                            }
                        }
                    },
                });
            
            });
        });
        
    }, 500);
}

/*

setTimeout(function(){
    "use strict";
    var mapData = {
        "US": 298,
        "SA": 200,
        "AU": 760,
        "IN": 2000000,
        "GB": 120,        
    };	
    if( $('#world-map-markers').length > 0 ){
        $('#world-map-markers').vectorMap({
            map: 'world_mill_en',
            backgroundColor: 'transparent',
            borderColor: '#fff',
            borderOpacity: 0.25,
            borderWidth: 0,
            color: '#e6e6e6',
            regionStyle : {
                initial : {
                fill : '#f4f4f4'
                }
            },

            markerStyle: {
            initial: {
                        r: 5,
                        'fill': '#fff',
                        'fill-opacity':1,
                        'stroke': '#000',
                        'stroke-width' : 1,
                        'stroke-opacity': 0.4
                    },
                },
        
            markers : [{
                latLng : [21.00, 78.00],
                name : 'INDIA : 350'
            
            },
            {
                latLng : [-33.00, 151.00],
                name : 'Australia : 250'
                
            },
            {
                latLng : [36.77, -119.41],
                name : 'USA : 250'
            
            },
            {
                latLng : [55.37, -3.41],
                name : 'UK   : 250'
            
            },
            {
                latLng : [25.20, 55.27],
                name : 'UAE : 250'
            
            }],

            series: {
                regions: [{
                    values: {
                        "US": '#49c5b6',
                        "SA": '#667add',
                        "AU": '#50d38a',
                        "IN": '#60bafd',
                        "GB": '#ff758e',
                    },
                    attribute: 'fill'
                }]
            },
            hoverOpacity: null,
            normalizeFunction: 'linear',
            zoomOnScroll: false,
            scaleColors: ['#000000', '#000000'],
            selectedColor: '#000000',
            selectedRegions: [],
            enableZoom: false,
            hoverColor: '#fff',
        });
    }
}, 800);
*/