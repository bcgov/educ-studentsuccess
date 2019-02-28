// ***************************
var margin = {
  top: 50,
  right: 30,
  bottom: 50,
  left: 30
};

var width = 860 - margin.left - margin.right,
  height = 700 - margin.top - margin.bottom;
var centered;

var formatC = d3.format(",.0f");
var formatD = d3.format("+,.0f");
//var of min & max number of students move in and out 
var movein_min, movein_max, moveout_min, moveout_max;


var projection = d3.geoAlbers()
  .rotate([122, 0, 0])
  .scale(2700)
  .translate([width * .57, height * 1.7]);

var path = d3.geoPath()
  .projection(projection);

var svg = d3.select("#map").append("svg")
  .attr("width", width + margin.right + margin.left)
  .attr("height", height + margin.top + margin.bottom);

var chartGroup = svg.append("g");

//initialize html tooltip
var tooltip = d3.select("#map-container")
  .append("div")
  .attr("id", "tt")
  .style("z-index", "10")
  .style("position", "absolute")
  .style("visibility", "hidden");


var dateScale, sliderScale, slider;

var format = d3.format(",");

// var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
//     months_full = ["January","February","March","April","May","June","July","August","September","October","November","December"],
var orderedColumns = [],
  currentFrame = 0,
  interval,
  frameLength = 500,
  isPlaying = false;

var sliderMargin = 65;

//create scales
var circleSize = d3.scaleLinear().range([0, 400]).domain([0, 300]);

d3.csv('csv/sd_coming.csv', function (data) {
  comingData = data;

  //array contains all coming numbers
  let num_coming_arr = [];

  //loop through the csv, length is the total number of rows(districts)
  for (var i = 0; i < data.length; i++) {
    //for...in statement iterates over all non-Symbol, enumerable properties (columns) of an object(each row)
    for (var stu_num in data[i]) {
      var stu_num = parseFloat(data[i][stu_num]); //parseFloat() parses a string and returns a floating point number
      //filter out all NaN
      if (!isNaN(stu_num)) {
        num_coming_arr.push(stu_num);
      }
    }
  }
  movein_min = Math.ceil(Math.min.apply(Math, num_coming_arr.filter(Boolean)));
  //movein_max will be the max # of total move in, from going csv
});


