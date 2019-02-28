let height = 200;
let width = 500;
let margin = {left: 50, right:50, top:40, bottom: 0};

let tree = d3.tree.size([width,heihgt]); //size takes a array

let svg = d3.select('body')
            .append('svg')
            .attr('width', '100%')
            .attr('height', '100%');

let chartGroup = svg.append('g')
                    .attr('transform', 'translate('+margin.left+', '+margin.top+')');;

d3.json('treeData.json').get(function(error,data) {
    console.log(data[0]); //top level called root
    //hierachy() is for json or other hierachical data
    let root = d3.hierachy(data[0]); //node object
    tree(root); 

    chartGroup.selectAll('circle')
              .data()
              .enter()
              .append('circle')
              .attr('cx', function(d) {return d.x;})
              .attr('cy', function(d) {return d.x;})
              .attr('cr', '5')
              
    chartGroup.selectAll('path')
              .data(root.descendants().slice(1))
              .enter()
              .append('path')
              .attr('class','link')
              .attr('d', function(d) {
                return 'M' +d.x+ ',' +d.y+ 'C' +d.parent.x+ ',' +d.parent.y; // L ine or C urve
              });
})