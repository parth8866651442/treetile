<?php include 'header.php'; ?>
<link href="assets/css/contact.css" type="text/css" rel="stylesheet" />

    <section id="con-header">
    <div class="cont_main">
        <div class="row">
            <div class="col-sm-4 logo-none">
                <div class="con-img">
                    <img src="assets/images/logo.svg" />
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="con-add">
                    <h3>Tree Tile LLP</h3>
                    <p><?php echo $fc['address']; ?></p>
                </div>
            </div>
            <div class="col-sm-4 col-xs-6">
                <div class="con-ph">
                    <div class="ph-bx">
                        <img src="assets/images/mail.png" />
                        <p>
                            <?php foreach($email as $e) { ?>
                        <a href="mailto:<?php echo str_replace(' ','',$e); ?>"><?php echo $e; ?></a>
                            <?php } ?>
                        </p>
                    </div>
                    <div class="ph-bx">
                        <img src="assets/images/phone.png" />
                        <p>
                            <?php foreach($mobile as $m) { ?>
                        <a href="tel:<?php echo str_replace(' ','',$m); ?>"><?php echo $m; ?></a><br />
                        <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="wrapper">
    <section id="form-c">
        <div class="form-box">
            <div class="row bg-wh">
                <div class="in-head">
                    <h1>Get in Touch</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="in-form parallax-image js-rellax" data-scroll data-scroll-speed="-1">
                        <form id="formoid" method="post" action="<?php echo SITEURL; ?>code.php" data-scroll data-scroll-speed="2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name*</label>
                                    <input type="text" class="form-control" name="name" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone No.*</label>
                                    <input type="text" class="form-control" name="phone" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail*</label>
                                    <input type="email" class="form-control" name="email" required />
                                </div>
                            </div>

                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Message</label>
                                    <textarea class="form-control" name="message" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="contactForm__button-holder">
                                        <button type="submit" name="submit" value="submit" class="new_btn" id="s_btn">
                                            Send Inquiry
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section id="map">
    <div class="map-bx">
        <div class="row">
            <div class="col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=<?php echo base64_decode($fc['map']); ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>


<?php include 'footer.php'; ?>	        