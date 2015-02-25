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
      cb();
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

          /* delete 
          if(settings.cb == null){
            settings.cb = function () {
              setTimeout(function () {
                  deleteString($tar, settings.delay, function () {
                    loop($tar, (idx + 1) % settings.text.length);
                  });
                }, settings.pause);
            }
          }
          /**/  



          typeString($tar, settings.text[idx], 0, settings.delay,  function(){
            var ilustracion = $tar.parents(".textos").next(".ilustracion")


            if(ilustracion.css("display") == "none" ){
              $tar.parents(".textos").toggle()
              ilustracion.fadeIn("slow");
            }else{
              ilustracion.fadeOut("slow", function(){
                $tar.parents(".textos").fadeIn("slow");
              });
            }
            
            $tar.empty();
          });

        }($(this), 0));
      });
    }
  });

  // plugin defaults  
  $.extend({
    teletype: {
      defaults: {
        delay: 100,
        pause: 0,
        text: [],
        cb: null
      }
    }
  });
}(jQuery));