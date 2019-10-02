/*!
 * Dashmix - v1.5.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2018
 */

/*
$('select.form-control').selectpicker({
   'showTick': true,
   'liveSearchNormalize': true,
   'liveSearchPlaceholder': 'Suche...',
   'noneResultsText': 'keine Ergebnisse {0}. Mindestens 3 Zeichen.'
});

$('.bs-searchbox > input').keyup(function(event) {
   var select = $(this).parent().parent().prevAll('select');
   var ajax = select.data('ajax-source');
   var keyword = $(this).val();

   if(ajax && keyword && keyword.trim().length >= 3 && select && event.key == "Enter") {
       $.ajax({
           type: "GET",
           url: ajax,
           data: { keyword: keyword },
           dataType: "JSON",
           success: function (data) {
               console.log(data);
               var options = '';
               $.each(data, function (key, value) { 
                   options += '<option value="'+value.id+'">'+value.name+'</option>';
               });
               $(select).html(options).selectpicker('refresh');
           }
       });
   }
});

*/

$(function () {
    let token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    console.log('X-CSRF-TOKEN: ' + token)
});

function getStudyDays() {
    let study_id = $("#study_id").val();

    if (study_id) {
        $.ajax({
            type: "GET",
            url: "/studydays/",
            data: { study_id: study_id },
            dataType: "JSON",
            beforeSend: function (data) {
                $("input[name=days]").attr("checked", false);
                $(".create-suggestions").attr("disabled", true);
            },
            success: function (data) {
                if (data) {
                    $("#monday").attr(
                        "checked",
                        data.monday > 0 ? true : false
                    );
                    $("#tuesday").attr(
                        "checked",
                        data.tuesday > 0 ? true : false
                    );
                    $("#wednesday").attr(
                        "checked",
                        data.wednesday > 0 ? true : false
                    );
                    $("#thursday").attr(
                        "checked",
                        data.thursday > 0 ? true : false
                    );
                    $("#friday").attr(
                        "checked",
                        data.friday > 0 ? true : false
                    );
                    $("#saturday").attr(
                        "checked",
                        data.saturday > 0 ? true : false
                    );
                    $("#sunday").attr(
                        "checked",
                        data.sunday > 0 ? true : false
                    );
                }
            }
        });
    }
}

function getCourseDays() {
    let study_id = $("#study_id").val();
    let course_id = $("#course_id").val();

    if (study_id && course_id) {
        $.ajax({
            type: "GET",
            url: "/coursedays/",
            data: { study_id: study_id, course_id: course_id },
            dataType: "JSON",
            beforeSend: function (data) {
                $("input[name=days]").attr("checked", false);
                $(".create-suggestions").attr("disabled", true);
            },
            success: function (data) {
                //console.log(data);
                if (data) {
                    $(".create-suggestions").attr("disabled", false);

                    $("#monday").attr(
                        "checked",
                        data.monday > 0 ? true : false
                    );
                    $("#tuesday").attr(
                        "checked",
                        data.tuesday > 0 ? true : false
                    );
                    $("#wednesday").attr(
                        "checked",
                        data.wednesday > 0 ? true : false
                    );
                    $("#thursday").attr(
                        "checked",
                        data.thursday > 0 ? true : false
                    );
                    $("#friday").attr(
                        "checked",
                        data.friday > 0 ? true : false
                    );
                    $("#saturday").attr(
                        "checked",
                        data.saturday > 0 ? true : false
                    );
                    $("#sunday").attr(
                        "checked",
                        data.sunday > 0 ? true : false
                    );
                }
            }
        });
    }
}

