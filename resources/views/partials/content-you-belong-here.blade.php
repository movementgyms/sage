<div class="elcap-body">
  <?php
    // get all field groups
    $membership_links_key = '';
    $groups = acf_get_fields('group_609d5d41112bf');
    if( $groups ):

      foreach( $groups as $group ):
        if ($group['label'] === 'Membership Links') {
          $membership_links = $group;
        }

        $fields = $group['sub_fields'];
        $group_name = $group['name'];

        switch($group['label']) {
          case 'Title Group':
            $title = '';
            $title_image = '';
            $paragraph = '';
            $heading = '';
            foreach($fields as $field):
              $name = $field['name'];
              $value = get_field($group_name . '_' . $name);
              if ($name === 'title') {
                $title = $value;
              }
              if ($name === 'title_image') {
                $title_image =  $value;
              }
              if ($name === 'sub_heading') {
                $heading =  $value;
              }
              if ($name === 'community_paragraph') {
                $paragraph =  $value;
              }
            endforeach;
            ?>
              <div class="you-belong-here-title">
                <img
                  class="title-image"
                  alt="title-img"
                  src=<?php echo esc_url($title_image['sizes']['full_width']); ?> />
                <div class="title">
                  <?php echo $title; ?>
                </div>
                <div class="community-message">
                  <div class="community-wrapper content-area">
                    <h2 class="heading">
                      <?php echo $heading; ?>
                    </h2>
                    <div class="paragraph">
                      <?php echo $paragraph; ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            break;
          case 'We Believe Content Area':
            $image = '';
            $heading = '';
            $paragraph = '';
            $link = '';
            foreach($fields as $field):
              $name = $field['name'];
              $value = get_field($group_name . '_' . $name);
              if ($name === 'believe_image') {
                $image =  $value;
              }
              if ($name === 'believe_heading') {
                $heading =  $value;
              }
              if ($name === 'believe_paragraph') {
                $paragraph =  $value;
              }
              if ($name === 'believe_link') {
                $link =  $value;
              }
            endforeach;
            ?>
              <div class="basic-img left we-believe">
                <div class="basic-wrapper content-area">
                  <div class="image-wrapper">
                    <img class="image left" alt="image" src=<?php echo esc_url($image['sizes']['full_width']); ?> />
                  </div>
                  <div class="basic-content left">
                    <h2 class="heading"><?php echo $heading; ?></h2>
                    <p class="paragraph"><?php echo $paragraph; ?></p>
                    <div class="link we-believe">
                      <a href=<?php echo $link['url']; ?>><?php echo $link['title']?></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            break;
          case 'Membership Area':
            $heading_1 = '';
            $heading_2 = '';
            $memberships = '';
            $email_group = '';
            $footer = '';
            $dropdown = '';
            foreach($fields as $field) {
              $name = $field['name'];
              $value = get_field($group_name . '_' . $name);
              if ($name === 'heading_1') {
                $heading_1 =  $value;
              }
              if ($name === 'heading_2') {
                $heading_2 =  $value;
              }
              if ($name === 'memberships') {
                $memberships =  $value;
              }
              if ($name === 'email_group') {
                $email_group =  $value;
              }
              if ($name === 'footer_message') {
                $footer =  $value;
              }
              if ($name === 'membership_dropdown') {
                $dropdown =  $value;
              }
            }
            ?>
              <div class="membership-block">
                <div class="content-area">
                  <h2 class="heading_1">
                    <?php echo $heading_1; ?>
                  </h2>
                  <h3 class="heading_2">
                    <?php echo $heading_2; ?>
                  </h3>
                  <div class="membership-box-group">
                    <?php
                      foreach($memberships as $member):
                      $sub_heading = $member['heading'];
                    ?>
                      <div class="membership-box">
                        <h3 class="heading">
                          <?php echo $sub_heading; ?>
                        </h3>
                        <ul>
                          <?php
                            $list = $member['list'];
                            foreach($list as $list_item):
                          ?>
                            <li class="list-item">
                              <?php echo $list_item['list_item']; ?>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="membership-footer">
                    <div class="email-group">
                      <?php
                        $message = $email_group['message'];
                        $label = $email_group['label'];
                        $email = $email_group['email']
                      ?>
                      <p class="membership-guide">
                        <?php echo $message ?? ''; ?>
                      </p>
                      <a href="mailto:<?php echo $email; ?>" class="email-link">
                        <?php echo $label; ?>
                      </a>
                    </div>
                    <div class="message">
                      <?php echo $footer; ?>
                    </div>
                    <div class="dropdown-container">
                      <div class="dropdown-text">
                        <?php echo $dropdown; ?>
                      </div>
                      <?php
                        $links = get_field('membership_links_links');
                      ?>
                      <div class="dropdown-content">
                        <?php foreach ($links as $link): ?>
                          <ul>
                            <li>
                              <a href=<?php echo $link['link'] ?>>
                                <?php echo $link['city'] ?>
                              </a>
                            </li>
                          </ul>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            break;
          case 'Covid Info':
            $icons = '';
            $heading = '';
            $paragraph = '';
            $covid_link = '';
            foreach($fields as $field) {
              $name = $field['name'];
              $value = get_field($group_name . '_' . $name);
              if ($name === 'covid_icons') {
                $icons =  $value;
              }
              if ($name === 'heading') {
                $heading =  $value;
              }
              if ($name === 'paragraph') {
                $paragraph =  $value;
              }
              if ($name === 'covid_link') {
                $covid_link =  $value;
              }
            }
            ?>
              <div class="covid-info-group">
                <div class="content-area">
                  <div class="covid-content">
                    <h2 class="heading"><?php echo $heading; ?></h2>
                    <p class="paragraph"><?php echo $paragraph; ?></p>
                  </div>
                  <div class="covid-icon-group">
                    <?php foreach($icons as $icon): ?>
                      <div class="covid-icon">
                        <img class="icon" alt="icon" src=<?php echo esc_url($icon['icon']['sizes']['large']); ?> />
                        <p class="subtext">
                          <?php echo $icon['icon_subtext']; ?>
                        </p>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="covid-dropdown">
                    <div class="covid-dropdown-text">
                      <?php echo $covid_link['dropdown']; ?>
                    </div>
                    <div class="covid-dropdown-content">
                      <ul>
                        <?php
                          $list = $covid_link['links'];
                          foreach($list as $linkitem):
                        ?>
                          <li>
                            <a href=<?php echo $linkitem['link'] ?>>
                              <?php echo $linkitem['city'] ?>
                            </a>
                          </li>
                          <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            break;
          case 'Offerings Content':
            $offering = $fields ? $fields[0] : null;

            if ( have_rows($group_name . '_' . $offering['name']) ):
              $index = 0;
              while ( have_rows($group_name . '_' . $offering['name']) ): the_row();
                $image = get_sub_field('offering_image');
                $heading = get_sub_field('offering_heading');
                $link = get_sub_field('offering_link');
                $paragraph = get_sub_field('offering_paragraph');
                $direction = get_sub_field('direction');
                $direction_class = $direction[0] === "right" ? "right" : "left";
                ?>
                  <div class="basic-img">
                    <div class="basic-wrapper content-area <?php echo $direction_class;?>">
                      <div class="image-wrapper">
                        <img class="image <?php echo $direction_class;?> <?php if($index === 0) echo "overlap"; ?>" alt="image" src=<?php echo esc_url($image['sizes']['full_width']); ?> />
                      </div>
                      <div class="basic-content <?php if($index > 0) echo "not-first"; ?> <?php echo $direction_class;?>">
                        <h2 class="heading"><?php echo $heading; ?></h2>
                        <p class="paragraph"><?php echo $paragraph; ?></p>
                        <?php if ($link['link'] !== ''): ?>
                          <div class="link <?php echo $direction_class;?>">
                            <a href=<?php echo $link['link']; ?>>
                              <?php echo $link['label'] ?>
                            </a>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php
                $index++;
              endwhile;
            endif;
            break;
            break;
          case 'Footer Video':
            $footer = $fields[0];

            if ( have_rows($group_name . '_' . $footer['name']) ):
              $index = 0;
              while ( have_rows($group_name . '_' . $footer['name']) ): the_row();
                $image = get_sub_field('image');
                $placeholder = get_sub_field('placeholder');

                ?>
                  <div class="footer">
                    <div class="footer-image" style="background: url(<?php echo esc_url($image['sizes']['full_width']) ?>) 50% 100% / cover;">
                      <?php if ($placeholder && $placeholder['sizes']['full_width'] !== ''): ?>
                        <img alt="play-button" class="play-button" src=<?php echo esc_url($placeholder['sizes']['full_width']) ?> />
                      <?php endif; ?>
                    </div>
                  </div>
                <?php
              endwhile;
            endif;
            break;
          default:
            break;
        }
      endforeach;

    endif; ?>
</div>
