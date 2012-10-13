// remap jQuery to $
(function($){

 



 



})(window.jQuery);

/* ASYNC load SM scripts */
(function(doc, script) {
    var js,
        fjs = doc.getElementsByTagName(script)[0],
        add = function(url, id) {
            if (doc.getElementById(id)) {return;}
            js = doc.createElement(script);
            js.src = url;
            id && (js.id = id);
            fjs.parentNode.insertBefore(js, fjs);
        };

    // Google Analytics
    add(('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js', 'ga');
    // Google+ button
//    add('https://apis.google.com/js/plusone.js');
    // Facebook SDK
//    add('//connect.facebook.net/en_US/all.js', 'facebook-jssdk');
    // Twitter SDK
//    add('//platform.twitter.com/widgets.js', 'twitter-wjs');
    // Pinterest
//	add('//assets.pinterest.com/js/pinit.js', 'pinterest-js');
}(document, 'script'));
