//slider

//Create SVG element for slider
let tslider_width = $('#trans_slider').width() * .85;

let tslider_slider = d3.select("#trans_slider")
    .append("svg")
    .attr("width", tslider_width)
    .attr("height", 50);

let tsliderGroup = tslider_slider.append("g")
    .attr('transform', 'translate(35, 20)');;

let tslider_moving = false;
let tslider_currentValue = 0;
let tslider_targetValue = tslider_width - 50;


let tslider_years = [2013, 2018];
let tslider_step = 1;

// array useful for step sliders
let tslider_yearValues = d3.range(years[0], years[1], step || 1).concat(years[1]);

//scales
let tslider_xScale = d3.scaleLinear()
    .domain(years)
    .range([0, tslider_targetValue])
    .clamp(true);

//create track
tsliderGroup.append("line")
    .attr("class", "track")
    .attr("x1", tslider_xScale.range()[0])
    .attr("x2", tslider_xScale.range()[1])
    .select(function () { return this.parentNode.appendChild(this.cloneNode(true)); })
    .attr("class", "track-inset")
    .select(function () { return this.parentNode.appendChild(this.cloneNode(true)); })
    .attr("class", "track-overlay")
    .call(d3.drag()
        .on("start.interrupt", tslider_startDrag)
        .on("drag", tslider_drag)
        .on("end", tslider_end)
    );

//create track overlay
tsliderGroup.insert("g", ".track-overlay")
    .attr("class", "ticks")
    .attr("transform", "translate(0, 18)")
    .selectAll("text")
    .data(tslider_xScale.ticks(6))
    .enter()
    .append("text")
    .attr("x", tslider_xScale)
    .attr("y", 10)
    .attr("text-anchor", "middle")
    .text(function (d) { return d; });

//slider handle
let tslider_handle = tsliderGroup.selectAll("rect")
    .data([0, 1])
    .enter()
    .append('rect', '.track-overlay')
    .attr("class", "handle")
    .attr('rx', 3)
    .attr('ry', 3)
    .attr('x', -8)
    .attr('y', -10)
    .attr("width", 16)
    .attr("height", 20)
    .call(d3.drag()
        .on("start.interrupt", tslider_startDrag)
        .on("drag", tslider_drag)
        .on("end", tslider_end));

function tslider_startDrag(d) {
    tsliderGroup.interrupt();
    d3.select(this).raise().classed('active', true);
}

function tslider_drag(d) {
    let x = d3.event.x;
    let xMin = tslider_xScale(years[0]),
        xMax = tslider_xScale(years[1]);
    if (x > xMax) {
        x = xMax - 10;
    } else if (x < xMin) {
        x = xMin;
    }
    console.log(x);
    tslider_handle.attr('x', x);
}

function tslider_end(d) {
    // console.log('dragged');
    currentValue = d3.event.x;
    d3.select(this).classed('active', false);
    tslider_inputYear(currentValue);
}

//flag for checking update() year input
let tslider_yrCheck = 0;
function tslider_inputYear(val) {
    // console.log(val);

    let x = tslider_xScale.invert(val);

    let index = null, midPoint, cx, xVal;

    if (step) {
        // if step has a value, compute the midpoint based on range values and reposition the slider based on the mouse position
        for (var i = 0; i < tslider_yearValues.length; i++) {
            if (x >= yearValues[i] && x <= tslider_yearValues[i + 1]) {
                index = i;
                break;
            }
        }
        midPoint = (tslider_yearValues[index] + tslider_yearValues[index + 1]) / 2;
        if (x < midPoint) {
            cx = tslider_xScale(tslider_yearValues[index]);
            xVal = tslider_yearValues[index];
        } else {
            cx = tslider_xScale(tslider_yearValues[index + 1]);
            xVal = tslider_yearValues[index + 1];
        }
    } else {
        // if step is null or 0, return the drag value as is
        cx = tslider_xScale(x);
        xVal = x.toFixed(3);
    }

    // update position and text of label according to slider scale
    tslider_handle.attr("x", cx - 8);

    //verify that a method was called with certain year input, call update() with unique each year value once
    // if (tslider_yrCheck != xVal) {
    //     tslider_update(xVal);
    //     tslider_yrCheck = xVal;
    // }
}

//trans_margin 
let trans_margin = { top: 50, right: 50, bottom: 50, left: 50 };

//height and width
let trans_height = 400 - trans_margin.top - trans_margin.bottom;
let trans_width = 600 - trans_margin.left - trans_margin.right;

let trans_yScale = d3.scaleLinear()
    .range([height, 0]);

let trans_xScale = d3.scaleBand()
    .range([0, width])
    .padding(0.2);