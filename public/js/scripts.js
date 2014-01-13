$(function() {

    var autoloadElements = $('[data-toggle="autoload"]');
    var count = autoloadElements.length;
    for (var i = 0; i < count; i++) {
        var entry = autoloadElements[i];
        $.ajax({
            url: $(entry).attr("data-url"),
            async: false,
            success: function(data) {
                $(entry).html(data);
            }            
        });
    }


    //Xử lí toggle menu 
    $("#menu-toggle").click(function(e) {
        if ($("#nav-side").hasClass("collapsed")) {
            $("#navtab-contents").removeClass("collapsed");
            $("#nav-side").removeClass("collapsed");
            $("#page-settings").removeClass("collapsed");
            $("#navtabs").removeClass("collapsed");
        } else {
            $("#navtab-contents").addClass("collapsed");
            $("#nav-side").addClass("collapsed");
            $("#page-settings").addClass("collapsed");
            $("#navtabs").addClass("collapsed");
        }
        return false;
    });

    /**
     * Xử lí sự kiện click vào menu cha
     */
    $(document).on("click", "a.dropdown-toggle", function() {
        var parent = $(this).parent();
        if (parent.hasClass("single-ton")) {
            if (parent.hasClass("open")) {
                parent.removeClass("open");
            } else {
                $(".single-ton.dropdown.open").removeClass("open");
                parent.addClass("open");
            }
        } else {
            if (parent.hasClass("open")) {
                parent.removeClass("open");
            } else {
                parent.addClass("open");
            }
        }
    });

    /**
     * Xử lú sự kiện ẩn menu singleton
     */
    $(window).on("click", function(e) {
        var dropdownSingleton = $(".single-ton.dropdown");
        if (!$(e.target).is(dropdownSingleton) && dropdownSingleton.has(e.target).length === 0) {
            $(".single-ton.dropdown.open").removeClass("open");
        }
        return true;
    });
    /**
     * Xử lí sự kiên đối với các link thêm một tab mới
     */
    $(document).on("click", "[data-togle='create-tab']", function(e) {
//dừng xử lí sự kiện tại đây
        var data = {
            title: $(this).attr("data-title"),
            dataId: $(this).attr("data-id"),
            dataUrl: $(this).attr("data-url")
        };
        //Kiểm tra xem tồn tại tab chưa nếu chưa thì mới thêm
        if ($("#navtabs>li>a[href='#" + data.dataId + "']").length === 0) {
//add tab
            var tabsHtml = '<li>';
            tabsHtml += '<i class="fa fa-refresh tab-refresh-icon"></i>';
            tabsHtml += '<a href="#' + data.dataId + '" data-toggle="tab">' + data.title + '</a>';
            tabsHtml += '<i class="fa fa-times tab-close-icon"></i>';
            $("#navtabs").append(tabsHtml);
            //add tab content
            var tabsContent = '<div class="tab-pane active fade in" id="' + data.dataId + '">';
            tabsContent += '<iframe src="' + data.dataUrl + '"></iframe>';
            tabsContent += '</div>';
            $("#navtab-contents").append(tabsContent);
        }

        $('#navtabs a[href="#' + data.dataId + '"]').tab('show');
    });


    /**
     * Xử lí sự kiện khi click vào icon refresh tab
     */
    $("#navtabs").on("click", ".tab-refresh-icon", function() {
        var dataId = $(this).parent().find("a").attr("href");
        var iframe = $(dataId).find("iframe")[0];
        var src = $('[data-id="' + dataId.replace("#", "") + '"]').attr("data-url");
        $(iframe).removeAttr("src");
        iframe.contentWindow.location.href = src;
        return false;
    });
    /**
     * Xử lí sự kiện khi click vào icon close tab
     */
    $("#navtabs").on("click", ".tab-close-icon", function() {
        var dataId = $(this).parent().find("a").attr("href");
        var parent = $(this).parent();
        var index = $(parent).index(); //index of close tab
        var tablength = $("#navtabs").find("li").length - 1;
        //remove tab
        parent.remove();
        $(dataId).remove();
        var tab;
        //focus other tab
        if (tablength === 0) {
            return;
        } else if (index < tablength) {
            tab = $('#navtabs li:eq(' + (index) + ') a');
        } else {
            tab = $('#navtabs li:eq(' + (index - 1) + ') a');
        }
        tab.tab('show');
        return false;
    });

});
