<?php

$term_noffset_args = array(
    'taxonomy' => 'collezione',
    'hide_empty' => false,
    'meta_query' => array(
        array(
            'key'     => 'term_collection_user_id',
            'value'   => $logged_user_id,
            'compare' => 'IN'
        )
    )
);

$number_of_series = count(get_terms($term_noffset_args));

$collection_page    = (get_query_var('paged')) ? get_query_var('paged') : 1;
$per_page           = 1;
$offset             = ($collection_page - 1) * $per_page;

$term_offset_args = array(
    'taxonomy' => 'collezione',
    'number' => $per_page,
    'offset' => $offset,
    'hide_empty' => false,
    'meta_query' => array(
        array(
            'key'     => 'term_collection_user_id',
            'value'   => $logged_user_id,
            'compare' => 'IN'
        )
    )
);

$usr_selected_terms = get_terms($term_offset_args);

// display taxonomy 
foreach ($usr_selected_terms as $single_tid) {
}

// pagination 

if ($usr_selected_terms) {
    $get_site_url = get_template_directory_uri();
    $args = array(
        'base' => home_url('/alimentazione-della-raccolta/%_%'),
        'current' => $collection_page,
        'total' => ceil($number_of_series / $per_page),
        'prev_text'          => '<img src=' . "$get_site_url" . '/assets/images/icons/arrow-left.svg>',
        'next_text'          => '<img src=' . "$get_site_url" . '/assets/images/icons/FrecciaCustom.svg>',
    );
    echo paginate_links($args);
}
