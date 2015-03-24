 $(document).ready(function() {
                $(".flip").click(function() {
                    $(".panel").slideToggle("slow");/* afficher input nouveau commentaire */
                    $(".panel2").hide();           /* cacher input nouveau SOUS commentaire */
                    $(".paneledit2").hide();       /* cacher input edit SOUS commentaire */
                    $(".paneledit").hide();       /* cacher input edit commentaire */
                });
                $(".flip2").click(function() {
                    $(".panel2").slideToggle("slow");/* afficher input nouveau  SOUS commentaire */
                    $(".panel").hide();             /* cacher input input nouveau commentaire */
                    $(".paneledit2").hide();       /* cacher input edit SOUS commentaire */
                    $(".paneledit").hide();       /* cacher input edit commentaire */
                });

                $(".flipedit").click(function() {
                    $(".paneledit").slideToggle("slow");/* afficher input EDIT nouveau commentaire */
                    $(".panel").hide();   /* cacher input nouveau  commentaire */
                    $(".panel2").hide(); /* cacher input nouveau SOUS commentaire */
                    $(".paneledit2").hide();/* cacher input EDIT SOUS nouveau commentaire */
                });

                $(".flipedit2").click(function() {
                    $(".paneledit2").slideToggle("slow");/* afficher input EDIT SOUS nouveau commentaire */
                    $(".panel").hide();  /* cacher input nouveau  commentaire */
                    $(".panel2").hide();/* cacher input nouveau SOUS commentaire */
                    $(".paneledit").hide();       /* cacher input edit commentaire */
                });

            });