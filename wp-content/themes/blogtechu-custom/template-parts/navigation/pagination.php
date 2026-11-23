<?php
/**
 * Posts pagination.
 *
 * @package Blogtechu_Custom
 */

the_posts_pagination(
  array(
    'mid_size'  => 1,
    'prev_text' => __( 'Previous', 'blogtechu-custom' ),
    'next_text' => __( 'Next', 'blogtechu-custom' ),
  )
);
