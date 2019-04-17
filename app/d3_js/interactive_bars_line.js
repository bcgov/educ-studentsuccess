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


 //x1, usedto create the group (grouped bars) elements
 // 0.1 is the padding added to offset the band from the edge of the interval
 let bar_xScale1 = d3.scaleBand()
     .rangeRound([0, line_width])
     .padding(.2)
     .paddingInner(.2);

 //x2, create the smaller elements inside the group
 // domain and range will be set later
 let bar_xScale2 = d3.scaleBand()
     .padding(0.1);

 let line_yScale = d3.scaleLinear()
     .range([line_height, 0]);

 let bar_yScale = d3.scaleLinear()
     .range([line_height, 0]);

 //color scale
 let color_scale = d3.scaleOrdinal()
     .range(['#fde6ba', '#96c0e6', '#ef8a62', '#d8beda']);

 let bar_xAxis = d3.axisBottom()
     .scale(bar_xScale1);

 let line_yAxis = d3.axisRight()
     .scale(line_yScale);

 let bar_yAxis = d3.axisLeft()
     .scale(bar_yScale);


 //lines
 let growthLine = d3.line()
     .x(function (d) {
         return line_xScale(d.School_Year);
     })
     .y(function (d) {
         return line_yScale(d.FORECAST_ENROLMENT);
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
 let tooltip_line = d3.select("#lineContainer")
     .append("div")
     .attr("id", "line_tt")
     .style("z-index", "10")
     .style("position", "absolute")
     .style("visibility", "hidden");




 d3.csv('../assets/raw_data/grouped.csv', function (error, data) {
     if (error) {
         throw error;
     }

     let districtData = data.filter(function (d) { return d.DISTRICT == district.substring(7, district.length) });

     console.log(districtData);

     //get the array of keys (drivers)
     let driverNames = d3.keys(data[0]).filter(function (key) {
         if (key !== 'DISTRICT' && key !== 'School_Year' && key !== 'FORECAST_ENROLMENT') {
             return key
         }
     });

     console.log(driverNames);

     //for each js object, generate a new key called drivers
     // value is an array of js objects each has driver name and value

     //because grouped bar chart
     //data must be grouped by year, inside data grouped by drivers 

     districtData.forEach(function (d) {
         d.FORECAST_ENROLMENT = parseInt(d.FORECAST_ENROLMENT);
         d.drivers = driverNames.map(function (name) {
             return {
                 name: name,
                 value: +d[name]
             };
         });
     });


     //set aixs
     line_xScale.domain(districtData.map(function (d) { return d.School_Year; }));
     bar_xScale1.domain(districtData.map(function (d) { return d.School_Year; }));
     // set x2 axis within the bar group
     bar_xScale2.domain(driverNames).rangeRound([0, bar_xScale1.bandwidth()]);
     line_yScale.domain([0, d3.max(districtData, function (d) { return d.FORECAST_ENROLMENT; })]);

     // get min and max from multi columns (drivers)
     //first find out lowest/highest population amount throught the years then finds out largest number of drivers of that year
     bar_yScale.domain([d3.min(districtData, function (d) {
         return d3.min(d.drivers, function (d) {
             return d.value;
         });
     }), d3.max(districtData, function (d) {
         return d3.max(d.drivers, function (d) {
             return d.value;
         });
     })]);
     //     .range([line_height - bar_yScale_neg(d3.min(districtData, function (d) {
     //         return d3.min(d.drivers, function (d) {
     //             return d.value;
     //         })
     //     })), 0]);

     //line y axis
     line_chartGroup.append('g')
         .attr('class', 'yAxis')
         .attr('transform', "translate( " + line_width + ", 0 )")
         .call(line_yAxis)
         .append("text")
         .attr("transform", "rotate(-90)")
         .attr('fill', '#ccc')
         .attr("y", -6)
         .attr("dy", ".9em")
         .style("text-anchor", "end")
         .text("Toatal FTE in the year");

     //bar y axis
     line_chartGroup.append('g')
         .attr('class', 'yAxis2')
         .call(bar_yAxis)
         .append("text")
         .attr("transform", "rotate(-90)")
         .attr('fill', '#ccc')
         .attr("y", 6)
         .attr("dy", ".9em")
         .style("text-anchor", "end")
         .text("Driver Impact");

     //bar x axis
     line_chartGroup.append('g')
         .attr('transform', 'translate(0,' + line_height + ')')
         .attr('class', 'xAxis')
         .call(bar_xAxis);

     //zero line

     let zero = [
         { 'x': 0, 'y': 0 },
         { 'x': line_width, 'y': 0 }
     ];

     var xScale = d3.scaleLinear()
         .domain([0, line_width]) // input
         .range([0, line_width]);

     let zero_line = d3.line()
         .x(function (d) { return xScale(d['x']); })
         .y(function (d) { return bar_yScale(d['y']); });

     line_chartGroup.append('path')
         .datum(zero)
         .attr('id', 'zero-line')
         .attr('d', zero_line);

     //year group
     let yrGroup = line_chartGroup.selectAll('.year')
         .data(districtData)
         .enter()
         .append('g')
         .attr('class', 'year')
         .attr('transform', function (d) {
             return 'translate(' + bar_xScale1(d.School_Year) + ',0)';
         });



     //draw grouped bars
     yrGroup.selectAll('.bar')
         .data(function (d) { return d.drivers; })
         .enter().append('rect')
         .attr('class', 'bar')
         .attr('x', function (d) { return bar_xScale2(d.name); })
         .attr('width', function (d) { return bar_xScale2.bandwidth(); })
         .attr('y', function (d) { return bar_yScale(Math.max(0, d.value)); })
         .attr('height', function (d) { return Math.abs(bar_yScale(d.value) - bar_yScale(0)); })
         .style('fill', function (d) { return color_scale(d.name); });

     //bar labels
     // let labels = line_chartGroup.selectAll(".label")
     //     .data(districtData)
     //     .enter()
     //     .append("text")
     //     .attr("class", "label")
     //     .attr("x", (function (d) { return bar_xScale(d.Year) + bar_xScale.bandwidth() / 2; }))
     //     .attr("y", function (d) { return line_height - bar_yScale(d.NetMigration) + 1; })
     //     .attr("dy", ".75em")
     //     .text(function (d) { return d.NetMigration; });

     //draw line graph
     let linegraph = line_chartGroup.append('path')
         .datum(districtData)
         .attr('class', 'line')
         .attr('d', growthLine);


     let dots = line_chartGroup.selectAll(".dot")
         .data(districtData)
         .enter().append("circle") // Uses the enter().append() method
         .attr("class", "dot") // Assign a class for styling
         .attr("cx", function (d) { return line_xScale(d.School_Year); })
         .attr("cy", function (d) { return line_yScale(d.FORECAST_ENROLMENT) })
         .attr("r", 5)
         .on("mouseenter", function (d) {
             //toolOver is the event handler
             console.log(d);
             return line_toolOver(d, this);
         })
         .on("mousemove", function (d) {
             //gets mouse coordinates on screen
             let offsetTarget = $(this).parent().parent().parent().parent();
             console.log(offsetTarget);
             let offset = offsetTarget.offset();

             let mx = (event.pageX - offset.left);
             let my = (event.pageY - offset.top);

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

         let districtData = data.filter(function (d) { return d.DISTRICT == district.substring(2, district.length) });

         console.log(districtData);

         let driverNames = d3.keys(data[0]).filter(function (key) {
             if (key !== 'DISTRICT' && key !== 'School_Year' && key !== 'FORECAST_ENROLMENT' && key !== 'drivers') {
                 return key
             }
         });

         console.log(driverNames);
         //for each js object, generate a new key called drivers
         // value is an array of js objects each has driver name and value

         //because grouped bar chart
         //data must be grouped by year, inside data grouped by drivers 

         districtData.forEach(function (d) {
             d.FORECAST_ENROLMENT = parseInt(d.FORECAST_ENROLMENT);
             d.drivers = driverNames.map(function (name) {
                 console.log(name, +d[name]);
                 return {
                     name: name,
                     value: +d[name]
                 };
             });
         });


         d3.select('#distName').text(district);

         //set aixs
         line_xScale.domain(districtData.map(function (d) { return d.School_Year; }));
         bar_xScale1.domain(districtData.map(function (d) { return d.School_Year; }));
         // set x2 axis within the bar group
         bar_xScale2.domain(driverNames).rangeRound([0, bar_xScale1.bandwidth()]);
         line_yScale.domain([0, d3.max(districtData, function (d) { return d.FORECAST_ENROLMENT; })]);

         // get min and max from multi columns (drivers)
         //first find out lowest/highest population amount throught the years then finds out largest number of drivers of that year
         bar_yScale.domain([d3.min(districtData, function (d) {
             return d3.min(d.drivers, function (d) {
                 return d.value;
             });
         }), d3.max(districtData, function (d) {
             return d3.max(d.drivers, function (d) {
                 return d.value;
             });
         })]);

         yrGroup.data(districtData);
         yrGroup.selectAll('.bar')
             .data(function (d) { console.log(d.drivers); return d.drivers; })
             .transition()
             .duration(1500)
             .attr('y', function (d) { return bar_yScale(Math.max(0, d.value)); })
             .attr('height', function (d) { return Math.abs(bar_yScale(d.value) - bar_yScale(0)); });

         linegraph.datum(districtData)
             .transition()
             .duration(1500)
             .attr('d', growthLine);


         dots.data(districtData)
             .transition()
             .duration(1500)
             .attr("cx", function (d) { return line_xScale(d.School_Year); })
             .attr("cy", function (d) { return line_yScale(d.FORECAST_ENROLMENT) });

         zero_line.y(function (d) { return bar_yScale(d['y']); });
         d3.select('#zero-line')
             .transition()
             .duration(1600)
             .attr('d', zero_line);

         line_chartGroup.select('.yAxis')
             .transition()
             .duration(1600)
             .call(line_yAxis);

         line_chartGroup.select('.yAxis2')
             .transition()
             .duration(1600)
             .call(bar_yAxis);
     });


     //legends
     let legends = ['Demographics', 'Migration', 'Retention', 'Independent']
     let svgContainer = d3.select('#lineContainer .svg-content');
     var legend = svgContainer.selectAll(".legend")
         .data(legends)
         .enter().append("svg")
         .append('g')
         .attr("class", "legend")
         .attr("transform", function (d, i) { return "translate(" + i * 80 + ", 0)"; })
         .style("opacity", "0");

     legend.append("rect")
         .attr("x", line_width - 240)
         .attr("width", 18)
         .attr("height", 18)
         .style("fill", function (d) { return color_scale(d); });

     legend.append("text")
         .attr("x", line_width - 220)
         .attr("y", 9)
         .attr("dy", ".3em")
         .style("text-anchor", "start")
         .text(function (d) { return d; });

     // legend.transition().duration(500).delay(function (d, i) { return 1300 + 100 * i; }).style("opacity", "1");
     legend.style("opacity", "1");

 });

 function line_toolOver(v, thepath) {
     d3.select(thepath)
         //in v4+ use the "long forms"
         .attr("style", "fill:#FCBA19")
         .attr("cursor", "pointer");
     return tooltip_line.style("visibility", "visible");
 };

 function line_toolOut(m, thepath) {
     d3.select(thepath)
         .attr("style", "fill:#002663")
         .attr("cursor", "pointer");
     return tooltip_line.style("visibility", "hidden");
 };


 function line_toolMove(mx, my, data) {
     //create the tooltip, style it and inject info
     if (+data.School_Year > 2018) {
         return tooltip_line.style("top", my + 40 + "px")
             .style("left", mx - 10 + "px")
             .html("Forecast Enrolment: <b>" + Math.round(data.FORECAST_ENROLMENT));
     } else {
         return tooltip_line.style("top", my + - 20 + "px")
             .style("left", mx - 10 + "px")
             .html("Total Enrolment: <b>" + Math.round(data.FORECAST_ENROLMENT));
     }
 };