<script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/2.1.0/mustache.min.js"></script>

<script id="friend-list-template" type="text/x-handlebars-template">
    <p>
    <ul id="ul-friends">
    {{#each friends}}
        <li>
          <input type="checkbox" data-id="{{ id }}" data-name="{{ name }}">
          {{ name }}
        </li>
    {{/each}}
    </ul>
</p>
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $.when($.ajax({
                url: "../data/template.mst",
                dataType: 'text'
            }), $.ajax({
                url: "../data/test.json"
            }))
            .done(function(template, data) {
                Mustache.parse(template[0]);
                var rendered = Mustache.render(template[0], {
                    panels: data[0].panels
                });
                $(".container").html(rendered);
            })
            .fail(function() {
                alert("Sorry there was an error.");
            });
    });
</script>

<!-- @include('partials.mustache_template') -->
<script>
    // define variables
    var ajaxUrl = "http://api.open-notify.org/iss-now.json",
        $target = $("#target"), // where to output
        $template = $("#template").html(), // html template
        html, data;

    // make ajax request
    // https://api.jquery.com/jquery.ajax/
    $.ajax({
        url: ajaxUrl,
        dataType: "jsonp",
        success: function(data) {

            // response from API
            console.log(data);

            // define data based on response
            data = data.iss_position;

            // wrangle data with Mustache.js
            // http://coenraets.org/blog/2011/12/tutorial-html-templates-with-mustache-js/
            html = Mustache.to_html($template, data);

            // output to page
            $target.append(html);

        } // success
    });
</script>