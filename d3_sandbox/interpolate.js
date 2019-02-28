//object array
let dataArray = [{
  x: 5,
  y: 5
}, {
  x: 10,
  y: 15
}, {
  x: 20,
  y: 7
}, {
  x: 30,
  y: 18
}, {
  x: 40,
  y: 10
}]

//array of 6 charts
var interpolateTypes = [d3.curveLinear, d3.curveNatural, d3.curveStep, d3.curveBasis, d3.curveBundle, d3.curveCardinal];

//ONE svg
let svg = d3.select('body')
  .append('svg')
  .attr('height', '100%')
  .attr('width', '100%');

for (var p = 0; p < 6; p++) {

  /*use generator to generate a path
    it generates a path, a line with 4 sections
    d3.line() is different from a svg line
    */

  //put the generators first
  //this is a function expression, won't work until we call line()
  let line = d3.line()
    //supply the generator with 5 datapoints
    .x(function (data, index) {
      return data.x * 6
    }) //use function to input data value
    .y(function (data, index) {
      return data.y * 4
    }) //use function to input data value
    .curve(interpolateTypes[p]); // make it d3.curveCardinal, d3.curveStep 18 types

  //coordinates for translate 6 groups
  //use var here, so we can access
  var shiftX = p * 250;
  var shiftY = 0;
  // add path and dots into a group, g is inside of svg element
  let chartGroup = svg.append('g')
    .attr('class', 'group' + p) // group styles
    .attr('transform', 'translate(' + shiftX + ',' + shiftY + ')'); //tansform the group as a whole

  //append path to svg element
  chartGroup.append('path')
    .attr('fill', 'none')
    .attr('stroke', 'blue')
    //path takes d-data 
    // line(dataArray) is equivlent to 'M30,20L60,60L120,28L180,72L240,40'
    .attr('d', line(dataArray));


  // select all circle with grp class
  chartGroup.selectAll('circle.grp' + p)
    .data(dataArray)
    .enter()
    .append('circle')
    .attr('class', function (data, index) {
      return 'grp' + index
    })
    .attr('cx', function (data, index) {
      return data.x * 6;
    })
    .attr('cy', function (data, index) {
      return data.y * 4;
    })
    .attr('r', '2');
}