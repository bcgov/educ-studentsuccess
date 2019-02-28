// most chart needs two domains (possible vaules) for x,y axis 
// 2 ranges, d3 outputs, width height 
// scale domain into range, scales can be continous, ordinal, quantized, or sequential 

let dataArray = [25, 26, 28, 32, 37, 45, 55, 70, 90, 120, 135, 150, 160, 168, 172, 177, 180];
let dataYears = ['2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016'];

//parse date string
let parseDate = d3.timeParse('%Y');
let maxYear = d3.max(dataYears, function (data) {
  return parseDate(data);
});
//an array contains both min and max value
let minMax = d3.extent(dataYears, function (data) {
  return parseDate(data);
});

let height = 200;
let width = 500;

//margin
let margin = {
  left: 50,
  right: 50,
  top: 40,
  bottom: 0
};

//y scale
let y = d3.scaleLinear() //type of the scale
  .domain([0, d3.max(dataArray)]) //domain, always take an array
  .range([height, 0]); //output range, invert range cuz browser draws upside down
//x scale
let x = d3.scaleTime()
  .domain(d3.extent(dataYears, function (data) {
    return parseDate(data);
  }))
  .range([0, width]);

//create axis
let yAxis = d3.axisLeft(y) //4 axis generators: top left bottom right
  //.ticks(3) //number of ticks
  .tickPadding(10); //distance btw label and line
// left & right tells d3 where to put the LABELS realtive to the line

let xAxis = d3.axisBottom(x);
 
let area = d3.area()
  .x(function (data, index) {
    //use index because we use dataArray to generate area chart NOT dataYears
    return x(parseDate(dataYears[index])); 
  })
  .y0(height) //lower line, run along the axis, 200px from the top
  .y1(function (data, index) {
    return height - data;
  }); // higher line 
let svg = d3.select("body").append("svg").attr("height", "100%").attr("width", "100%");

let chartGroup = svg.append('g')
  .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

chartGroup.append("path")
  .attr("d", area(dataArray));

//both x,y aixs has its own group
chartGroup.append('g')
  .attr('class', 'axis y')
  .call(yAxis);

chartGroup.append('g')
  .attr('class', 'axis x')
  .attr('transform', 'translate(0,'+height+')')
  .call(xAxis);