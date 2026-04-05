{{-- ===== Contact Section ===== --}}
<div class="contact-section">
    <div class="container">

        {{-- Header --}}
        <div class="contact-header">
            <div class="contact-header__eyebrow">
                <span class="contact-header__eyebrow-dot"></span>
                Hubungi Kami
            </div>
            <h2 class="contact-header__title">Ada yang bisa <span class="contact-header__title-accent">kami bantu?</span></h2>
            <p class="contact-header__desc">Tim kami siap melayani Anda. Kirim pesan atau hubungi langsung melalui informasi di bawah ini.</p>
        </div>

        <div class="contact-grid">

            {{-- ===== Left: Info Panel ===== --}}
            <div class="contact-info">
                <div class="contact-info__bg-orb contact-info__bg-orb--1"></div>
                <div class="contact-info__bg-orb contact-info__bg-orb--2"></div>
                <div class="contact-info__grid"></div>

                <div class="contact-info__content">
                    <h3 class="contact-info__title">Informasi Kontak</h3>
                    <p class="contact-info__sub">Kami selalu siap membantu kebutuhan kesehatan Anda.</p>

                    <ul class="contact-info__list">
                        <li class="contact-info__item">
                            <span class="contact-info__icon"><i class="fas fa-phone-alt"></i></span>
                            <div>
                                <div class="contact-info__label">Telepon</div>
                                <div class="contact-info__value">+012 345 67890</div>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <span class="contact-info__icon"><i class="fas fa-envelope"></i></span>
                            <div>
                                <div class="contact-info__label">Email</div>
                                <div class="contact-info__value">info@medicare.com</div>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <span class="contact-info__icon"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <div class="contact-info__label">Alamat</div>
                                <div class="contact-info__value">Jl. Kesehatan No. 123,<br>Jakarta, Indonesia</div>
                            </div>
                        </li>
                        <li class="contact-info__item">
                            <span class="contact-info__icon"><i class="fas fa-clock"></i></span>
                            <div>
                                <div class="contact-info__label">Jam Operasional</div>
                                <div class="contact-info__value">Senin – Sabtu: 08.00 – 21.00<br>Minggu: 09.00 – 18.00</div>
                            </div>
                        </li>
                    </ul>

                    <div class="contact-info__socials">
                        <div class="contact-info__socials-label">Ikuti Kami</div>
                        <div class="contact-info__socials-row">
                            <a href="#" class="contact-info__social-btn" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="contact-info__social-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="contact-info__social-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="contact-info__social-btn" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== Right: Form ===== --}}
            <div class="contact-form-wrap">
                <h3 class="contact-form-wrap__title">Kirim Pesan</h3>
                <p class="contact-form-wrap__sub">Isi formulir di bawah ini dan kami akan segera merespons.</p>

                <form class="contact-form">
                    <div class="contact-form__row">
                        <div class="contact-field">
                            <label class="contact-field__label" for="c_name">Nama Lengkap</label>
                            <div class="contact-field__wrap">
                                <span class="contact-field__icon"><i class="fas fa-user"></i></span>
                                <input type="text" id="c_name" class="contact-field__input" placeholder="Nama Anda">
                            </div>
                        </div>
                        <div class="contact-field">
                            <label class="contact-field__label" for="c_email">Alamat Email</label>
                            <div class="contact-field__wrap">
                                <span class="contact-field__icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" id="c_email" class="contact-field__input" placeholder="nama@email.com">
                            </div>
                        </div>
                    </div>

                    <div class="contact-field">
                        <label class="contact-field__label" for="c_subject">Subjek</label>
                        <div class="contact-field__wrap">
                            <span class="contact-field__icon"><i class="fas fa-tag"></i></span>
                            <input type="text" id="c_subject" class="contact-field__input" placeholder="Topik pesan Anda">
                        </div>
                    </div>

                    <div class="contact-field">
                        <label class="contact-field__label" for="c_message">Pesan</label>
                        <div class="contact-field__wrap contact-field__wrap--textarea">
                            <span class="contact-field__icon contact-field__icon--top"><i class="fas fa-comment-alt"></i></span>
                            <textarea id="c_message" class="contact-field__input contact-field__input--textarea" placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="contact-submit-btn">
                        <i class="fas fa-paper-plane me-2"></i>
                        Kirim Pesan
                        <i class="fas fa-arrow-right contact-submit-btn__arrow"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- ===== Google Map ===== --}}
<div class="contact-map">
    <iframe
        class="contact-map__iframe"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
        frameborder="0"
        allowfullscreen=""
        aria-hidden="false"
        tabindex="0">
    </iframe>
</div>