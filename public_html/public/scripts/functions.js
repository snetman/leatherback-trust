$(document).ready(function() {

  //console.log( "ready!" );

  //
  // Init function
  //

  $init = function() {
    // Add a 'ready' class to the body tag
    $('html').addClass('ready');
    // Do the section nav
    if ($sectionnav.length) {
      checkSectionNav();
    }
  };

  //
  // Easyfader carousel
  //

  /*
  $('#Fader').easyFader({
    autoCycle: false,
    slideDur: 7000,
    effectDur: 500
  });

  // For other styles of carousel, these are the init functions

  $('#Slider').easyFader({
    effect: 'slide'
  });
  $('#Carousel').easyFader({
    effect: 'carousel'
  });
  */

  //
  // Toggle the responsive menu
  //

  // Define functions

  $closeMenu = function () {
    if ($('html').hasClass('menu-open')) {
      $('html').removeClass('menu-open').addClass('menu-closed');
    }
    return false;
  };

  $openMenu = function () {
    // If the nav is already open, then just close it if I double hit the open button
    if ($('html').hasClass('menu-open')) {
      $closeMenu();
    } else {
      $('html').addClass('menu-open').removeClass('menu-closed');
    }
    return false;
  };

  // Handle clicks on the "open nav" button
  $('#MenuOpenBtn').on('click', $openMenu);

  // Close the nav when I click on the close button
  $('#MenuCloseBtn').on('click', $closeMenu);

  // Set the original state of the menu
  $('html').addClass('menu-closed');

  // Close the nav when I click on the nav area outside the links
  //$('#Header').on('click', $closeMenu);

  //
  // Show/hide more links
  //

  /*
  Markup:
  <div id="UniqueName" class="more-content is-hidden">
    Content here...
  </div>
  <a class="more-link" href="#UniqueName">
    <span class="showtext">Show this</span>
    <span class="hidetext is-hidden">Hide this</span>
  </a>
  */

  $morelinks = $('.more-link');

  // Handle the showing
  $morelinks.click(function(){
    $targetcontent = $(this).attr('href'); // Get the target
    // If the target is hidden
    if ($($targetcontent).hasClass('is-hidden')) {
      $($targetcontent).removeClass('is-hidden'); // Show it
      $(this).find('.showtext').addClass('is-hidden'); // Hide the "show" text
      $(this).find('.hidetext').removeClass('is-hidden'); // Show the "hide" text
    // If the taret is showing
    } else {
      $($targetcontent).addClass('is-hidden'); // Hide it
      $(this).find('.hidetext').addClass('is-hidden'); // Hide the "hide" text
      $(this).find('.showtext').removeClass('is-hidden'); // Show the "show" text
    }

    return false;
  });

  //
  // Animated jump links
  //

  $('a.animate-scroll').on('click', function(event) {
    var target = $( $(this).attr('href') );
    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 750);
    }
  });

  //
  // Section nav
  //

  /*
  Markup:
  <nav id="SectionNav" class="nav section-nav">
    <ul>
      <li class="inthissection"><span class="eyebrow"><em>In this section:</em></span></li>
      <li><a href="#">Nav link here</a></li>
      <li id="LessNav"><a id="LessNavLink" href="#">&times; {{ "Less" | translate }}</a></li>
      <li id="MoreNav"><a id="MoreNavLink" href="#SectionNav">{{ "More" | translate }}&hellip;</a></li>
    </ul>
  </nav>
  */

  // Check the nav

  var $mobileRowMax = 2; // Number of visible rows we allow before needing to hide nav items
  var $tabletRowMax = 1;
  var $sectionnav = $('#SectionNav');

  $sectionnav.data({
    totalWidth: 0,
    moreWidth: 0
  });

  function checkSectionNav () {

    // Figure out how wide the container is and the more link
    $sectionnav.data({
      'totalWidth' : $sectionnav.width(),
      'moreWidth' : $('#MoreNav').width()
    });

    // Set up a width counter and row counter
    var $widthCount = 0;
    var $rowNumber = 1;

    // Get the nav items and count them up
    var $navItems = $sectionnav.find('li').not('#MoreNav, #LessNav');
    var $totalItems = $navItems.length;

    // Loop through the items
    $navItems.each(function(index){

      var $curitem = $(this);
      var $itemWidth = $curitem.width();

      console.log($curitem.html());

      // Add row-based classes and keep track of rows

      if ($itemWidth + $widthCount <= $sectionnav.data('totalWidth')) {

        $curitem.addClass('row-' + $rowNumber);
        $widthCount += $itemWidth;

      } else {

        $rowNumber++;
        $curitem.addClass('row-' + $rowNumber);
        $widthCount = $itemWidth;

      }

      if ($rowNumber > $mobileRowMax) {
        $curitem.addClass('overflow-mobile');
      }
      if ($rowNumber > $tabletRowMax) {
        $curitem.addClass('overflow-tablet');
      }

    });

    // Check my final row counts against what I'm shooting for as limits
    if ($rowNumber > $tabletRowMax ) {
      $sectionnav.addClass('need-more-tablet');
    }
    if ($rowNumber > $mobileRowMax) {
      $sectionnav.addClass('need-more-mobile');
    }
  }

  // Handle clicks on the links

  $('#MoreNavLink').click(function(){
    $(this).parents('#SectionNav').removeClass('hide-more');
    return false;
  });
  $('#LessNavLink').click(function(){
    $(this).parents('#SectionNav').addClass('hide-more');
    return false;
  });

  // Call an init function

  $init();

}); // End document ready