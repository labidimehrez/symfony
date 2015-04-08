            jQuery(function($) {
                function fixDiv() {
                    var $cache = $('#getFixed');
                    if ($(window).scrollTop() > 200)
                        $cache.css({
                            'position': 'fixed',
                            'top': '89px'
                        });
                    else
                        $cache.css({
                            'position': 'relative',
                            'top': 'auto'
                        });
                }
                $(window).scroll(fixDiv);
                fixDiv();
            });