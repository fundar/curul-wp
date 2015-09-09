(function ($) {
  // writes the string
  //
  // @param jQuery $target
  // @param String str
  // @param Numeric cursor
  // @param Numeric delay
  // @param Function cb
  // @return void
  function typeString($target, str, cursor, delay, cb) {
    $target.html(function (_, html) {
      return html + str[cursor];
    });

    if (cursor < str.length - 1) {
      setTimeout(function () {
        typeString($target, str, cursor + 1, delay, cb);
      }, delay);
    }
    else {
      cb($target);
      setTimeout(function () {
        typeString($target, str, 0, delay, cb);
      }, delay);
    }
  }

  // clears the string
  //
  // @param jQuery $target
  // @param Numeric delay
  // @param Function cb
  // @return void
  function deleteString($target, delay, cb) {
    var length;

    $target.html(function (_, html) {
      length = html.length;
      return html.substr(0, length - 1);
    });

    if (length > 1) {
      setTimeout(function () {
        deleteString($target, delay, cb);
      }, delay);
    }
    else {
      cb();
    }
  }

  // jQuery hook
  $.fn.extend({
    teletype: function (opts) {
      var settings = $.extend({}, $.teletype.defaults, opts);
      if (opts.text == ''){
        console.log("stop")
        return false

      }
      
      return $(this).each(function () {
        (function loop($tar, idx) {
          // type

          /* delete */
          if(settings.cb == null){
            settings.cb = function () {
              setTimeout(function () {
                  deleteString($tar, settings.delay, function () {
                    loop($tar, (idx + 1) % settings.text.length);
                  });
                }, settings.pause);
            }
          }else{
            typeString($tar, settings.text[idx], 0, settings.delay, settings.cb)
          }

        }($(this), 0));
      });
    }
  });

  // plugin defaults  
  $.extend({
    teletype: {
      defaults: {
        delay: 100,
        pause: 1000,
        text: [],
        cb: function(el){

            var ilustracion = el.parents(".textos").next(".ilustracion")
            var votos_el = ilustracion.parents(".click_area").next(".votos")

            if(ilustracion.css("display") == "none" ){
              el.parents(".textos").toggle()
              ilustracion.fadeIn("slow");
              //votos_el.slideDown("slow")
            }else{
              ilustracion.fadeOut("slow", function(){
                el.parents(".textos").fadeIn("slow");
                //votos_el.slideDown("slow")
              });
            }
            
            el.empty();
        }
      }
    }
  });
}(jQuery));