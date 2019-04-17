//line_margin 
let line_margin = { top: 50, right: 50, bottom: 50, left: 50 };

//height and width
let line_height = 400 - line_margin.top - line_margin.bottom;
let line_width = 600 - line_margin.left - line_margin.right;

let formatC = d3.format(",.0f");
// let formatPercent = d3.format(".0%");

//parseDate is used to covert string into year format from the csv file 
let parseDate = d3.timeParse('%Y');

//scales
let line_xScale = d3.scalePoint().range([0, line_width]).padding(0.5);;

let bar_xScale = d3.scaleBand()
    .range([0, line_width]).paddingInner(0.5)
    .paddingOuter(0.25);

let line_yScale = d3.scaleLinear()
    .range([line_height, 0]);

let bar_yScale = d3.scaleLinear()
    .range([line_height, 0]);

let bar_xAxis = d3.axisBottom()
    .scale(bar_xScale)
    .ticks(5);

let line_yAxis = d3.axisRight()
    .scale(line_yScale)
    .ticks(10)
    .tickFormat(d => d + "%");

let bar_yAxis = d3.axisLeft()
    .scale(bar_yScale);


//lines
let growthLine = d3.line()
    .x(function (d) {
        return line_xScale(d.Year);
    })
    .y(function (d) {
        return line_yScale(d.PercentChange);
    })
    .curve(d3.curveMonotoneX); //smooth the line


//distirct controls
let district = 'line_SD05';
let districts = ["SD05", "SD06", "SD08", "SD10", "SD19"];
let defaultPageLoad = true;

//create district btns
let distBtn = d3.select('#distContainer')
    .selectAll('div')
    .data(districts)
    .enter()
    .append('div')
    .attr('id', function (d, i) {
        return 'line_' + d;
    })
    .text(function (d) {
        return d;
    })
    .attr('class', function (d) { //adding a condition to higlight selected btn
        if ('line_' + d == district) {
            return 'distBtn selectedDist';
        } else {
            return 'distBtn';
        }
    });

//canvas
let line_svg = d3.select('#lineContainer').append('svg')
    .attr("preserveAspectRatio", "xMinYMin meet")  // This forces uniform scaling for both the x and y, aligning the midpoint of the SVG object with the midpoint of the container element.
    .attr("viewBox", "0 0 600 400") //defines the aspect ratio, the inner scaling of object lengths and coordinates
    .attr('class', 'svg-content');

let line_chartGroup = line_svg.append('g')
    .attr('class', 'chartGroup')
    .attr('transform', 'translate(' + line_margin.left + ',' + line_margin.top + ')');


//initialize html tooltip
var tooltip_line = d3.select("#lineContainer")
    .append("div")
    .attr("id", "line_tt")
    .style("z-index", "10")
    .style("position", "absolute")
    .style("visibility", "hidden");


