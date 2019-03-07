//Width and height
var width = 760;
var height = 600;
var centered;

var formatC = d3.format(",.0f");
var formatD = d3.format("+,.0f");

//var of min & max number of students move in and out 
var movein_min, movein_max, moveout_min, moveout_max;

var colors = ["#EDF8FB", "#41083e"]; //color range based on the number of people

//array used to populate dropdown menu
var sd_list_arr = [];

//create the projection expression
var projection = d3.geoAlbers()
  .rotate([122, 0, 0])
  .scale(2700)
  .translate([width * .57, height * 1.7]);
// .fitSize([width, height], json);

//Define path generator
var path = d3.geoPath()
  .projection(projection);

//create scales
var circleSize = d3.scaleLinear().range([0, 400]).domain([0, 300]);

var lineSize = d3.scaleLinear().range([2, 25]).domain([0, 35000]);

// var fillcolor = d3.scaleLinear().range(colors).domain(immdomain);


//Create SVG element
var svg = d3.select("#map")
  .append("svg")
  .attr("width", width)
  .attr("height", height);


var fp = d3.format(".1f"); // format number, 1 place after decimal

//initialize html tooltip
var tooltip = d3.select("#maincontainer")
  .append("div")
  .attr("id", "tt")
  .style("z-index", "10")
  .style("position", "absolute")
  .style("visibility", "hidden");

var tooltip2 = d3.select("#maincontainer")
  .append("div")
  .attr("id", "tt2")
  .style("z-index", "10")
  .style("position", "absolute")
  .style("visibility", "hidden");

var chartGroup = svg.append("g");


var comingData, goingData;

var currentDist;


//the BIG function that wraps around the d3 pattern (bind, add, update, remove)
function updateMap(coming, going) {

  chartGroup.selectAll('.circ').remove().transition()
    .duration(500);

  chartGroup.selectAll('.goingline').remove().transition()
    .duration(500);

  d3.csv(coming, function (data) {
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

    /*
         num__coming_arr is not a number, cannot pass into Math.max() directly
         instead, pass an array of arguments:
 
         how to get the min val and exclude 0:
         num_coming_arr.filter creates a new array with all elements that pass the boolean test
 
         for this instance, movein_min returns 0 because 0.xxxx might get rounded to 0
 
         so, use Math.ceil()
         */
    movein_min = Math.ceil(Math.min.apply(Math, num_coming_arr.filter(Boolean)));
    //movein_max will be the max # of total move in, from going csv
  });

  d3.csv(going, function (data) {
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

      //get both school district numbers and names
      var sd_num = data[i].Abbrev;
      var sd_name = data[i].District;

      sd_list_arr.push(sd_num + '-' + sd_name);
    }

    //stop populate the dropdown list again when changing dataset(2014,15,16...)
    if (sd_list_arr.length <= 60) {
      //populate the dropdown list
      //onsole.log(sd_list_arr);
      for (let i = 0; i < sd_list_arr.length; i++) {
        let opt = sd_list_arr[i];
        console.log(sd_list_arr.length);
        d3.select('#distDropdown')
          .append('option')
          .text(opt)
          //take the sd number (first 4 letters) as value
          .attr('value', opt.substring(0, 4));
      };
    }


    /* 
    problem here:
    JavaScript engine called hoisting. The parser will read through the entire function before running it, 
    and any variable declarations (i.e. using the var keyword) will be executed as if they were at the top of the containing scope.
 
    so move.... var is declared throughout the entire scope, 
    but its value is undefined until the following statments run.
    CANNOT USE for the domain[] on top :(
 
    */
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

    /////////////////////////////////////
    var indomain = [moveout_min, moveout_max]; //domain of min-max 
    var outdomain = [movein_min, movein_max];
    var fillcolor = d3.scaleLinear().range(colors).domain(indomain);
    ////////////////////////////////////

    d3.json("../geo_json/sd_geo.json", function (json) {

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
        .style("stroke", "#666")
        .style("fill", "#fff");

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
            return "#65a89d";
          } else {
            return "#a96a46";
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
        })
        .on("click", function (d) {

          currentDist = d;
          console.log(currentDist);
          clicked(d);
        })
        .transition()
        .duration(1500);
    });
  });
}

//initial/default map

