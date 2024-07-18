$.sidebar = function() {
        var $sidebar = $(".sidebar");
        $sidebar.each(function(i) {
            if (!$(".sidebar-overlay").length > 0) {
                $("body").append('<div class="sidebar-overlay"></div>');
            }
        });

        function sidebarIn(id) {
            $sidebar.each(function() {
                if ($(this).attr('id') == id) {
                    if (!$(this).hasClass("sidebar-in")) {
                        $sidebar.removeClass("sidebar-in");
                        $(this).addClass("sidebar-in");
                        $(".sidebar-overlay").addClass("sidebar-in");
                        $("body").addClass("sidebar-in");
                    } else {
                        $(this).removeClass("sidebar-in");
                        $(".sidebar-overlay").removeClass("sidebar-in");
                        $("body").removeClass("sidebar-in");
                    }
                }
            });
        }
        $("[data-sidebar-target]").on("click", function() {
            sidebarIn($(this).data("sidebar-target"));
        });
        $("[data-sidebar-dismiss]").on("click", function() {
            sidebarIn($(this).data("sidebar-dismiss"));
        });
        $(".sidebar-overlay").on("click", function() {
            $sidebar.removeClass("sidebar-in");
            $(this).removeClass("sidebar-in");
            $("body").removeClass("sidebar-in");
        });
    }
    $.sidebar();