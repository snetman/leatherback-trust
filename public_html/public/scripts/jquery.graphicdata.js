$(document).ready(function() {

  //
  // Turtles and nests in decline
  //
/*
<div class="node-wrapper">
  <div class="node" data-year="1988"><span class="node-count">0</span></div>
  <div class="node" data-year="1989"><span class="node-count">0</span></div>
  <div class="node" data-year="1990"><span class="node-count">0</span></div>
  <div class="node" data-year="1991"><span class="node-count">0</span></div>
  <div class="node" data-year="1992"><span class="node-count">0</span></div>
  <div class="node" data-year="1993"><span class="node-count">0</span></div>
  <div class="node" data-year="1994"><span class="node-count">0</span></div>
</div>
*/
  // Set constants
  var minWidthForCount = 60; // pixels
  var countPadding = 10; // pixels
  var minNodeHeight = 1; // pixels
  var heightOfLargestNode = 33.333333333; // percent

  // Collect all of my objects
  var $nodes = $('.node');
  var $leatherbackTurtles = $('#TurtlesOverTime td[data-species="leatherback"]');
  var $leatherbackNests = $('#NestsOverTime td[data-species="leatherback"]');
  var $oliveridleyTurtles = $('#TurtlesOverTime td[data-species="oliveridley"]');
  var $oliveridleyNests = $('#NestsOverTime td[data-species="oliveridley"]');
  var $greenTurtles = $('#TurtlesOverTime td[data-species="green"]');
  var $greenNests = $('#NestsOverTime td[data-species="green"]');
  var $allTurtles = $('#TurtlesOverTime th[data-species="all"]');
  var $allNests = $('#NestsOverTime th[data-species="all"]');

  // Create my data container that will hold the max values for all the stats we're tracking
  var $nodewrap = $('.node-wrapper');
  $nodewrap.data({
    leatherbackTurtlesMax: 0,
    leatherbackNestsMax: 0,
    oliveridleyTurtlesMax: 0,
    oliveridleyNestsMax: 0,
    greenTurtlesMax: 0,
    greenNestsMax: 0,
    allTurtlesMax: 0,
    allNestsMax: 0
  });

  $nodes.each(function(index,value){
    // Set all my values
    var yr = $(this).attr('data-year');
    var lts = parseInt($leatherbackTurtles.eq(index).text().replace(/,/g, ''),10);
    var lns = parseInt($leatherbackNests.eq(index).text().replace(/,/g, ''),10);
    var ots = parseInt($oliveridleyTurtles.eq(index).text().replace(/,/g, ''),10);
    var ons = parseInt($oliveridleyNests.eq(index).text().replace(/,/g, ''),10);
    var gts = parseInt($greenTurtles.eq(index).text().replace(/,/g, ''),10);
    var gns = parseInt($greenNests.eq(index).text().replace(/,/g, ''),10);
    var ats = parseInt($allTurtles.eq(index).text().replace(/,/g, ''),10);
    var ans = parseInt($allNests.eq(index).text().replace(/,/g, ''),10);

    // Store my data in the year node
    $(this).data({
      y: yr,
      leatherbackTurtles: lts,
      leatherbackNests: lns,
      oliveridleyTurtles: ots,
      oliveridleyNests: ons,
      greenTurtles: gts,
      greenNests: gns,
      allTurtles: ats,
      allNests: ans,
    });

    // If this year's data is the max in any category, update the values in the node wrapper
    if (lts > $nodewrap.data('leatherbackTurtlesMax')) {
      $nodewrap.data('leatherbackTurtlesMax', lts);
    }
    if (lns > $nodewrap.data('leatherbackNestsMax')) {
      $nodewrap.data('leatherbackNestsMax', lns);
    }
    if (ots > $nodewrap.data('oliveridleyTurtlesMax')) {
      $nodewrap.data('oliveridleyTurtlesMax', ots);
    }
    if (ons > $nodewrap.data('oliveridleyNestsMax')) {
      $nodewrap.data('oliveridleyNestsMax', ons);
    }
    if (gts > $nodewrap.data('greenTurtlesMax')) {
      $nodewrap.data('greenTurtlesMax', gts);
    }
    if (gns > $nodewrap.data('greenNestsMax')) {
      $nodewrap.data('greenNestsMax', gns);
    }
    if (ats > $nodewrap.data('allTurtlesMax')) {
      $nodewrap.data('allTurtlesMax', ats);
    }
    if (ans > $nodewrap.data('allNestsMax')) {
      $nodewrap.data('allNestsMax', ans);
    }

  });

  // Function to display the nodes
  function buildNodes(s, t) {
    var totalNodes = $nodes.length;
    var species = s; // e.g. leatherback
    var valueName = species + t; // e.g. leatherbackTurtles
    var maxName = valueName + 'Max'; // e.g. leatherbackTurtlesMax
    var maxValue = $nodewrap.data(maxName);
    var containerSize = $('.node-wrapper').width();
    var nodeWidth = ( 100 / totalNodes ) + '%';
    var nodePixelWidth = containerSize / totalNodes;
    var maxNodeHeight = Math.floor(containerSize * heightOfLargestNode * 0.01);

    //console.log(maxName + ': ' + maxValue + '; maxNodeHeight: ' + maxNodeHeight);

    $nodes.each(function(){
      var curnode = $(this);
      var curnodeinner = $(this).find('.node-inner');
      var curcount = curnode.find('.node-count');
      // Set the text of the value
      var curval = $(this).data(valueName);
      curcount.text(curval);
      // Set the width
      var mywidth = nodeWidth;
      // Set the height
      var ratioToMax = curval/maxValue;
      var pixelHeight = Math.floor(ratioToMax * maxNodeHeight);
      if (pixelHeight < minNodeHeight) {
        pixelHeight = minNodeHeight;
      }
      // Style the node
      curnode.css({
        'width': mywidth,
        'height': pixelHeight + 'px'
      });
      curnodeinner.css({
        'height': pixelHeight + 'px'
      });
      // Set visibility of the count
      // Count the number of characters
      var countWidth = (curcount.text().length + 2) * 10; // number of characters * estimated width of a character
      var countHeight = 20; // Estimated height of a character
      // If the char height is larger than the nodePixelWidth or the charlength is longer than the pixelHeight, hide the count
      if ( pixelHeight >= countWidth && nodePixelWidth >= countHeight ) {
        curcount.removeClass('hide-me');
      } else {
        curcount.addClass('hide-me');
      }
      // Set the species
      curnode.attr('data-species', species);
    });
  }

  // Function to check visibility of nodes
  function setCountVisibility() {
    $nodes.each(function(){
      var curnode = $(this);
      var curcount = curnode.find('.node-count');
      var pixelWidth = curnode.width();
      if ( pixelWidth < minWidthForCount ) {
        curcount.addClass('hide-me');
      } else {
        curcount.removeClass('hide-me');
      }
    });
  }

  // Events on nodes
  $nodes.hover(
    function(){
      // On enter
      $('.node-tooltip').addClass('is-active');
      var curnode = $(this);
      var stat = curnode.find('.node-count').text();
      var year = curnode.attr('data-year');
      var position = curnode.position();
      var width = curnode.width();
      var centerPos = position.left + (width * 0.5);
      updateTooltipData(stat, year);
      deployTooltip(centerPos);
    }, function(){
      // On leave
      $('.node-tooltip').removeClass('is-active');
    }
  );


  // Tooltip management
  function deployTooltip(xPos) {
    var tip = $('.node-tooltip');
    var width = tip.width();
    var trackWidth = tip.parent().width();
    var leftEdgePos = xPos - (width * 0.5);
    var rightEdgePos = xPos + (width * 0.5);
    var rightOutcrop = rightEdgePos - trackWidth;
    var leftOutcrop = 0 - leftEdgePos;
    //console.log('Tip width: ' + width + '; Track width: ' + trackWidth + '; Right: ' + rightEdgePos + '; outcrop: ' + outcrop);
    if (rightOutcrop > 0) {
      xPos -= rightOutcrop;
      tip.addClass('is-adjusted');
    } else if (leftOutcrop > 0) {
      xPos += leftOutcrop;
      tip.addClass('is-adjusted');
    } else {
      tip.removeClass('is-adjusted');
    }
    tip.css({
      'left': xPos
    });
  }

  // Write new data to the tooltip
  function updateTooltipData(stat, year) {
    var tip = $('.node-tooltip');
    if (stat != '') {
      tip.find('.tooltip-stat').text(stat);
    }
    if (year != '') {
      tip.find('.tooltip-year').text(year);
    }
  }

  // Write a single datum to the tooltip
  function updateTooltipDatum(datum, value) {
    var tip = $('.node-tooltip');
    tip.find(datum).text(value);
  }

  // On resize finished, re-do the margins, count visibility and heights of the nodes

  var rtime = new Date(1, 1, 2000, 12,00,00);
  var timeout = false;
  var delta = 200;
  $(window).resize(function() {
    rtime = new Date();
    if (timeout === false) {
      timeout = true;
      setTimeout(resizeend, delta);
    }
  });

  function resizeend() {
    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
    } else {
      timeout = false;
      var activespecies = $('#SpeciesSelect .is-active a').attr('data-species');
      var activetype = $('#TypeSelect .is-active a').attr('data-type');
      buildNodes(activespecies, activetype);
    }
  }

  //
  // The species select code
  //
  /*
  <ul id="SpeciesSelect">
    <li><a href="#" data-species="leatherback">Leatherback</a></li>
    <li><a href="#" data-species="oliveridley">Olive Ridley</a></li>
    <li><a href="#" data-species="green">East Pacific Green</a></li>
    <li><a href="#" data-species="all">All</a></li>
  </ul>
  */
  $('#DataSelect a').click(function(){
    // If the drop select is closed, open it, else close it
    var thismenu = $(this).parents('.drop-select');
    thismenu.toggleClass('is-open');

    // Find my siblings and remove the is-active class
    $(this).parent().siblings('.is-active').removeClass('is-active');
    $(this).parent().addClass('is-active');

    // Find the species and type
    var activespecies = $('#SpeciesSelect .is-active a').attr('data-species');
    var activetype = $('#TypeSelect .is-active a').attr('data-type');
    var myspecies = $(this).attr('data-species');
    var mytype = $(this).attr('data-type');
    if (myspecies) {
      activespecies = myspecies;
    }
    if (mytype) {
      activetype = mytype;
    }
    // Build the nodes
    buildNodes(activespecies, activetype);
    // Update the tooltip species
    $('.node-tooltip').attr('data-species', activespecies);
    return false;
  });

  // Build the nodes with our default selection
  buildNodes("leatherback", "Turtles");

}); // End document ready