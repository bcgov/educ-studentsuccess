let dataArray = [5, 11, 18];
//svg is a canvas

let dataDays = ['Mon', 'Wed', 'Fri'];

//color scales
let rainbow = d3.scaleSequential(d3.interpolateRainbow) //define algorithm (8 of them)
                .domain([0,10]); //number of points in that color range  

let rainbow2 = d3.scaleSequential(d3.interpolateRainbow) 
                .domain([0,3]);         

//ordinal scale
let x = d3.scaleBand()
          .domain(dataDays)
          .range([0,170])
          .paddingInner(0.1176); //% of the chart that is dedicated to white space

// let x = d3.scaleOrdinal()
//           .domain(dataDays)
//           .range([25,85,145]);

// let x = d3.scalePoint()
//           .domain(dataDays)
//           .range([0, 170]); //min&max like orther scale types
let xAxis = d3.axisBottom(x);

//1. select an element from DOM
//2. add or append a new svg element to it
let svg = d3.select('body')
  .append('svg')
  //set attr width and height
  .attr('height', '100%')
  .attr('width', '100%');

//begin by selecting rect, but havent added yet, 
//can be class, id, attr, containment (children of a particular div)

/*
tells the browser to find svg and see if there is rect
isnide, if yes, return em in a selection array, 
if not, return an empty selection
*/
svg.selectAll('rect')
  //binds data to selection, one by one (5,11,18)
  .data(dataArray)
  /*
  D3 put leftover data or missing element
  into an enter selection, e.g if there were 2 rect, 
  18 will be in the enter selection

  in this case, empty selection means all 3 data points
  are leftover/missing elements, add all 3 numbers into
  the enter selection
  */
  .enter().append('rect') //then append a rect for each item in the enter selection
          .attr('height',function(data,index){ return data*15;}) ////use function to add data dynamically 
          .attr('width','50')
          .attr('fill',function(data,index) { return rainbow(index); }) //d3 use fill for bg-color;
          .attr('x',function(data,index){ return 60*index;}) //use function to add data dynamically 
          .attr('y',function(data,index){ return 300-(data*15);});// shift bars, so we dont read them upside down

  /*
  if there are 4 rect already in the dom,
  instead of enter().append()
  it will be .exit().remove()
  the 4th rect will never be used
  */

  let bar2 = svg.append('g')
                .attr('transform','translate(100,400)');

  bar2.selectAll('rect')
     .data(dataArray)
     .enter()
     .append('rect')
     .attr('height', function(data, index){ return data*10; })
     .attr('width', '20')
     .attr('fill',function(data,index) { return rainbow2(index); })//cat20 is a color array 
     .attr('x', function(data,index){ return 30*index; })
     .attr('y', function(data,index){ return 300-(data*10)});


  svg.append('g')
     .attr('class','x axis hidden')
     .attr('transform', 'translate(0,300)')
     .call(xAxis);