//%Y means 4 digits , / means separated by /
let parseDate = d3.timeParse('%m/%d/%Y');

// d3.csv('../prices.csv')
//   .then(function (data) {
//     console.log(
//       data.filter(function(d,i){
//         return {
//           month: parseDate(d.month),
//           price: Number(d.price.trim().slice(1))
//         }
//       })
//     );
//   });


d3.csv('prices.csv')
  .row(function (data) {
    return {
      month: parseDate(data.month),
      price: Number(data.price.trim().slice(1))
    };
  }).get(function (error, data) {

    let height = 300;
    let width = 500;
    //extremes
    let max = d3.max(data, function (d) {
      return d.price;
    });

    let minDate = d3.min(data, function (d) {
      return d.month;
    });

    let maxDate = d3.max(data, function (d) {
      return d.month;
    });

    //scale
    var y = d3.scaleLinear()
      .domain([0, max])
      .range([height, 0]);
    var x = d3.scaleTime()
      .domain([minDate, maxDate])
      .range([0, width]);

    let yAxis = d3.axisLeft(y);
    let xAxis = d3.axisBottom(x);

    let svg = d3.select('body')
      .append('svg')
      .attr('height', '100%')
      .attr('width', '100%');

    let margin = {
      left: 50,
      right: 50,
      top: 40,
      bottom: 0
    }

    let chartGroup = svg.append('g')
      .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

    let line = d3.line()
      .x(function (d) {
        return x(d.month);
      })
      .y(function (d) {
        return y(d.price);
      });

    chartGroup.append('path')
      //path takes d-data 
      .attr('d', line(data));

    chartGroup.append('g')
      .attr('class', 'x axis')
      .attr('transform', 'translate(0,' + height + ')')
      .call(xAxis);

    chartGroup.append('g')
      .attr('class', 'y axis')
      .call(yAxis);
  })