updateMap("../app/assets/raw_data/sd_coming_2018.csv", "../app/assets/raw_data/sd_going_2018.csv");

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


//toolOver2 and ...2 are event handlers for paths btw two districts
function toolOver2(v, thepath) {

  d3.select(thepath)
    //in v4+ use the "long forms", opacity for stroke, fill-opacity for shape bg
    .attr("opacity", "0.7")
    .attr("cursor", "pointer");
  return tooltip2.style("visibility", "visible");
};

function toolOut2(m, thepath) {
  d3.select(thepath)
    //in v4+ use the "long forms"
    .attr("opacity", "0.5")
    .attr("cursor", "");
  return tooltip2.style("visibility", "hidden");
};

function toolMove2(mx, my, home, end, v1, v2) {
  var diff = v1 - v2;

  if (mx < 120) {
    mx = 120
  };

  if (my < 40) {
    my = 40
  };

  //create the tooltip for paths, style it and inject info
  return tooltip2.style("top", my + -140 + "px")
    .style("left", mx - 120 + "px")
    .html("<div id='tipContainer2'><div id='tipLocation'><b>" + home +
      "/" + end + "</b></div><div id='tipKey2'>Migration, " + home +
      " to " + end + ": <b>" + formatC(v2) + "</b><br>Migration, " + end +
      " to " + home + ": <b>" + formatC(v1) + "</b><br>Net change, " + home +
      ": <b>" + formatD(v1 - v2) + "</b></div><div class='tipClear'></div> </div>");
};

//function crates the path
function clicked(selected, flowtype) {
  console.log(typeof (selected));
  //var coming = selected.properties;
  let selDist, distName;
  let homex, homey;

  // let selectedOpt = d3.select('#distDropdown').nodes()[0][0].label;


  /*
  if the selection is made by clicking we can access the following properties
  if the selection is done by dropdown, get attribute from dom element
  */

  if (selected.abbrev && selected.properties.SDNAME) {
    selDist = selected.abbrev;
    console.log(selDist);
    //sleDist is the SD number, distName is for displaying purpose
    distName = selected.properties.SDNAME;

    // geopath that creates target district map
    // defined in the begining 
    homex = path.centroid(selected)[0];
    homey = path.centroid(selected)[1];

  } else {
    //get sd abbrev from the id, 
    //here we dont have distName, will define later
    selDist = selected.getAttribute('id');


    //convert attribute string to number for use in the path('d',val)
    homex = +(selected.getAttribute('cx'));
    homey = +(selected.getAttribute('cy'));
  }
  console.log(homex, homey);

  /*
   d3.selectAll(".circ")
   .attr("fill-opacity", "0.2");
  */



  chartGroup.selectAll(".goingline")
    //dash css, 0 solid
    .attr("stroke-dasharray", 0)
    .remove()


  chartGroup.selectAll(".goingline")
    //bind going data
    .data(goingData)
    .enter().append("path")
    .attr("class", "goingline")

    .attr("d", function (d, i) {
      console.log(d); // it's all obejcts in goingData
      //data points here are from .csv, case sensitive!!!
      var abb = d.Abbrev;

      console.log(abb);

      /*
      net changes btw going and coming
      the csv coming and going is based on column: e.g. going or coming number of students to the ditrict in title row 
      */
      var finalval = comingData[i][selDist] - goingData[i][selDist];
      console.log(finalval);
      /*
      select the district (destination, id has been assigned)
      the id here is the id of the circle of destination (circle)
      */

      var theDistrict = d3.select('#' + abb);

      //here we can extract the full name of home ditrict
      if (selDist == abb) {
        distName = theDistrict.nodes()[0].__data__.id;
      }

      /*
       selections are arrays of arrays of DOM elements. 
       The outer-most array is called a 'selection', 
       the inner array(s) are called 'groups' and those groups contain the DOM elements.

       In the normal version (https://d3js.org/d3.v4.js), the console.log return should be: 
       Selection {_groups: Array[1], _parents: Array[1]}

       !!!!!use nodes(): to get the inner array(s)!!!!!
       */

      //coordinates of the path destination
      var destx = path.centroid(theDistrict.nodes()[0].__data__)[0];
      var desty = path.centroid(theDistrict.nodes()[0].__data__)[1];

      if (flowtype && flowtype == 'inflow') {
        if (!isNaN(finalval) && (finalval > 0)) {
          return "M" + destx + "," + desty + " Q" + Number((destx + homex)) / 2 + " " + (desty + homey) / 1.5 + " " + homex + " " + homey;
        }

      } else if (flowtype && flowtype == 'outflow') {
        if (!isNaN(finalval) && (finalval < 0)) {
          return "M" + homex + "," + homey + " Q" + (destx + homex) / 2 + " " + (desty + homey) / 2.5 + " " + destx + " " + desty;
        }
      } else {
        //validate and check the net changes, and exclude path with no migration change
        if (!isNaN(finalval) && (comingData[i][selDist] != 0 || goingData[i][selDist] != 0)) {
          //extract the district name from the __data__ obejct
          console.log(theDistrict.nodes()[0].__data__.id);

          //if theres changes meanig movements btw home distric and dest district
          if (finalval > 0) {
            return "M" + destx + "," + desty + " Q" + Number((destx + homex)) / 2 + " " + (desty + homey) / 1.5 + " " + homex + " " + homey;
          } else {
            return "M" + homex + "," + homey + " Q" + (destx + homex) / 2 + " " + (desty + homey) / 2.5 + " " + destx + " " + desty;
          }
        }
      }

    })

    //the drawing annimation
    .call(transition)

    //determine the stroke width based on net changes

    .attr("stroke-width", function (d, i) {
      var finalval = comingData[i][selDist] - goingData[i][selDist];
      return lineSize(parseFloat(Math.abs(finalval)));
    })
    //stroke color
    .attr("stroke", function (d, i) {
      var finalval = comingData[i][selDist] - goingData[i][selDist];
      if (finalval > 0) {
        //color for positive growth
        return "#65a89d";
      } else {
        return "#a96a46";
      }

    })
    .attr("fill", "none")
    .attr("opacity", 0.5)
    .attr("stroke-linecap", "round")
    .on("mouseenter", function (d) {
      return toolOver2(d, this);
    })
    .on("mousemove", function (d, i) {
      var m = d3.mouse(this);
      mx = m[0];
      my = m[1];
      return toolMove2(mx, my, distName, d.District, comingData[i][selDist], goingData[i][selDist]);
    })
    .on("mouseleave", function (d) {
      return toolOut2(d, this);
    });
}

