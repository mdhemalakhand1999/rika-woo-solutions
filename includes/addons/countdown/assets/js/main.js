(function($) {
    $(window).on('load', function() {
        /**
         * Working with countdown markup
         */
        function makeTimer( dateObj, object ) {
              var endTime = new Date(dateObj);			
              endTime = (Date.parse(endTime) / 1000);
              console.log(endTime);
              var now = new Date();
              now = (Date.parse(now) / 1000);
        
              var timeLeft = endTime - now;
        
              var days = Math.floor(timeLeft / 86400); 
              var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
              var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
              var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
          
              if (hours < "10") { hours = "0" + hours; }
              if (minutes < "10") { minutes = "0" + minutes; }
              if (seconds < "10") { seconds = "0" + seconds; }
              object.find("#days").html("<span class='label'>Days</span>" + '<span class="rws-count-value">'+ days + '</span>');
              object.find("#hours").html("<span class='label'>Hours</span>" + '<span class="rws-count-value">'+ hours + '</span>');
              object.find("#minutes").html("<span class='label'>Minutes</span>" + '<span class="rws-count-value">'+ minutes + '</span>');
              object.find("#seconds").html("<span class='label'>Seconds</span>" + '<span class="rws-count-value">'+ seconds + '</span>');
          }
        
          
          $('.rws-timer').each(function() {
            let dateObj = $(this).data('date');
            let thisData = $(this);
            setInterval(function() { makeTimer(dateObj, thisData); }, 1000);
        });
    });
})(jQuery)