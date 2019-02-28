 //margin
 let margin = {
    top: 50,
    bottom: 50,
    left: 100,
    right: 100
}

let ani_width = 600 - margin.left - margin.right;
let ani_height = 450 - margin.top - margin.bottom;

var formatC = d3.format(",.0f");
var formatD = d3.format("+,.0f");

//the data object here is used to load different year's data
let data = {};


//create the projection expression
var projection1 = d3.geoAlbers()
    .rotate([122, 0, 0])
    .scale(2000)
    .translate([ani_width*.85, ani_height * 2.2]);
// .fitSize([width, height], json);

//Define path generator
var ani_path = d3.geoPath()
    .projection(projection1);

//create scales
var circleSize = d3.scaleLinear().domain([0, 300]).range([0, 700]);

//Create SVG element for map
var svg_map = d3.select("#animationMap")
    .append("svg")
    .attr("width", ani_width + margin.left + margin.right)
    .attr("height", ani_height + margin.top + margin.bottom);

//chart group
mapGroup = svg_map.append('g');

//initialize html animation_tooltip
var animation_tooltip = d3.select("#aniContainer")
    .append("div")
    .attr("id", "ani_tt")
    .style("z-index", "10")
    .style("position", "absolute")
    .style("visibility", "hidden");

//update migration map 
function draw(year) {

    //d3.csv() in queue, here csv_data is same as the data in d3.csv(xxx,function (data) {})
    let csv_data = data[year];

    let trans = d3.transition()
        .duration(500);

    d3.json("../assets/geo_json/sd_geo.json", function (json) {

        for (var i = 0; i < csv_data.length; i++) {
            var dataDistrict = csv_data[i].District; //district names in csv data

            var tempObj = {}; //crate a temp object

            //for...in statement iterates over all non-Symbol, enumerable properties (columns) of an object(each row)
            for (var propt in csv_data[i]) {
                var valz = parseFloat(csv_data[i][propt]); //parseFloat() parses a string and returns a floating point number
                tempObj[propt] = valz;
            }
            //Find the corresponding district inside the GeoJSON
            for (var j = 0; j < json.features.length; j++) {

                var jsonDistrict = json.features[j].properties.SDNAME; //district names in json file

                if (dataDistrict == jsonDistrict) {

                    matched = true; //match flag
                    //create new properties and add vals in json
                    json.features[j].properties.district = dataDistrict;
                    json.features[j].id = dataDistrict;
                    json.features[j].abbrev = csv_data[i].Abbrev;
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
        mapGroup.selectAll("path")
            .data(json.features)
            .enter()
            .append("path")
            .attr("class", "dist")
            //add id(district name) to each path (district shape on map)
            .attr("id", function (d) {
                return d.properties.district;
            })
            .attr("d", ani_path) //path here is the geo path generator
            .attr("stroke-width", 0.5);

        //Bind data to circles per GeoJSON feature/districts	
        let circles = mapGroup.selectAll("circle")
            .data(json.features);

        //exit and remove phase clean data points for next binding
        circles.exit()
            .remove();

        console.log(circles);

        let newCircles = circles
            .enter().append("circle")
            .attr("cx", function (d) {
                var centname = d.properties.SDNAME;
                var ctroid;
                ctroid = ani_path.centroid(d)[0]; // get the centroid x
                return ctroid;
            })
            .attr("cy", function (d) {
                var centname = d.properties.SDNAME;
                var ctroid;
                ctroid = ani_path.centroid(d)[1]; // get the centroid y
                return ctroid;
            })
            .attr("r", function (d) { //radius of the circle is defined by the number of total net migration change

                /*total_move_in and totale_emm are columns from csv file
                got added to json features through :    
                json.features[j].properties[propt] = tempObj[propt];*/
                var diff = d.properties.total_move_in - d.properties.total_move_out;

                //gives a minmum r if net changes = 0
                if (Math.abs(diff) < 5) {
                    return 3;
                } else {
                    return circleSize(Math.sqrt(Math.abs(diff) / Math.PI));
                }

            })
            //attach district name to each circle
            .attr("id", function (d) {
                return 'overview_'+ d.abbrev;
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
            .attr("stroke-weight", "0.5");

        newCircles.merge(circles)
            .transition(trans)
            .attr("r", function (d) {
                var diff = d.properties.total_move_in - d.properties.total_move_out;
                if (Math.abs(diff) < 5) {
                    return 3;
                } else {
                    return circleSize(Math.sqrt(Math.abs(diff) / Math.PI));
                }
            })
            .attr("fill", function (d) {
                /*fill the color based on -/+ net changes*/
                var diff = d.properties.total_move_in - d.properties.total_move_out;
                if (diff > 0) {
                    return "#67a9cf";
                } else {
                    return "#ef8a62";
                }

            });

        // add event listener for mouse over
        newCircles.on("mouseenter", function (d) {
            //toolOver is the event handler
            return ani_toolOver(d, this);
        })
            .on("mousemove", function (d) {
                //gets mouse coordinates on screen
                var m = d3.mouse(this);
                mx = m[0];
                my = m[1];

                return ani_toolMove(mx, my, d);
            })
            .on("mouseleave", function (d) {
                return ani_toolOut(d, this);
            });

    });
}

// queue to load the multiple datasets
d3.queue()
    .defer(d3.csv, '../assets/raw_data/sd_going_2018.csv')
    .defer(d3.csv, '../assets/raw_data/sd_going_2017.csv')
    .defer(d3.csv, '../assets/raw_data/sd_going_2016.csv')
    .defer(d3.csv, '../assets/raw_data/sd_going_2015.csv')
    .defer(d3.csv, '../assets/raw_data/sd_going_2014.csv')
    .defer(d3.csv, '../assets/raw_data/sd_going_2013.csv')
    .await(function (error, d2018, d2017, d2016, d2015, d2014, d2013) {
        data['2013'] = d2013;
        data['2014'] = d2014;
        data['2015'] = d2015;
        data['2016'] = d2016;
        data['2017'] = d2017;
        data['2018'] = d2018;
        draw(2013);
    });


function ani_toolOver(v, thepath) {
    d3.select(thepath)
        //in v4+ use the "long forms"
        .attr("fill-opacity", "0.7")
        .attr("cursor", "pointer");
    return animation_tooltip.style("visibility", "visible");
};

function ani_toolOut(m, thepath) {
    d3.select(thepath)
        .attr("fill-opacity", "0.5")
        .attr("cursor", "pointer");
    return animation_tooltip.style("visibility", "hidden");
};


function ani_toolMove(mx, my, data) {

    if (mx < 120) {
        mx = 120
    };

    if (my < 40) {
        my = 40
    };

    //create the animation_tooltip, style it and inject info
    return animation_tooltip.style("top", my + - 80 + "px")
        .style("left", mx - 140 + "px")
        .html("<div id='tipContainer'><div id='tipLocation'><b>" + data.id +
            "</b></div><div id='tipKey'>Net migration: <b>" + formatC((data.properties.total_move_in - data.properties.total_move_out)) +
            "</b></div><div class='tipClear'></div> </div>");
};


//slider

//Create SVG element for slider
let svg_slider = d3.select("#slider")
    .append("svg")
    .attr("width", ani_width - margin.left)
    .attr("height", 100);

let sliderGroup = svg_slider.append("g")
    .attr('transform', 'translate(20, 50)');;

let moving = false;
let currentValue = 0;
let targetValue = ani_width;

let years = [2013, 2018];
let step = 1;
// array useful for step sliders
let yearValues = d3.range(years[0], years[1], step || 1).concat(years[1]);

let yearText = d3.select('#year')
    .html("<h5>Year:</h5><span> 2013</span>");

let playButton = d3.select("#play-button");

//scales
let xScale = d3.scaleLinear()
    .domain(years)
    .range([0, targetValue - margin.left - margin.right])
    .clamp(true);


//create track
sliderGroup.append("line")
    .attr("class", "track")
    .attr("x1", xScale.range()[0])
    .attr("x2", xScale.range()[1])
    .select(function () { return this.parentNode.appendChild(this.cloneNode(true)); })
    .attr("class", "track-inset")
    .select(function () { return this.parentNode.appendChild(this.cloneNode(true)); })
    .attr("class", "track-overlay")
    .call(d3.drag()
        .on("start.interrupt", function () { sliderGroup.interrupt(); })
        .on("start drag", function () {
            console.log('dragged');
            currentValue = d3.event.x;
            update(currentValue);
        })
    );

//create track overlay
sliderGroup.insert("g", ".track-overlay")
    .attr("class", "ticks")
    .attr("transform", "translate(0," + 18 + ")")
    .selectAll("text")
    .data(xScale.ticks(6))
    .enter()
    .append("text")
    .attr("x", xScale)
    .attr("y", 10)
    .attr("text-anchor", "middle")
    .text(function (d) { return d; });

//slider handle
let handle = sliderGroup.insert("circle", ".track-overlay")
    .attr("class", "handle")
    .attr("r", 9);

// let label = slider.append("text")
//     .attr("class", "label")
//     .attr("text-anchor", "middle")
//     .text(formatDate(startDate))
//     .attr("transform", "translate(0," + (-25) + ")")

function update(val) {
    console.log(val);

    let x = xScale.invert(val);

    let index = null, midPoint, cx, xVal;
    if (step) {
        // if step has a value, compute the midpoint based on range values and reposition the slider based on the mouse position
        for (var i = 0; i < yearValues.length; i++) {
            if (x >= yearValues[i] && x <= yearValues[i + 1]) {
                index = i;
                break;
            }
        }
        midPoint = (yearValues[index] + yearValues[index + 1]) / 2;
        if (x < midPoint) {
            cx = xScale(yearValues[index]);
            xVal = yearValues[index];
        } else {
            cx = xScale(yearValues[index + 1]);
            xVal = yearValues[index + 1];
        }
    } else {
        // if step is null or 0, return the drag value as is
        cx = xScale(x);
        xVal = x.toFixed(3);
    }

    // update position and text of label according to slider scale
    handle.attr("cx", cx);
    yearText.html("<h5>Year:</h5><span> " + xVal + "</span>");
    draw(xVal);
}

//play animation
playButton.on('click', function () {
    let btn = d3.select(this);
    if (btn.text() == 'Pause') {
        moving = false;
        clearInterval(timer);
        btn.text('Play');
    } else {
        moving = true;
        //starts from where the slider at
        timer = setInterval(play, 100);
        btn.text('Pause');
    }

});

//loop back
function play() {
    update(currentValue);
    currentValue = currentValue + (targetValue / 151);
    if (currentValue > targetValue) {
        moving = false;
        currentValue = 0;
        clearInterval(timer);
        // timer = 0;
        playButton.text("Play");
        console.log("Slider moving: " + moving);
    }
}