//must append elements or bind data before a transition starts.
//use the attrTween and transform to navigate along the path
function transition(path) {
  path.transition()
    .duration(2000)
    .attrTween("stroke-dasharray", tweenDash);
}

function tweenDash() {
  var l = this.getTotalLength(),
    i = d3.interpolateString("0," + l, l + "," + l);
  return function (t) {
    return i(t);
  };
}

//  d3.select(self.frameElement).style("height", "700px");


/*control panel*/

//limit the size of the drop down
// let distSelect = d3.select('#distDropdown');
// distSelect.on('click', function () {
//   if (this.options.length > 10) {
//     this.size = 10;
//   }
// })
//   .on('change', function () {
//     this.size = 0;
//   })
//   .on('blur', function () {
//     this.size = 0;
//   });

//swap database when select changes
d3.select('#yearDropdown')
  .on('change', function () {
    var newData = eval(d3.select(this).property('value'));
    //clear dropdown array
    // sd_list_arr=[];
    updateMap("../app/assets/raw_data/sd_coming_" + newData + ".csv", "../app/assets/raw_data/sd_going_" + newData + ".csv");
  });

//dropdown select district
d3.select('#distDropdown')
  .on('change', function () {
    let targetSd = eval(d3.select(this).property('value'));
    currentDist = targetSd;
    console.log(currentDist);
    clicked(targetSd);
  })

//toggle migration flow
let flowBtns = d3.selectAll('.flowBtn');
flowBtns.on('click', function () {

  flowBtns.attr('class', 'flowBtn');
  this.classList.add('selected'); //this can only apply vanllila js code

  let btnFlowType = this.getAttribute('value');
  console.log(btnFlowType);

  let currentLines = chartGroup.selectAll('.goingline');
  console.log(currentLines);

  currentLines.remove();

  //let strokeColor = currentLines.nodes()[i].attributes.stroke.nodeValue;
  if (btnFlowType) {
    clicked(currentDist, btnFlowType);
  } else if (btnFlowType == 'all') {
    clicked(currentDist);
  }

});