d3.csv('csv/sd_going.csv', function (data) {
  goingData = data;

  console.log(goingData);
  //array contains all going numbers
  let num_going_arr = [];

  //loop through the csv, length is the total number of rows(states)
  for (var i = 0; i < data.length; i++) {
    //for...in statement iterates over all non-Symbol, enumerable properties (columns) of an object(each row)
    for (var stu_num in data[i]) {

      //filter out last two colums (totals)
      var stu_num = parseFloat(data[i][stu_num]); //parseFloat() parses a string and returns a floating point number
      //filter out all NaN
      if (!isNaN(stu_num)) {
        num_going_arr.push(stu_num);
      }
    }
    moveout_min = Math.ceil(Math.min.apply(Math, num_going_arr.filter(Boolean)));
    moveout_max = Math.round(Math.max.apply(Math, num_going_arr));
    console.log(moveout_min, moveout_max);

    //this is for max in movingin column
    data.forEach(function (d) {
      d.total_move_in = parseInt(d.total_move_in);
    });
    movein_max = d3.max(data, function (d) {
      return d.total_move_in;
    });
  }
  /////////////////////////////////////
  var indomain = [moveout_min, moveout_max]; //domain of min-max 
  var outdomain = [movein_min, movein_max];


  d3.json("json/sd_geo.json", function (error, json) {

    //loop through the csv, length is the total number of rows(districts)
    for (var i = 0; i < data.length; i++) {
      var dataDistrict = data[i].District; //district names in csv data
      var tempObj = {}; //crate a temp object

      //for...in statement iterates over all non-Symbol, enumerable properties (columns) of an object(each row)
      for (var propt in data[i]) {
        var valz = parseFloat(data[i][propt]); //parseFloat() parses a string and returns a floating point number
        tempObj[propt] = valz;
      }
      //Find the corresponding district inside the GeoJSON
      for (var j = 0; j < json.features.length; j++) {

        var jsonDistrict = json.features[j].properties.SDNAME; //state names in json file

        if (dataDistrict == jsonDistrict) {

          matched = true; //match flag
          //create new properties and add vals in json
          json.features[j].properties.district = dataDistrict;
          json.features[j].id = dataDistrict;
          json.features[j].abbrev = data[i].Abbrev;
          json.features[j].ind = i;

          //loop all propt in this temp object
          for (var propt in tempObj) {
            //check if it's a number
            if (!isNaN(tempObj[propt])) {
              //add properties&vals to json
              json.features[j].properties[propt] = tempObj[propt];
            }

          }
          break;
        }
      }
    }

    //Bind data and create one path per GeoJSON feature
    chartGroup.selectAll("path")
      .data(json.features)
      .enter()
      .append("path")
      .attr("class", "district")
      //add id(district name) to each path (district shape on map)
      .attr("id", function (d) {
        return d.properties.district;
      })
      .attr("d", path) //path here is the geo path generator
      .attr("stroke-width", 0.5)
      .attr("class", "land");

    // map.selectAll("path")
    //     .data(topojson.feature(us, us.objects.states).features)
    //     .enter()
    //     .append("path")
    //     .attr("vector-effect","non-scaling-stroke")
    //     .attr("class","land")
    //     .attr("d", path);

    //  map.append("path")
    //      .datum(topojson.mesh(us, us.objects.states, function(a, b) { return a !== b; }))
    //      .attr("class", "state-boundary")
    //      .attr("vector-effect","non-scaling-stroke")
    //      .attr("d", path);

    // probe = d3.select("#map-container").append("div")
    //   .attr("id","probe");

    // d3.select("body")
    //   .append("div")
    //   .attr("id","loader")
    //   .style("top",d3.select("#play").node().offsetTop + "px")
    //   .style("height",d3.select("#date").node().offsetHeight + d3.select("#map-container").node().offsetHeight + "px")

    //Bind data to circles per GeoJSON feature/districts	
    chartGroup.selectAll("circle")
      .data(json.features)
      .enter().append("circle")
      .attr("cx", function (d) {
        var centname = d.properties.SDNAME;
        var ctroid;
        ctroid = path.centroid(d)[0]; // get the centroid x
        return ctroid;
      })
      .attr("cy", function (d) {
        var centname = d.properties.SDNAME;
        var ctroid;
        ctroid = path.centroid(d)[1]; // get the centroid y
        return ctroid;
      })
      .attr("r", function (d) {
        //radius of the circle is defined by the number of total net migration change

        /*total_move_in and totale_emm are columns from csv file
        got added to json features through :    
        json.features[j].properties[propt] = tempObj[propt];*/
        var diff = d.properties.total_move_in - d.properties.total_move_out;
        //gives a minmum r if net changes = 0
        if (Math.abs(diff) < 5) {
          return 2;
        } else {
          return circleSize(Math.sqrt(Math.abs(diff) / Math.PI));
        }

      })
      .attr("class", "circ")
      //attach district name to each circle
      .attr("id", function (d) {
        return d.abbrev;
      })
      .attr("fill", function (d) {
        /*fill the color based on -/+ net changes*/
        var diff = d.properties.total_move_in - d.properties.total_move_out;
        if (diff > 0) {
          return "#67a9cf";
        } else {
          return "#ef8a62";
        }

      })
      .attr("fill-opacity", "0.5")
      .attr("stroke", "#fff")
      .attr("stroke-weight", "0.5")

      // add event listener for mouse over
      .on("mouseenter", function (d) {
        //toolOver is the event handler
        return toolOver(d, this);
      })
      .on("mousemove", function (d) {
        //gets mouse coordinates on screen
        var m = d3.mouse(this);
        mx = m[0];
        my = m[1];

        return toolMove(mx, my, d);
      })
      .on("mouseleave", function (d) {
        return toolOut(d, this);
      });


    window.onresize = resize;
    resize();
  });
});


