//margin
let demo_margin = {
    top: 10,
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
    .attr("viewBox", "0 0 600 400") //define the aspect ratio, the inner scaling of object lengths and coordinates
    .attr('class', 'svg-content');

let demo_chartGroup = demo_svg.append('g')
    .attr('class', 'chartGroup')
    .attr("transform", "translate(" + demo_margin.left + "," + demo_margin.top + ")");

let legendContainer = d3.select('#demo-legend')
    .append('svg')
    .attr('height', '200')
    .append('g')
    .attr('class', 'legendContainer');

d3.csv('../assets/raw_data/demographics.csv', function (error, data) {
    if (error) {
        throw error;
    }

    //array of selected district (objects), used to draw lines
    let defaultDistrict = ['SD23-Central Okanagan', 'SD35-Langley', 'SD61-Greater Victoria', 'SD73-Kamloops - Thompson'];

    let defaultType = 'NEW_KINDERGARTEN';

    function demoClear() {
        //clear existing line
        let existingPath = d3.selectAll("#demoContainer .demo_line");
        existingPath.exit();
        existingPath.transition()
            .duration(500)
            .remove();
        //clear existing legends
        let existingLegend = d3.selectAll("#demo-legend .legend");
     
        existingLegend.exit();
        existingLegend.transition()
            .duration(100)
            .remove();

        //clear tooltips 
        demo_chartGroup.selectAll(".demott_circle")
            .remove();
        d3.selectAll(".demott_rect")
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
        //tooltips
        let demott = demo_chartGroup.append('g')
            .attr('class', 'demott')
            .style('display', 'none');

        //tt line
        demott.append('line')
            .attr('class', 'demott_line')
            .attr("y1", 0)
            .attr("y2", demo_height);

        //tt info rect, since z-index doesnt work for svg elments, draw later
        d3.select('#demoContainer').append('div')
            .attr('class', 'demott_rect')
            .style('display', 'none');

        //overlay, to triger tt
        demo_svg.append('rect')
            .attr("transform", "translate(" + demo_margin.left + "," + demo_margin.top + ")")
            .attr("class", "demo_overlay")
            .attr("width", demo_width)
            .attr("height", demo_height)
            .on("mouseover", function () {
                demott.style("display", null);
            })
            .on("mouseleave", function () {

                demott.style("display", "none");
                d3.selectAll(".demott_rect")
                    .style('display', 'none');
                demo_chartGroup.selectAll(".demott_circle")
                    .style('display', 'none');

            })
            .on("mousemove", showDemott);
        
            let currentPos;
        // custom invert function for point scale + tooltips
        function showDemott() {
            let xPos = d3.mouse(this)[0];
            let domain = demo_xScale.domain();
            let range = demo_xScale.range();
            let rangePoints = d3.range(range[0], range[1], demo_xScale.step())
            currentPos = domain[d3.bisect(rangePoints, xPos) - 1];

            if (currentPos) {
                demott.select(".demott_line").attr("x1", demo_xScale(currentPos));
                demott.select(".demott_line").attr("x2", demo_xScale(currentPos));
                demo_chartGroup.selectAll(".demott_circle")
                    .style('display', 'none');
                // select circles for the current year (mouse over)
                demo_chartGroup.selectAll("circle[cx='" + demo_xScale(currentPos) + "']")
                    .style('display', null);

                //difference btween contianer div and svg canvas
                let oBox = document.getElementById('demoContainer').getBoundingClientRect();
                let svgSacle = oBox.width / 600;

                d3.select(".demott_rect")
                        .style('display', null)
                        .html(function() { 
                            let content = "<div class='tipHeader'><b>Year: </b>" + currentPos +"</div>"; 
                            for(let d of selectedDistricts){ 
                             for (let d2 of districtData) {
                                if (d2.DISTRICT==d.substring(2,4)&&d2.SCHOOL_YEAR==currentPos)
                                content += "<div class='tipInfo' data-num='"+d2[type]+"'>"+d.substring(5, d.length)+ ": <span class='tipNum'>"+d2[type]+"</span></div>"
                                }
                            }
                            return content;});

                //sort html elements based on value
                let tipBox = $('.demott_rect');
 
                tipBox.find('.tipInfo').sort(function(a,b){
                    return +b.getAttribute('data-num') - +a.getAttribute('data-num')
                })
                .appendTo(tipBox);


                if (currentPos == 2018) {
                    d3.select(".demott_rect").style('left', (demo_xScale(currentPos) * svgSacle - 60) + 'px');
                } else {
                    d3.select(".demott_rect").style('left', (demo_xScale(currentPos) * svgSacle + 85) + 'px');;
                }
            }
        }

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
                });


            //draw line
            let demo_line = demo_chartGroup.append('path')
                .datum(district)
                .attr('class', 'demo_line')
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
            
            //tooltips info
            d3.select('.demott')
                       .append('div')
                       .text(selectedDistricts[i]);

            //animate path
            let totalLength = demo_line.node().getTotalLength();
            // console.log(totalLength);

            demo_line.attr("stroke-dasharray", totalLength + " " + totalLength)
                .attr("stroke-dashoffset", totalLength)
                .transition()
                .duration(1500)
                .attr("stroke-dashoffset", 0);

            //tooltips circle
            for (let dist of district) {
                demo_chartGroup.append('circle')
                    .attr('class', 'demott_circle')
                    .attr('r', '5')
                    .attr('cx', demo_xScale(dist.SCHOOL_YEAR))
                    .attr('cy', demo_yScale(dist[type]))
                    .style('fill', demo_color(selectedDistricts[i]))
                    .style('display', 'none');
            }
        }


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
        let radioValue = $("input[name='demo-type']:checked").val();
        if (radioValue) {
            demoClear();
            demoUpdate(radioValue, defaultDistrict);
        }
    });

    //checkbox list in modal, sd_arr (list of districts) is a global array from predictors section
    //value= '" + dist + "' has to be quoted like this, since val contains space
    $.each(sd_arr, function (index, dist) {
        let checkbox;
        if (dist == 'SD23-Central Okanagan' || dist == 'SD35-Langley' || dist == 'SD61-Greater Victoria' || dist == 'SD73-Kamloops - Thompson') {
            checkbox = "<div class='checkbox'><label><input type='checkbox' id=" + dist.substring(2, 4) + " class='demo_checkbox' value= '" + dist + "' checked><span>" + dist.substring(2, dist.length) + "</span></label></div>"
        } else {
            checkbox = "<div class='checkbox'><label><input type='checkbox' id=" + dist.substring(2, 4) + " class='demo_checkbox' value= '" + dist + "'><span>" + dist.substring(2, dist.length) + "</span></label></div>"
        }
        $(".modal-body").append($(checkbox));
    })

    //set the selection limit
    $('.checkbox input:checkbox').on('change', function (e) {
        $('#demoModal_msg').css('color', '#494949');
        if ($('.checkbox input:checkbox:checked').length > 8) {
            //this.checked = false; OR 
            $(this).prop('checked', false);
            $('#demoModal_msg').css('color', '#d8292f');
        }
    });

    $('#demo_deselect').click(function() {
        $('.demo_checkbox').prop("checked", false);
    });

    $('#demo_save').click(function () {
        defaultDistrict = [];
        $(".checkbox  input:checkbox:checked").map(function (e) {
            defaultDistrict.push($(this).val());
        });
        let radioValue = $("input[name='demo-type']:checked").val()
        console.log(radioValue);
        demoClear();
        demoUpdate(radioValue, defaultDistrict);
    });

});