function getCoursesOfStudy() {
    let study_id = $("#study_id").val();
    let dropdown = $("#course_id");
    let weekdays = $("input[name=days]");

    let days = [];
    $.each($("input[name=days]:checked"), function () {
        days.push($(this).val());
    });

    if (study_id) {
        $.ajax({
            type: "GET",
            url: "/studycourses/",
            data: { study_id: study_id },
            dataType: "JSON",
            beforeSend: function (data) {
                dropdown.html("").attr("disabled", true);
                weekdays.attr("checked", false);
            },
            success: function (data) {
                if (data) {
                    let options = "<option value=''>---</option>";

                    $.each(data, function (key, value) {
                        options +=
                            '<option value="' +
                            value.id +
                            '">' +
                            value.number +
                            " " +
                            value.name +
                            "</option>";
                    });

                    dropdown.html(options).attr("disabled", false);
                }
            }
        });
    }
}


function getActivities() {
    $.ajax({
        type: "GET",
        url: "/xhr/activities",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/activities...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getMethods() {
    $.ajax({
        type: "GET",
        url: "/xhr/methods",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/methods...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getFiles() {
    $.ajax({
        type: "GET",
        url: "/xhr/files",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/files...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getPeriods() {
    $.ajax({
        type: "GET",
        url: "/xhr/periods",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/periods...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getExclusions() {
    $.ajax({
        type: "GET",
        url: "/xhr/exclusions",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/exclusions...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}


function getImports() {
    $.ajax({
        type: "GET",
        url: "/xhr/imports",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/imports...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getEvents() {
    $.ajax({
        type: "GET",
        url: "/xhr/events",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/events...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getGrades() {
    $.ajax({
        type: "GET",
        url: "/xhr/grades",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/grades...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getPersons() {
    $.ajax({
        type: "GET",
        url: "/xhr/persons",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/persons...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getCourses() {
    $.ajax({
        type: "GET",
        url: "/xhr/courses",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/courses...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getRooms() {
    $.ajax({
        type: "GET",
        url: "/xhr/rooms",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/rooms...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getAssets() {
    $.ajax({
        type: "GET",
        url: "/xhr/assets",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/assets...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getStudies() {
    $.ajax({
        type: "GET",
        url: "/xhr/studies",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/studies...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getGroups() {
    $.ajax({
        type: "GET",
        url: "/xhr/groups",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/groups...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getObjectives() {
    $.ajax({
        type: "GET",
        url: "/xhr/skills",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/skills...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getSkills() {
    $.ajax({
        type: "GET",
        url: "/xhr/skills",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/skills...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}

function getScripts() {
    $.ajax({
        type: "GET",
        url: "/xhr/scripts",
        data: {},
        dataType: "JSON",
        beforeSend: function () {
            console.log('Fetching data over /xhr/scripts...');
        },
        success: function (data) {
            if (data.success) {
                console.log(data.result);
            }
        }
    });
}


  // #10. CHARTJS CHARTS http://www.chartjs.org/

  if (typeof Chart !== 'undefined') {

    var fontFamily = '"Proxima Nova W01", -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
    // set defaults
    Chart.defaults.global.defaultFontFamily = fontFamily;
    Chart.defaults.global.tooltips.titleFontSize = 14;
    Chart.defaults.global.tooltips.titleMarginBottom = 4;
    Chart.defaults.global.tooltips.displayColors = false;
    Chart.defaults.global.tooltips.bodyFontSize = 12;
    Chart.defaults.global.tooltips.xPadding = 10;
    Chart.defaults.global.tooltips.yPadding = 8;

    // init lite line chart if element exists

    if ($("#liteLineChart").length) {
      var liteLineChart = $("#liteLineChart");

      var liteLineGradient = liteLineChart[0].getContext('2d').createLinearGradient(0, 0, 0, 200);
      liteLineGradient.addColorStop(0, 'rgba(30,22,170,0.08)');
      liteLineGradient.addColorStop(1, 'rgba(30,22,170,0)');

      var chartData = [13, 28, 19, 24, 43, 49];

      if (liteLineChart.data('chart-data')) chartData = liteLineChart.data('chart-data').split(',');

      // line chart data
      var liteLineData = {
        labels: ["January 1", "January 5", "January 10", "January 15", "January 20", "January 25"],
        datasets: [{
          label: "Sold",
          fill: true,
          lineTension: 0.4,
          backgroundColor: liteLineGradient,
          borderColor: "#8f1cad",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#fff",
          pointBackgroundColor: "#2a2f37",
          pointBorderWidth: 2,
          pointHoverRadius: 6,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 2,
          pointRadius: 4,
          pointHitRadius: 5,
          data: chartData,
          spanGaps: false
        }]
      };

      // line chart init
      var myLiteLineChart = new Chart(liteLineChart, {
        type: 'line',
        data: liteLineData,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: false,
              ticks: {
                fontSize: '11',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 55
              }
            }]
          }
        }
      });
    }

    // init lite line chart V2 if element exists

    if ($("#liteLineChartV2").length) {
      var liteLineChartV2 = $("#liteLineChartV2");

      var liteLineGradientV2 = liteLineChartV2[0].getContext('2d').createLinearGradient(0, 0, 0, 100);
      liteLineGradientV2.addColorStop(0, 'rgba(40,97,245,0.1)');
      liteLineGradientV2.addColorStop(1, 'rgba(40,97,245,0)');

      var chartDataV2 = [13, 28, 19, 24, 43, 49, 40, 35, 42, 46];

      if (liteLineChartV2.data('chart-data')) chartDataV2 = liteLineChartV2.data('chart-data').split(',');

      // line chart data
      var liteLineDataV2 = {
        labels: ["1", "3", "6", "9", "12", "15", "18", "21", "24", "27"],
        datasets: [{
          label: "Balance",
          fill: true,
          lineTension: 0.35,
          backgroundColor: liteLineGradientV2,
          borderColor: "#2861f5",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#2861f5",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 2,
          pointRadius: 3,
          pointHitRadius: 10,
          data: chartDataV2,
          spanGaps: false
        }]
      };

      // line chart init
      var myLiteLineChartV2 = new Chart(liteLineChartV2, {
        type: 'line',
        data: liteLineDataV2,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '10',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 55
              }
            }]
          }
        }
      });
    }

    // init lite line chart V2 if element exists

    if ($("#liteLineChartV3").length) {
      var liteLineChartV3 = $("#liteLineChartV3");

      var liteLineGradientV3 = liteLineChartV3[0].getContext('2d').createLinearGradient(0, 0, 0, 255);
      liteLineGradientV3.addColorStop(0, 'rgba(40,97,245,0.8)');
      liteLineGradientV3.addColorStop(1, 'rgba(40,97,245,0.3)');

      var chartDataV3 = [4.8,4.9,5.0,5.1,5.0,4.8,5.5,5.8,5.5,5.0,6.2,4.6,5.0,4.0,5.9,4.0,6.1,6.0,5.8,3.5,6.8,4.5,6.0,4.2,4.6,6.0,4.8,5.9,5.0,6.1,5.0,5.8,5.5,5.8,5.5,5.0,6.2,4.6,5.0,4.8,4.9,5.0,5.1,5.0,4.8,5.5,5.8,5.5,5.0,6.2,4.6,5.0];
      var chartDataV4 = [3.8,8.9,2.0,5.1,4.8,4.9,5.0,5.1,5.0,4.8,5.5,5.8,5.5,5.0,6.2,4.6,5.0,4.2,4.6,6.0,4.8,5.9,5.0,6.1,5.0,5.8,5.5,5.8,5.5,5.0,6.2,4.6,5.0,5.0,4.8,5.5,5.8,5.5,5.0,6.2,4.6,5.0,4.0,5.9,4.0,6.1,6.0,5.8,3.5,6.8,4.5,6.0];

      //if (liteLineChartV3.data('chart-data')) chartDataV3 = liteLineChartV3.data('chart-data').split(',');

      // line chart data
      var liteLineDataV3 = {
        labels: ["", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", ""],
        datasets: [{
          label: "Preis",
          fill: true,
          lineTension: 0.15,
          backgroundColor: liteLineGradientV3,
          borderColor: "#2861f5",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#2861f5",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#2861F5",
          pointHoverBorderWidth: 10,
          pointRadius: 0,
          pointHitRadius: 30,
          data: chartDataV3,
          spanGaps: false
        }, 
        {
            label: "Preis",
            fill: true,
            lineTension: 0.15,
            backgroundColor: liteLineGradientV4,
            borderColor: "#2861f5",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#2861f5",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 2,
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "#FC2055",
            pointHoverBorderColor: "#2861F5",
            pointHoverBorderWidth: 10,
            pointRadius: 0,
            pointHitRadius: 30,
            data: chartDataV4,
            spanGaps: true
          }]
      };

      // line chart init
      var myLiteLineChartV3 = new Chart(liteLineChartV3, {
        type: 'line',
        data: liteLineDataV3,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '8',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 10
              }
            }]
          }
        }
      });
    }

    if ($("#liteLineChartV4").length) {
      var liteLineChartV4 = $("#liteLineChartV4");

      var liteLineGradientV4 = liteLineChartV4[0].getContext('2d').createLinearGradient(0, 0, 0, 255);
      liteLineGradientV4.addColorStop(0, 'rgba(225,49,49,0.8)');
      liteLineGradientV4.addColorStop(1, 'rgba(225,49,49,0.05)');

      var chartDataV4 = [28, 12, 29, 5, 11, 15, 30, 35, 40, 26, 18];

      if (liteLineChartV4.data('chart-data')) chartDataV4 = liteLineChartV4.data('chart-data').split(',');

      // line chart data
      var liteLineDataV4 = {
        labels: ["", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", ""],
        datasets: [{
          label: "Preis",
          fill: true,
          lineTension: 0.15,
          backgroundColor: liteLineGradientV4,
          borderColor: "#E13131",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#2861f5",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#E13131",
          pointHoverBorderColor: "#E13131",
          pointHoverBorderWidth: 10,
          pointRadius: 0,
          pointHitRadius: 30,
          data: chartDataV4,
          spanGaps: true
        }]
      };

      // line chart init
      var myliteLineChartV4 = new Chart(liteLineChartV4, {
        type: 'line',
        data: liteLineDataV4,
        options: {
          legend: {
            display: false
          },

          scales: {
            xAxes: [{
              ticks: {
                fontSize: '10',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: true,
              ticks: {
                beginAtZero: true,
                max: 10
              }
            }]
          }
        }
      });
    }


    
    if ($("#liteLineChartV5").length) {
      var liteLineChartV5 = $("#liteLineChartV5");

      var liteLineGradientV4 = liteLineChartV5[0].getContext('2d').createLinearGradient(0, 0, 0, 70);
      liteLineGradientV4.addColorStop(0, 'rgba(40,97,245,0.5)');
      liteLineGradientV4.addColorStop(1, 'rgba(40,97,245,0)');

      var chartDataV5 = [28, 12, 29, 5, 11, 15, 30, 35, 40, 26, 18];

      if (liteLineChartV5.data('chart-data')) chartDataV5 = liteLineChartV5.data('chart-data').split(',');

      // line chart data
      var liteLineDataV5 = {
        labels: ["", "FEB", "", "MAR", "", "APR", "", "MAY", "", "JUN", "", "JUL", ""],
        datasets: [{
          label: "Billanz",
          fill: true,
          lineTension: 0.15,
          backgroundColor: liteLineGradientV4,
          borderColor: "#2861f5",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#2861f5",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 0,
          pointRadius: 0,
          pointHitRadius: 10,
          data: chartDataV5,
          spanGaps: false
        }]
      };

      // line chart init
      var myliteLineChartV5 = new Chart(liteLineChartV5, {
        type: 'line',
        data: liteLineDataV5,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '10',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.0)',
                zeroLineColor: 'rgba(0,0,0,0.0)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 55
              }
            }]
          }
        }
      });
    }


    // init line chart if element exists
    if ($("#lineChart").length) {
      var lineChart = $("#lineChart");

      // line chart data
      var lineData = {
        labels: ["1", "5", "10", "15", "20", "25", "30", "35"],
        datasets: [{
          label: "Visitors Graph",
          fill: false,
          lineTension: 0.3,
          backgroundColor: "#fff",
          borderColor: "#047bf8",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "#fff",
          pointBackgroundColor: "#141E41",
          pointBorderWidth: 3,
          pointHoverRadius: 10,
          pointHoverBackgroundColor: "#FC2055",
          pointHoverBorderColor: "#fff",
          pointHoverBorderWidth: 3,
          pointRadius: 5,
          pointHitRadius: 10,
          data: [27, 20, 44, 24, 29, 22, 43, 52],
          spanGaps: false
        }]
      };

      // line chart init
      var myLineChart = new Chart(lineChart, {
        type: 'line',
        data: lineData,
        options: {
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontSize: '11',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.05)',
                zeroLineColor: 'rgba(0,0,0,0.05)'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
                max: 65
              }
            }]
          }
        }
      });
    }

    // init donut chart if element exists
    if ($("#barChart1").length) {
      var barChart1 = $("#barChart1");
      var barData1 = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
          label: "My First dataset",
          backgroundColor: ["#5797FC", "#629FFF", "#6BA4FE", "#74AAFF", "#7AAEFF", '#85B4FF'],
          borderColor: ['rgba(255,99,132,0)', 'rgba(54, 162, 235, 0)', 'rgba(255, 206, 86, 0)', 'rgba(75, 192, 192, 0)', 'rgba(153, 102, 255, 0)', 'rgba(255, 159, 64, 0)'],
          borderWidth: 1,
          data: [24, 42, 18, 34, 56, 28]
        }]
      };
      // -----------------
      // init bar chart
      // -----------------
      new Chart(barChart1, {
        type: 'bar',
        data: barData1,
        options: {
          scales: {
            xAxes: [{
              display: false,
              ticks: {
                fontSize: '11',
                fontColor: '#969da5'
              },
              gridLines: {
                color: 'rgba(0,0,0,0.05)',
                zeroLineColor: 'rgba(0,0,0,0.05)'
              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                color: 'rgba(0,0,0,0.05)',
                zeroLineColor: '#6896f9'
              }
            }]
          },
          legend: {
            display: false
          },
          animation: {
            animateScale: true
          }
        }
      });
    }

    // init pie chart if element exists
    if ($("#pieChart1").length) {
      var pieChart1 = $("#pieChart1");

      // pie chart data
      var pieData1 = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
        datasets: [{
          data: [300, 50, 100, 30, 70],
          backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          borderWidth: 0
        }]
      };

      // -----------------
      // init pie chart
      // -----------------
      new Chart(pieChart1, {
        type: 'pie',
        data: pieData1,
        options: {
          legend: {
            position: 'bottom',
            labels: {
              boxWidth: 15,
              fontColor: '#3e4b5b'
            }
          },
          animation: {
            animateScale: true
          }
        }
      });
    }

    // -----------------
    // init donut chart if element exists
    // -----------------
    if ($("#donutChart").length) {
      var donutChart = $("#donutChart");

      // donut chart data
      var data = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
        datasets: [{
          data: [300, 50, 100, 30, 70],
          backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          borderWidth: 0
        }]
      };

      // -----------------
      // init donut chart
      // -----------------
      new Chart(donutChart, {
        type: 'doughnut',
        data: data,
        options: {
          legend: {
            display: false
          },
          animation: {
            animateScale: true
          },
          cutoutPercentage: 80
        }
      });
    }

    // -----------------
    // init donut chart if element exists
    // -----------------
    if ($("#donutChart1").length) {
      var donutChart1 = $("#donutChart1");

      // donut chart data
      var data1 = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
        datasets: [{
          data: [300, 50, 100, 30, 70],
          backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
          borderWidth: 6,
          hoverBorderColor: 'transparent'
        }]
      };

      // -----------------
      // init donut chart
      // -----------------
      new Chart(donutChart1, {
        type: 'doughnut',
        data: data1,
        options: {
          legend: {
            display: false
          },
          animation: {
            animateScale: true
          },
          cutoutPercentage: 80
        }
      });
    }
  }