/*
  d3.csv('csv/test.csv',function(data){
    var first = data[0];
    // get columns
    for ( var mug in first ){
      if ( mug != "CITY" && mug != "LAT" && mug != "LON" ){
        orderedColumns.push(mug);
      }
    }
    orderedColumns = ["1999","2000","2001","2002","2003","2004","2005","2006","2007","2008"];

    orderedColumns.sort( sortColumns );

    draw city points 
    for ( var i in data ){
      var projected = projection([ parseFloat(data[i].LON), parseFloat(data[i].LAT) ])
      map.append("circle")
        .datum( data[i] )
        .attr("cx",projected[0])
        .attr("cy",projected[1])
        .attr("r",1)
        .attr("vector-effect","non-scaling-stroke")
        .on("mousemove",function(d){
          hoverData = d;
          setProbeContent(d);
          probe
            .style( {
              "display" : "block",
              "top" : (d3.event.pageY - 80) + "px",
              "left" : (d3.event.pageX + 10) + "px"
            })
        })
        .on("mouseout",function(){
          hoverData = null;
          probe.style("display","none");
        })
    }

    createLegend();

    dateScale = createDateScale(orderedColumns).range([0,500]);
    
    createSlider();

    d3.select("#play")
      .attr("title","Play animation")
      .on("click",function(){
        if ( !isPlaying ){
          isPlaying = true;
          d3.select(this).classed("pause",true).attr("title","Pause animation");
          animate();
        } else {
          isPlaying = false;
          d3.select(this).classed("pause",false).attr("title","Play animation");
          clearInterval( interval );
        }
      });

    drawMonth( orderedColumns[currentFrame] ); // initial map

    window.onresize = resize;
    resize();

    d3.select("#loader").remove();

  })

});

function drawMonth(m,tween){
  var circle = map.selectAll("circle")
    .sort(function(a,b){
      // catch nulls, and sort circles by size (smallest on top)
      if ( isNaN(a[m]) ) a[m] = 0;
      if ( isNaN(b[m]) ) b[m] = 0;
      return Math.abs(b[m]) - Math.abs(a[m]);
    })
    .attr("class",function(d){
      return d[m] > 0 ? "gain" : "loss";
    })
  if ( tween ){
    circle
      .transition()
      .ease("linear")
      .duration(frameLength)
      .attr("r",function(d){
        return circleSize(d[m])
      });
  } else {
    circle.attr("r",function(d){
      return circleSize(d[m])
    });
  }

  d3.select("#date p#month").html( monthLabel(m) );

  if (hoverData){
    setProbeContent(hoverData);
  }
}

function animate(){
  interval = setInterval( function(){
    currentFrame++;

    if ( currentFrame == orderedColumns.length ) currentFrame = 0;

    d3.select("#slider-div .d3-slider-handle")
      .style("left", 100*currentFrame/(orderedColumns.length-1) + "%" );
    slider.value(currentFrame)

    console.log(100*currentFrame/(orderedColumns.length-1) + "%");

    drawMonth( orderedColumns[ currentFrame ], true );

    if ( currentFrame == orderedColumns.length - 1 ){
      isPlaying = false;
      d3.select("#play").classed("pause",false).attr("title","Play animation");
      clearInterval( interval );
      return;
    }

  },frameLength);
}

function createSlider(){

  sliderScale = d3.scaleLinear().domain([0,orderedColumns.length-1]);

  var val = slider ? slider.value() : 0;

  slider = d3.slider()
    .scale( sliderScale )
    .on("slide",function(event,value){
      if ( isPlaying ){
        clearInterval(interval);
      }
      currentFrame = value;
      drawMonth( orderedColumns[value], d3.event.type != "drag" );
    })
    .on("slideend",function(){
      if ( isPlaying ) animate();
      d3.select("#slider-div").on("mousemove",sliderProbe)
    })
    .on("slidestart",function(){
      d3.select("#slider-div").on("mousemove",null)
    })
    .value(val);

  d3.select("#slider-div").remove();

  d3.select("#slider-container")
    .append("div")
    .attr("id","slider-div")
    .style("width",dateScale.range()[1] + "px")
    .on("mousemove",sliderProbe)
    .on("mouseout",function(){
      d3.select("#slider-probe").style("display","none");
    })
    .call( slider );

  d3.select("#slider-div a").on("mousemove",function(){
    d3.event.stopPropagation();
  })

  var sliderAxis = d3.axisBottom()
    .scale( dateScale )
    .tickFormat(function(d){
      console.log(d);
      return d.getFullYear().toString();
    })
    .tickSize(10)

  d3.select("#axis").remove();

  d3.select("#slider-container")
    .append("svg")
    .attr("id","axis")
    .attr("width",dateScale.range()[1] + sliderMargin*2 )
    .attr("height",25)
    .append("g")
      .attr("transform","translate(" + (sliderMargin+1) + ",0)")
      .call(sliderAxis);

  // d3.select("#axis > g g:first-child text").attr("text-anchor","end").style("text-anchor","end");
  // d3.select("#axis > g g:last-of-type text").attr("text-anchor","start").style("text-anchor","start");
}

// function createLegend(){
//   var legend = g.append("g").attr("id","legend").attr("transform","translate(560,10)");

//   legend.append("circle").attr("class","gain").attr("r",5).attr("cx",5).attr("cy",10)
//   legend.append("circle").attr("class","loss").attr("r",5).attr("cx",5).attr("cy",30)

//   legend.append("text").text("jobs gained").attr("x",15).attr("y",13);
//   legend.append("text").text("jobs lost").attr("x",15).attr("y",33);

//   var sizes = [ 10000, 100000, 250000 ];
//   for ( var i in sizes ){
//     legend.append("circle")
//       .attr( "r", circleSize( sizes[i] ) )
//       .attr( "cx", 80 + circleSize( sizes[sizes.length-1] ) )
//       .attr( "cy", 2 * circleSize( sizes[sizes.length-1] ) - circleSize( sizes[i] ) )
//       .attr("vector-effect","non-scaling-stroke");
//     legend.append("text")
//       .text( (sizes[i] / 1000) + "K" + (i == sizes.length-1 ? " jobs" : "") )
//       .attr( "text-anchor", "middle" )
//       .attr( "x", 80 + circleSize( sizes[sizes.length-1] ) )
//       .attr( "y", 2 * ( circleSize( sizes[sizes.length-1] ) - circleSize( sizes[i] ) ) + 5 )
//       .attr( "dy", 13)
//   }
// }

// function setProbeContent(d){
//   var val = d[ orderedColumns[ currentFrame ] ],
//       m_y = getMonthYear( orderedColumns[ currentFrame ] ),
//       month = months_full[ months.indexOf(m_y[0]) ];

//       console.log(m_y);
//   var html = "<strong>" + d.CITY + "</strong><br/>" +
//             format( Math.abs( val ) ) + " jobs " + ( val < 0 ? "lost" : "gained" ) + "<br/>" +
//             "<span>" + month + " " + m_y[1] + "</span>";
//   probe
//     .html( html );
// }

function sliderProbe(){
  var d = dateScale.invert( ( d3.mouse(this)[0] ) );
  d3.select("#slider-probe")
    .style( "left", d3.mouse(this)[0] + sliderMargin + "px" )
    .style("display","block")
    .select("p")
    .html(d.getFullYear() )
}
*/

