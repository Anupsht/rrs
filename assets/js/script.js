jQuery(function ($) {
    $(document).ready(function() {
        // banner-word-change
        const typedTextSpan = $(".typed-text");
        const cursorSpan = $(".cursor");
      
        const textArray = ["Find Your Perfect Room with Ease."];
        const typingDelay = 200;
        const erasingDelay = 100;
        const newTextDelay = 2000;
        let textArrayIndex = 0;
        let charIndex = 0;
      
        function type() {
          if (charIndex < textArray[textArrayIndex].length) {
            if (!cursorSpan.hasClass("typing")) cursorSpan.addClass("typing");
            typedTextSpan.text(typedTextSpan.text() + textArray[textArrayIndex][charIndex]);
            charIndex++;
            setTimeout(type, typingDelay);
          } else {
            cursorSpan.removeClass("typing");
            setTimeout(erase, newTextDelay);
          }
        }
      
        function erase() {
          if (charIndex > 0) {
            if (!cursorSpan.hasClass("typing")) cursorSpan.addClass("typing");
            typedTextSpan.text(textArray[textArrayIndex].substring(0, charIndex - 1));
            charIndex--;
            setTimeout(erase, erasingDelay);
          } else {
            cursorSpan.removeClass("typing");
            textArrayIndex++;
            if (textArrayIndex >= textArray.length) textArrayIndex = 0;
            setTimeout(type, typingDelay + 1100);
          }
        }
      
        if (textArray.length) setTimeout(type, newTextDelay + 250);
    });
});