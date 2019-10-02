/*
 *  Document   : be_pages_dashboard.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Dashboard Page
 */

class pageDashboard {
    /*
     * Chart.js, for more examples you can check out http://www.chartjs.org/docs
     *
     */
    static initChartsMain() {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#495057';
        Chart.defaults.scale.gridLines.color                = 'transparent';
        Chart.defaults.scale.gridLines.zeroLineColor        = 'transparent';
        Chart.defaults.scale.display                        = false;
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 0;
        Chart.defaults.global.elements.point.radius         = 0;
        Chart.defaults.global.elements.point.hoverRadius    = 0;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.labels.boxWidth        = 12;

        // Get Chart Containers
        let chartMainCon  = jQuery('.js-chartjs-dashboard-earnings');
        let chartMainDataCurrentEventLabels = jQuery('.main-chart-event-data-current').data('labels');
        let chartMainDataCurrentEventValues = jQuery('.main-chart-event-data-current').data('values');
        let chartMainDataLastEventLabels = jQuery('.main-chart-event-data-last').data('labels');
        let chartMainDataLastEventValues = jQuery('.main-chart-event-data-last').data('values');
        let chartMainDataNextEventLabels = jQuery('.main-chart-event-data-next').data('labels');
        let chartMainDataNextEventValues = jQuery('.main-chart-event-data-next').data('values');

        let chartMainDataConcat = chartMainDataCurrentEventValues.concat(chartMainDataLastEventValues).concat(chartMainDataNextEventValues);

        let chartMainGradient = chartMainCon[0].getContext('2d');
        
        let chartMainGradient1, chartMainGradient2, chartMainGradient3;

        chartMainGradient1 = chartMainGradient.createLinearGradient(0, 0, 0, 200);
        chartMainGradient2 = chartMainGradient.createLinearGradient(0, 0, 0, 200);
        chartMainGradient3 = chartMainGradient.createLinearGradient(0, 0, 0, 200);

        chartMainGradient1.addColorStop(0, 'rgba(130, 181, 75, 1)');
        chartMainGradient1.addColorStop(1, 'rgba(130, 181, 75, .2)');

        chartMainGradient2.addColorStop(0, 'rgba(233, 236, 239, 1)');
        chartMainGradient2.addColorStop(1, 'rgba(233, 236, 239, 0.2)');
        
        chartMainGradient3.addColorStop(0, 'rgba(40,97,245,0.8');
        chartMainGradient3.addColorStop(1, 'rgba(40,97,245,0.2');
        
        // Set Main Chart variables
        let chartMain, chartMainOptions, chartMainData, chartMainDataYear, chartMainDataMonth, chartMainDataWeek;

        // Main Chart Options
        chartMainOptions = {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: Math.max.apply(Math, chartMainDataConcat),
                        //max: 315
                    }
                }]
            },
            tooltips: {
                intersect: false,
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' ' + tooltipItems.yLabel + ' Sales';
                    }
                }
            }
        };

        // Main Chart Default Data
        chartMainData = {
            labels: chartMainDataCurrentEventLabels,
            datasets: [
                {
                    label: 'aktuelles Jahr',
                    fill: true,
                    backgroundColor: 'rgba(130, 181, 75, .3)',
                    //backgroundColor: chartMainGradient1,
                    //borderColor: 'rgba(130, 181, 75, .1)',
                    pointBackgroundColor: 'rgba(130, 181, 75, 1)',
                    pointBorderColor: '#fff',
                    //borderWidth: 6,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(130, 181, 75, 1)',
                    lineTension: 0.25,
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderWidth: 0,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 10,
                    pointRadius: 0,
                    pointHitRadius: 30,
                    data: chartMainDataCurrentEventValues,
                },
                {
                    label: 'Vorjahr',
                    fill: true,
                    //backgroundColor: 'rgba(0, 0, 0, 0.2)',
                    backgroundColor: chartMainGradient2,
                    //borderColor: 'rgba(0, 0, 0, 0.1)',
                    pointBackgroundColor: 'rgba(233, 236, 239, 1)',
                    pointBorderColor: '#fff',
                    //borderWidth: 6,
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(233, 236, 239, 1)',
                    lineTension: 0.25,
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderWidth: 0,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 10,
                    pointRadius: 0,
                    pointHitRadius: 30,
                    data: chartMainDataNextEventValues
                }
            ]
        };

        // Main Chart for Year
        chartMainDataYear = {
            labels: this.randoms(80, 0, 80),
            datasets: [
                {
                    label: 'aktuelles Jahr',
                    fill: true,
                    backgroundColor: 'rgba(130, 181, 75, .3)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(130, 181, 75, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(130, 181, 75, 1)',
                    data: chartMainDataCurrentEventValues
                },
                {
                    label: 'Vorjahr',
                    fill: true,
                    backgroundColor: 'rgba(233, 236, 239, 1)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(233, 236, 239, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(233, 236, 239, 1)',
                    data: chartMainDataNextEventValues
                }
            ]
        };

        // Set up month labels
        let chartMainDataMonthLabels = [];

        for (let i = 0; i < 30; i++) {
            chartMainDataMonthLabels[i] = (i === 29) ? '1 day ago' : (30 - i) + ' days ago';
        }

        // Main Chart Data for Month
        chartMainDataMonth = {
            labels: chartMainDataMonthLabels,
            datasets: [
                {
                    label: 'This Month',
                    fill: true,
                    backgroundColor: 'rgba(130, 181, 75, .3)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(130, 181, 75, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(130, 181, 75, 1)',
                    data: chartMainDataCurrentEventValues
                },
                {
                    label: 'Last Month',
                    fill: true,
                    backgroundColor: 'rgba(233, 236, 239, 1)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(233, 236, 239, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(233, 236, 239, 1)',
                    data: chartMainDataNextEventValues
                }
            ]
        };

        // Main Chart Data for Week
        chartMainDataWeek = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(130, 181, 75, .3)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(130, 181, 75, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(130, 181, 75, 1)',
                    data: chartMainDataCurrentEventValues
                },
                {
                    label: 'Last Week',
                    fill: true,
                    backgroundColor: 'rgba(233, 236, 239, 1)',
                    borderColor: 'transparent',
                    pointBackgroundColor: 'rgba(233, 236, 239, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(233, 236, 239, 1)',
                    data: chartMainDataNextEventValues
                }
            ]
        };

        // Init Main Chart
        if (chartMainCon.length) {
            chartMain = new Chart(chartMainCon, {
                type: 'line',
                data: chartMainData,
                options: chartMainOptions
            });
        }

        // Toggle to Week data
        jQuery('[data-toggle="dashboard-chart-set-week"]').on('click', () => {
            chartMain.data.labels       = chartMainDataWeek.labels;
            chartMain.data.datasets[0]  = chartMainDataWeek.datasets[0];
            chartMain.data.datasets[1]  = chartMainDataWeek.datasets[1];
            chartMain.update();
        });

        // Toggle to Month data
        jQuery('[data-toggle="dashboard-chart-set-month"]').on('click', () => {
            chartMain.data.labels       = chartMainDataMonth.labels;
            chartMain.data.datasets[0]  = chartMainDataMonth.datasets[0];
            chartMain.data.datasets[1]  = chartMainDataMonth.datasets[1];
            chartMain.update();
        });

        // Toggle to Year data
        jQuery('[data-toggle="dashboard-chart-set-year"]').on('click', () => {
            chartMain.data.labels       = chartMainDataYear.labels;
            chartMain.data.datasets[0]  = chartMainDataYear.datasets[0];
            chartMain.data.datasets[1]  = chartMainDataYear.datasets[1];
            chartMain.update();
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initChartsMain();
    }

    static randoms(limit, bottom, top) {
        for (var array=[],i=bottom;i<limit;++i) array[i]=i;
        var tmp, current;
        if(top) while(--top) {
          current = Math.floor(Math.random() * (top + 1));
          tmp = array[current];
          array[current] = array[top];
          array[top] = tmp;
        }
        return array;
    }
}

// Initialize when page loads
jQuery(() => { pageDashboard.init(); });