function resize() {
  var w = d3.select("#container").node().offsetWidth,
    h = window.innerHeight - 80;
  var scale = Math.max(1, Math.min(w / width, h / height));
  svg
    .attr("width", width * scale)
    .attr("height", height * scale);
  chartGroup.attr("transform", "scale(" + scale + "," + scale + ")");

  d3.select("#map-container").style("width", width * scale + "px");

  // dateScale.range([0, 500 + w - width]);

  // createSlider();
}

function toolOver(v, thepath) {
  d3.select(thepath)
    //in v4+ use the "long forms"
    .attr("fill-opacity", "0.7")
    .attr("cursor", "pointer");
  return tooltip.style("visibility", "visible");
};

function toolOut(m, thepath) {
  d3.select(thepath)
    .attr("fill-opacity", "0.5")
    .attr("cursor", "");
  return tooltip.style("visibility", "hidden");
};


function toolMove(mx, my, data) {

  if (mx < 120) {
    mx = 120
  };

  if (my < 40) {
    my = 40
  };

  //create the tooltip, style it and inject info
  return tooltip.style("top", my + -140 + "px")
    .style("left", mx - 120 + "px")
    .html("<div id='tipContainer'><div id='tipLocation'><b>" + data.id +
      "</b></div><div id='tipKey'>Migration in: <b>" + formatC(data.properties.total_move_in) +
      "</b><br>Migration out: <b>" + formatC(data.properties.total_move_out) +
      "</b><br>Net migration: <b>" + formatC((data.properties.total_move_in - data.properties.total_move_out)) +
      "</b></div><div class='tipClear'></div> </div>");
};