d3.csv('../assets/raw_data/multi_line.csv', function (error, data) {
    if (error) {
        throw error;
    }

    //ditrict = 'line_' + d.Abbrv, so need to substring()
    let districtData = data.filter(function (d) { return d.Abbrv == district.substring(5, district.length) });

    // format the data
    districtData.forEach(function (d) {
        // d.Year = (parseDate(d.Year)).getFullYear();
        d.NetMigration = +d.NetMigration;
        d.PercentChange = +d.PercentChange;
    });

    console.table(data);

    //array of net migration from 2014-2018
    // map gives us an object
    //use Object.values to extract values into an array
    // netMigration = Object.values(districtData.map(function (d) {
    //     return {
    //         '2014': d['2014'],
    //         '2015': d['2015'],
    //         '2016': d['2016'],
    //         '2017': d['2017'],
    //         '2018': d['2018']
    //     }
    // })[0]);

    //loop through the json array


    // console.log(netMigration);
    // console.log(Object.values(netMigration[0]));
    console.log(formatC(d3.min(districtData, function (d) { return d.NetMigration })));

    //draw aixs
    line_xScale.domain(districtData.map(function (d) { return d.Year; }));
    bar_xScale.domain(districtData.map(function (d) { return d.Year }));
    line_yScale.domain([0, d3.max(districtData, function (d) { return d.PercentChange })]).nice();
    bar_yScale.domain([d3.min(districtData, function (d) { return d.NetMigration }) - 20, d3.max(districtData, function (d) { return d.NetMigration }) + 20]);

    //line axis
    line_chartGroup.append('g')
        .attr('class', 'yAxis')
        .attr('transform', "translate( " + line_width + ", 0 )")
        .call(line_yAxis);

    //bar axis
    line_chartGroup.append('g')
        .attr('class', 'yAxis2')
        .call(bar_yAxis);

    line_chartGroup.append('g')
        .attr('transform', 'translate(0,' + line_height + ')')
        .attr('class', 'xAxis')
        .call(bar_xAxis);


    //draw bar graph
    let bargraph = line_chartGroup.selectAll('.bar')
        .data(districtData)
        .enter().append('rect')
        .attr('class', 'bar')
        .attr('x', function (d) { return bar_xScale(d.Year); })
        .attr('width', function (d) { return bar_xScale.bandwidth(); })
        .attr('y', function (d) { return line_height - bar_yScale(d.NetMigration); })
        .attr('height', function (d) { return bar_yScale(d.NetMigration); });

    //bar labels
    let labels = line_chartGroup.selectAll(".label")
        .data(districtData)
        .enter()
        .append("text")
        .attr("class", "label")
        .attr("x", (function (d) { return bar_xScale(d.Year) + bar_xScale.bandwidth() / 2; }))
        .attr("y", function (d) { return line_height - bar_yScale(d.NetMigration) + 5; })
        .attr("dy", ".75em")
        .text(function (d) { return formatC(d.NetMigration); });

    //draw line graph
    let linegraph = line_chartGroup.append('path')
        .datum(districtData)
        .attr('class', 'line')
        .attr('d', growthLine);


    let dots = line_chartGroup.selectAll(".dot")
        .data(districtData)
        .enter().append("circle") // Uses the enter().append() method
        .attr("class", "dot") // Assign a class for styling
        .attr("cx", function (d) { console.log(d.Year); return line_xScale(d.Year); })
        .attr("cy", function (d) { return line_yScale(d.PercentChange) })
        .attr("r", 5)
        .on("mouseenter", function (d) {
            //toolOver is the event handler
            console.log(d);
            return line_toolOver(d, this);
        })
        .on("mousemove", function (d) {
            //gets mouse coordinates on screen
            var m = d3.mouse(this);
            mx = m[0];
            my = m[1];
            console.log(mx, my);

            return line_toolMove(mx, my, d);
        })
        .on("mouseleave", function (d) {
            return line_toolOut(d, this);
        });

    distBtn.on('click', function (d) {
        //remove all element with .selected class
        d3.selectAll('.selectedDist')
            .classed('selectedDist', false);
        //add selected class to button being clicked
        d3.select(this)
            .classed('selectedDist', true);
        //set district 
        district = d;
        console.log(district);

        districtData = data.filter(function (d) { return d.Abbrv == district });

        distName = districtData[0].District;

        d3.select('#distName').text(district + ' ' + distName);

        districtData.forEach(function (d) {
            d.NetMigration = +d.NetMigration;
            d.PercentChange = +d.PercentChange;
        });

        line_xScale.domain(districtData.map(function (d) { return d.Year; }));
        bar_xScale.domain(districtData.map(function (d) { return d.Year }));
        line_yScale.domain([0, d3.max(districtData, function (d) { return d.PercentChange })]).nice();
        bar_yScale.domain([d3.min(districtData, function (d) { return d.NetMigration }) - 20, d3.max(districtData, function (d) { return d.NetMigration }) + 20]);


        bargraph.data(districtData)
            .transition()
            .duration(1500)
            .attr('y', function (d) { return line_height - bar_yScale(d.NetMigration); })
            .attr('height', function (d) { return bar_yScale(d.NetMigration); });


        linegraph.datum(districtData)
            .transition()
            .duration(1500)
            .attr('d', growthLine);

        console.log(growthLine(districtData));
        dots.data(districtData)
            .transition()
            .duration(1500)
            .attr("cx", function (d) { return line_xScale(d.Year) })
            .attr("cy", function (d) { return line_yScale(d.PercentChange) });

        labels.data(districtData)
            .transition()
            .duration(1500)
            .attr("y", function (d) { return line_height - bar_yScale(d.NetMigration) + 5; })
            .text(function (d) { return formatC(d.NetMigration); });


        line_chartGroup.select('.yAxis')
            .transition()
            .duration(1600)
            .call(line_yAxis);

        line_chartGroup.select('.yAxis2')
            .transition()
            .duration(1600)
            .call(bar_yAxis);
    });

});

function line_toolOver(v, thepath) {
    d3.select(thepath)
        //in v4+ use the "long forms"
        .attr("style", "fill:#38598a")
        .attr("cursor", "pointer");
    return tooltip_line.style("visibility", "visible");
};

function line_toolOut(m, thepath) {
    d3.select(thepath)
        .attr("style", "fill:#fcba19")
        .attr("cursor", "pointer");
    return tooltip_line.style("visibility", "hidden");
};


function line_toolMove(mx, my, data) {
    //create the tooltip, style it and inject info
    return tooltip_line.style("top", my + - 20 + "px")
        .style("left", mx - 10 + "px")
        .html("Percentage Change: <b>" + data.PercentChange + "%");
};