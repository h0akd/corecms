$(function() {
    $(document).on("click", "[data-action='edit']", function() {
        var url = $(this).attr("data-url");
        window.location.href = url;
    });

    $(document).on("click", "[data-action='delete']", function() {
        var url = $(this).attr("data-url");
        if (!confirm("Bạn có thực sự muốn xoá bản ghi này không")) {
            return;
        }
        var parent = $(this).parent().parent();
        $.ajax({
            url: url,
            method: "PUT",
            success: function(data) {
                data = $.parseJSON(data);
                if (data.code === 1) {
                    parent.remove();
                } else {
                    alert("Xảy ra lỗi không thể xoá được bản ghi");
                }
            },
            error: function() {
                alert("Xảy ra lỗi không thể xoá được bản ghi");
            }
        });
    });

    $(document).on("click", "[data-action='active']", function() {
        var url = $(this).attr("data-url");
        if (!confirm("Bạn có thực sự muốn kích hoạt bản ghi này không")) {
            return;
        }
        var icon = $(this).find("i.fa");
        $.ajax({
            url: url,
            method: "PUT",
            success: function(data) {
                data = $.parseJSON(data);
                if (data.code === 1) {
                    if (data.current === 0) {
                        $(icon).removeClass("fa-check-square");
                        $(icon).addClass("fa-square");
                    } else {
                        $(icon).addClass("fa-check-square");
                        $(icon).removeClass("fa-square");
                    }
                } else {
                    alert("Xảy ra lỗi không thể kích hoạt được bản ghi");
                }
            },
            error: function() {
                alert("Xảy ra lỗi không thể kích hoạt được bản ghi");
            }
        });
    });
});
