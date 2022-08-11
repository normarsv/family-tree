<?php

add_action('wp_ajax_nopriv_newsletter_submit', 'newsletter_submit');
add_action('wp_ajax_newsletter_submit', 'newsletter_submit');

function newsletter_submit()
{
    $email = $_POST['email'];
    if (($email && $email != '') && class_exists('Flamingo_Inbound_Message')) {
        Flamingo_Inbound_Message::add([
            'channel'          => '',
            'status'           => '',
            'subject'          => 'New newsletter user <' . $email . '>',
            'from'             => $email,
            'from_name'        => $email,
            'from_email'       => '',
            'fields'           => [],
            'meta'             => [],
            'akismet'          => [],
            'recaptcha'        => [],
            'spam'             => false,
            'spam_log'         => [],
            'consent'          => [],
            'timestamp'        => null,
            'posted_data_hash' => null,
        ]);
    }
    echo wp_json_encode(['status' => true]);
    wp_die();
}


add_action('wp_ajax_nopriv_register', 'register_form');
add_action('wp_ajax_register', 'register_form');

function register_form()
{
    $email = sanitize_email(strtolower($_POST['email']));
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];

    // TODO: find a workaround to this for security purposes
    //    $valid = $_POST['valid'];
    //
    //    if (!wp_verify_nonce($valid, 'register')) {
    //        echo wp_json_encode(['status' => false, 'valid' => 'invalid']);
    //        wp_die();
    //    }

    $username_exists = username_exists($username);
    $email_exists = email_exists($email);
    if ($username_exists || $email_exists) {
        echo wp_json_encode(['status' => false, 'username_exists' => $username_exists, 'email_exists' => $email_exists]);
        wp_die();
    }

    gt_create_user($username, $password, $email);

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_profile_completion', 'profile_completion');
add_action('wp_ajax_profile_completion', 'profile_completion');

function profile_completion()
{
    $thisthat = $_POST['thisthat'];
    $icon = sanitize_text_field($_POST['icon']);
    $howdidyouhear = sanitize_text_field($_POST['howdidyouhear']);
    $user_id = get_current_user_id();

    update_user_meta($user_id, 'gt_thisthat', $thisthat);
    update_user_meta($user_id, 'gt_icon', $icon);
    update_user_meta($user_id, 'gt_how_hear', $howdidyouhear);

    update_user_meta($user_id, 'account_verified', true);
    delete_user_meta($user_id, 'verify_token');

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_create_question', 'create_question');
add_action('wp_ajax_create_question', 'create_question');

function create_question()
{
    $title = sanitize_text_field($_POST['title']);
    $body = sanitize_text_field($_POST['body']);
    $tax = sanitize_text_field($_POST['tax']);
    $tags = sanitize_text_field($_POST['tags']);
    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    $post_args = ['post_title' => $title, 'post_content' => $body, 'post_type' => 'question', 'post_status' => 'publish'];
    $post_id = wp_insert_post($post_args);
    wp_set_object_terms($post_id, $tax, 'topics');

    if ($tags != '' && $tags != null) {
        wp_set_post_tags($post_id, $tags);
    }

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_answer_question', 'answer_question');
add_action('wp_ajax_answer_question', 'answer_question');

function answer_question()
{
    $body = sanitize_text_field($_POST['body']);
    $post_id = $_POST['post_id'];
    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    $post_args = [
        'comment_content' => $body,
        'comment_post_ID' => $post_id,
        'user_id'         => get_current_user_id(),
    ];
    wp_insert_comment($post_args);

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_delete_question', 'delete_question');
add_action('wp_ajax_delete_question', 'delete_question');

function delete_question()
{
    $post_id = $_POST['question_id'];
    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    wp_trash_post($post_id);

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_delete_answer', 'delete_answer');
add_action('wp_ajax_delete_answer', 'delete_answer');

function delete_answer()
{
    $comment_id = $_POST['answer_id'];
    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    wp_delete_comment($comment_id);

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_update_email', 'update_email');
add_action('wp_ajax_update_email', 'update_email');

function update_email()
{
    $email = strtolower(sanitize_email($_POST['email']));
    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    if (email_exists($email)) {
        echo wp_json_encode(['status' => false, 'email_exists' => true]);
        wp_die();
    }

    wp_update_user(['ID' => get_current_user_id(), 'user_email' => $email]);

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_flag_question', 'flag_question');
add_action('wp_ajax_flag_question', 'flag_question');

function flag_question()
{
    $question_id = $_POST['question_id'];
    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    wp_update_post(['ID' => $question_id, 'post_status' => 'flagged']);

    echo wp_json_encode(['status' => true]);
    wp_die();
}

add_action('wp_ajax_nopriv_invite_friend', 'invite_friend');
add_action('wp_ajax_invite_friend', 'invite_friend');

function invite_friend()
{
    $emails = json_decode(stripslashes($_POST['emails']));
    $body = $_POST['body'];

    if (!is_user_logged_in()) {
        echo wp_json_encode(['status' => false]);
        wp_die();
    }

    //TODO: Refactor this with a faster and proper solution
    echo wp_json_encode(['status' => true]);

    $url = site_url();
    $html = gt_invite_friend_template($url, $body);
    
    foreach ($emails as $email) {
        wp_mail($email, 'Girl Talk Invite!', $html);
    }
    wp_die();
}