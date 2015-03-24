/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
       $(document).ready(function() {
                $(".flip").click(function()
                {
                    $(".panel3").slideToggle("slow");
                });



                $(".flip2").click(function()
                {
                    $(".panel3").slideToggle("slow");
                });


                $(".flip3").click(function()
                {
                    $(".panel3").fadeOut();
                    $("div#cacherdiv").hide();
                });

            });

