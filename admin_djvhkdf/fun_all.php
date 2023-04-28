<div class="row-fluid">
  <article class="span12 data-block nested">
    <div class="data-container">
      <header>
        <h2>Media Managment</h2>
        <br>
        <br>
        <hr>
      </header>
      <section class="tab-content">
        <div class="tab-pane active" id="newUser">
          <?php
					if ( isset( $_POST[ 'submit_product' ] ) ) {
						unset( $_POST[ 'submit_product' ] );

						$resss = $obj_fun->add_MetaData( 'functionality', $_POST );
						if ( $resss > 0 )
							echo "<script>window.location.href = 'setting.php'</script>";
					}
					?>
          <form class="form-horizontal" method="post" action="#" onSubmit="">
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Video</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="video" <?php echo ($obj_fun->getMetaData('video') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="video" <?php echo ($obj_fun->getMetaData('video') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Our News</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="news-with-one-image-and-detail" <?php echo ($obj_fun->getMetaData('news-with-one-image-and-detail') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="news-with-one-image-and-detail" <?php echo ($obj_fun->getMetaData('news-with-one-image-and-detail') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Exhibition & Event</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="event" <?php echo ($obj_fun->getMetaData('event') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="event" <?php echo ($obj_fun->getMetaData('event') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">News With Video</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="news_video" <?php echo ($obj_fun->getMetaData('news_video') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="news_video" <?php echo ($obj_fun->getMetaData('news_video') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Our Blog</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="blog" <?php echo ($obj_fun->getMetaData('blog') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="blog" <?php echo ($obj_fun->getMetaData('blog') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div style="clear:both;"></div>
            <div class="form-actions" style="border-top:none;"> <br/>
              <input name="submit_product" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
            </div>
          </form>
        </div>
      </section>
    </div>
  </article>
</div>
<div class="row-fluid">
  <article class="span12 data-block nested">
    <div class="data-container">
      <header>
        <h2>Other Pages</h2>
        <br>
        <br>
        <hr>
      </header>
      <section class="tab-content">
        <div class="tab-pane active" id="newUser">
          <form class="form-horizontal" method="post" action="#" onsubmit="">
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Frontend Menu</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="frontmenu" <?php echo ($obj_fun->getMetaData('frontmenu') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="frontmenu" <?php echo ($obj_fun->getMetaData('frontmenu') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Frontend Contact</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="frontcontact" <?php echo ($obj_fun->getMetaData('frontcontact') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="frontcontact" <?php echo ($obj_fun->getMetaData('frontcontact') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Meta Data</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="metadata" <?php echo ($obj_fun->getMetaData('metadata') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="metadata" <?php echo ($obj_fun->getMetaData('metadata') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Analytics</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="analytics" <?php echo ($obj_fun->getMetaData('analytics') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="analytics" <?php echo ($obj_fun->getMetaData('analytics') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Catalogue</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="catalogue" <?php echo ($obj_fun->getMetaData('catalogue') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="catalogue" <?php echo ($obj_fun->getMetaData('catalogue') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 ">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Web Visitor</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="web_visitor" <?php echo ($obj_fun->getMetaData('web_visitor') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="web_visitor" <?php echo ($obj_fun->getMetaData('web_visitor') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Catalogue With Menu</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="cataloguemenu" <?php echo ($obj_fun->getMetaData('cataloguemenu') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="cataloguemenu" <?php echo ($obj_fun->getMetaData('cataloguemenu') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 ">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Export Flags</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="exportFlag" <?php echo ($obj_fun->getMetaData('exportFlag') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="exportFlag" <?php echo ($obj_fun->getMetaData('exportFlag') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Catalogue With Image</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="catalogueimg" <?php echo ($obj_fun->getMetaData('catalogueimg') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="catalogueimg" <?php echo ($obj_fun->getMetaData('catalogueimg') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Whatsapp Counter</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="Whatsapp_display" <?php echo ($obj_fun->getMetaData('Whatsapp_display') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="Whatsapp_display" <?php echo ($obj_fun->getMetaData('Whatsapp_display') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Header Image</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="headerimage" <?php echo ($obj_fun->getMetaData('headerimage') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="headerimage" <?php echo ($obj_fun->getMetaData('headerimage') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            
            <!-------OTPVerification---------------->
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Login With OTP </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="login_otp" <?php echo ($obj_fun->getMetaData('login_otp') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="login_otp" <?php echo ($obj_fun->getMetaData('login_otp') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <!-------OTPVerification---------------->
            
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Other Admin Panel </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="Admin_Panel_Change" <?php echo ($obj_fun->getMetaData('Admin_Panel_Change') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="Admin_Panel_Change" <?php echo ($obj_fun->getMetaData('Admin_Panel_Change') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Ceramic Admin Panel </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="product" <?php echo ($obj_fun->getMetaData('product') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="product" <?php echo ($obj_fun->getMetaData('product') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Slider With Menu & Size </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="slidermenu" <?php echo ($obj_fun->getMetaData('slidermenu') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="slidermenu" <?php echo ($obj_fun->getMetaData('slidermenu') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Slider With Description</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="slidertext" <?php echo ($obj_fun->getMetaData('slidertext') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="slidertext" <?php echo ($obj_fun->getMetaData('slidertext') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Slider URL </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="slider_url" <?php echo ($obj_fun->getMetaData('slider_url') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="slider_url" <?php echo ($obj_fun->getMetaData('slider_url') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            
            <div style="clear:both;"></div>
            <div class="form-actions" style="border-top:none;"> <br>
              <input name="submit_product" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
            </div>
          </form>
        </div>
      </section>
    </div>
  </article>
</div>
<div class="row-fluid">
  <article class="span12 data-block nested">
    <div class="data-container">
      <header>
        <h2>Ceramic Product Details</h2>
        <br>
        <br>
        <hr>
      </header>
      <section class="tab-content">
        <div class="tab-pane active" id="newUser">
          <form class="form-horizontal" method="post" action="#" onsubmit="">
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Product with View</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="product-view" <?php echo ($obj_fun->getMetaData('product-view') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="product-view" <?php echo ($obj_fun->getMetaData('product-view') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Product Scatch</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="product_scatch" <?php echo ($obj_fun->getMetaData('product_scatch') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="product_scatch" <?php echo ($obj_fun->getMetaData('product_scatch') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Menu Logo</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="menulogo" <?php echo ($obj_fun->getMetaData('menulogo') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="menulogo" <?php echo ($obj_fun->getMetaData('menulogo') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">TKD For Menu</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="tkd_menu" <?php echo ($obj_fun->getMetaData('tkd_menu') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="tkd_menu" <?php echo ($obj_fun->getMetaData('tkd_menu') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Size Logo</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="sizelogo" <?php echo ($obj_fun->getMetaData('sizelogo') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="sizelogo" <?php echo ($obj_fun->getMetaData('sizelogo') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">TKD For Size</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="tkd_size" <?php echo ($obj_fun->getMetaData('tkd_size') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="tkd_size" <?php echo ($obj_fun->getMetaData('tkd_size') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Series Logo</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="serieslogo" <?php echo ($obj_fun->getMetaData('serieslogo') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="serieslogo" <?php echo ($obj_fun->getMetaData('serieslogo') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">TKD For Series</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="tkd_series" <?php echo ($obj_fun->getMetaData('tkd_series') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="tkd_series" <?php echo ($obj_fun->getMetaData('tkd_series') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Product Page Catalogue Link</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="catalog_link" <?php echo ($obj_fun->getMetaData('catalog_link') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="catalog_link" <?php echo ($obj_fun->getMetaData('catalog_link') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Product Series No String Length</label>
                  <div class="controls">
                    <input id="series_no_length" name="series_no_length" class="input-xlarge" type="number" maxlength="6" value="<?php echo $obj_fun->getMetaData('series_no_length'); ?>"/>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Ceramic Application</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="ceramic_application" <?php echo ($obj_fun->getMetaData('ceramic_application') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="ceramic_application" <?php echo ($obj_fun->getMetaData('ceramic_application') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Product Inspiration</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="product_inspiration" <?php echo ($obj_fun->getMetaData('product_inspiration') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="product_inspiration" <?php echo ($obj_fun->getMetaData('product_inspiration') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Tiles Color</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="Tiles_Color" <?php echo ($obj_fun->getMetaData('Tiles_Color') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="Tiles_Color" <?php echo ($obj_fun->getMetaData('Tiles_Color') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div style="clear:both;"></div>
            <div class="form-actions" style="border-top:none;"> <br>
              <input name="submit_product" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
            </div>
          </form>
        </div>
      </section>
    </div>
  </article>
</div>
<div class="row-fluid">
  <article class="span12 data-block nested">
    <div class="data-container">
      <header>
        <h2>Light Box</h2>
        <br>
        <br>
        <hr>
      </header>
      <section class="tab-content">
        <div class="tab-pane active" id="newUser">
          <form class="form-horizontal" method="post" action="#" onsubmit="">
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Youtube Video Light Box</label>
                  <div class="controls">
                    <input id="youtube_video_lightbox" name="youtube_video_lightbox" class="input-xlarge" type="text" value="<?php echo $obj_fun->getMetaData('youtube_video_lightbox'); ?>"/>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">LightBox</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="lightboxok" name="lightbox" <?php echo ($obj_fun->getMetaData('lightbox') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                    <input type="radio" value="0" id="lightboxno" name="lightbox" <?php echo ($obj_fun->getMetaData('lightbox') == 0 ? 'checked="checked"' : ''); ?>  />
                    Disabled
                    <div style="float:right"> </div>
                    </label>
                    <?php
                                    $gallary = $obj_fun->getGallery('lightbox');
                                    $i = 0;
                                    foreach ($gallary as $value) {
                                       if(isset($gallary[$i]['thumb']) && $gallary[$i]['thumb'] != ''){ ?>
                    <img id="lightboximagesrc" src="../<?php echo $gallary[$i]['thumb']; ?>" width="40" height="40" alt="No Image" style="float:right;margin:10px 10px;">
                    <?php 
                                        }
                                     $i++;
                                    
                                 } ?>
                    <?php if(!empty($gallary)) { ?>
                    <a class="btn btn-alt btn-large btn-danger"  id="delete_lightbox" style="clear: both">Remove all lightbox Images</a>
                    <?php } ?>
                  </div>
                </div>
              </fieldset>
            </div>
            <div style="clear:both;"></div>
            <div class="form-actions" style="border-top:none;"> <br>
              <input name="submit_product" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
            </div>
          </form>
        </div>
      </section>
    </div>
  </article>
</div>
<div class="row-fluid">
  <article class="span12 data-block nested">
    <div class="data-container">
      <header>
        <h2>Gallery</h2>
        <br>
        <br>
        <hr>
      </header>
      <section class="tab-content">
        <div class="tab-pane active" id="newUser">
          <form class="form-horizontal" method="post" action="#" onsubmit="">
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Slider</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="slider" <?php echo ($obj_fun->getMetaData('slider') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="slider" <?php echo ($obj_fun->getMetaData('slider') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Infrastructure</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="infrastructure" <?php echo ($obj_fun->getMetaData('infrastructure') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="infrastructure" <?php echo ($obj_fun->getMetaData('infrastructure') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Application</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="gallery" <?php echo ($obj_fun->getMetaData('gallery') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="gallery" <?php echo ($obj_fun->getMetaData('gallery') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Advertisement</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="advertisement" <?php echo ($obj_fun->getMetaData('advertisement') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="advertisement" <?php echo ($obj_fun->getMetaData('advertisement') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Showroom</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="showroom" <?php echo ($obj_fun->getMetaData('showroom') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="showroom" <?php echo ($obj_fun->getMetaData('showroom') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Application Icon</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="appicon" <?php echo ($obj_fun->getMetaData('appicon') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="appicon" <?php echo ($obj_fun->getMetaData('appicon') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div style="clear:both;"></div>
            <div class="form-actions" style="border-top:none;"> <br>
              <input name="submit_product" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
            </div>
          </form>
        </div>
      </section>
    </div>
  </article>
</div>
<div class="row-fluid">
  <article class="span12 data-block nested">
    <div class="data-container">
      <header>
        <h2>Inquiry Managment</h2>
        <br>
        <br>
        <hr>
      </header>
      <section class="tab-content">
        <div class="tab-pane active" id="newUser">
          <form class="form-horizontal" method="post" action="#" onsubmit="">
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Product Inquiry</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="product-inquiry" <?php echo ($obj_fun->getMetaData('product-inquiry') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="product-inquiry" <?php echo ($obj_fun->getMetaData('product-inquiry') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Contact Inquiry</label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1 ">
                      <input type="radio" value="1" id="yes" name="contact" <?php echo ($obj_fun->getMetaData('contact') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="contact" <?php echo ($obj_fun->getMetaData('contact') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6 mrg-lft-0">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Register Inquiry </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="register_inquiry" <?php echo ($obj_fun->getMetaData('register_inquiry') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="register_inquiry" <?php echo ($obj_fun->getMetaData('register_inquiry') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="span6">
              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="input">Career Inquiry </label>
                  <div class="controls mrg-tp-8">
                    <label class="radio radio1">
                      <input type="radio" value="1" id="yes" name="career" <?php echo ($obj_fun->getMetaData('career') == 1 ? 'checked="checked"' : ''); ?> >
                      Enable </label>
                    <label class="radio">
                      <input type="radio" value="0" id="no" name="career" <?php echo ($obj_fun->getMetaData('career') == 0 ? 'checked="checked"' : ''); ?>  />
                      Disabled </label>
                  </div>
                </div>
              </fieldset>
            </div>
            <div style="clear:both;"></div>
            <div class="form-actions" style="border-top:none;"> <br>
              <input name="submit_product" class="btn btn-alt btn-large btn-primary" type="submit" value="Update">
            </div>
          </form>
        </div>
      </section>
    </div>
  </article>
</div>
