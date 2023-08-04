<?php
$header_background_image = get_field('covid_header_background_image');
$gyms = get_field('gyms');

if (!$gyms) {
  $gyms = [];
}

function break_email($email) {
  return str_replace('@', '&#8203;@', str_replace('.', '&#8203;.', $email));
}

function output_covid_content($content, $gyms) {
  $layout = $content['acf_fc_layout']; ?>

  <?php
    $has_content = false;
    if (!empty($gyms)) {
      foreach ($gyms as $gym) {
        if(!empty($gym['make_reservation_url']) || !empty($gym['reservations_start_date']) || !empty($gym['occupancy_widget_url']) || !empty($gym['setting_schedule_pdf'])) {
          $has_content = true;
        }
      }
    }
  ?>

  <section <?=!empty($content['anchor_id']) ? 'id="' . $content['anchor_id'] . '"' : ''?> class="<?=str_replace('_', '-', $layout)?> section-border-top section-content <?=count($gyms) === 1 && $has_content ? 'single-gym' : ''?>">


    <?php if ($layout === 'two_column_content'): ?>
      <?php if (!empty($content['heading'])): ?>
        <h2><?=$content['heading']?></h2>
      <?php endif;?>
      <div class="main">
        <?php if(!empty($content['left_column_content'])): ?>
          <div><?=$content['left_column_content'];?></div>
        <?php endif; ?>
        <?php if(!empty($content['right_column_content'])): ?>
          <div><?=$content['right_column_content'];?></div>
        <?php endif;?>
      </div>


    <?php elseif($layout === 'make_a_reservation'): ?>
      <?php if (!empty($content['heading'])): ?>
        <h2><?=$content['heading']?></h2>
    <?php endif;?>
        <div class="main">
          <?php if(!empty($content['left_column_content'])): ?>
            <div><?=$content['left_column_content'];?></div>
          <?php endif; ?>
          <?php if(!empty($content['right_column_content'])): ?>
            <div><?=$content['right_column_content'];?></div>
          <?php endif;?>
        </div>

        <ul class="reservations <?=count($gyms) === 1 && $has_content ? 'single-gym' : ''?>">
          <?php foreach ($gyms as $gym): ?>
            <?php if(!empty($gym['make_reservation_url']) || !empty($gym['reservations_start_date']) || !empty($gym['occupancy_widget_url']) || !empty($gym['setting_schedule_pdf'])): ?>
            <li>
              <h3><?=$gym['name']?></h3>
              <?php if (!empty($gym['make_reservation_url'])): ?>
                <div>
                  <a class="reservation-link" href="<?=$gym['make_reservation_url'];?>" target="_blank" rel="noopener">
                    Make Reservation
                    <svg class="covid-arrow-right" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                      viewBox="0 0 29.91 31.74" style="enable-background:new 0 0 29.91 31.74;" xml:space="preserve">
                      <polygon class="st0" points="14.15,1.99 12.74,3.41 24.2,14.87 1.88,14.87 1.88,16.87 24.2,16.87 12.74,28.33 14.15,29.74
                        28.03,15.87 "/>
                    </svg>
                  </a>
                </div>
              <?php elseif(!empty($gym['reservations_start_date'])): ?>
                <p class="reservation-link disabled">Reservations begin<br/><?=$gym['reservations_start_date'];?></p>
              <?php endif;?>

              <?php if (!empty($gym['occupancy_widget_url'])): ?>
                <script type="text/javascript"
                  src="<?=$gym['occupancy_widget_url']?>">
                </script>
              <?php endif;?>

              <?php if (!empty($gym['setting_schedule_pdf'])) :?>
                <div>
                  <a href="<?=$gym['setting_schedule_pdf']?>" target="_blank" rel="noopener">View Setting Schedule (PDF)</a>
                </div>
              <?php endif;?>
            </li>
            <?php endif; ?>
          <?php endforeach;?>
        </ul>
      <div class="trailing-content"><?=$content['trailing_content']?></div>


    <?php elseif($layout === 'one_column_content'): ?>
      <div class="main"><?=$content['content']?></div>
    <?php endif;?>

  </section>
  <?php
}
?>

<div id="primary">
  <section class="heading" style="background-image: url('<?=$header_background_image['sizes']['2048x2048']?>')">
    <div class="uk-container">
      <h1><?=str_replace("\n", '<br/>', get_field('covid_header_title'));?></h1>
      <div class="main">
        <p class="subheading"><?=get_field('covid_header_subheading');?></p>
      </div>
    </div>
  </section>

  <?php if (get_field('covid_hide_gyms') !== true): ?>
  <section class="gyms">
    <div class="container">
      <ul class="gym-list <?=count($gyms) === 1 ? 'single-gym' : ''?>">
        <?php foreach($gyms as $gym): ?>
          <li>
            <div class="gym-square" style="background-image: url('<?=$gym['image']['sizes']['medium']?>')">
              <div class="gym-info">
                <p class="gym-abbreviation" aria-hidden="true"><?=$gym['abbreviation']?></p>
                <h2 class="gym-name"><?=$gym['name']?></h2>
              </div>
            </div>
            <p class="opening-info">
              <strong>Opening Date</strong>
              <br/>
              <?=$gym['opening_date']?>
            </p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <?php endif; ?>

  <?php // The rest of this content is strictly within the container width ?>

  <div class="uk-container">
    <?php
      if (!empty(get_field('covid_header_content'))) {
        foreach(get_field('covid_header_content') as $content) {
          output_covid_content($content, $gyms);
        }
      }
    ?>

    <section class="welcome-home section-border-top section-content">
      <h2><?=get_field('covid_welcome_home_heading')?></h2>
      <ul class="icon-grid">
        <?php foreach(get_field('covid_welcome_home_icons') as $icon): ?>
          <li>
            <img src="<?=$icon['icon']['sizes']['medium']?>" alt="" />
            <p><?=$icon['caption']?></p>
          </li>
        <?php endforeach;?>
      </ul>
    </section>

    <?php
      if (!empty(get_field('covid_content'))) {
        foreach(get_field('covid_content') as $content) {
          output_covid_content($content, $gyms);
        }
      }
    ?>

    <section class="covid-faqs section-border-top section-content">
      <h2><?=get_field('covid_faqs_heading')?></h2>
      <ul class="faq-list">
        <?php foreach(get_field('covid_faqs_faqs') as $faq): ?>
          <li>
            <h3 class="faq-title">
              <span><?=$faq['title'];?></span>
              <i class="icon-plus"></i>
              <i class="icon-minus"></i>
            </h3>
            <div class="faq-content"><?=$faq['content']?></div>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>

    <?php if (!empty($gyma) && count($gyms) > 0): ?>
      <section class="gym-contact-info section-border-top section-content">
        <h2><?=get_field('covid_gym_contact_information_heading');?></h2>
        <ul class="gym-contact-list <?=count($gyms) === 1 ? 'single-gym' : ''?>">
          <?php foreach($gyms as $gym): ?>
            <li>
              <h3><?=$gym['name']?></h3>
              <p><a class="phone" href="tel:<?=$gym['phone_number'];?>"><?=$gym['phone_number'];?></a></p>
              <a href="mailto:<?=$gym['contact_email'];?>"><?=break_email($gym['contact_email']);?></a>
            </li>
          <?php endforeach;?>
        </ul>
      </section>
    <?php endif; ?>

  </div>

</div>

<script>
  jQuery(function() {
    jQuery(document).on('click', '.faq-title', function() {
      jQuery(this).siblings('.faq-content').slideToggle();
      jQuery(this).toggleClass('expanded');
    });
  });
</script>
