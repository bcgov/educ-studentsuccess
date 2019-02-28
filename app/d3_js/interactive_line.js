 //line_margin 
 let line_margin = { top: 50, right: 50, bottom: 50, left: 50 };

 //height and width
 let line_height = 400 - line_margin.top - line_margin.bottom;
 let line_width = 600 - line_margin.left - line_margin.right;

 var formatC = d3.format(",.0f");

 //parseDate is used to covert string into year format from the csv file 
 let parseDate = d3.timeParse('%Y');

 //scales
 let line_xScale = d3.scaleTime()
     .range([0, line_width]);

 let line_yScale = d3.scaleLinear()
     .range([line_height, 0]);

 let line_xAxis = d3.axisBottom()
     .scale(line_xScale)
     .ticks(5);

 let line_yAxis = d3.axisLeft()
     .scale(line_yScale)
     .ticks(5);

 //lines
 let growthLine = d3.line()
     .x(function (d) {
         return line_xScale(d.Year);
     })
     .y(function (d) {
         return line_yScale(d.NetMigration);
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
         return 'line_'+d;
     })
     .text(function (d) {
         return d;
     })
     .attr('class', function (d) { //adding a condition to higlight selected btn
         if ( 'line_'+d == district) {
             return 'distBtn selected';
         } else {
             return 'distBtn';
         }
     });

 //canvas
 let line_svg = d3.select('#lineContainer').append('svg')
     .attr('width', line_width + line_margin.left + line_margin.right)
     .attr('height', line_height + line_margin.top + line_margin.bottom);

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
     let districtData = data.filter(function (d) { return d.Abbrv == district.substring(5,district.length) });

     // format the data
     districtData.forEach(function (d) {
         d.Year = parseDate(d.Year);
         d.NetMigration = +d.NetMigration;
     });

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

     //draw aixs
     line_xScale.domain(d3.extent(districtData, function (d) { return d.Year }));
     line_yScale.domain([d3.min(districtData, function (d) { return d.NetMigration }) - 20, d3.max(districtData, function (d) { return d.NetMigration }) + 20]);

     line_chartGroup.append('g')
         .attr('class', 'yAxis')
         .call(line_yAxis);

     line_chartGroup.append('g')
         .attr('transform', 'translate(0,' + line_height + ')')
         .attr('class', 'xAxis')
         .call(line_xAxis);

     //draw line graph
     let linegraph = line_chartGroup.append('path')
         .datum(districtData)
         .attr('class', 'line')
         .attr('d', growthLine);

     let dots = line_chartGroup.selectAll(".dot")
         .data(districtData)
         .enter().append("circle") // Uses the enter().append() method
         .attr("class", "dot") // Assign a class for styling
         .attr("cx", function (d) { return line_xScale(d.Year) })
         .attr("cy", function (d) { return line_yScale(d.NetMigration) })
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
         d3.select('.selected')
             .classed('selected', false);
         //add selected class to button being clicked
         d3.select(this)
             .classed('selected', true);
         //set district 
         district = d;
         console.log(district);

         districtData = data.filter(function (d) { return d.Abbrv == district });

         districtData.forEach(function (d) {
             // d.Year = parseDate(d.Year);, this parseDate() will parse the parsed date again.
             d.NetMigration = +d.NetMigration;
         });

         line_xScale.domain(d3.extent(districtData, function (d) { return d.Year }));
         line_yScale.domain([d3.min(districtData, function (d) { return d.NetMigration }) - 20, d3.max(districtData, function (d) { return d.NetMigration }) + 20]);


         console.log(d3.extent(districtData, function (d) { return d.NetMigration }));

         linegraph.datum(districtData)
             .transition()
             .duration(1500)
             .attr('d', growthLine);

         console.log(growthLine(districtData));
         dots.data(districtData)
             .transition()
             .duration(1500)
             .attr("cx", function (d) { return line_xScale(d.Year) })
             .attr("cy", function (d) { return line_yScale(d.NetMigration) });


         line_chartGroup.select('.yAxis')
             .transition()
             .duration(1500)
             .call(line_yAxis);
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
     return tooltip_line.style("top", my + 60 + "px")
         .style("left", mx - 10 + "px")
         .html("<div id='nmtt'>Net migration: <b>" + formatC(data.NetMigration) +
             "</div>");
 };