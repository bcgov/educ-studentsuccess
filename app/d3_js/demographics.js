//margin
let demo_margin = { top: 50, right: 50, bottom: 50, left: 50 };
//height and width
let demo_height = 400 - demo_margin.top - demo_margin.bottom;
let demo_width = 600 - demo_margin.left - demo_margin.right;

//parseDate is used to covert string into year format from the csv file 
let parDate = d3.timeParse('%Y');

//scales
let demo_xScale = d3.scalePoint().range([0, demo_width]).padding(0.5);
let demo_yScale = d3.scaleLinear().range([demo_height, 0]);

//color scale
// let demo_color = d3.scaleOrdinal()
//     .range(['#edc948', '#b07aa1', '#76b7b2', '#9c755f', '#f28e2b']);

//axes
let demo_xAxis = d3.axisBottom()
    .scale(demo_xScale);

let demo_yAxis = d3.axisLeft()
    .scale(demo_yScale)
    .tickSizeOuter(0);

//canvas
let demo_svg = d3.select('#demoContainer')
    .append('svg')
    .attr("preserveAspectRatio", "xMinYMin meet")  // This forces uniform scaling for both the x and y, aligning the midpoint of the SVG object with the midpoint of the container element.
    .attr("viewBox", "0 0 600 400") //defines the aspect ratio, the inner scaling of object lengths and coordinates
    .attr('class', 'svg-content');

let demo_chartGroup = demo_svg.append('g')
    .attr('class', 'chartGroup')
    .attr("transform", "translate(" + demo_margin.left + "," + demo_margin.top + ")");

let defaultDistrict = ['SD05', 'SD06', 'SD10', 'SD08'];

for (let dist of defaultDistrict) {
    console.log(dist);
}

d3.csv('../assets/raw_data/demo_test.csv', function (error, data) {
    if (error) {
        throw error;
    }

    //array of all selected district
    let districtData = [];

    for (let dist of defaultDistrict) {

        let district = data.filter(function (d) { return d.DISTRICT == dist.substring(2, dist.length) });

        // format the data
        district.forEach(function (d) {
            d.SCHOOL_YEAR = (parDate(d.SCHOOL_YEAR)).getFullYear();
            d.NEW_KINDERGARTEN = +d.NEW_KINDERGARTEN;
            d.GRADUATES = +d.GRADUATES;
            d.NET = +d.NET;
        });
        // concat method doesn't change the original array, need to reassign it.
        districtData = districtData.concat(district);
    }
    console.log(districtData);

    let defaultType = 'NEW_KINDERGARTEN';

    function demoClear() {
        //clear existing line
        let existingPath = d3.selectAll("#demoContainer .line");
        existingPath.exit();
        existingPath.transition()
            .duration(500)
            .remove();
    }

    function demoUpdate(type) {

        //line generator
        let demoLine = d3.line()
            .x(function (d) {
                return demo_xScale(d.SCHOOL_YEAR);
            })
            .y(function (d) {
                return demo_yScale(d[type]);
            })
            .curve(d3.curveMonotoneX);

        for (let dist of defaultDistrict) {

            let district = data.filter(function (d) { return d.DISTRICT == dist.substring(2, dist.length) });

            //set scale domain 
            demo_xScale.domain(district.map(function (d) { return d.SCHOOL_YEAR; }));

            demo_yScale.domain([Math.min(0, d3.min(district, function (d) { return d[type]; })),
            Math.max(0, d3.max(district, function (d) { return d[type]; }))]);

            let demo_line = demo_chartGroup.append('path')
                .datum(district)
                .attr('class', 'line')
                .attr('d', demoLine)
                .attr('fill', 'none')
                .attr("stroke-width", "2")
                .attr('stroke', '#4c4c4c');

            //animate path
            let totalLength = demo_line.node().getTotalLength();
            console.log(totalLength);

            demo_line.attr("stroke-dasharray", totalLength + " " + totalLength)
                .attr("stroke-dashoffset", totalLength)
                .transition()
                .duration(1500)
                .attr("stroke-dashoffset", 0);
        }

        //reset scale domain combined axes
        demo_xScale.domain(districtData.map(function (d) { return d.SCHOOL_YEAR; }));

        demo_yScale.domain([Math.min(0, d3.min(districtData, function (d) { return d[type]; })),
        Math.max(0, d3.max(districtData, function (d) { return d[type]; }))]);

        if ($('#demoContainer .yAxis').length) {

            //set transition
            let tran = d3.transition()
                .duration(1500);

            d3.select("#demoContainer .yAxis")
                .transition(tran)
                .call(demo_yAxis);

            d3.select("#demoContainer .xAxis")
                .transition(tran)
                .call(demo_xAxis);

            //grid line
            d3.selectAll("g.yAxis g.tick")
                .append("line")
                .attr("class", "gridline")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", demo_width)
                .attr("y2", 0);

            d3.selectAll("g.xAxis g.tick")
                .append("line")
                .attr("class", "gridline")
                .attr("x1", 0)
                .attr("y1", -demo_height)
                .attr("x2", 0)
                .attr("y2", 0);

        } else {

            //axes
            demo_chartGroup.append('g')
                .attr('class', 'yAxis')
                .call(demo_yAxis);

            demo_chartGroup.append('g')
                .attr('class', 'xAxis')
                .attr('transform', 'translate(0,' + demo_height + ')')
                .call(demo_xAxis);

            //grid line
            d3.selectAll("g.yAxis g.tick")
                .append("line")
                .attr("class", "gridline")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", demo_width)
                .attr("y2", 0);

            d3.selectAll("g.xAxis g.tick")
                .append("line")
                .attr("class", "gridline")
                .attr("x1", 0)
                .attr("y1", -demo_height)
                .attr("x2", 0)
                .attr("y2", 0);

        }
    }

    demoUpdate(defaultType);

    //radio selection
    $("#demo-radio input[type='radio']").change(function () {
        var radioValue = $("input[name='demo-type']:checked").val();
        if (radioValue) {
            demoClear();
            demoUpdate(radioValue);
        }
    });

});