<?php
require_once __DIR__ . '/../admin/socialMedia/publishIconSocialMedia.php';
$iconList = new PublishIconSocialMedia();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<aside class="social-media">
<?php echo $iconList->publish(); ?>
</aside> 