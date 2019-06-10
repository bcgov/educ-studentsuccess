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

//lines
let prov_retention_line = d3.line()
    .x(function (d) {
        return retention_xScale(d.SCHOOL_YEAR);
    })
    .y(function (d) {
        return retention_yScale(d.PROV_NET_RETENTION);
    })
    .curve(d3.curveMonotoneX); //smooth the line

//lines
let dist_retention_line = d3.line()
    .x(function (d) {
        return retention_xScale(d.SCHOOL_YEAR);
    })
    .y(function (d) {
        return retention_yScale(d.DIST_NET_RETENTION);
    })
    .curve(d3.curveMonotoneX); //smooth the line


//distirct controls
// let targetDistrict = 'SD05';
// let defaultPageLoad = true;

//array used to populate dropdown menu
// let sd_arr = [];

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

    let prov_net_retention = [];
    for(let d of data) {
            prov_net_retention.push(+d.PROV_NET_RETENTION);
    }
    console.log(prov_net_retention);


function retentionUpdate(dist) {

    d3.csv('../assets/raw_data/retention_district.csv', function (error, data) {
        if (error) {
            throw error;
        }

        let districtData = data.filter(function (d) { return +d.DISTRICT== dist });
        console.log(districtData);

         //set scale domain
         retention_xScale.domain(districtData.map(function (d) { return d.SCHOOL_YEAR; }));
 
         retention_yScale.domain([Math.min(prov_net_retention),
         Math.max(Math.max(prov_net_retention), d3.max(districtData, function (d) { return d.dist_net_retention; })]);
    });


}



});