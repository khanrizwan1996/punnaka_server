$(function () {
    products_tag.init();
}),
    (products_tag = {
        init: function () {
            products_tag.product_tags();
        },

        product_tags: function () {
            $(".tags").selectize({
                plugins: { remove_button: { label: "" } },
                render: {
                    option: function (t, i) {
                        return '<div class="option"><span>' + i(t.title) + "</span></div>";
                    },
                    item: function (t, i) {
                        return '<div class="item">' + i(t.title) + "</div>";
                    },
                },
                maxItems: null,
                valueField: "value",
                labelField: "title",
                searchField: "title",
                create: !0,
                onDropdownOpen: function (t) {
                    t.hide().velocity("slideDown", {
                        begin: function () {
                            t.css({ "margin-top": "0" });
                        },
                        duration: 200,
                        easing: easing_swiftOut,
                    });
                },
                onDropdownClose: function (t) {
                    t.show().velocity("slideUp", {
                        complete: function () {
                            t.css({ "margin-top": "" });
                        },
                        duration: 200,
                        easing: easing_swiftOut,
                    });
                },
            });
        },
    });
