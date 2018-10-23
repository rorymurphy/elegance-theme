<?php

function bootstrap_search_form( $form ) {
    $form = <<<'EOD'
<form role="search" method="get" action="%1$s">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" aria-label="Search Query" value="%2$s" aria-describedby="search-widget-submit-button">
        <div class="input-group-append">
            <button type="submit" class="btn" id="search-widget-submit-button">Search</button>
        </div>
    </div>
</form>
EOD;

    return sprintf($form, home_url('/'), get_search_query());
}

add_filter( 'get_search_form', 'bootstrap_search_form', 100 );