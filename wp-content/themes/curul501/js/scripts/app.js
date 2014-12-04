var run = {} 
run.pieChart = function(votos, urlBase){
      start = false;

      var margin = {top: 230, right: 280, bottom: 230, left: 280},
          radius = Math.min(margin.top, margin.right, margin.bottom, margin.left) - 40;

      var hue = d3.scale.category10();

      var luminance = d3.scale.sqrt()
          .domain([0, 1e6])
          .clamp(true)
          .range([90, 20]);

      var pie_chart = d3.select("#pie_chart").append("svg")
          .attr("id","pie_chart")
          .attr("width", margin.left + margin.right)
          .attr("height", margin.top + margin.bottom)
        .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

      var partition = d3.layout.partition()
          .sort(function(a, b) { return d3.ascending(a.name, b.name); })
          .size([2 * Math.PI, radius]);

      var arc = d3.svg.arc()
          .startAngle(function(d) { return d.x; })
          .endAngle(function(d) { return d.x + d.dx - .01 / (d.depth + .5); })
          .innerRadius(function(d) { return radius / 3 * d.depth; })
          .outerRadius(function(d) { return radius / 3 * (d.depth + 1) - 1; });


      var root =  {
          "name": "votacion",
          "children": [   
            {
             "name": "favor",
             "title": "Votos a favor",
             "tag": "votos a favor", 
             "class": "category",
             "color": { "l": 52.17304494493369,   "a": 39.69039823150866, "b": -35.0230301689294
             },
             "children": [ ]
            },
            {
             "name": "contra",
             "title": "Votos en contra",
             "tag": "votos en contra", 
             "class": "category",
             "color": {
              "l": 79.29033017704548, "a": 6.205848940433301, "b": -5.127890265132629 },
             "children": [ ]
            },
            {
             "name": "abstencion",
             "title": "Abstenciones",
             "tag": "abstenciones", 
             "class": "category",
             "color": { "l": 85.57449359301404, "a": 7.715810606051699, "b": 15.544942145990493 },
             "children": []
            },
            {
             "name": "ausente",
             "title": "Inasistencias",
             "tag": "inasistencias", 
             "class": "category",
             "color": { "l": 46.76947124553321, "a": 0.9824518740245147, "b": -9.727922529882548 },
             "children": []
            }
           ]
          }

      for (var i in votos){
        if(votos[i].id_political_party != 0 && votos[i].tipo != 'sp'){
          for(var j in root.children){
            var categoria = root.children[j]

            categoria.children.push({ 
              "name": votos[i]["tipo"].toUpperCase(), // NOMBRE DEL PARTIDO
              "size": votos[i][categoria.name] // CANTIDAD
            })
          }
        }
      }

      // Compute the initial layout on the entire tree to sum sizes.
      // Also compute the full name and fill color for each node,
      // and stash the children so they can be restored as we descend.
      partition
        .value(function(d) { return d.size; })
        .nodes(root)
        .forEach(function(d) {
          d._children = d.children;
          d.sum = d.value;
          d.key = key(d);

          if (!d.parent) return 
          if( !("class" in d) || !(d.class == "category") )
            d.color = d.parent.color

          d.fill = fill(d)

          d.fill.l = d.color.l
          d.fill.a = d.color.a
          d.fill.b = d.color.b

        });

      // Now redefine the value function to use the previously-computed sum.
      partition
          .children(function(d, depth) { return depth < 2 ? d._children : null; })
          .value(function(d) { return d.sum; });
      
      var border1 = pie_chart.append("circle")
          .attr("r", radius + 40)
          .style("fill", "#f6f1f7");

      border1.on("click", zoomOut)

      var border2 = pie_chart.append("circle")
          .attr("r", radius + 20)
          .style("fill", "#efe6f1");

      var back_center = pie_chart.append("circle")
          .attr("r", radius / 3)
          .style("fill", "#fff")

      total = pie_chart.append("text")
          .text(function(d){return "500"})
          .attr("font-family", "sans-serif")
          .attr("font-size", radius / 3)
          .attr("text-anchor", "middle")
          .attr("dy", function(d){return 20});

      center = pie_chart.append("circle")
          .attr("r", radius / 3)
          .on("click", zoomOut)
          .style("fill", "#fff")
          .style("fill-opacity", 0);

      center.append("title")
            .text("Volver");  

      path = pie_chart.selectAll("path")
          .data(partition.nodes(root).slice(1))
          .enter().append("path")
            .attr("d", arc)
            .style("fill", function(d) {  return d.fill; })
            .each(function(d) { 
              this._current = updateArc(d);
            })
            .on("click", zoomIn)

      createHovers()
    //})

    function zoomIn(p) {
      if (p.depth > 1) p = p.parent;
      if (!p.children) return;
      totalUpdate( p.sum )
      processData(p, plot )
      zoom(p, p);
    } 

    function zoomOut(p) {
      if (!p || !p.parent) return 
      zoom(p.parent, p);
      createHovers()
    }

    function createHovers(){
       path.each(function(d) {
        var nodeSelection = d3.select(this)
        nodeSelection.append("title")
           .text(function(d) {  return d.title || d.name ; })
      })
    }

    function clear(){
      //Velocity(document.querySelectorAll("#barchart")[0] , { opacity: 0 }, 500)
      jQuery("#barchart").animate({ opacity: 0 }, 500)
      totalUpdate("500");

    }

    function totalUpdate(data){
      total[0][0].innerHTML = data;
    }

    function processData(p, callback){
      // actualiza el total en la gráfica
      if( !('tag' in p) ) 
        return false
      var data = { name: p.name, tag: p.tag, title : p.title, color:p.fill.rgb() }
      if('children' in p){
        var partidos = p.children
        for(var i in partidos){

          if( !('partidos' in data) )  data['partidos'] = []

          data['partidos'].push({
            'partido': partidos[i].name, 
            'count': partidos[i].value 
          })

          if('total' in data) data['total'] +=  parseInt( partidos[i].value )
          else data['total'] = parseInt(partidos[i].value)
        }
      }
      callback(data)
    }
   
    plot = function(data){
      d3.select("#barchart").remove();
      var margins = {
        top: 12,
        left: 48,
        right: 24,
        bottom: 24
      },
      legendPanel = {
          width: 200
      },
      width = 750 - margins.left - margins.right - legendPanel.width,
      height = 250 - margins.top - margins.bottom,
      dataset = [ { name: "Total de " + data.tag + ":" + data.total, data: data.partidos } ],
      series = dataset.map(function (d) { return d.name; }),


      dataset = dataset.map(function (d) {
          return d.data.map(function (o, i) {
              // Structure it so that your numeric
              // axis (the stacked amount) is y
              return { y: o.count, x: o.partido };
          });
      }),
      stack = d3.layout.stack();

      stack(dataset);



      var dataset = dataset.map(function (group) {
        return group.map(function (d) {
            // Invert the x and y values, and y0 becomes x0
            return {  x: d.y, y: d.x, x0: d.y0 };
        });
      }),
      barchart = d3.select('#bar_chart')
          .append('svg')
          .attr("id","barchart")
          .attr('width', width + margins.left + margins.right + legendPanel.width)
          .attr('height', height + margins.top + margins.bottom )
          .append('g')
          .attr('transform', 'translate(' + margins.left + ',' + margins.top + ')'),
      xMax = d3.max(dataset, function (group) {
          return d3.max(group, function (d) { return d.x + d.x0; });
      }),
      xScale = d3.scale.linear()
          .domain([0, xMax])
          .range([0, width]),
      partidos = dataset[0].map(function (d) { return d.y; }),
      yScale = d3.scale.ordinal()
          .domain(partidos)
          .rangeRoundBands([0, height], .1),
      xAxis = d3.svg.axis()
          .scale(xScale)
          .orient('bottom'),
      yAxis = d3.svg.axis()
          .scale(yScale)
          .orient('left'),
      groups = barchart.selectAll('g')
          .data(dataset)
          .enter()
          .append('g')
          .style('fill',  data.color + ''),
      rects = groups.selectAll('rect')
          .data(function (d) {
          return d;
      })
      .enter()
      .append('rect')
      .attr('x', function (d) { return xScale(d.x0); })
      .attr('y', function (d, i) { return yScale(d.y);})
      .attr('height', function (d) { return yScale.rangeBand();  })
      .attr('width', function (d) { return xScale(d.x); })
      .on('mouseover', function (d) {
          var xPos = parseFloat(d3.select(this).attr('x')) / 2 + d3.select(this).attr('width') -  8;
          var yPos = parseFloat(d3.select(this).attr('y')) + yScale.rangeBand() / 2 ;

          d3.select('#tooltip')
              .style('left', xPos + 'px')
              .style('top', yPos + 'px')
              .select('#value')
              .text(d.x + " " + data.tag);
          /*

            barchart.select(".partidos").selectAll("text").remove();
            var ticks = barchart.select(".partidos").selectAll(".tick")
                        .append("svg:image")
                        .attr("xlink:href", function (d) {
                          return './statics/img/' + d + '.png'  ; 
                        })
                        .attr("width", 20)
                        .attr("height", 20)
                        .attr("x", -30)
                        .attr("y", -10);


          */

          d3.select('#tooltip').classed('hidden', false);
      })
          .on('mouseout', function () {
          d3.select('#tooltip').classed('hidden', true);
      })

      barchart.append('text')
          .attr('fill', 'black')
          .attr('y', 0)
          .text(data.title);

      barchart.append('g')
          .attr('class', 'axis')
          .attr('transform', 'translate(0,' + height + ')')
          .call(xAxis);

      barchart.append('g')
          .attr('class', 'partidos')
          .call(yAxis);

      barchart.append('rect')
          .attr('fill', 'white')
          .attr('width', 160)
          .attr('height', 30 * dataset.length)
          .attr('x', width + margins.left)
          .attr('y', 0);
      // cambiar texto por imagenes
      barchart.select(".axis").selectAll("text")
        .attr("stroke", "#ccc")
        .attr("fill", "#ccc")
        .attr("font-family", "sans-serif")
        .attr("font-size", "1em")
        .attr("text-anchor", "start")

        /*
          font-family="sans-serif"
3      font-size="20px"
4      text-anchor="middle"
        */

      barchart.select(".partidos").selectAll("text").remove();
      var ticks = barchart.select(".partidos").selectAll(".tick")
                  .append("svg:image")
                  .attr("xlink:href", function (d) {
                    return urlBase + '/images/' + d.toLowerCase() + '-54px.png'  ; 
                  })
                  .attr("width", 25)
                  .attr("height", 25)
                  .attr("x", -45)
                  .attr("y", -12);
;

    
      //Velocity(document.querySelectorAll("#barchart")[0] , { opacity: 1 }, 1000)
      jQuery("#barchart").animate({ opacity: 1 }, 1000)
     
    }
    // Zoom to the specified new root.
    function zoom(root, p) {
      if(root.parent == undefined) clear()
      if (document.documentElement.__transition__) return;
      // Rescale outside angles to match the new layout.
      var enterArc,
          exitArc,
          outsideAngle = d3.scale.linear().domain([0, 2 * Math.PI]);

      function insideArc(d) {
        return p.key > d.key
            ? {depth: d.depth - 1, x: 0, dx: 0} : p.key < d.key
            ? {depth: d.depth - 1, x: 2 * Math.PI, dx: 0}
            : {depth: 0, x: 0, dx: 2 * Math.PI};
      }

      function outsideArc(d) {
        return {depth: d.depth + 1, x: outsideAngle(d.x), dx: outsideAngle(d.x + d.dx) - outsideAngle(d.x)};
      }

      
      center.datum(root);

      // When zooming in, arcs enter from the outside and exit to the inside.
      // Entering outside arcs start from the old layout.
      if (root === p) enterArc = outsideArc, exitArc = insideArc, outsideAngle.range([p.x, p.x + p.dx]);

      path = path.data(partition.nodes(root).slice(1), function(d) { return d.key; });

      // When zooming out, arcs enter from the inside and exit to the outside.
      // Exiting outside arcs transition to the new layout.
      if (root !== p) enterArc = insideArc, exitArc = outsideArc, outsideAngle.range([p.x, p.x + p.dx]);

      d3.transition().duration(d3.event.altKey ? 7500 : 750).each(function() {
        path.exit().transition()
            .style("fill-opacity", function(d) { return d.depth === 1 + (root === p) ? 1 : 0; })
            .attrTween("d", function(d) { return arcTween.call(this, exitArc(d)); })
            .remove();

        path.enter().append("path")
            .style("fill-opacity", function(d) { return d.depth === 2 - (root === p) ? 1 : 0; })
            .style("fill", function(d) { return d.fill; })
            .on("click", zoomIn)
            .each(function(d) { this._current = enterArc(d); });

        path.transition()
            .style("fill-opacity", 1)
            .attrTween("d", function(d) { return arcTween.call(this, updateArc(d)); });
      });
    }

    function key(d) {
      var k = [], p = d;
      while (p.depth) k.push(p.name), p = p.parent;
      return k.reverse().join(".");
    }

    function fill(d) {
      var p = d;
      while (p.depth > 1) p = p.parent;
      var c = d3.lab(hue(p.name));
      c.l = luminance(d.sum);
      return c;
    }

    function arcTween(b) {
      var i = d3.interpolate(this._current, b);
      this._current = i(0);
      return function(t) {
        return arc(i(t)); 
      };
    }

    function updateArc(d) {
      return {depth: d.depth, x: d.x, dx: d.dx};
    }

    d3.select("#pie_chart").style("height", margin.top + margin.bottom + "px");
}

run.representantes_load = function(representantes){
  this.representantes_ctr = function (jQueryscope) { jQueryscope.representantes = representantes; }
}

