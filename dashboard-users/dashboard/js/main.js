window.onload = function() {

    let nav_bar_button_1 = document.getElementById('nav_bar_button_1');
    let nav_bar_line_1 = document.getElementById('nav_bar_line_1');
    let nav_bar_button_2 = document.getElementById('nav_bar_button_2');
    let nav_bar_line_2 = document.getElementById('nav_bar_line_2');
    let nav_bar_list_item = document.getElementById('nav_bar_list_item');
    let nav_bar = 'false';
    
    function show() {
        setTimeout(function(){nav_bar_list_item.style.display = 'block';},0);
    }
    
    function hidden() {
        setTimeout(function(){nav_bar_list_item.style.display = 'none';},1000);
    }

    function toggle_nav_bar_open() {
        if (nav_bar === 'true'){
            nav_bar_button_1.setAttribute("id", "nav_bar_close_1");
            nav_bar_line_1.setAttribute("id", "nav_bar_line_close_1");
            nav_bar_button_2.setAttribute("id", "nav_bar_close_2");
            nav_bar_line_2.setAttribute("id", "nav_bar_line_close_2");
            nav_bar_list_item.setAttribute("id", "nav_bar_list_item_hidden");
            hidden();
            nav_bar = 'false';
        }
        else {
            nav_bar_button_1.setAttribute("id", "nav_bar_open_1");
            nav_bar_line_1.setAttribute("id", "nav_bar_line_open_1");
            nav_bar_button_2.setAttribute("id", "nav_bar_open_2");
            nav_bar_line_2.setAttribute("id", "nav_bar_line_open_2");
            nav_bar_list_item.setAttribute("id", "nav_bar_list_item_show");
            show();
            nav_bar = 'true';
        }
    }

    nav_bar_button_1.onclick = function () {
        toggle_nav_bar_open();
    };

    nav_bar_button_2.onclick = function () {
        toggle_nav_bar_open();
    };

};