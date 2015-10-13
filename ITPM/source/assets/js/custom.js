jQuery(document).ready(function() {

   "use strict";

   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});

   // Popover
   jQuery('.popovers').popover();

   // Show panel buttons when hovering panel heading
   jQuery('.panel-heading').hover(function() {
      jQuery(this).find('.panel-btns').fadeIn('fast');
   }, function() {
      jQuery(this).find('.panel-btns').fadeOut('fast');
   });

   // Close Panel
   jQuery('.panel .panel-close').click(function() {
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });

   // Minimize Panel
   jQuery('.panel .panel-minimize').click(function(){
      var t = jQuery(this);
      var p = t.closest('.panel');
      if(!jQuery(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.find('i').removeClass('fa-minus').addClass('fa-plus');
         jQuery(this).attr('data-original-title','Maximize Panel').tooltip();
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.find('i').removeClass('fa-plus').addClass('fa-minus');
         jQuery(this).attr('data-original-title','Minimize Panel').tooltip();
      }
      return false;
   });

   jQuery('.leftpanel .nav .parent > a').click(function() {

      var coll = jQuery(this).parents('.collapsed').length;

      if (!coll) {
         jQuery('.leftpanel .nav .parent-focus').each(function() {
            jQuery(this).find('.children').slideUp('fast');
            jQuery(this).removeClass('parent-focus');
         });

         var child = jQuery(this).parent().find('.children');
         if(!child.is(':visible')) {
            child.slideDown('fast');
            if(!child.parent().hasClass('active'))
               child.parent().addClass('parent-focus');
         } else {
            child.slideUp('fast');
            child.parent().removeClass('parent-focus');
         }
      }
      return false;
   });


   // Menu Toggle
   jQuery('.menu-collapse').click(function() {
      if (!$('body').hasClass('hidden-left')) {
         if ($('.headerwrapper').hasClass('collapsed')) {
            $('.headerwrapper, .mainwrapper').removeClass('collapsed');
         } else {
            $('.headerwrapper, .mainwrapper').addClass('collapsed');
            $('.children').hide(); // hide sub-menu if leave open
         }
      } else {
         if (!$('body').hasClass('show-left')) {
            $('body').addClass('show-left');
         } else {
            $('body').removeClass('show-left');
         }
      }
      return false;
   });

   // Add class nav-hover to mene. Useful for viewing sub-menu
   jQuery('.leftpanel .nav li').hover(function(){
      $(this).addClass('nav-hover');
   }, function(){
      $(this).removeClass('nav-hover');
   });

   // For Media Queries
   jQuery(window).resize(function() {
      hideMenu();
   });

   hideMenu(); // for loading/refreshing the page
   function hideMenu() {

      if($('.header-right').css('position') == 'relative') {
         $('body').addClass('hidden-left');
         $('.headerwrapper, .mainwrapper').removeClass('collapsed');
      } else {
         $('body').removeClass('hidden-left');
      }

      // Seach form move to left
      if ($(window).width() <= 360) {
         if ($('.leftpanel .form-search').length == 0) {
            $('.form-search').insertAfter($('.profile-left'));
         }
      } else {
         if ($('.header-right .form-search').length == 0) {
            $('.form-search').insertBefore($('.btn-group-notification'));
         }
      }
   }

   collapsedMenu(); // for loading/refreshing the page
   function collapsedMenu() {

      if($('.logo').css('position') == 'relative') {
         $('.headerwrapper, .mainwrapper').addClass('collapsed');
      } else {
         $('.headerwrapper, .mainwrapper').removeClass('collapsed');
      }
   }


    $('.add-box').click(function(){
        var n = $('.textbox').length + 1;
        if( 5 < n ) {
            alert('Stop it!');
            return false;
        }
        var box_html = $('<div class="form-group textbox" id="box'+n+'"><label class="col-sm-2 control-label">Butir Kuesioner</label><div class="col-sm-8"><input placeholder="Butir Kuesioner.." required class="form-control" name="butir[]" type="text"></div><a href="javascript:removeBox(box'+n+')" class="remove-box">Remove</a></div>');
        box_html.hide();
        $('.textbox:last').after(box_html);
        box_html.fadeIn('slow');
        return false;
    });

   $('#toggleNotip').click(function() {
      $('#totalNotip').text('0');
   });

});