<?php

function social_share_menu_item()
{
    add_submenu_page("options-general.php", "Social Share", "Social Share", "manage_options", "social-share", "social_share_page");
}

add_action("admin_menu", "social_share_menu_item");

function social_share_page()
{
    ?>
    <div class="wrap">
        <h1>Social Sharing Options</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields("social_share_config_section");

            do_settings_sections("social-share");

            submit_button();
            ?>
        </form>
    </div>
    <?php
}


function social_share_settings()
{
    add_settings_section("social_share_config_section", "", null, "social-share");

    add_settings_field("social-share-facebook", "Do you want to display Facebook share button?", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-twitter", "Do you want to display Twitter share button?", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-linkedin", "Do you want to display LinkedIn share button?", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-googleplus", "Do you want to display GooglePlus share button?", "social_share_googleplus_checkbox", "social-share", "social_share_config_section");

    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-linkedin");
    register_setting("social_share_config_section", "social-share-googleplus");
}

function social_share_facebook_checkbox()
{
    ?>
    <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Check for Yes
    <?php
}

function social_share_twitter_checkbox()
{
    ?>
    <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Yes
    <?php
}

function social_share_linkedin_checkbox()
{
    ?>
    <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Yes
    <?php
}

function social_share_googleplus_checkbox()
{
    ?>
    <input type="checkbox" name="social-share-googleplus" value="1" <?php checked(1, get_option('social-share-googleplus'), true); ?> /> Check for Yes
    <?php
}

add_action("admin_init", "social_share_settings");



function the_share_buttons()
{
    $html = "<ul class=\"list--reset list--inline list--margin-tiny article__social-icons float-left\">";

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);

    $facebookURL = "http://www.facebook.com/sharer.php?u=" . $url;
    $twitterURL = "https://twitter.com/share?url=" . $url;
    $googleURL = "https://plus.google.com/share?url=" . $url;
    $linkedInURL = "http://www.linkedin.com/shareArticle?url=" . $url;

    if(get_option("social-share-facebook") == 1)
    {
        $html = $html . "<li class=\"list__item\">
                            <a href='". $facebookURL ."'
                            title=\"Facebook\" 
                            target=\"_blank\">
                                <span class=\"icon--facebook-logo-monochrome icon--default icon--color-facebook\"></span>
                            </a>
                          </li>";
    }

    if(get_option("social-share-twitter") == 1)
    {
        $html = $html . "<li class=\"list__item\">
                            <a href='". $twitterURL ."'
                             title=\"Twitter\"
                             target=\"_blank\">
                                <span class=\"icon--twitter-logo-monochrome icon--default icon--color-twitter\"></span>
                             </a>
                         </li>";
    }

    if(get_option("social-share-linkedin") == 1)
    {
        $html = $html . "<li class=\"list__item\">
                            <a href='". $linkedInURL ."'
                             title=\"LinkedIn\"
                              target=\"_blank\">
                              <span class=\"icon--linkedin-logo-monochrome icon--default icon--color-linkedin\"></span>
                            </a>
                         </li>";
    }

    if(get_option("social-share-googleplus") == 1)
    {
        $html = $html . "<li class=\"list__item\">
                            <a href='". $googleURL ."'
                             title=\"Google+\"
                              target=\"_blank\">
                              <span class=\"icon--googleplus-logo-monochrome icon--default icon--color-google-plus\"></span>
                            </a>
                        </li>";
    }

    $html = $html . "</ul>";
    $the_share = $html;

    echo $the_share;

//    return $the_share = $html;
}


