jQuery.noConflict();
jQuery(document).
ready
(
        function()
        {
                        jQuery("#backgroundcolor").hide();
                        jQuery("#backgroundimage").hide();
                        jQuery("label[for='backgroundcolor']").hide();
                        jQuery("label[for='backgroundimage']").hide();
                
                
                jQuery("#type1").click
                (
                        function()
                        {
                                jQuery("#backgroundcolor").hide();
                                jQuery("label[for='backgroundcolor']").hide();
                                jQuery("#backgroundimage").show();
                                jQuery("label[for='backgroundimage']").show();
                      
                        }
                );
                
                jQuery("#type2").click
                (
                        function()
                        {
                                jQuery("#backgroundcolor").show();
                                jQuery("label[for='backgroundcolor']").show();
                                jQuery("#backgroundimage").hide();
                                jQuery("label[for='backgroundimage']").hide();
                      
                        }
                );
        
        
        }
);
        
        
        

