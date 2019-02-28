let parseDate = d3.timeParse('%m/%d/%Y')

d3.tsv('../data.tsv')
  .row(function (d) {
    return {
      month: parseDate(d.month),
      price: Number(d.price.trime().slice(1))
    };
  })
  .get(function (error, data) {
    console.log(data);
  });


let psv = d3.dsvFormat("|");
d3.text('../data.txt')
  .get(function (error, data) {

    let rows = psv.parse(data);
    //declare a new array to format the data
    let newRows = [];
    for (let p = 0; p < rows.length; p++) {
      //push new entry to new array (newRows)
      newRows.push({
        month: parseDate(rows[p].month),
        // no d.price, use rows index rows[p]
        price: Number(rows[p].price.trim().slice(1))
      });
    }
    console.log(newRows);
  });

//  JSON file
d3.json('treeData.json').get(function (error, data) {
  console.log(data[0]); //get the top object without the [] 
  console.log(data[0].children); // level 2 objects
  console.log(data[0].children[0].children[1]); // level 3 children
  console.log(data[0].name); // properties

  //d3 json data handler to loop through data

})

// HTML handler d3 allows to download web page and parse web pages
// if the website has cross-origin resourse sharing (CORS)
d3.html('url').get(function(error,data){
  console.log(data); // all elements/nodes in that web apge

  var frag = data.querySelector('div');  //first div
  console.log(frag);
});

//convenience methods
d3.request(url) //location url
  //.row(function(d){...})
  .get(callback)

  //OR

d3.request(url,...,callback);
function callback(error, rows) {
  ...
}

//importing data directly from a database