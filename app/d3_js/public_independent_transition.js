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
    .select(function () {
        return this.parentNode.appendChild(this.cloneNode(true));
    })
    .attr("class", "track-inset")
    .select(function () {
        return this.parentNode.appendChild(this.cloneNode(true));
    })
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
    .text(function (d) {
        return d;
    });

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

    let index = null,
        midPoint, cx, xVal;

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
    if (tslider_yrCheck != xVal) {
        tslider_update(xVal);
        tslider_yrCheck = xVal;
    }
}


function tslider_update(year) {
    //trans_margin 
    let trans_margin = {
        top: 50,
        right: 50,
        bottom: 50,
        left: 50
    };

    //height and width
    let trans_height = 400 - trans_margin.top - trans_margin.bottom;
    let trans_width = 600 - trans_margin.left - trans_margin.right;

    let trans_yScale = d3.scaleLinear()
        .range([trans_height, 0]);

    let trans_xScale = d3.scaleBand()
        .range([0, trans_width])
        .padding(0.3);

    let trans_yAxis = d3.axisLeft()
        .scale(trans_yScale);

    let trans_xAxis = d3.axisBottom()
        .scale(trans_xScale);

    //canvas
    let trans_svg = d3.select('#transition_container').append('svg')
        .attr("preserveAspectRatio", "xMinYMin meet")  // This forces uniform scaling for both the x and y, aligning the midpoint of the SVG object with the midpoint of the container element.
        .attr("viewBox", "0 0 600 400") //defines the aspect ratio, the inner scaling of object lengths and coordinates
        .attr('class', 'svg-content');

    let trans_chartGroup = trans_svg.append('g')
        .attr('class', 'chartGroup')
        .attr('transform', 'translate(' + trans_margin.left + ',' + trans_margin.top + ')');


    //initialize html tooltip
    let trans_tooltip = d3.select("#transition_container")
        .append("div")
        .attr("id", "line_tt")
        .style("z-index", "10")
        .style("position", "absolute")
        .style("visibility", "hidden");

    d3.csv('../assets/raw_data/transition_district.csv', function (error, data) {
        if (error) {
            throw error;
        }

        function transClear() {
            //clear existing trans_bars
            let existingBar = d3.selectAll("#transition_container .trans_bar");
            existingBar.exit();
            existingBar.transition()
                .duration(500)
                .remove();

            //clear tooltips 
            // trans_chartGroup.selectAll(".demott_circle")
            //     .remove();
            // d3.selectAll(".demott_rect")
            //     .remove();
        }

        function transUpdate(type) {

            let districtData = data.filter(function (d) { return +d.SCHOOL_YEAR == year });

            //format data
            districtData.forEach(function (d) {
                d.ENTER_PUBLIC = +d.ENTER_PUBLIC;
                d.LEAVE_PUBLIC = +d.LEAVE_PUBLIC;
                d.NET_INDEPENDENT = +d.NET_INDEPENDENT;
            });

            //sort array of object based on # of enter, leave, and net
            districtData.sort(function (a, b) {
                //# of leave is negative, reverse sort
                if (type == 'LEAVE_PUBLIC') {
                    return a[type] - b[type];
                } else {
                    return b[type] - a[type];
                }
            });

            //top 5 district
            let districtData_top5 = districtData.slice(0, 5);

            //set scale domain
            trans_xScale.domain(districtData_top5.map(function (d) {
                return d.DISTRICT;
            }));

            trans_yScale.domain([Math.min(0, d3.min(districtData_top5, function (d) {
                return d[type];
            })),
            Math.max(0, d3.max(districtData_top5, function (d) {
                return d[type];
            }))]);


            console.log(districtData_top5);
            for (let d of districtData_top5) {
                console.log(d[type]);

                console.log(Math.abs(trans_yScale(d[type]) - trans_yScale(0)));
            }

            //draw trans_bars
            trans_chartGroup.selectAll('.trans_bar')
                .data(districtData_top5)
                .enter().append('rect')
                .attr('class', 'trans_bar')
                .attr('x', function (d) { return trans_xScale(d.DISTRICT); })
                .attr('y', function (d) {
                    if (d[type] > 0) {
                        return trans_yScale(d[type]);
                    } else {
                        return trans_yScale(0);
                    }
                })
                .attr('width', trans_xScale.bandwidth())
                .attr('height', function (d) { return Math.abs(trans_yScale(d[type]) - trans_yScale(0)); })
                .style('fill', '#FCBA19');


            //draw axes
            if ($('#transition_container .yAxis').length) {

                //set transition
                let tran = d3.transition()
                    .duration(1500);

                d3.select("#transition_container .yAxis")
                    .transition(tran)
                    .call(trans_yAxis);

                d3.select("#transition_container .xAxis")
                    .transition(tran)
                    .call(trans_xAxis);

                //grid line
                d3.selectAll("g.yAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", 0)
                    .attr("x2", trans_width)
                    .attr("y2", 0);

                d3.selectAll("g.xAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", trans_height)
                    .attr("x2", 0)
                    .attr("y2", 0);

            } else {

                //axes
                trans_chartGroup.append('g')
                    .attr('class', 'yAxis')
                    .call(trans_yAxis)
                    .append("text")
                    .attr("transform", "rotate(-90)")
                    .attr('fill', '#4c4c4c')
                    .attr("y", 6)
                    .attr("dy", ".8em")
                    .style("text-anchor", "end")
                    .text("FTE");

                trans_chartGroup.append('g')
                    .attr('class', 'xAxis')
                    .attr('transform', 'translate(0,' + trans_height + ')')
                    .call(trans_xAxis);

                //grid line
                d3.selectAll("g.yAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", 0)
                    .attr("x2", trans_width)
                    .attr("y2", 0);

                d3.selectAll("g.xAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", -trans_height)
                    .attr("x2", 0)
                    .attr("y2", 0);

            }

        }

        let defaultType = 'ENTER_PUBLIC';
        transUpdate(defaultType);

        //radio selection
        $("#trans_radio input[type='radio']").change(function () {
            let radioValue = $("input[name='trans-type']:checked").val();
            console.log(radioValue);
            if (radioValue) {
                transClear();
                transUpdate(radioValue);
            }
        });
    });
}
