//margin
let retention_margin = {
    top: 10,
    right: 50,
    bottom: 50,
    left: 30
};

//height and width
let retention_height = 400 - retention_margin.top - retention_margin.bottom;
let retention_width = 600 - retention_margin.left - retention_margin.right;

//scales
let retention_xScale = d3.scalePoint().range([0, retention_width]).padding(0.5);
let retention_yScale_dist = d3.scaleLinear().range([retention_height, 0]);
let retention_yScale_prov = d3.scaleLinear().range([retention_height, 0]);

//axes
let retention_xAxis = d3.axisBottom()
    .scale(retention_xScale);

let retention_yAxis_dist = d3.axisLeft()
    .scale(retention_yScale_dist)
    .tickSizeOuter(0);

let retention_yAxis_prov = d3.axisRight()
    .scale(retention_yScale_prov)
    .tickSizeOuter(0);

//lines
let prov_line = d3.line()
    .x(function (d) {
        return retention_xScale(d.SCHOOL_YEAR);
    })
    .y(function (d) {
        return retention_yScale_prov(d.PROV_NET_RETENTION);
    })
    .curve(d3.curveMonotoneX); //smooth the line

//lines
let dist_line = d3.line()
    .x(function (d) {
        return retention_xScale(d.SCHOOL_YEAR);
    })
    .y(function (d) {
        return retention_yScale_dist(d.DIST_NET_RETENTION);
    })
    .curve(d3.curveMonotoneX); //smooth the line

//canvas
let retention_svg = d3.select('#retention_container')
    .append('svg')
    .attr('preserveAspectRatio', 'xMinYMin meet') // This forces uniform scaling for both the x and y, aligning the midpoint of the SVG object with the midpoint of the container element.
    .attr('viewBox', '0 0 600 400') //define the aspect ratio, the inner scaling of object lengths and coordinates
    .attr('class', 'svg-content');

let retention_chartGroup = retention_svg.append('g')
    .attr('class', 'chartGroup')
    .attr('transform', 'translate(' + retention_margin.left + ',' + retention_margin.top + ')');

let retention_legend = d3.select('#retention_control .row')
    .append('svg')
    .attr('class', 'retention_legend col-4')
    .append('g')
    .attr('class', 'legend');

//populate dropdown menu
for (let i = 0; i < sd_arr.length; i++) {
    let opt = sd_arr[i];
    d3.select('#retention_distDropdown .list')
        .append('div')
        .text(opt)
        //take the sd number (first 4 letters) as value
        .attr('data-value', opt.substring(0, 4));
};

function retentionClear() {
    //clear existing line
    let provLine = d3.selectAll('#retention_container .prov_retention_line');
    provLine.exit();
    provLine.transition()
        .duration(500)
        .remove();

    let distLine = d3.selectAll('#retention_container .dist_retention_line');
    distLine.exit();
    distLine.transition()
        .duration(500)
        .remove();

    //clear existing legends
    let existingLegend = d3.selectAll('#retention_legend .legend');
    existingLegend.exit();
    existingLegend.transition()
        .duration(100)
        .remove();

    //clear tooltips 
    // demo_chartGroup.selectAll('.demott_circle')
    //     .remove();
    // d3.selectAll('.demott_rect')
    //     .remove();
}

