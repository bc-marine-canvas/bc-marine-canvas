<?php

// phpcs:disable
function add_gf_merge_tags($form) {
?>
  <script type="text/javascript">
    gform.addFilter('gform_merge_tags', 'addGFMergeTags');

    function addGFMergeTags(mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option) {
      mergeTags['other'].tags.unshift({
        tag: '{form notification_email}',
        label: 'Form Notification Email'
      });

      return mergeTags;
    }
  </script>
<?php

  return $form;
}
add_action('gform_admin_pre_render', __NAMESPACE__ . '\\add_gf_merge_tags');

// phpcs:enable
add_filter('gform_replace_merge_tags',
  function ($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
    $merge_tag = '{form_notification_email}';

    if (strpos($text, $merge_tag) === false) {
      return $text;
    }

    $email = get_field('opt_form_notification_email', 'option');
    $text = str_replace($merge_tag, $email, $text);

    return $text;
  },
10, 7);

/**
 * Change the Gravity Forms "submission-in-progress" spinner.
 */
add_filter('gform_ajax_spinner_url',
  function($source, $form) {
    return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAA' .
      'ABAAEAAAIBRAA7';
  },
10, 2);