// function sortColumns(a,b){
//   // [month,year]
//   var monthA = a.split("-"),
//       monthB = b.split("-");
//   // Y2K !!!
//   // 99 becomes 9; 2000+ becomes 11+
//   if ( monthA[1] < 90 ) monthA[1] = parseInt(monthA[1]) + 11;
//   else monthA[1] = parseInt(monthA[1]) - 90;
//   if ( monthB[1] < 90 ) monthB[1] = parseInt(monthB[1]) + 11;
//   else monthB[1] = parseInt(monthB[1]) - 90;

//   // turn year+month into a sortable number
//   return ( 100*parseInt(monthA[1]) + months.indexOf(monthA[0]) ) - ( 100*parseInt(monthB[1]) + months.indexOf(monthB[0]) );
// }

// function createDateScale(columns) {
//   var start = getYear(columns[0]);
//   var end = getYear(columns[columns.length - 1]);
//   console.log(start, end);
//   return d3.scaleTime()
//     //needs to create new date object for domain
//     .domain([new Date(start, '0'), new Date(end, '0')]);
// }

// function getYear(column) {
//   return parseInt(column);
// }

// function monthLabel(m) {
//   var m_y = getYear(m);
//   return m_y;
// }


//slider 
range = [2009, 2018],
step = 1; // change the step and if null, it'll switch back to a normal slider

var svg2 = d3.select('#slider-div').append('svg')
  .attr('width', width)
  .attr('height', height/2);

var slider = svg2.append('g')
  .classed('slider', true)
  .attr('transform', 'translate(' + margin.left +', '+ margin.top + ')');

// using clamp here to avoid slider exceeding the range limits
var xScale = d3.scaleLinear()
.domain(range)
.range([0, width - margin.left - margin.right])
.clamp(true);

// array useful for step sliders
var rangeValues = d3.range(range[0], range[1], step || 1).concat(range[1]);
console.log(rangeValues);
var xAxis = d3.axisBottom(xScale).tickValues(rangeValues).tickFormat(function (d) {
return d;
});

// drag behavior initialization
var drag = d3.drag()
.on('start.interrupt', function () {
    slider.interrupt();
}).on('start drag', function () {
    dragged(d3.event.x);
});

// this is the main bar with a stroke (applied through CSS)
var track = slider.append('line').attr('class', 'track')
.attr('x1', xScale.range()[0])
.attr('x2', xScale.range()[1]);

// this is a bar (steelblue) that's inside the main "track" to make it look like a rect with a border
var trackInset = d3.select(slider.node().appendChild(track.node().cloneNode())).attr('class', 'track-inset');

var ticks = slider.append('g').attr('class', 'ticks').attr('transform', 'translate(0, 4)')
.call(xAxis);

// drag handle
var handle = slider.append('circle').classed('handle', true)
.attr('r', 8);

// this is the bar on top of above tracks with stroke = transparent and on which the drag behaviour is actually called
// try removing above 2 tracks and play around with the CSS for this track overlay, you'll see the difference
var trackOverlay = d3.select(slider.node().appendChild(track.node().cloneNode())).attr('class', 'track-overlay')
.call(drag);

// text to display
var text = d3.select('#date p').append('text')
.text(' 2008');

// initial transition
slider.transition().duration(750)
.tween("drag", function () {
    var i = d3.interpolate(0, 10);
    return function (t) {
        dragged(xScale(i(t)));
    }
});

function dragged(value) {
var x = xScale.invert(value), index = null, midPoint, cx, xVal;
if(step) {
    // if step has a value, compute the midpoint based on range values and reposition the slider based on the mouse position
    for (var i = 0; i < rangeValues.length - 1; i++) {
        if (x >= rangeValues[i] && x <= rangeValues[i + 1]) {
            index = i;
            break;
        }
    }
    midPoint = (rangeValues[index] + rangeValues[index + 1]) / 2;
    if (x < midPoint) {
        cx = xScale(rangeValues[index]);
        xVal = rangeValues[index];
    } else {
        cx = xScale(rangeValues[index + 1]);
        xVal = rangeValues[index + 1];
    }
} else {
    // if step is null or 0, return the drag value as is
    cx = xScale(x);
    xVal = x.toFixed(3);
}
// use xVal as drag value
handle.attr('cx', cx);
text.text(' ' + xVal);
}