d3.csv('../assets/raw_data/retention_provincial.csv', function (error, data) {
    if (error) {
        throw error;
    }

    let provData = data;
    provData.forEach(function (d) {
        d.SCHOOL_YEAR = (parseDate(d.SCHOOL_YEAR)).getFullYear()
        d.PROV_NET_RETENTION = +d.PROV_NET_RETENTION;
    })



    function retentionUpdate(dist) {

        d3.csv('../assets/raw_data/retention_district.csv', function (error, data) {
            if (error) {
                throw error;
            }

            let districtData = data.filter(function (d) {
                return +d.DISTRICT == dist
            });

            districtData.forEach(function (d) {
                d.SCHOOL_YEAR = (parseDate(d.SCHOOL_YEAR)).getFullYear();
                d.DIST_NET_RETENTION = +d.DIST_NET_RETENTION;
            });

            console.log(districtData);
            //set scale domain
            retention_xScale.domain(districtData.map(function (d) {
                return d.SCHOOL_YEAR;
            }));

            retention_yScale_prov.domain([d3.min(provData, function (d) {
                return d.PROV_NET_RETENTION;
            }), 0]);

            retention_yScale_dist.domain([d3.min(districtData, function (d) {
                return d.DIST_NET_RETENTION;
            }), d3.max(districtData, function (d) {
                return d.DIST_NET_RETENTION;
            })]);

            //tooltips
            let retentiontt = retention_chartGroup.append('g')
                .attr('class', 'retentiontt')
                .style('display', 'none');

            //tt line
            retentiontt.append('line')
                .attr('class', 'retentiontt_line')
                .attr("y1", 0)
                .attr("y2", retention_height);

            //tt info rect, since z-index doesnt work for svg elments, draw later
            d3.select('#retention_container').append('div')
                .attr('class', 'retentiontt_rect')
                .style('display', 'none');

            //overlay, to triger tt
            retention_svg.append('rect')
                .attr("transform", "translate(" + retention_margin.left + "," + retention_margin.top + ")")
                .attr("class", "retention_overlay")
                .attr("width", retention_width)
                .attr("height", retention_height)
                .on("mouseover", function () {
                    retentiontt.style("display", null);
                })
                .on("mouseleave", function () {

                    retentiontt.style("display", "none");
                    d3.selectAll(".retentiontt_rect")
                        .style('display', 'none');
                    retention_chartGroup.selectAll(".retentiontt_circle")
                        .style('display', 'none');

                })
                .on("mousemove", showRetentiontt);

            //draw liens
            let prov_retention_line = retention_chartGroup.append('path')
                .datum(provData)
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

            //animate path
            let plineLength = prov_retention_line.node().getTotalLength();
            let dlineLength = dist_retention_line.node().getTotalLength();

            prov_retention_line.attr("stroke-dasharray", plineLength + " " + plineLength)
                .attr("stroke-dashoffset", plineLength)
                .transition()
                .duration(1500)
                .attr("stroke-dashoffset", 0);

            dist_retention_line.attr("stroke-dasharray", dlineLength + " " + dlineLength)
                .attr("stroke-dashoffset", dlineLength)
                .transition()
                .duration(1500)
                .attr("stroke-dashoffset", 0);

            //legends
            retention_legend.append('rect')
                .attr('x', 10)
                .attr('y', 20)
                .attr('width', 18)
                .attr('height', 18)
                .style('fill', '#002663');

            retention_legend.append('text')
                .attr('x', 30)
                .attr('y', 35)
                .text('Province');

            retention_legend.append('rect')
                .attr('x', 10)
                .attr('y', 50)
                .attr('width', 18)
                .attr('height', 18)
                .style('fill', '#FCBA19');

            retention_legend.append('text')
                .attr('x', 30)
                .attr('y', 65)
                .text('Southeast Kootenay');

            if ($('#retention_container .yAxis_dist').length) {

                //set transition
                let tran = d3.transition()
                    .duration(1500);

                d3.select('#retention_container .yAxis_dist')
                    .transition(tran)
                    .call(retention_yAxis_dist);

                d3.select('#retention_container .yAxis_prov')
                    .transition(tran)
                    .call(retention_yAxis_prov);

                d3.select('#retention_container .xAxis')
                    .transition(tran)
                    .call(retention_xAxis);

                //grid line
                d3.selectAll('g.yAxis_dist g.tick')
                    .append('line')
                    .attr('class', 'gridline')
                    .attr('x1', 0)
                    .attr('y1', 0)
                    .attr('x2', retention_width)
                    .attr('y2', 0);

                d3.selectAll('g.xAxis_dist g.tick')
                    .append('line')
                    .attr('class', 'gridline')
                    .attr('x1', 0)
                    .attr('y1', -retention_height)
                    .attr('x2', 0)
                    .attr('y2', 0);

            } else {

                //axes
                retention_chartGroup.append('g')
                    .attr('class', 'yAxis_dist')
                    .call(retention_yAxis_dist)
                    .append('text')
                    .attr('transform', 'rotate(-90)')
                    .attr('fill', '#4c4c4c')
                    .attr('y', 6)
                    .attr('dy', '.8em')
                    .style('text-anchor', 'end')
                    .text('FTE - District');

                retention_chartGroup.append('g')
                    .attr('class', 'yAxis_prov')
                    .attr('transform', 'translate( ' + retention_width + ', 0 )')
                    .call(retention_yAxis_prov)
                    .append('text')
                    .attr('transform', 'rotate(-90)')
                    .attr('fill', '#4c4c4c')
                    .attr('y', 6)
                    .attr('dy', '-0.2em')
                    .style('text-anchor', 'end')
                    .text('FTE - Province');

                retention_chartGroup.append('g')
                    .attr('class', 'xAxis')
                    .attr('transform', 'translate(0,' + retention_height + ')')
                    .call(retention_xAxis);

                //grid line
                d3.selectAll('g.yAxis_dist g.tick')
                    .append('line')
                    .attr('class', 'gridline')
                    .attr('x1', 0)
                    .attr('y1', 0)
                    .attr('x2', retention_width)
                    .attr('y2', 0);

                d3.selectAll('g.xAxis_dist g.tick')
                    .append('line')
                    .attr('class', 'gridline')
                    .attr('x1', 0)
                    .attr('y1', -retention_height)
                    .attr('x2', 0)
                    .attr('y2', 0);

            }


        });


    }

    retentionUpdate('05');

    //dropdown select district
    //removes event handlers from selected elements as updateGraph
    $('#retention_distDropdown').unbind().on('click', function (et) {
        console.log('clicked');
        $(this).toggleClass('active');

        //or add on click when appending the divs
        d3.selectAll('#retention_distDropdown .list div')
            .on('click', function () {
                $('#retention_distDropdown span').text($(this).text());
                $('#retention_distDropdown').attr('attr', 'dropDown');

                //reset target district 
                targetDistrict = d3.select(this).attr('data-value').substring(2, 4);
                retentionClear();
                retentionUpdate(targetDistrict);
            });
    });

});