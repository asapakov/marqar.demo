<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Дерево</title>
    <style>
      .node circle {
        fill: #fff;
        stroke: steelblue;
        stroke-width: 1px;
      }

      .node text { font: 12px sans-serif; }

      .link {
        fill: none;
        stroke: #ccc;
        stroke-width: 1px;
      }

      div.tooltip {
          position: absolute;
          text-align: left;
          width: 200px;
          height: 200px;
          padding: 8px;
          font: 11px sans-serif;
          background: #ffff99;
          border: solid 1px #aaa;
          border-radius: 8px;
          pointer-events: none;
      }      
    </style>
    
  </head>
    <body>

<?php
$servername = "localhost";
$username = "u_markhar";
$password = "a5Ylua76";
$dbname = "markhar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


$sql = "SELECT * FROM user ORDER BY id ASC";  

// start query time measurement
$start_time = microtime(true);

$result = $conn->query($sql);

$arr = [];

if ($result->num_rows) {
	$arr[] = '{id: 0, name: "null"}';

	while ($row = $result->fetch_assoc()) {
    		$arr[] = '{id: ' . $row["id"] . ', 
                    parentId: ' . $row["parent_user_id"] . ', 
                    name: "' . $row["first_name"] . '",
                    level: ' . $row["level"] . ',
                    ref_id: ' . $row["ref_id"] . ',
                    status: ' . $row["status"] . ',
                    reg_order: "' . $row["reg_order"] . '",
                    can_left: ' . $row["can_left"] . ',
                    left_cell: ' . $row["left_cell"] . ',
                    left_points: ' . $row["left_points"] . ',
                    left_money: "' . $row["left_money"] . '",
                    can_right: ' . $row["can_right"] . ',                    
                    right_cell: ' . $row["right_cell"] . ',
                    right_points: ' . $row["right_points"] . ',
                    right_money: "' . $row["right_money"] . '",
                    created_at: "' . date('m/d/Y H:i:s', $row["created_at"]) . '",
                    updated_at: "' . date('m/d/Y H:i:s', $row["updated_at"]) . '"}';  
	}

} else {
  echo "0 results";
}

// calculate elapsed query time
echo sprintf('Elapsed: %f seconds<br>', microtime(true) - $start_time);

$result->free_result();
$conn->close();
?>

    <!-- load the d3.js library --> 
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script> -->
    <script src="https://d3js.org/d3.v5.min.js"></script>
      
    <script>
  const chaos = d3.stratify()
    .id(function(d) { return d.id; })
    .parentId(function(d) { return d.parentId; })
  ([
<?php
	echo implode(',', $arr);
?>
  ])
      //  assigns the data to a hierarchy using parent-child relationships
      let nodes = d3.hierarchy(chaos, d => d.children);
      console.log(nodes.count().value);

      // set the dimensions and margins of the diagram
      const margin = {top: 20, right: 200, bottom: 30, left: 90},
            width  = 1660 - margin.left - margin.right,
            height = nodes.count().value * 20 - margin.top - margin.bottom;

      // declares a tree layout and assigns the size
      const treemap = d3.tree().size([height, width]);


      // maps the node data to the tree layout
      nodes = treemap(nodes);

      // append the svg object to the body of the page
      // appends a 'group' element to 'svg'
      // moves the 'group' element to the top left margin
      const svg = d3.select("body").append("svg")
              .attr("width", width + margin.left + margin.right)
              .attr("height", height + margin.top + margin.bottom),
            g = svg.append("g")
              .attr("transform",
                  "translate(" + margin.left + "," + margin.top + ")");

      // Add tooltip div
      var div = d3.select("body").append("div")
      .attr("class", "tooltip")
      .style("opacity", 1e-6);

      // adds the links between the nodes
      const link = g.selectAll(".link")
          .data( nodes.descendants().slice(1))
        .enter().append("path")
          .attr("class", "link")
          .style("stroke", d => "black")
          .attr("d", d => {
             return "M" + d.y + "," + d.x
               + "C" + (d.y + d.parent.y) / 2 + "," + d.x
               + " " + (d.y + d.parent.y) / 2 + "," + d.parent.x
               + " " + d.parent.y + "," + d.parent.x;
             });

      const node = g.selectAll(".node")
          .data(nodes.descendants())
          .enter().append("g")
          .attr("class", d => "node" + (d.children ? " node--internal" : " node--leaf"))
          .attr("transform", d => "translate(" + d.y + "," + d.x + ")");

      node.append("circle")
        .on("mouseover", mouseover)
        .on("mousemove", function(d){mousemove(d);})
        .on("mouseout", mouseout)
        .attr("r", d => 5)
        .style("stroke", d => "black")
        .style("fill", d => "white");
        
      node.append("text")
        .attr("dy", ".35em")
        .attr("x", d => d.children ? -13 : 13)
        .attr("y", d => d.children ? -13 : 0)
        // .attr("y", d => d.children && d.depth !== 0 ? -(10 + 5) : d)
        .style("text-anchor", d => d.children ? "end" : "start")
        .text(function(d) { 
          // console.log(d.data);
          return d.data.id;
          // return d.data.id + " " + d.data.data.value + "";
        }); 


        function mouseover() {
            div.transition()
            .duration(300)
            .style("opacity", 0.9);
        }

        function mousemove(d) {
            div
            .html("<b>first_name:</b> " + d.data.data.name + 
              "<br /> <b>level:</b> " + d.data.data.level + 
              "<br /> <b>ref_id:</b> " + d.data.data.ref_id + 
              "<br /> <b>status:</b> " + d.data.data.status + 
              "<br /> <b>reg_order:</b> " + d.data.data.reg_order + 
              "<br /> <b>can_left:</b> " + d.data.data.can_left + 
              "<br /> <b>left_cell:</b> " + d.data.data.left_cell + 
              "<br /> <b>left_points:</b> " + d.data.data.left_points + 
              "<br /> <b>left_money:</b> " + d.data.data.left_money + 
              "<br /> <b>can_right:</b> " + d.data.data.can_right + 
              "<br /> <b>right_cell:</b> " + d.data.data.right_cell + 
              "<br /> <b>right_points:</b> " + d.data.data.right_points + 
              "<br /> <b>right_money:</b> " + d.data.data.right_money + 
              "<br /> <b>created_at:</b> " + d.data.data.created_at + 
              "<br /> <b>updated_at:</b> " + d.data.data.updated_at)
            .style("left", (d3.event.pageX ) + "px")
            .style("top", (d3.event.pageY) + "px");
        }

        function mouseout() {
            div.transition()
            .duration(300)
            .style("opacity", 1e-6);
        }

        // .text(d => d.data.value); 


      // node.append("text")
      //   .attr("x", function(d) { return d.children || d._children ? -13 : 13; })
      //   .attr("dy", ".35em")
      //   .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
      //   .text(function(d) { return d.data.name; })
      //   .style("fill-opacity", 1e-6);        
    </script>
   
  </body>
</html>
