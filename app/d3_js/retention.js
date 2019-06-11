//margin
let retention_margin = {
    top: 10,
    right: 50,
    bottom: 50,
    left: 50
};

//height and width
let retention_height = 400 - retention_margin.top - retention_margin.bottom;
let retention_width = 600 - retention_margin.left - retention_margin.right;

//scales
let retention_xScale = d3.scalePoint().range([0, retention_width]).padding(0.5);
let retention_yScale = d3.scaleLinear().range([retention_height, 0]);

//axes
let retention_xAxis = d3.axisBottom()
    .scale(retention_xScale);

let retention_yAxis = d3.axisLeft()
    .scale(retention_yScale)
    .tickSizeOuter(0);

//lines
let prov_line = d3.line()
    .x(function (d) {
        return retention_xScale(d.SCHOOL_YEAR);
    })
    .y(function (d) {
        return retention_yScale(d.PROV_NET_RETENTION);
    })
    .curve(d3.curveMonotoneX); //smooth the line

//lines
let dist_line = d3.line()
    .x(function (d) {
        return retention_xScale(d.SCHOOL_YEAR);
    })
    .y(function (d) {
        return retention_yScale(d.DIST_NET_RETENTION);
    })
    .curve(d3.curveMonotoneX); //smooth the line

//canvas
let retention_svg = d3.select('#retention_container')
    .append('svg')
    .attr("preserveAspectRatio", "xMinYMin meet") // This forces uniform scaling for both the x and y, aligning the midpoint of the SVG object with the midpoint of the container element.
    .attr("viewBox", "0 0 600 400") //define the aspect ratio, the inner scaling of object lengths and coordinates
    .attr('class', 'svg-content');

let retention_chartGroup = retention_svg.append('g')
    .attr('class', 'chartGroup')
    .attr("transform", "translate(" + retention_margin.left + "," + retention_margin.top + ")");

let retention_legend = d3.select('#retention_control')
    .append('svg')
    .append('g')
    .attr('class', 'legendContainer');

// function retentionClear() {
//     //clear existing line
//     let existingPath = d3.selectAll("#demoContainer .demo_line");
//     existingPath.exit();
//     existingPath.transition()
//         .duration(500)
//         .remove();
//     //clear existing legends
//     let existingLegend = d3.selectAll("#demo-legend .legend");
//     console.log(existingLegend);
//     existingLegend.exit();
//     existingLegend.transition()
//         .duration(100)
//         .remove();

//     //clear tooltips 
//     demo_chartGroup.selectAll(".demott_circle")
//         .remove();
//     d3.selectAll(".demott_rect")
//         .remove();
// }

d3.csv('../assets/raw_data/retention_provincial.csv', function (error, data) {
    if (error) {
        throw error;
    }

    let prov_net_retention = data;
    prov_net_retention.forEach(function (d) {
        d.PROV_NET_RETENTION = +d.PROV_NET_RETENTION;
    })
    console.log(prov_net_retention);


    function retentionUpdate(dist) {

        d3.csv('../assets/raw_data/retention_district.csv', function (error, data) {
            if (error) {
                throw error;
            }

            let districtData = data.filter(function (d) {
                return +d.DISTRICT == dist
            });

            districtData.forEach(function (d) {
                d.DIST_NET_RETENTION = +d.DIST_NET_RETENTION;
            });

            //set scale domain
            retention_xScale.domain(districtData.map(function (d) {
                return d.SCHOOL_YEAR;
            }));

            retention_yScale.domain([Math.min(prov_net_retention),
                Math.max(Math.max(prov_net_retention), d3.max(districtData, function (d) {
                    return d.dist_net_retention;
                }))
            ]);


            //draw liens
            let prov_retention_line = retention_chartGroup.append('path')
                .datum(prov_net_retention)
                .attr('class', 'prov_retention_line')
                .attr('d', prov_line)
                .attr('fill', 'none')
                .attr('stroke-width', '2');

            let dist_retention_line = retention_chartGroup.append('path')
                .datum(districtData)
                .attr('class', 'dist_retention_line')
                .attr('d', dist_line)
                .attr('fill', 'none')
                .attr('stroke-width', '2');

            // retention_legend.append("rect")
            //     .attr("x", 10)
            //     .attr("y", i * 20)
            //     .attr("width", 18)
            //     .attr("height", 18)
            //     .style("fill", '#002663');

            // retention_legend.append("text")
            //     .attr("x", 30)
            //     .attr("y", 15 + i * 20)
            //     .text(selectedDistricts[i]);

            if ($('#retention_container .yAxis').length) {

                //set transition
                let tran = d3.transition()
                    .duration(1500);

                d3.select("#retention_container .yAxis")
                    .transition(tran)
                    .call(retention_xAxis);

                d3.select("#retention_container .xAxis")
                    .transition(tran)
                    .call(retention_yAxis);

                //grid line
                d3.selectAll("g.yAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", 0)
                    .attr("x2", retention_width)
                    .attr("y2", 0);

                d3.selectAll("g.xAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", -retention_height)
                    .attr("x2", 0)
                    .attr("y2", 0);

            } else {

                //axes
                retention_chartGroup.append('g')
                    .attr('class', 'yAxis')
                    .call(retention_yAxis)
                    .append("text")
                    .attr("transform", "rotate(-90)")
                    .attr('fill', '#4c4c4c')
                    .attr("y", 6)
                    .attr("dy", ".8em")
                    .style("text-anchor", "end")
                    .text("FTE");

                retention_chartGroup.append('g')
                    .attr('class', 'xAxis')
                    .attr('transform', 'translate(0,' + retention_height + ')')
                    .call(retention_xAis);

                //grid line
                d3.selectAll("g.yAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", 0)
                    .attr("x2", retention_width)
                    .attr("y2", 0);

                d3.selectAll("g.xAxis g.tick")
                    .append("line")
                    .attr("class", "gridline")
                    .attr("x1", 0)
                    .attr("y1", -retention_height)
                    .attr("x2", 0)
                    .attr("y2", 0);

            }


        });


    }

    retentionUpdate('05');



});