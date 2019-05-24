//margin
let demo_margin = {
    top: 50,
    right: 50,
    bottom: 50,
    left: 50
};
//height and width
let demo_height = 400 - demo_margin.top - demo_margin.bottom;
let demo_width = 600 - demo_margin.left - demo_margin.right;

//scales
let demo_xScale = d3.scalePoint().range([0, demo_width]).padding(0.5);
let demo_yScale = d3.scaleLinear().range([demo_height, 0]);

//create color scale
let demo_color = d3.scaleOrdinal(d3.schemeCategory20);

//axes
let demo_xAxis = d3.axisBottom()
    .scale(demo_xScale);

let demo_yAxis = d3.axisLeft()
    .scale(demo_yScale)
    .tickSizeOuter(0);

//canvas
let demo_svg = d3.select('#demoContainer')
    .append('svg')
    .attr("preserveAspectRatio", "xMinYMin meet") // This forces uniform scaling for both the x and y, aligning the midpoint of the SVG object with the midpoint of the container element.
    .attr("viewBox", "0 0 600 400") //defines the aspect ratio, the inner scaling of object lengths and coordinates
    .attr('class', 'svg-content');

let demo_chartGroup = demo_svg.append('g')
    .attr('class', 'chartGroup')
    .attr("transform", "translate(" + demo_margin.left + "," + demo_margin.top + ")");

let legendContainer = d3.select('#demo-legend')
    .append('svg')
    .append('g')
    .attr('class', 'legendContainer');

d3.csv('../assets/raw_data/demo_test.csv', function (error, data) {
    if (error) {
        throw error;
    }

    //array of selected district (objects), used to draw lines
    let defaultDistrict = ['SD23-Central Okanagan', 'SD35-Langley', 'SD61-Greater Victoria', 'SD73-Kamloops - Thompson'];

    let defaultType = 'NEW_KINDERGARTEN';

    function demoClear() {
        //clear existing line
        let existingPath = d3.selectAll("#demoContainer .line");
        existingPath.exit();
        existingPath.transition()
            .duration(500)
            .remove();
        //clear existing legends
        let existingLegend = d3.selectAll("#demo-legend .legend");
        console.log(existingLegend);
        existingLegend.exit();
        existingLegend.transition()
            .duration(100)
            .remove();
    }

    function demoUpdate(type, selectedDistricts) {


        //array of all selected, used to set axes
        let districtData = [];
        for (let dist of selectedDistricts) {

            let district = data.filter(function (d) {
                return d.DISTRICT == dist.substring(2, 4)
            });

            // format the data
            district.forEach(function (d) {
                d.SCHOOL_YEAR = (parseDate(d.SCHOOL_YEAR)).getFullYear();
                d.NEW_KINDERGARTEN = +d.NEW_KINDERGARTEN;
                d.GRADUATES = +d.GRADUATES;
                d.NET = +d.NET;
            });
            // concat method doesn't change the original array, need to reassign it.
            districtData = districtData.concat(district);
        }
        console.log(districtData);

        // for (let dist of defaultDistrict) {
        // use for loop for positioning the legend
        for (let i = 0; i < selectedDistricts.length; i++) {
            let district = data.filter(function (d) {
                return d.DISTRICT == selectedDistricts[i].substring(2, 4)
            });

            console.log(district);

            //set scale domain (combined districtData[])
            demo_xScale.domain(districtData.map(function (d) {
                return d.SCHOOL_YEAR;
            }));

            demo_yScale.domain([Math.min(0, d3.min(districtData, function (d) {
                    return d[type];
                })),
                Math.max(0, d3.max(districtData, function (d) {
                    return d[type];
                }))
            ]);

            //line generator 
            let demoLine = d3.line()
                .x(function (d) {
                    return demo_xScale(d.SCHOOL_YEAR);
                })
                .y(function (d) {
                    return demo_yScale(d[type]);
                })
                .curve(d3.curveMonotoneX);


            //draw line
            let demo_line = demo_chartGroup.append('path')
                .datum(district)
                .attr('class', 'line')
                .attr('d', demoLine)
                .attr('fill', 'none')
                .attr("stroke-width", "2")
                .attr('stroke', demo_color(selectedDistricts[i]));

            // draw legend
            let legend = legendContainer.append('g')
                .attr('class', 'legend');

            legend.append("rect")
                .attr("x", 10)
                .attr("y", i * 20)
                .attr("width", 18)
                .attr("height", 18)
                .style("fill", demo_color(selectedDistricts[i]));

            legend.append("text")
                .attr("x", 30)
                .attr("y", 15 + i * 20)
                .text(selectedDistricts[i]);
            
            console.log(selectedDistricts[i]);

            //animate path
            let totalLength = demo_line.node().getTotalLength();
            // console.log(totalLength);

            demo_line.attr("stroke-dasharray", totalLength + " " + totalLength)
                .attr("stroke-dashoffset", totalLength)
                .transition()
                .duration(1500)
                .attr("stroke-dashoffset", 0);
        }

        // //reset scale domain for combined axes
        // demo_xScale.domain(districtData.map(function (d) {
        //     return d.SCHOOL_YEAR;
        // }));

        // demo_yScale.domain([Math.min(0, d3.min(districtData, function (d) {
        //         return d[type];
        //     })),
        //     Math.max(0, d3.max(districtData, function (d) {
        //         return d[type];
        //     }))
        // ]);

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
                .call(demo_yAxis)
                .append("text")
                .attr("transform", "rotate(-90)")
                .attr('fill', '#4c4c4c')
                .attr("y", 6)
                .attr("dy", ".8em")
                .style("text-anchor", "end")
                .text("Headcount");

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

    demoUpdate(defaultType, defaultDistrict);

    /******control******/

    //radio selection
    $("#demo-radio input[type='radio']").change(function () {
        var radioValue = $("input[name='demo-type']:checked").val();
        if (radioValue) {
            demoClear();
            demoUpdate(radioValue, defaultDistrict);
        }
    });
    console.log(sd_arr);
    //populate checkbox list in modal, sd_arr (list of districts) is a global array from predictors section
    //value= '" + dist + "' has to be quoted like this, since val contains space
    $.each(sd_arr, function (index, dist) {
        let checkbox = "<div class='checkbox'><label><input type='checkbox' id=" + dist.substring(2, 4) + " value= '" + dist + "'>" + dist.substring(2, dist.length) + "</label></div>"
        $(".modal-body").append($(checkbox));
    })

    //set the selection limit
    $('.checkbox input:checkbox').on('change', function (e) {
        if ($('.checkbox input:checkbox:checked').length > 10) {
            //this.checked = false; OR 
            $(this).prop('checked', false);
            console.log('Please select no more than 10 districts');
        }
    });

    $('#demo-save').click(function () {
        defaultDistrict = [];
        $(".checkbox  input:checkbox:checked").map(function (e) {
            defaultDistrict.push($(this).val());
        });
        console.log(defaultDistrict);
        demoClear();
        demoUpdate(defaultType, defaultDistrict);
    });

});